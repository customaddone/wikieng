# terraformの各コードの保存用
# 外部公開しないプライベートバケット
resource "aws_s3_bucket" "private" {
  bucket = "customaddone-private"

  # versioningの設定を有効にすると、オブジェクトを変更、削除してもいつでも戻れる
  versioning {
    enabled = true
  }

  # 暗号化
  server_side_encryption_configuration {
    rule {
      apply_server_side_encryption_by_default {
        sse_algorithm = "AES256"
      }
    }
  }
}

# 外部公開用
resource "aws_s3_bucket" "public" {
  bucket = "customaddone-public"
  # アクセス権はaclで設定します
  # public-readでインターネットからの読み込みを可能にしている
  acl    = "public-read"

  # クロスオリジン可能
  cors_rule {
    allowed_origins = ["https://example.com"]
    allowed_methods = ["GET"]
    allowed_headers = ["*"]
    max_age_seconds = 3000
  }
}
