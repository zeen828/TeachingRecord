[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
在CentOS下安裝自動部署套件Jenkins與配置流程。

## **Teaching & Examples [教學&範例]**
### GCP上作業
```bash
# 切換權限
sudo su
# 建立專案
cd /data
# 拉Laravel程式
git clone https://gitlab.com/cookietag-backend-openai/openai-admin.git openai-admin
# 切亂目錄擁有者
sudo chown cookietag:google-sudoers -R openai-admin/
# 切換branch並更新
cd openai-admin
git checkout -b dev origin/dev
git pull
# 設定Laravel配置所需目錄權限
sudo chmod -R 775 storage
```

### GCP Laradock Workspace安裝作業
```bash
cd /data/Laradock/
# 進入workspace容器
docker-compose exec workspace bash
docker-compose exec workspace-82 bash
# 進入專案
cd openai-admin/
# 安裝
composer install
# 設定檔
cp .env.example .env
# 產生key
php artisan key:generate
php artisan migrate
```

### GCP Laradock Nginx設置
```bash
cd /data/Laradock/nginx/sites/
cp filefans-api.diudiu.com.conf ts-openai.diudiu.com.conf
vi ts-openai.diudiu.com.conf
# 回Laradock目錄
cd /data/Laradock/
# 重啟Nginx服務
docker-compose restart nginx
```

```nginx
server {
    listen 80;
    server_name ts-openai.ddiudiu.com;
    return 301 https://ts-openai.ddiudiu.com$request_uri;
}

server {

    # listen 80;
    # listen [::]:80;

    # For https
    listen 443 ssl;
    # listen [::]:443 ssl ipv6only=on;
    # ssl_certificate /etc/nginx/ssl/diudiu.com.root.crt;
    # ssl_certificate_key /etc/nginx/ssl/diudiu.com.key;
    ssl_certificate /etc/nginx/ssl/godaddy.ddiudiu.com.crt;
    ssl_certificate_key /etc/nginx/ssl/godaddy.ddiudiu.com.key;

    server_name ts-openai.ddiudiu.com;
    root /var/www/openai-admin/public;
    index index.php index.html index.htm;

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        #fastcgi_pass php-upstream;
        fastcgi_pass php-fpm-82:9000;
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

    error_log /var/log/nginx/ts_openai_diudiu_com_error.log;
    access_log /var/log/nginx/ts_openai_diudiu_com_access.log;
}
```

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
