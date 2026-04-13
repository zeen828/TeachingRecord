[回上層目錄](../README.md)

# 環境部署

## **Description [描述]**
個人電腦上使用laradock開發。

## **Teaching & Examples [教學&範例]**

# 安裝 Docker
<details>
    <summary>安裝 Docker</summary>

### 訪問官網下載
[Docker官網](https://www.docker.com/)

### Docker常用指令
```bash
# 停止所有容器
docker stop $(docker ps -aq)
# 刪除所有容器
docker rm $(docker ps -aq)
# 刪除所有映像檔
docker rmi -f $(docker images -aq)
# 刪除所有無用的Docker網路(避免IP衝突)
docker network prune -f
# 刪除所有無用的Volume
docker volume prune -f
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

</details>
<div style="margin-bottom: 20px;"></div>


# 檢查 WSL
<details>
    <summary>檢查 WSL</summary>

### WSL處理(須進入Windows的WSL下處理速度才不會卡IO)
```bash
# 查詢WSL(如果顯示 Default Version: 2 (或 1)，表示已經啟用)
wsl --status
# 列出所有安裝的linuxx
wsl -l -v
```

### VSCode使用WSL
* 安裝套件WSL(選擇Microsoft出版的)
* 點擊左下角做連線，選擇Connect to WSL

</details>
<div style="margin-bottom: 20px;"></div>


# 安裝 Laradock
<details>
    <summary>安裝 Laradock</summary>

### Git安裝
```bash
# 從 GitHub 上將 Laradock 下載下來
git clone https://github.com/Laradock/laradock.git Laradock

# 複製範本 env-example 檔作為設定檔
cd Laradock && cp .env.example .env
```

### .env設定檔要調整的
```md
# 專案設定PHP 8.3
PHP_VERSION=8.3

# 專案設定MySQL 8
MYSQL_VERSION=8.4
# 這個port可能被佔用，所以調整成別的
MYSQL_PORT=33060

# 這個port可能被佔用，所以調整成別的
NGINX_HOST_HTTP_PORT=8880
# 這個port可能被佔用，所以調整成別的
NGINX_HOST_HTTPS_PORT=8443

# Workspace容器開啟SWOOLE
WORKSPACE_INSTALL_SWOOLE=true
# php-fpm容器開啟SWOOLE，處理來自 Nginx 的網頁請求。
PHP_FPM_INSTALL_SWOOLE=true
# php-worker容器開啟SWOOLE，專門用來跑 Laravel 的 Queue (隊列)
PHP_WORKER_INSTALL_SWOOLE=true
```

### docker-compose指令
```bash
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
docker-compose exec --user=root workspace bash
docker-compose exec --user=laradock workspace bash

# 重開OS後要先執行
sudo service docker start

# 進入容器
docker-compose exec workspace bash
docker-compose exec nginx bash
docker-compose exec php-fpm bash
# 重啟容器
docker-compose restart nginx
docker-compose restart php-fpm
# 查詢容器
docker-compose ps -a
# 查詢服務Log
docker-compose logs nginx -f
docker-compose logs php-fpm -f
# 停止容器運作
docker-compose stop
# 停止容器運作外加上移除容器
docker-compose down
```

### phpMyAdmin入口
[PHPMyAdmin入口](http://127.0.0.1:8081/)

</details>
<div style="margin-bottom: 20px;"></div>


# 建立專案
<details>
    <summary>Laravel 各版本安裝</summary>

<details>
    <summary>Laravel 7.x</summary>

### 安裝Laravel 7.x 安裝(PHP 8.3版本過新)
```bash
composer create-project --prefer-dist laravel/laravel 07_laravel 7.*
```

</details>

<details>
    <summary>Laravel 8.x</summary>

### 安裝Laravel 8.x
```bash
# 進入容器 workspace 建立專案(支援filament 2.5)
composer create-project --prefer-dist laravel/laravel 08_laravel 8.*
cd 08_laravel
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
# 設定資料庫
vi .env
# 進入容器 workspace 建立資料庫
php artisan migrate
```

</details>

<details>
    <summary>Laravel 9.x</summary>

### 安裝Laravel 9.x(此版本有資安問題停止支援)
```bash
composer create-project --prefer-dist laravel/laravel 09_laravel 9.*
```

</details>

<details>
    <summary>Laravel 10.x</summary>

### 安裝Laravel 10.x
```bash
# 進入容器 workspace 建立專案(支援filament 3.3)
composer create-project --prefer-dist laravel/laravel 10_laravel 10.*
cd 10_laravel
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
# 設定資料庫
vi .env
# 進入容器 workspace 建立資料庫
php artisan migrate
```

</details>

<details>
    <summary>Laravel 11.x</summary>

### 安裝Laravel 11.x
```bash
# 進入容器 workspace 建立專案(支援filament 5.2)
composer create-project --prefer-dist laravel/laravel 11_laravel 11.*
cd 11_laravel
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
# 設定資料庫
vi .env
# 進入容器 workspace 建立資料庫
php artisan migrate
```

</details>

<details>
    <summary>Laravel 12.x</summary>

### 安裝Laravel 12.x
```bash
# 進入容器 workspace 建立專案(支援filament 5.2)
composer create-project --prefer-dist laravel/laravel 12_laravel 12.*
cd 12_laravel
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
# 設定資料庫
vi .env
# 進入容器 workspace 建立資料庫
php artisan migrate
```

</details>

<details>
    <summary>Laravel 13.x</summary>

### 安裝Laravel 13.x
```bash
# 進入容器 workspace 建立專案(支援filament 5.2)
composer create-project --prefer-dist laravel/laravel 13_laravel 13.*
cd 13_laravel
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
# 設定資料庫
vi .env
# 進入容器 workspace 建立資料庫
php artisan migrate
```

</details>

#### ENV資料庫設定
```md
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel12
DB_USERNAME=default
DB_PASSWORD=secret
```

</details>
<div style="margin-bottom: 20px;"></div>


<details>
    <summary>Filament</summary>

### Filament 常用操作指令
```bash
# 生成後台Resource功能
# --generate 自動針對資料庫產生欄位
php artisan make:filament-resource User --generate
# --soft-deletes 軟刪除，需要增加deleted_at欄位
php artisan make:filament-resource User --soft-deletes
# --view 查看頁面
php artisan make:filament-resource User --view
# 可同時多個設定使用
php artisan make:filament-resource User --generate --view
php artisan make:filament-resource User --generate --soft-deletes --view
```

### Filament 中的 Resource 設定
```php
# 菜單標題
protected static ?string $recordTitleAttribute = 'name';
```

<details>
    <summary>Filament 2.x</summary>

```bash
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
```

</details>

<details>
    <summary>Filament 3.x</summary>

</details>

<details>
    <summary>Filament 4.x</summary>

```bash
# 後台 Filament 4.X
composer require filament/filament:"^4.0"
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
```

</details>

<details>
    <summary>Filament 5.x</summary>

```bash
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
```

</details>

### 權限管理套件-1
[Filament Shield](https://github.com/bezhanSalleh/filament-shield)
```bash
# 安裝Filament Shield (權限與角色管理)套件
composer require bezhansalleh/filament-shield
# 複製設定
php artisan vendor:publish --tag="filament-shield-config"
# 修改app/Models/User.php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    ...
}
# 執行安裝指令
php artisan shield:setup
# 給自己權限
php artisan shield:super-admincd .
# 生成所有 Resource 的權限
php artisan shield:generate --all
```

### 權限管理套件-2
[參考文件](https://spatie.be/docs/laravel-permission/v6/installation-laravel)
### 權限管理套件-2(對應UI)
[參考文件](https://filamentphp.com/plugins/tharinda-rodrigo-spatie-roles-permissions)


# 安裝基本套件
```bash
composer require filament/forms
composer require filament/tables
composer require filament/notifications
```

### 5.x套件
[輸入框帶計算機](https://filamentphp.com/plugins/ariefng-calculator-plugin)
[輸入框多多國語細選項](https://filamentphp.com/plugins/ahmed-d-ali-countries)
[多媒體庫](https://filamentphp.com/plugins/mohamed-slimani-media-manager)

</details>
<div style="margin-bottom: 20px;"></div>


# GIT 使用
<details>
    <summary>GIT 使用</summary>

### 常用指令
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
</details>
<div style="margin-bottom: 20px;"></div>
