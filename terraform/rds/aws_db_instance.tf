resource "aws_db_instance" "example" {
  identifier                 = "example"
  engine                     = "mysql"
  engine_version             = "5.7.25"
  instance_class             = "db.t3.small"
  allocated_storage          = 20
  max_allocated_storage      = 100
  storage_type               = "gp2"
  storage_encrypted          = true
  name                       = "wikieng"
  username                   = "root"
  password                   = "topsecret"
  multi_az                   = true
  publicly_accessible        = false
  backup_window              = "09:10-09:40"
  backup_retention_period    = 30
  maintenance_window         = "mon:10:10-mon:10:40"
  auto_minor_version_upgrade = false
  skip_final_snapshot        = false
  port                       = 3306
  apply_immediately          = false
  vpc_security_group_ids     = [module.mysql_sg.security_group_id]
  parameter_group_name       = aws_db_parameter_group.example.name
  option_group_name          = aws_db_option_group.example.name
  db_subnet_group_name       = aws_db_subnet_group.example.name

  lifecycle {
    ignore_changes = [password]
  }
}

module "mysql_sg" {
  source      = "./aws_db_module"
  name        = "mysql-sg"
  vpc_id      = data.terraform_remote_state.vpc.outputs.example_id
  port        = 3306
  cidr_blocks = [data.terraform_remote_state.vpc.outputs.cidr_block]
}

data "terraform_remote_state" "vpc" {
  backend = "s3"
  config = {
    bucket = "customaddone-private"
    key    = "sample/vpc/terraform.tfstate"
    region = "ap-northeast-1"
  }
}
