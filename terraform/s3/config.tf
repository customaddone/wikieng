provider "aws" {
   region = "ap-northeast-1"
}

terraform {
  backend "s3" {
    bucket = "customaddone-private"
    key    = "sample/s3/terraform.tfstate"
    region = "ap-northeast-1"
  }
}
