resource "aws_ecr_repository" "example" {
  name = "example"
}

resource "aws_ecr_repository" "app" {
  name = "app"
}
