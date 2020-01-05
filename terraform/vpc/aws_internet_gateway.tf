# VPCは隔絶されたネットワークであり、単体ではインターネットと接続出来ません
# インターネットゲートウェイを作成し、VPCとインターネットの間で通信ができるように
resource "aws_internet_gateway" "example" {
  vpc_id = aws_vpc.example.id
}



# インターネットゲートウェイだけではまだインターネットと通信できません
# ネットワークにデータを流すためにルーティング情報を管理するルートテーブルが必要です
resource "aws_route_table" "public_0" {
  vpc_id = aws_vpc.example.id
}

resource "aws_route_table" "public_1" {
  vpc_id = aws_vpc.example.id
}

# private用はインターネットゲートウェイに繋ぐ必要なし
resource "aws_route_table" "private_0" {
  vpc_id = aws_vpc.example.id
}

resource "aws_route_table" "private_1" {
  vpc_id = aws_vpc.example.id
}

# ルートは、ルートテーブルの１レコードに該当します
resource "aws_route" "public_0" {
  route_table_id         = aws_route_table.public_0.id
  gateway_id             = aws_internet_gateway.example.id
  destination_cidr_block = "0.0.0.0/0"
}

resource "aws_route" "public_1" {
  route_table_id         = aws_route_table.public_1.id
  gateway_id             = aws_internet_gateway.example.id
  destination_cidr_block = "0.0.0.0/0"
}

resource "aws_route" "private_0" {
  route_table_id         = aws_route_table.private_0.id
  nat_gateway_id         = aws_nat_gateway.nat_gateway_0.id
  destination_cidr_block = "0.0.0.0/0"
}

resource "aws_route" "private_1" {
  route_table_id         = aws_route_table.private_1.id
  nat_gateway_id         = aws_nat_gateway.nat_gateway_1.id
  destination_cidr_block = "0.0.0.0/0"
}



# どのルートテーブルを利用するかはサブネット単位で決めます
# ルートテーブルとサブネットを紐付けます
resource "aws_route_table_association" "public_0" {
  subnet_id      = aws_subnet.public_0.id
  route_table_id = aws_route_table.public_1.id
}

resource "aws_route_table_association" "public_1" {
  subnet_id      = aws_subnet.public_1.id
  route_table_id = aws_route_table.public_1.id
}

resource "aws_route_table_association" "private_0" {
  subnet_id      = aws_subnet.private_0.id
  route_table_id = aws_route_table.private_0.id
}

resource "aws_route_table_association" "private_1" {
  subnet_id      = aws_subnet.private_1.id
  route_table_id = aws_route_table.private_1.id
}
