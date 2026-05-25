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
# 進入Ubuntu(目錄大概是/home/使用者名稱/www)
wsl -d Ubuntu
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
# 安裝laravel 12，不要自動執行預設腳本
composer create-project --prefer-dist laravel/laravel 12_laravel 12.* --no-scripts
cd 12_laravel
# 複製.env檔案
cp .env.example .env
# 將檔案權限在 workspace 容器設定成laradock
chown -R laradock:laradock 12_laravel
cd 12_laravel
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
# 產生應用程式金鑰
php artisan key:generate
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
# 安裝laravel 13，不要自動執行預設腳本
composer create-project --prefer-dist laravel/laravel 13_laravel 13.* --no-scripts
cd 13_laravel
# 複製.env檔案
cp .env.example .env
# 將檔案權限在 workspace 容器設定成laradock
chown -R laradock:laradock 13_laravel
cd 13_laravel
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
# 產生應用程式金鑰
php artisan key:generate
# 設定資料庫
vi .env
# 進入容器 workspace 建立資料庫
php artisan migrate
```

</details>

#### ENV資料庫設定
```md
APP_ENV=local
APP_ENV=production
APP_ENV=testing
APP_ENV=staging

APP_LOCALE=zh_TW

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel12
DB_USERNAME=default
DB_PASSWORD=secret
```

APP_ENV 值	用途
local	本機開發環境
production	正式環境
testing	PHPUnit 測試
staging	測試站／預備正式環境

<details>
    <summary>Laravel 常用操作指令</summary>

### Controller
```bash
# 建立乾淨 Controller
php artisan make:controller UserController
# 建立只執行一件事的 Controller 其他繼承function會忽略
php artisan make:controller ProvisionServer --invokable
# 建立資源控制 Controller ，搭配路由Route::resource('photos', PhotoController::class);自動指向全部操作
php artisan make:controller PhotoController --resource
# 同上並自訂 Model
php artisan make:controller UserAController --model=User --resource
# 同上增加驗證檢查
php artisan make:controller UserBController --model=User --resource --requests
# 只建立 API 用功能面
php artisan make:controller PhotoController --api
```

### Model
```bash
# 建立 Model
php artisan make:model Flight
# 建立 Model(一起建遷移檔案)
php artisan make:model Flight --migration
# 建立 Model(一起建工廠類)
php artisan make:model Flight --factory
php artisan make:model Flight -f
# 建立 Model(一起建填充)
php artisan make:model Flight --seed
php artisan make:model Flight -s
# 建立 Model(一起建控制器)
php artisan make:model Flight --controller
php artisan make:model Flight -c
# 建立 Model(一起建CRUD完整控制器)
php artisan make:model Flight --controller --resource --requests
php artisan make:model Flight -crR
# 建立 Model(一起建授權政策)
php artisan make:model Flight --policy
# 建立 Model(不確定)
php artisan make:model Flight -mfsc
# 建立 Model(一起建model, migration, factory, seeder, policy, controller, form requests)
php artisan make:model Flight --all
php artisan make:model Flight -a
# 建立 Model(關聯用中間表，Model class type不一樣)
php artisan make:model Member --pivot
php artisan make:model Member -p
# 顯示 Model 資訊
php artisan model:show Flight
# 定義通用的查詢條件
php artisan make:scope AncientScope
# 建立Model事件
php artisan make:observer UserObserver --model=User
```

### View
```bash
# 建立視圖
php artisan make:view greeting
# 建立告警
php artisan make:component Alert --inline
# 建立驗證器
php artisan make:request StorePostRequest
```

### Route
```bash
# 建立 API 路由檔案(12版及簡化專門針對api做了安裝會自動安裝相依套件)
php artisan install:api
# 路由清單
php artisan route:list
php artisan route:list -v
php artisan route:list -vv
php artisan route:list --path=api
```

### Middleware
```bash
# 建立中間健
php artisan make:middleware EnsureTokenIsValid
```

### Logs
```bash
# 安裝錯誤訊息頁面
php artisan vendor:publish --tag=laravel-errors

# 監聽LOG?(不確定)
php artisan pail
php artisan pail -v
php artisan pail -vv
php artisan pail --filter="QueryException"
php artisan pail --message="User created"
php artisan pail --level=error
php artisan pail --user=1
```

### PHP
```bash
# 本機運行PHP
php artisan tinker
```

### Command
```bash
# 建立排程檔案
php artisan make:command SendEmails
```

### Migration
```bash
# 建立遷移檔案
php artisan make:migration create_flights_table
# Dump資料庫出來存為SQL(似乎要安裝 mysqldump 套件)
php artisan schema:dump
php artisan schema:dump --prune
php artisan schema:dump
php artisan schema:dump --database=testing --prune
# 查詢遷移檔案狀態
php artisan migrate:status
# 模擬遷移不執行(輸出遷移SQL)
php artisan migrate --pretend
# 執行遷移
php artisan migrate
# 執行遷移(每個檔案給一個編號)
php artisan migrate --step
# 執行遷移(強制執行)
php artisan migrate --force
# 遷移回復
php artisan migrate:rollback
# 遷移回復(5個編號)
php artisan migrate:rollback --step=5
# 遷移回復(指定編號)
php artisan migrate:rollback --batch=3
# 模擬遷移回復不執行(輸出遷移SQL)
php artisan migrate:rollback --pretend
# 回復所有遷移(資料庫會清空)
php artisan migrate:reset
# 回復所有遷移再重新執行遷移(資料庫會清空重建)
php artisan migrate:refresh
# 回復所有遷移再重新執行遷移，遷移完自動執行 Seeder
php artisan migrate:refresh --seed
# 回復所有遷移再重新執行遷移(指定編號)
php artisan migrate:refresh --step=5
# 卸載 Drop 所有資料庫
php artisan migrate:fresh
# 卸載 Drop 所有資料庫，再重新執行遷移跟 Seeder
php artisan migrate:fresh --seed
# 卸載 Drop 所有資料庫(不確定功能)
php artisan migrate:fresh --database=admin
```

```php
# 新建
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->rememberToken();
                $table->timestamps();

                $table->comment('使用者');
            });
        }
# 加欄位
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_admin')->default('0')->comment('管理員')->after('remember_token');// after
                $table->boolean('is_temple')->default('0')->comment('廟與人員')->after('remember_token');
            });
        }

```

### Seeder
```bash
# 建立填充檔案
php artisan make:seeder UserSeeder
# 執行填充
php artisan db:seed
# 執行填充(指定 Class)
php artisan db:seed --class=UserSeeder
# 重建資料庫並填充
php artisan migrate:fresh --seed
# 重建資料庫並填充(指定 Class)
php artisan migrate:fresh --seed --seeder=UserSeeder
# 執行填充(強制執行)
php artisan db:seed --force
```

</details>


### 套件
[Laravel Analytics](https://github.com/bezhanSalleh/laravel-analytics)

</details>
<div style="margin-bottom: 20px;"></div>


<details>
    <summary>Filament 各版本安裝</summary>

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
# 安裝(會問二個問題，後台路徑、GitHub Like)
php artisan filament:install --panels
# 後台建立 User(會問三個問題，名稱、信箱、密碼)
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
    <summary>Filament 常用操作指令</summary>

### Filament 常用操作指令
```bash
# 建立Panel(名稱撮要一起清掉bootstrap/providers.php宣告)
php artisan filament:panel App

# 生成後台Resource功能
# --generate 自動針對資料庫產生欄位
php artisan make:filament-resource User --generate
# --soft-deletes 軟刪除，需要增加deleted_at欄位
php artisan make:filament-resource User --soft-deletes
# --view 查看頁面
php artisan make:filament-resource User --view
# --simple 簡易模式(彈窗)
php artisan make:filament-resource User --simple
# 可同時多個設定使用
php artisan make:filament-resource User --generate --view
php artisan make:filament-resource User --generate --view --simple
php artisan make:filament-resource User --generate --soft-deletes --view
```

### Filament 中的 Resource 設定
```php
# 菜單標題
protected static ?string $recordTitleAttribute = 'name';
```

</details>

### 權限管理套件-1
[Filament Shield](https://github.com/bezhanSalleh/filament-shield)
[Filament Shield](https://filamentphp.com/plugins/bezhansalleh-shield)
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
# 會詢問以下幾個問題
1.Do you want to configure Shield for multi-tenancy? / (No)多租戶設定
2.Would you like to run 'shield:install'? / (Yes)套件安裝
3.Which Panel would you like to install Shield for? / (admin)
4.Would you like to run 'shield:generate' for 'admin' Panel? / (Yes)
5.Would you like to select what to generate (permissions, policies or both) ? / (Yes)
6.What do you want to generate? / (Policies & Permissions)生成權限與政策
7.Would you like to run 'shield:super-admin' for 'admin' Panel? / (Yes)設定超級管理員
8.Would you like to show some love by starring the repo? / (Yes)

# 給自己權限
php artisan shield:super-admincd .
# 生成所有 Resource 的權限
php artisan shield:generate --all
# 只生成特定資源的權限
php artisan shield:generate --resource=UserResource
```

### 權限管理套件-2
[參考文件](https://spatie.be/docs/laravel-permission/v6/installation-laravel)
### 權限管理套件-2(對應UI)
[參考文件](https://filamentphp.com/plugins/tharinda-rodrigo-spatie-roles-permissions)

### 多國語系切換
[Language Switch](https://github.com/bezhanSalleh/filament-language-switch)
```bash
# 安裝
composer require bezhansalleh/filament-language-switch
# 設定 /app/Providers/AppServiceProvider.php
use BezhanSalleh\LanguageSwitch\LanguageSwitch;

public function boot(): void
{
    LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
        $switch->locales(['zh_TW', 'en']);
    });
}
```

### 切換面板
[Panel Switch](https://github.com/bezhanSalleh/filament-panel-switch)
```bash
# 安裝
composer require bezhansalleh/filament-panel-switch
# 需要先定義出新的Panel
# 設定 /app/Providers/AppServiceProvider.php
PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
    $panelSwitch->panels([
        'admin',
        'dev',
        'app'
    ]);
});
```


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
[目錄改至上排TOP目錄](jeffersongoncalves/filament-topbar)

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



<details>
    <summary>Inertia.js 安裝</summary>

### Inertia.js 前端後台功能
```bash
# 安裝套件
composer require laravel/breeze --dev
# 安裝
php artisan breeze:install
# 問題.1
 ┌ Which Breeze stack would you like to install?
 │   ○ Blade with Alpine (使用 Laravel 傳統的 Blade 模板引擎，搭配輕量級的 Alpine.js 來處理簡單的前端互動)
 │   ○ Livewire (Volt Class API) with Alpine (使用 Livewire（結合 Volt 的 Class API 寫法）來處理動態資料，並搭配 Alpine.js 處理微互動)
 │   ○ Livewire (Volt Functional API) with Alpine (使用 Livewire（結合 Volt 的 Functional API 寫法）來處理動態資料，並搭配 Alpine.js 處理微互動)
 │   ○ React with Inertia (前端使用 React，並透過 Inertia.js 連接 Laravel)
 │ › ● Vue with Inertia (前端使用 Vue.js，並透過 Inertia.js 連接 Laravel)
 │   ○ API only (僅安裝後端相關的基礎架構（如 Laravel Sanctum 權限驗證設定），完全不包含任何前端畫面與樣板)
 └──────────────────────────────────────────────────────────────┘
# 問題.2
 ┌ Would you like any optional features?
 │   ◼ Dark mode (深色模式)
 │   ◼ Inertia SSR (伺服器端渲染，SEO需要)
 │ › ◼ TypeScript (為前端的 Vue 或 React 導入 TypeScript 的支援)
 │   ◻ ESLint with Prettier (安裝前端的程式碼品質檢查與格式化工具)
 └──────────────────────────────────────────────────────────────┘
# 問題.3
 ┌ Which testing framework do you prefer? ──────────────────────┐
 │   ○ Pest                                                     │
 │ › ● PHPUnit                                                  │
 └──────────────────────────────────────────────────────────────┘
# 此動作沒執行到
npm install && npm run dev

# 將檔案權限在 workspace 容器設定成laradock
chown -R laradock:laradock 12_laravel
```
[參考](https://inertiajs.com/)

</details>