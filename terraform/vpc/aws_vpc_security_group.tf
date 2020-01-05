#AWSのファイアウォールには、サブネット単位で動く「ネットワークACL」と
#インスタンスレベルで動く「セキュリティグループ」がある
#セキュリティグループ本体です EC2とかに使える
resource "aws_security_group" "example" {
  name   = "example"
  vpc_id = aws_vpc.example.id
}

#HTTPで通信できるよう80番ポートを許可
module "example_sg" {
  source      = "./aws_security_group"
  name        = "module-sg"
  vpc_id      = aws_vpc.example.id
  port        = 80
  cidr_blocks = ["0.0.0.0/0"]
}
