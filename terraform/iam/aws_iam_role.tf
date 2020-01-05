#ecs-task用
data "template_file" "task-role-template" {
  template = file("./task_role.json")
}

resource "aws_iam_role" "task-role" {
  name               = "ecsTaskExecutionRole"
  assume_role_policy = data.template_file.task-role-template.rendered
}

resource "aws_iam_role_policy_attachment" "task-role-attachment" {
  role       = "${aws_iam_role.task-role.name}"
  policy_arn = "arn:aws:iam::aws:policy/service-role/AmazonECSTaskExecutionRolePolicy"
}



#ec2用
resource "aws_iam_role" "ecs_instance_role" {
  name = "ecs_instance_role"
  path = "/"
  assume_role_policy = file("./ec2_assume_role_policy.json")
}

resource "aws_iam_instance_profile" "ecs_instance_profile" {
  name = "ecs-instance-profile"
  role = aws_iam_role.ecs_instance_role.name
}



#ecs用
resource "aws_iam_policy" "ecs_instance_policy" {
  name        = "ecs-instance-policy"
  path        = "/"
  description = ""
  policy      = data.aws_iam_policy_document.ecs.json
}

resource "aws_iam_role_policy_attachment" "ecs_instance_role_attach" {
  role = aws_iam_role.ecs_instance_role.name
  policy_arn = aws_iam_policy.ecs_instance_policy.arn
}



output "ecs_role_arn" {
  value = aws_iam_role.task-role.arn
}

output "ecs_instance_profile_name" {
  value = aws_iam_instance_profile.ecs_instance_profile.name
}
