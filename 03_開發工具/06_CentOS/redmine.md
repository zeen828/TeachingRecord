[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
屁話一段

## **Teaching & Examples [教學&範例]**
實作範例期望每個人照步驟都可以有一個成功範例

# 安裝套件
```bash
sudo yum install curl gpg gcc gcc-c++ make patch autoconf automake bison libffi-devel libtool
sudo yum install readline-devel sqlite-devel zlib-devel openssl-develh readline glibc-headers glibc-devel
sudo yum install mariadb-devel zlib libyaml-devel bzip2 iconv-devel ImageMagick ImageMagick-devel
```

# 安裝資料庫
```bash
sudo yum install mariadb-server
sudo systemctl start mariadb
sudo systemctl enable mariadb
sudo systemctl status mariadb
sudo mysql_secure_installation
# Do you want to set up the root user password?
# Do you want to remove anonymous user accounts?
# Do you want to restrict root user access to the local machine?
# Do you want to remove the test database?
# Answer with Y (yes) to all these questions.
```


## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
