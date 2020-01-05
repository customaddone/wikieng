provider "aws" {
   region = "ap-northeast-1"
}

terraform {
  backend "s3" {
    bucket = "customaddone-private"
    key    = "sample/iam/terraform.tfstate"
    region = "ap-northeast-1"
  }
}
