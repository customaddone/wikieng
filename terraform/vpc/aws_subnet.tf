# VPCをさらに分割し、サブネットを作成します
# 複数のアベイラビリティーゾーンにサブネットを作成します
# 1つのアベイラビリティーゾーンが消滅しても引き続き使えるようになる
resource "aws_subnet" "public_0" {
  vpc_id                  = aws_vpc.example.id

  # 10.0.1.0〜10.0.1.255まで使えるよ
  cidr_block              = "10.0.1.0/24"
  availability_zone       = "ap-northeast-1a"

  #パブリックIPアドレスを自動的に割り当ててくれる
  map_public_ip_on_launch = true
}

resource "aws_subnet" "public_1" {
  vpc_id                  = aws_vpc.example.id
  cidr_block              = "10.0.2.0/24"
  availability_zone       = "ap-northeast-1c"
  map_public_ip_on_launch = true
}



# DBなど外からアクセスされたくないサービスのため
resource "aws_subnet" "private_0" {
  vpc_id                  = aws_vpc.example.id
  cidr_block              = "10.0.65.0/24"
  availability_zone       = "ap-northeast-1a"
  map_public_ip_on_launch = false
}

resource "aws_subnet" "private_1" {
  vpc_id                  = aws_vpc.example.id
  cidr_block              = "10.0.66.0/24"
  availability_zone       = "ap-northeast-1c"
  map_public_ip_on_launch = false
}



output "public_0_id" {
  value = aws_subnet.public_0.id
}

output "public_1_id" {
  value = aws_subnet.public_1.id
}

output "private_0_id" {
  value = aws_subnet.private_0.id
}

output "private_1_id" {
  value = aws_subnet.private_1.id
}
