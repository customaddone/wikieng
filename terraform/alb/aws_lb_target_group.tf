# ALBがリクエストを飛ばす対象をターゲットグループと言う
# このターゲットグループはECSサービスと関連付けます
resource "aws_lb_target_group" "example" {
  name                 = "example"
  # ターゲットの種類
  # ターゲットにipを指定した場合は以下も書いてね
  vpc_id               = data.terraform_remote_state.vpc.outputs.example_id
  port                 = 80
  protocol             = "HTTP"

  deregistration_delay = 300

  #正常/異常判定を行う
  health_check {
    port                = 80
  }
  # ロードバランサーとターゲットグループとECSサービスを同時に作成するとエラーになります
  depends_on = [aws_lb.example]
}

# ターゲットグループにリクエストを飛ばすリスナールールを作成します
resource "aws_lb_listener_rule" "example" {
  listener_arn = aws_lb_listener.https.arn
  priority     = 100

  #フォワード先のターゲットグループを設定します
  action {
    type             = "forward"
    target_group_arn = aws_lb_target_group.example.arn
  }

  condition {
    field  = "path-pattern"
    values = ["/*"]
  }
}

output "lb_target_group_arn" {
  value = aws_lb_target_group.example.arn
}
