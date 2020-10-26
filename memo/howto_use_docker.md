# コンテナの作成(80番ポートをフォワーディング､コンテナ名指定､ホストのディレクトリをマウント)
`$ docker run -d -it -p 80:80 --name php_exp -v {ホストのフルパス}:/var/www/html ubuntu:20.04 /bin/bash --login`

# コンテナの起動
`$ docker start php_exp`

# コンテナの稼働状況確認
`$ docker ps`

# コンテナのシェルにログイン
`$ docker exec -it php_exp bash`