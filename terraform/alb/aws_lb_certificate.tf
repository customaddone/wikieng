#HTTPS化するために必要なSSL
#SSL証明書を発行
resource "aws_acm_certificate" "example" {
  domain_name               = aws_route53_record.example.name
  subject_alternative_names = []
  # ドメインの所有権の検証方法
  validation_method         = "DNS"

  lifecycle {
    # 新しいSSL証明書を作ってから、古いSSLと差し替える
    create_before_destroy = true
  }
}

#DNS用のSSL
resource "aws_route53_record" "example_certificate" {
  name    = aws_acm_certificate.example.domain_validation_options[0].resource_record_name
  type    = aws_acm_certificate.example.domain_validation_options[0].resource_record_type
  records = [aws_acm_certificate.example.domain_validation_options[0].resource_record_value]
  zone_id = data.aws_route53_zone.example.id
  ttl     = 60
}

#apply時にSSL発行証の検証が完了するまで待ってくれる
resource "aws_acm_certificate_validation" "example" {
  certificate_arn         = aws_acm_certificate.example.arn
  validation_record_fqdns = [aws_route53_record.example_certificate.fqdn]
}
