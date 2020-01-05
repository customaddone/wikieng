#コンテナオーケストレーション
#ホストサーバーを束ねるECSクラスタ、コンテナの実行単位となるタスク、コンテナを長時間稼働させるECSサービス
#clusterは名前を指定するだけ
data "template_file" "user_data" {
  template = file("./user_data.tpl")
}

#セキュリティグループ
module "aws_security_group" {
  source      = "./aws_security_group"
  name        = "aws_security_group"
  vpc_id      = data.terraform_remote_state.vpc.outputs.example_id
  port        = 80
  cidr_blocks = ["10.0.0.0/16"]
}

resource "aws_instance" "sample" {
  ami                         = "ami-05b296a384694dfa4"
  instance_type               = "t2.small"
  monitoring                  = true
  iam_instance_profile        = data.terraform_remote_state.iam.outputs.ecs_instance_profile_name
  subnet_id                   = data.terraform_remote_state.vpc.outputs.private_0_id
  user_data                   = data.template_file.user_data.rendered
  associate_public_ip_address = true

  vpc_security_group_ids = [
    module.aws_security_group.security_group_id
  ]

  root_block_device {
    volume_size = "20"
    volume_type = "gp2"
  }
}

data "terraform_remote_state" "vpc" {
  backend = "s3"
  config = {
    bucket = "customaddone-private"
    key    = "sample/vpc/terraform.tfstate"
    region = "ap-northeast-1"
  }
}

data "terraform_remote_state" "iam" {
  backend = "s3"
  config = {
    bucket = "customaddone-private"
    key    = "sample/iam/terraform.tfstate"
    region = "ap-northeast-1"
  }
}
