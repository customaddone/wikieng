#http用に80番ポートを許可
module "http_sg" {
  source      = "./aws_security_group"
  name        = "http-sg"
  vpc_id      = data.terraform_remote_state.vpc.outputs.example_id
  port        = 80
  cidr_blocks = ["0.0.0.0/0"]
}

#http用に443番ポートを許可
module "https_sg" {
  source      = "./aws_security_group"
  name        = "https-sg"
  vpc_id      = data.terraform_remote_state.vpc.outputs.example_id
  port        = 443
  cidr_blocks = ["0.0.0.0/0"]
}

#http→https用に8080番ポートを許可
module "http_redirect_sg" {
  source      = "./aws_security_group"
  name        = "http-redirect-sg"
  vpc_id      = data.terraform_remote_state.vpc.outputs.example_id
  port        = 8080
  cidr_blocks = ["0.0.0.0/0"]
}
