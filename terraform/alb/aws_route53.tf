#route53で独自ドメインを利用できるようになります
#route53を束ねるホストゾーンを設定
data "aws_route53_zone" "example" {
  name = "wikiforlearningenglish.com"
}

#DNSレコード
#設定したドメインでALBへとアクセスできるようになります
resource "aws_route53_record" "example" {
  zone_id = data.aws_route53_zone.example.zone_id
  name    = data.aws_route53_zone.example.name
  # DNSレコードタイプ
  type    = "A"

  alias {
    name                   = aws_lb.example.dns_name
    zone_id                = aws_lb.example.zone_id
    evaluate_target_health = true
  }
}



output "domain_name" {
  value = aws_route53_record.example.name
}
