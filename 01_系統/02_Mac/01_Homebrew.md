[回上層目錄](../README.md)

# Homebrew

## **Description [描述]**
Mac下的套件的管理工具，可以幫忙快速安裝套件。

## **Teaching & Examples [教學&範例]**
### 安裝
```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
# 輸入密碼
# 按Enert

# 查詢有哪些服務
brew services list
```

### brew 安裝 Nginx
```bash
# 安裝
brew install nginx
# 啟動
brew services start nginx
# 停止
brew services stop nginx
# 重啟
brew services restart nginx
# 讀取設定
nginx -s reload
brew services reload nginx

# 看是否有跑起來
ps aux | grep nginx
# 查詢
nginx -T
# 查詢
nginx -T | grep server_name
# 預設網址
http://localhost:8080
# 設定檔位置
## Apple Silicon：
/opt/homebrew/etc/nginx/nginx.conf
## Intel Mac：
/usr/local/etc/nginx/nginx.conf

# 設定黨位置
/usr/local/etc/nginx/servers/xxx.conf
```

<details>
    <summary>Laravel 設定範例</summary>

```conf
server {
    listen 8081;
    server_name laravel.test;

    root /Users/YOUR_NAME/Sites/myapp/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

</details>

### PHP
```bash
# 安裝指定版本
brew install php@8.2
brew install php@8.4
# 服務器操作
brew services start php@8.2
brew services start php@8.4
brew services stop php@8.2
brew services stop php@8.4
brew services restart php@8.2
brew services restart php@8.4
# 查詢啟用port
nginx -T | grep fastcgi_pass
# 設定檔
/usr/local/etc/php/8.2/php-fpm.d/www.conf
/usr/local/etc/php/8.4/php-fpm.d/www.conf
# 執行檔
/usr/local/opt/php@8.2/bin/php -v
/usr/local/opt/php@8.4/bin/php -v
```

### brew 安裝 Composer
```bash
brew install composer
```

### brew 安裝 MySQL
```bash
# 安裝
brew install mysql
# 啟動
brew services start mysql
# 停止
brew services stop mysql
# 重啟
brew services restart mysql
# 查詢
mysql --version
mysqladmin -u root status
# 設定 root 密碼(8碼有英數符號 qaz1@3WSX)
mysql_secure_installation
```

MacBook 可以下載 Sequel Ace(APP Store下載) 或 TablePlus 平替 phpMyAdmin，省得再去安裝phpMyAdmin需要一堆動作。


<details>
    <summary>設定root密碼一連串問答</summary>

```TXT
 mysql_secure_installation

Securing the MySQL server deployment.

Connecting to MySQL using a blank password.
The 'validate_password' component is installed on the server.
The subsequent steps will run with the existing configuration
of the component.
Please set the password for root here.
密碼規則8各字以上，要有英數跟特殊符號。

New password:  

Estimated strength of the password: 100 
Do you wish to continue with the password provided?(Press y|Y for Yes, any other key for No) : y  
你這個密碼夠強，要不要用？

By default, a MySQL installation has an anonymous user,
allowing anyone to log into MySQL without having to have
a user account created for them. This is intended only for
testing, and to make the installation go a bit smoother.
You should remove them before moving into a production
environment.

Remove anonymous users? (Press y|Y for Yes, any other key for No) : y
刪掉匿名帳號?

Success.


Normally, root should only be allowed to connect from
'localhost'. This ensures that someone cannot guess at
the root password from the network.

Disallow root login remotely? (Press y|Y for Yes, any other key for No) : y
是否禁止root遠端登入?

Success.

By default, MySQL comes with a database named 'test' that
anyone can access. This is also intended only for testing,
and should be removed before moving into a production
environment.


Remove test database and access to it? (Press y|Y for Yes, any other key for No) : y
刪除測試資料庫?

 - Dropping test database...
Success.

 - Removing privileges on test database...
Success.

Reloading the privilege tables will ensure that all changes
made so far will take effect immediately.

Reload privilege tables now? (Press y|Y for Yes, any other key for No) : y
剛剛的設定立即生效?

Success.

All done! 
```

</details>

### Redis
```bash
# 查資訊
brew info redis
# 
brew services restart redis
# 查詢port
lsof -iTCP -sTCP:LISTEN | grep redis
# 查詢port
redis-cli info server | grep tcp_port
```

## **Reference article [參考文章]**
[參考文件](https://brew.sh/index_zh-tw)

## **Author [作者]**
`Mr. Will`
