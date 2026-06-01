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

### Nginx
```bash
brew services start nginx
brew services stop nginx
brew services restart nginx

nginx -s reload
brew services reload nginx

nginx -T
# 設定黨位置
/usr/local/etc/nginx/servers/xxx.conf
```

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
