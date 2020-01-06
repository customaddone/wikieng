# ALBはAWSが提供するロードバランサーです
# HTTPSでアクセスできるよう設定します
resource "aws_lb" "example" {
  # 名前はnameで設定します
  name                       = "example"
  # 種別はload_balancer_typeで設定します
  load_balancer_type         = "application"
  # ALBがインターネット向けなのかVPC内部向けなのか
  internal                   = false
  idle_timeout               = 60
  # 削除保護
  #enable_deletion_protection = true

  subnets = [
    data.terraform_remote_state.vpc.outputs.public_0_id,
    data.terraform_remote_state.vpc.outputs.public_1_id,
  ]

  access_logs {
    bucket  = data.terraform_remote_state.s3.outputs.artifact_id
    enabled = true
  }

  security_groups = [
    module.http_sg.security_group_id,
    module.https_sg.security_group_id,
    module.http_redirect_sg.security_group_id
  ]
}


output "alb_dns_name" {
  value = aws_lb.example.dns_name
}



data "terraform_remote_state" "vpc" {
  backend = "s3"
  config = {
    bucket = "customaddone-private"
    key    = "sample/vpc/terraform.tfstate"
    region = "ap-northeast-1"
  }
}

data "terraform_remote_state" "s3" {
  backend = "s3"
  config = {
    bucket = "customaddone-private"
    key    = "sample/s3/terraform.tfstate"
    region = "ap-northeast-1"
  }
}
