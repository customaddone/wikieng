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

module "aws_security_group_ssh" {
  source      = "./aws_security_group"
  name        = "aws_security_group_ssh"
  vpc_id      = data.terraform_remote_state.vpc.outputs.example_id
  port        = 22
  cidr_blocks = ["0.0.0.0/0"]
}

resource "aws_instance" "sample" {
  ami                         = "ami-05b296a384694dfa4"
  instance_type               = "t2.small"
  monitoring                  = true
  iam_instance_profile        = data.terraform_remote_state.iam.outputs.ecs_instance_profile_name
  subnet_id                   = data.terraform_remote_state.vpc.outputs.private_0_id
  user_data                   = data.template_file.user_data.rendered
  associate_public_ip_address = true
  key_name = aws_key_pair.rdskey.key_name

  vpc_security_group_ids = [
    module.aws_security_group.security_group_id,
    module.aws_security_group_ssh.security_group_id
  ]

  root_block_device {
    volume_size = "20"
    volume_type = "gp2"
  }
}

resource "aws_key_pair" "rdskey" {
  key_name = "rdskey"
  public_key = "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDB+jaHRY/nfP6KSpQEpzdimTQQDifBjemivLZzxbc6TetV3Y3zt0KgffJ7nY/KjkAIblmt67toK5cih7XbOf6poWKvuc1KF9/+N4vM18MZ8Q+TK4DylYq52pVDQLvyW76CHlbkFytcTbGQpD6CKP21ZYUyO6HeYl99x81vRc1g41dzfQnGWS2bouoOVNFWw4dH9fBTJjkiP78D13hD1iJvzwOJGXR3UenconIMBly/9w9DnvqeJiVkJd00SpCheRt92XAkwts9kOF9lg/fUBsWSx79E0jHAwjdofJGhhnRqIWp6o/2099QprrKi1bPQ+W/qcqPQnZy9WWrUccCHSBl"
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
