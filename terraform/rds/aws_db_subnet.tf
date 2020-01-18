resource "aws_db_subnet_group" "example" {
  name       = "example"
  subnet_ids = [
    data.terraform_remote_state.vpc.outputs.private_0_id,
    data.terraform_remote_state.vpc.outputs.private_1_id,
  ]
}
