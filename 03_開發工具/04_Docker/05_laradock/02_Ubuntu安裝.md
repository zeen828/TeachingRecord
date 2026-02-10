[回上層目錄](../README.md)

# 環境部署

## **Description [描述]**
GCP上發佈laradock。更新日期2023/12/14

## **Teaching & Examples [教學&範例]**

# Ubuntu 7 安裝 Docker
```bash
```

# 安裝Laradock
```bash
# 從 GitHub 上將 Laradock 下載下來
git clone https://github.com/Laradock/laradock.git Laradock

# 複製範本 env-example 檔作為設定檔
cd Laradock && cp .env.example .env

# 2024-05-13建立加密貨幣專案設定
PHP_VERSION=8.4

MYSQL_VERSION=8.0
# 這個port可能被佔用，所以調整成別的
MYSQL_PORT=33066

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
# 停止所有容器
docker stop $(docker ps -aq)
# 刪除所有容器
docker rm -f $(docker ps -aq)
# 刪除所有映像檔
docker rmi -f $(docker images -aq)
# 查詢容器
docker ps -a
# 查詢映像檔
docker images
# 查詢服務Log
docker logs -f laradock-nginx-1
# 查容器
docker ps -a
docker exec -it <Container ID> bash
docker exec -it 59df4c9852a0 bash
```


### docker-compose指令
```bash
# 進入容器
docker compose exec workspace bash
docker compose exec nginx bash
docker compose exec php-fpm bash
# 重啟容器
docker compose restart nginx
docker compose restart php-fpm
# 查詢容器
docker compose ps -a
# 查詢服務Log
docker compose logs nginx -f
docker compose logs php-fpm -f
# 停止容器運作
docker compose stop
# 停止容器運作外加上移除容器
docker compose down
```

### phpMyAdmin
http://34.18.26.112:8081/



### 建立專案
#### Laravel 7.X
```bash
composer create-project --prefer-dist laravel/laravel 07_test 7.* - X PHP版本過薪
```

#### Laravel 8.X + Filament 2.X
```bash
# 進入容器 workspace 建立專案(支援filament 2.5)
composer create-project --prefer-dist laravel/laravel 08_test 8.*
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock /var/www/08_test/storage /var/www/08_test/bootstrap/cache
chmod -R 775 /var/www/08_test/storage /var/www/08_test/bootstrap/cache
# 設定資料庫
vi .env
# 進入容器 workspace 建立資料庫
php artisan migrate

# 後台 Filament 2.X
composer require filament/filament:"^2.0"
# 建立帳號
php artisan make:filament-user
# 配置設定檔
php artisan vendor:publish --tag=filament-config
# 發布語言包
php artisan vendor:publish --tag=filament-translations
php artisan vendor:publish --tag=forms-translations
php artisan vendor:publish --tag=tables-translations
php artisan vendor:publish --tag=filament-support-translations
# 設定 config/app.php
'locale' => env('APP_LOCALE', 'en'),
# 設定 .env
APP_LOCALE=zh_TW
# 安裝基本套件
composer require filament/forms
composer require filament/tables
composer require filament/notifications
```

#### Laravel 9.X
```bash
composer create-project --prefer-dist laravel/laravel 09_test 9.*  -  X 版本有資安問題停止支援
```

#### Laravel 10.X
```bash
# 進入容器 workspace 建立專案(支援filament 3.3)
composer create-project --prefer-dist laravel/laravel 10_test 10.*
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock /var/www/10_test/storage /var/www/10_test/bootstrap/cache
chmod -R 775 /var/www/08_test/storage /var/www/10_test/bootstrap/cache
# 設定資料庫
vi .env
# 進入容器 workspace 建立資料庫
php artisan migrate
```

#### Laravel 11.X
```bash
# 進入容器 workspace 建立專案(支援filament 5.2)
composer create-project --prefer-dist laravel/laravel 11_test 11.*
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock /var/www/11_test/storage /var/www/11_test/bootstrap/cache
chmod -R 775 /var/www/08_test/storage /var/www/11_test/bootstrap/cache
# 設定資料庫
vi .env
# 進入容器 workspace 建立資料庫
php artisan migrate
```

#### Laravel 12.X Filament 5.X
```bash
# 進入容器 workspace 建立專案(支援filament 5.2)
composer create-project --prefer-dist laravel/laravel 12_test 12.*
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock /var/www/12_test/storage /var/www/12_test/bootstrap/cache
chmod -R 775 /var/www/08_test/storage /var/www/12_test/bootstrap/cache
# 設定資料庫
vi .env
# 進入容器 workspace 建立資料庫
php artisan migrate

# 後台 Filament 5.X
composer require filament/filament:"^5.0"
php artisan filament:install --panels
# 後台建立 User
php artisan make:filament-user
# 發布設定檔
php artisan vendor:publish --tag=filament-config
# 發布語言包
php artisan vendor:publish --tag=filament-translations
php artisan vendor:publish --tag=forms-translations
php artisan vendor:publish --tag=tables-translations
php artisan vendor:publish --tag=filament-support-translations
# 設定 .env
APP_LOCALE=zh_TW

# 未確認權限管理部份
composer require spatie/laravel-permission
```


### GIT 使用
```bash
cd 08_test
# 初始化
git init
# 建立用戶資訊
git config user.name "will"
git config user.email "will@nsst.com.tw"
# 加入全部檔案
git add .
# 提交差異
git commit -m "init: 原始 Laravel 8 專案"
# 查詢狀態
git status
# 查看分支
git branch -r
# 建立新分支
git checkout -b test-admin-laravel-8
# 回覆提交後程序
git reset --hard
```