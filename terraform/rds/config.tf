provider "aws" {
   region = "ap-northeast-1"
}

terraform {
  backend "s3" {
    bucket = "customaddone-private"
    key    = "sample/rds/terraform.tfstate"
    region = "ap-northeast-1"
  }
}
