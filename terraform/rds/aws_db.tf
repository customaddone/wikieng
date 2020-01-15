module "rds" {
  source = "./aws_db_module"
  name = "example"

  vpc_id     = data.terraform_remote_state.vpc.outputs.example_id
  subnet_ids = [
    data.terraform_remote_state.vpc.outputs.private_0_id,
    data.terraform_remote_state.vpc.outputs.private_1_id,
  ]

  database_name   = "wikieng"
  master_username = "root"
  master_password = "topsecret"
}

data "terraform_remote_state" "vpc" {
  backend = "s3"
  config = {
    bucket = "customaddone-private"
    key    = "sample/vpc/terraform.tfstate"
    region = "ap-northeast-1"
  }
}
