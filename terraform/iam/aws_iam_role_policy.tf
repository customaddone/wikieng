# AWSでは、あるサービスから別のサービスを操作する際に、権限が必要になります
# 権限はポリシーで指定します
# ポリシーでは「実行可能なアクション」や「操作可能なリソース」を指定でき、柔軟に権限を設定できます
data "aws_iam_policy_document" "ecs" {
  statement {
    # effect AllowかDenyか
    effect    = "Allow"
    # なんのサービスで、どんな操作が実行できるか
    actions   = [
      "ecs:CreateCluster",
      "ecs:DeregisterContainerInstance",
      "ecs:DiscoverPollEndpoint",
      "ecs:Poll",
      "ecs:RegisterContainerInstance",
      "ecs:StartTelemetrySession",
      "ecs:UpdateContainerInstancesState",
      "ecs:Submit*",
      "ecr:GetAuthorizationToken",
      "ecr:BatchCheckLayerAvailability",
      "ecr:GetDownloadUrlForLayer",
      "ecr:BatchGetImage",
      "logs:CreateLogStream",
      "logs:PutLogEvents"
    ]
    # なんのリソースを利用できるか
    resources = ["*"]
  }
}
