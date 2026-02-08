[回上層目錄](../README.md)

# 環境部署

## **Description [描述]**
GCP上發佈laradock。更新日期2023/12/14

## **Teaching & Examples [教學&範例]**

# CentOS 7 安裝 Docker
```bash
# 更新yum套件工具
sudo yum update -y

# 檢查是否安裝了Docker
ps -ef |grep docker


# 擴充yum套件
sudo yum install -y yum-utils

# 添加yum安裝倉庫
sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo


# 安裝Docker
sudo yum install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# 啟動Docker服務
sudo systemctl start docker
sudo systemctl enable docker

# 查看Docker版本
docker -v
# Docker version 24.0.7, build afdd53b
sudo docker version

# 忘了做啥
# sudo yum install /path/to/package.rpm

# 測試Docker
sudo docker run hello-world

# 好像是單獨啟用nginx在研究
# sudo docker run -d -p 80:80 --name webserver nginx
```

# CentOS 7 安裝 Docker Compose
```bash
# 下載執行檔
sudo curl -L "https://github.com/docker/compose/releases/download/1.27.4/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

# 設定權限
sudo chmod +x /usr/local/bin/docker-compose

# 建立軟連結
sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose

# 查看Docker Compose版本
docker-compose -v
# docker-compose version 1.27.4, build 40524192
```

# Git安裝
```bash
sudo yum install -y git
git --version
```

# 指令
```bash
# linux查目錄容量
du -sh * 

# Vim 複製大篇幅教學
光標滑到要複製的起點按v
光標滑到要複製的結尾按y
光標滑到要貼上的地方按p
```

## ----切換成root---- ##

# 安裝Laradock
```bash
# 從 GitHub 上將 Laradock 下載下來
git clone https://github.com/Laradock/laradock.git Laradock

# 複製範本 env-example 檔作為設定檔
cd Laradock && cp .env.example .env

# 2024-05-13建立加密貨幣專案設定
PHP_VERSION=8.2

MYSQL_VERSION=8.0
# 這個port可能被佔用，所以調整成別的
MYSQL_PORT=33066

# 修改 .env 檔的 APP_CODE_PATH_HOST 參數到指定的映射路徑
#APP_CODE_PATH_HOST=/var/www

#APP_CODE_PATH_HOST:         設定Laravel專案要放在local的哪個path
#APP_CODE_PATH_CONTAINER:    設定專案要同步到container中的哪個path
#DATA_PATH_HOST:             設定db, redis資料要放在哪個path
# DATA_PATH_HOST=/data/.laradock/data


# 使用 docker-compose 啟動 Laradock
cd Laradock
sudo systemctl start docker
docker-compose up -d nginx mysql redis workspace phpmyadmin
docker-compose up -d nginx mysql redis workspace phpmyadmin redis-webui swagger-ui swagger-editor mosquitto
# PS:如果無法正常啟動，上次是遇到docker-compose版本問題安裝到1.23
# 另外開PHP版本
docker-compose exec workspace bash
docker-compose exec workspace-74 bash
docker-compose exec workspace-82 bash

# 重開OS後要先執行
sudo service docker start
```


### docker指令
```bash
# 查容器
docker ps -a
docker exec -it <Container ID> bash
docker exec -it 59df4c9852a0 bash
```


### docker-compose指令
```bash
# 停止容器運作
docker-compose stop
# 停止容器運作外加上移除容器
docker-compose down
# 重啟Nginx服務
docker-compose restart nginx
# 重啟Redis服務
docker-compose restart redis
# 查看Nginx紀錄
docker-compose logs nginx
# 查看Nginx即時紀錄
docker-compose logs -f nginx
# 進入jenkins容器(工作區/var/jenkins_home/workspace)
docker-compose exec jenkins bash
# 進入workspace容器
docker-compose exec workspace bash
# 查容器
docker-compose ps
```

### phpMyAdmin
http://34.18.26.112:8081/


### 丟丟
```bash
```

### 丟丟Web
#### 原始碼管理
http://122.116.21.111:30000/frontend/throwthrow-web.git
*/v2

#### 建置環境
Provide Node & npm bin/ folder to PATH

#### 建置
執行shell
```bash
FOLDER=diudiu_api

rm $FOLDER*

tar cvfz $FOLDER.tgz ./*

cat << EOF > $FOLDER.sh

tar xvfz $FOLDER.tgz -C /data/temp/api/

rsync -r /data/temp/api/ /data/diudiu-api/

chmod -R 775 /data/diudiu-api/storage || exit 0

EOF
```

```bash
# 安裝yarn套件
npm install -g yarn --registry=https://registry.npm.taobao.org
# 設定.env
cat << EOF > .env
DIUDIU_ENV=test
PROD_URL=https://tsapi.ddiudiu.com/
PROD_WEB_UEL=https://ts.ddiudiu.com/
EOF
# 安裝套件
yarn install
# 發布
yarn build
# 產生發布檔案
yarn generate

# dist

FOLDER=diudiu_web
cd dist
tar cvfz $FOLDER.tgz ./*
cd ..

mv dist/$FOLDER.tgz ./

cat << EOF > $FOLDER.sh

tar xvfz $FOLDER.tgz -C /data/diudiu-web/dist/ || exit 1

EOF
```

#### 建置後動作

# 酷奇鐵克用
```bash
# 拉api程式
git clone http://122.116.21.111:30000/backend/throwthrow-api.git diudiu-api
git checkout -b dev origin/dev
# sudo chown root:google-sudoers -R diudiu-api/
sudo chown cookietag:google-sudoers -R diudiu-api/
cd diudiu-api
sudo chmod -R 775 storage
git branch -r
git checkout -b develop origin/develop

diudiu
xN5a494uCxtjiEoE

mkdir temp
cd temp
mkdir api
sudo chown cookietag:google-sudoers -R /data/temp

# 進入docker workspace
docker ps -a
docker exec -it <Container ID> bash

# laravel安裝
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed

# 回原始服務器安裝node.js
sudo yum -y install curl
curl -sL https://rpm.nodesource.com/setup_14.x | sudo bash -
sudo yum install -y nodejs
node -v
# 要安裝14.x版本

# 回原始服務器安裝yarn
curl --silent --location https://dl.yarnpkg.com/rpm/yarn.repo | sudo tee /etc/yum.repos.d/yarn.repo
sudo rpm --import https://dl.yarnpkg.com/rpm/pubkey.gpg
sudo yum install yarn
yarn --version
# 1.22.18

# 拉web程式
git clone http://122.116.21.111:30000/frontend/throwthrow-web.git diudiu-web
sudo chown root:google-sudoers -R diudiu-web/
cd diudiu-web

git branch -r
# git checkout v2-new-route
# git checkout origin/feature/v2-new-route
git checkout -b v2 origin/v2

# 設定api網址
vi nuxt.config.js
# baseUrl: process.env.DIUDIU_ENV == 'prod' ? 'https://aeapi.ddiudiu.com/' : 'https://v1api.ddiudiu.com/',
yarn install
# 發布
yarn build
# 產生發布檔案
yarn generate

# api的nginx配置
# vi aeapi.diudiu.com.conf
server {
    listen 80;
    server_name aeapi.ddiudiu.com;
    return 301 https://aeapi.ddiudiu.com$request_uri;
}

server {

    # listen 80;
    # listen [::]:80;

    # For https
    listen 443 ssl;
    # listen [::]:443 ssl ipv6only=on;
    ssl_certificate /etc/nginx/ssl/diudiu.com.root.crt;
    ssl_certificate_key /etc/nginx/ssl/diudiu.com.key;

    server_name aeapi.ddiudiu.com;
    root /var/www/diudiu-api/public;
    index index.php index.html index.htm;

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_pass php-upstream;
        fastcgi_index index.php;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #fixes timeouts
        fastcgi_read_timeout 600;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    location /.well-known/acme-challenge/ {
        root /var/www/letsencrypt/;
        log_not_found off;
    }

    error_log /var/log/nginx/aeapi_diudiu_com_error.log;
    access_log /var/log/nginx/aeapi_diudiu_com_access.log;
}

# vue的nginx配置
# vi ae.diudiu.com.conf
server {
    listen 80;
    server_name ae.ddiudiu.com;
    return 301 https://ae.ddiudiu.com$request_uri;
}

server {

    # listen 80;
    # listen [::]:80;

    # For https
    listen 443 ssl;
    # listen [::]:443 ssl ipv6only=on;
    ssl_certificate /etc/nginx/ssl/diudiu.com.root.crt;
    ssl_certificate_key /etc/nginx/ssl/diudiu.com.key;

    server_name ae.ddiudiu.com;
    root /var/www/diudiu-web/dist;
    index index.html index.htm;

    location / {
        # 需要指向下面的 @router，否則 Vue 的路由在 Nginx 中刷新會報 404
        try_files $uri $uri/ @router;
        index index.html;
    }

    # 對應上面的 @router
    # 主要原因是路由的路徑資源並不是一個真實的路徑，所以無法找到具體的文件
    # 因此需要 rewrite 到 index.html 中，然後交給路由進行處理
    location @router {
        rewrite ^.*$ /index.html last;
    }

    error_log /var/log/nginx/ae_diudiu_com_error.log;
    access_log /var/log/nginx/ae_diudiu_com_access.log;
}
```

# 機器要連接docker內的mysql
```bash
docker ps
# 0e87995f164f laradock_mysql 0.0.0.0:3306->3306/tcp, :::3306->3306/tcp, 33060/
mysql -u root -h 0.0.0.0 -proot
mysql -u default -h 0.0.0.0 -psecret
# laradock內建帳號
```

# 測試資料
```
# 丟丟測試帳號
0900000000
password
```

# 疑難排除
```bash
# 查歷史
history
history | more

# ERROR: Couldn't connect to Docker daemon at http+docker://localhost - is it running?
# If it's at a non-standard location, specify the URL with the DOCKER_HOST environment variable.

# 從新啟動Docker
sudo systemctl start docker
docker-compose up -d nginx redis workspace
```


# 測試透過Jenkins機建立新專案（補充資料）
``` bash
# 先去Jenkins上建立項目到可以上傳檔案

# 回GCP主機拉git檔案（避免隱藏檔遺落，配置Nginx用）
git clone https://gitlab.com/cookietag-backend-bank/bank-web.git bank-web
## 輸入帳號will@cookietag.com
## 輸入密碼Will1@3qaz

# 切換分支
git branch
git branch -r
git checkout -b dev origin/dev

# 複製.env
cp .env.example .env

# 調整擁有者
sudo chown cookietag:google-sudoers -R bank-web/
sudo chmod -R 775 bank-web/storage

# 到容器workspace裡面去安裝composer套件
docker-compose exec workspace bash
composer install
```

## **Reference article [參考文章]**
[Centos 7 安裝Docker](https://tutorials.tinkink.net/zh-hant/linux/how-to-install-docker-on-centos-7.html)
[docker-compose常遇指令](https://www.cnblogs.com/moxiaoan/p/9299404.html)
[GCS配置教學](http://www.alvinchen.club/2019/08/28/laravel-%E4%B8%8A%E5%82%B3%E6%AA%94%E6%A1%88%E5%88%B0google-cloud-plateform-storage-gcs/)

## **Author [作者]**
`Mr. Will`

http://localhost:30000/backend/preach-api.git

git clone http://122.116.21.111:30000/backend/preach-api.git preach-api