[回上層目錄](../README.md)

# 環境部署

## **Description [描述]**
GCP上發佈laradock。

## **Teaching & Examples [教學&範例]**

# 安裝Docker
```bash
# 更新yum套件工具
sudo yum update

# 安裝以下套件
sudo yum install -y yum-utils device-mapper-persistent-data lvm2

# 添加倉庫
sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo

# 安裝最新版本的Docker引擎
sudo yum install docker-ce docker-ce-cli containerd.io

# 啟動Docker服務
sudo systemctl start docker

# 查看Docker版本
docker -v
Docker version 19.03.5

# 啟動Docker
sudo systemctl start docker

# 將目前使用者加進docker群組（已root身份執行即可）
sudo gpasswd -a ${USER} docker
# 需要重新登入
```

# 安裝Docker Compose
```bash
# 下載執行檔
sudo curl -L "https://github.com/docker/compose/releases/download/1.23.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

# 設定權限
sudo chmod +x /usr/local/bin/docker-compose

# 建立軟連結
sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose

# 查看Docker Compose版本
docker-compose -v
docker-compose version 1.25.3
```

# Git安裝
```bash
sudo yum install git
git –version
```

# 安裝Laradock
```bash
# 從 GitHub 上將 Laradock 下載下來
git clone https://github.com/Laradock/laradock.git Laradock

# 複製範本 env-example 檔作為設定檔
cd ~/Laradock && cp env-example .env

# 修改 .env 檔的 APP_CODE_PATH_HOST 參數到指定的映射路徑
APP_CODE_PATH_HOST=/var/www

APP_CODE_PATH_HOST:         設定Laravel專案要放在local的哪個path
APP_CODE_PATH_CONTAINER:    設定專案要同步到container中的哪個path
DATA_PATH_HOST:             設定db, redis資料要放在哪個path

# 使用 docker-compose 啟動 Laradock
cd ~/Laradock
docker-compose up -d nginx mysql redis workspace
docker-compose up -d nginx redis workspace
# 停止容器運作
docker-compose stop
# 停止容器運作外加上移除容器
docker-compose down
# 重啟Nginx服務
docker-compose restart nginx
# 查看Nginx紀錄
docker-compose logs  nginx
# 查看Nginx即時紀錄
docker-compose logs -f nginx

# 查容器
docker ps -a
docker exec -it <Container ID> bash
docker exec -it 526858050d53 bash
```

# 酷奇鐵克用
```bash
# 拉api程式
git clone http://122.116.21.111:30000/backend/throwthrow-api.git diudiu-api
sudo chown root:google-sudoers -R diudiu-api/
cd diudiu-api
sudo chmod -R 775 storage
git checkout origin/develop

diudiu
xN5a494uCxtjiEoE

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

# 拉web程式
git clone http://122.116.21.111:30000/frontend/throwthrow-web.git diudiu-web
sudo chown root:google-sudoers -R diudiu-web/
cd diudiu-web

git branch -r
git checkout v2-new-route
git checkout origin/feature/v2-new-route

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
        index index.html index.htm;
    }

    # 對應上面的 @router
    # 主要原因是路由的路徑資源並不是一個真實的路徑，所以無法找到具體的文件
    # 因此需要 rewrite 到 index.html 中，然後交給路由進行處理
    location @router {
        index index.html index.htm;
    }

    error_log /var/log/nginx/ae_diudiu_com_error.log;
    access_log /var/log/nginx/ae_diudiu_com_access.log;
}
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

# 啟動Docker
sudo systemctl start docker
```

## **Reference article [參考文章]**
[參考文件](https://blog.epoch.tw/2020/02/06/%E5%9C%A8-CentOS-%E4%B8%8A%E5%BB%BA%E7%AB%8B-Laradock-%E7%92%B0%E5%A2%83/)
[docker-compose常遇指令](https://www.cnblogs.com/moxiaoan/p/9299404.html)
[GCS配置教學](http://www.alvinchen.club/2019/08/28/laravel-%E4%B8%8A%E5%82%B3%E6%AA%94%E6%A1%88%E5%88%B0google-cloud-plateform-storage-gcs/)

## **Author [作者]**
`Mr. Will`

http://localhost:30000/backend/preach-api.git

git clone http://122.116.21.111:30000/backend/preach-api.git preach-api