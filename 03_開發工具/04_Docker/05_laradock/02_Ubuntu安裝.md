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
composer require filament/filament:"^2.0"ㄎ../10    
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

# 安裝Filament Shield (權限與角色管理)套件
composer require bezhansalleh/filament-shield:"^2.0"
# 修改app/Models/User.php
```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasRoles;
    // ...
}
```
# 執行安裝指令
php artisan shield:install
# 給自己權限
php artisan shield:super-admincd .
# 生成所有 Resource 的權限
php artisan shield:generate --all


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
# 設定後台面板
php artisan filament:install --panels
# 設定額外後台面板
php artisan make:filament-panel customer
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


# 建立使用者模組
php artisan make:filament-resource User
# 編輯多語系目錄
vi app/Filament/Resources/Users/UserResource.php
	...
	// 1. 側邊欄顯示名稱
    public static function getNavigationLabel(): string
    {
        return __('menu.customer');
    }

    // 2. 麵包屑與頁面標題 (單數)
    public static function getModelLabel(): string
    {
        return __('menu.customer');
    }

    // 3. 側邊欄群組名稱 (選單分組)
    public static function getNavigationGroup(): ?string
    {
        return __('menu.group_system');
    }

# 密碼調整
vi app/Filament/Resources/Users/Schemas/UserForm.php
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
	....
                TextInput::make('password')
                    ->password()
                    ->revealable() // 允許使用者點擊眼睛圖示查看密碼 (選配，好用)
                    // ->required()
                    // 重點 1：只有在「建立」頁面時才必填
                    ->required(fn (Page $livewire) => $livewire instanceof CreateRecord)
                    // 重點 2：脫水處理 (Dehydrate) - 如果欄位沒填寫，就不把這個欄位送進資料庫更新
                    ->dehydrated(fn ($state) => filled($state))
                    // ->label('密碼'),
					->label(__('fields.password')), // 使用 label() 進行翻譯


#建立一個後台項目
php artisan make:filament-resource Customer

[參考文件](https://spatie.be/docs/laravel-permission/v6/installation-laravel)
# 安裝權限管理套件
composer require spatie/laravel-permission
# 配置設定檔跟遷移檔
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
# 設定團隊模式
vi config/permission.php
'teams' => true,
# 清除設定緩存
php artisan optimize:clear
# 遷移
php artisan migrate
# 添加User Model權限套件
vi app/Models/User.php
use Spatie\Permission\Traits\HasRoles;

	...
	// The User model requires this trait
	use HasRoles;


# 建立Seeder
php artisan make:seeder CreateRole
# 編輯內容
vi database/seeders/CreateRole.php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
	...
	Role::create(['name' => 'writer']);
	Permission::create(['name' => 'edit articles']);
# 執行Seeder
php artisan db:seed --class=CreateRole
# 查詢目前設定
php artisan permission:show


[參考文件](https://filamentphp.com/plugins/tharinda-rodrigo-spatie-roles-permissions)
# 安裝權限管理對應UI
composer require althinect/filament-spatie-roles-permissions
# 配置設定檔跟遷移檔(上面執行過的話次次會SKIPPED)
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
# 配置UI設定顯示目錄
vi app/Providers/Filament/AdminPanelProvider.php
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;

$panel
    ...
    ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
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

https://filamentphp.com/plugins/hexters-hexa


參考
https://ithelp.ithome.com.tw/articles/10337981

https://learnku.com/docs/laravel-modules/9/spatie-laravel-permission/14313

veryenjoy.tw/enjoy/article/325

https://ithelp.ithome.com.tw/m/articles/10379639

https://learnku.com/articles/15321/the-use-of-laravel-permission-a-permission-management-extension-package

https://www.returnc.com/detail/3729

