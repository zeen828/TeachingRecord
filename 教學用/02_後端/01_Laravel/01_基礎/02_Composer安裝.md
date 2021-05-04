[回上層目錄](../README.md)

# 教學用 > 後端 > Laravel > 基礎 > Composer安裝

## **Description [描述]**
這邊會說明如何透過Composer安裝Laravel基本程式碼。

## **Teaching & Examples [教學&範例]**
### 安裝Composer
1. CentOS下安裝
```bash
# 透過PHP下載安裝檔案
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
# 檢驗下載包(顯示Installer verified即正常)
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
# 執行安裝
php composer-setup.php
# 刪除安裝包
php -r "unlink('composer-setup.php');"
# 移動到全域命令庫
mv composer.phar /usr/local/bin/composer
```
[Command-line installation](https://getcomposer.org/download/)

2. windows安裝
[Composer官方網站](https://getcomposer.org/)
到官方網站下載安裝包安裝後即可使用。

### Composer安裝Laravel
```bash
# 安裝指定版本
composer create-project --prefer-dist laravel/laravel Project 8.*
# 變數說明
# composer：主要命令
# create-project：
# --prefer-dist：
# laravel/laravel：
# Project：專案目錄名稱
# 8.*：指定安裝版本(未指定會以最新版本為主)
```

### 運行
```bash
# 運行Laravel
php artisan serve
# http://127.0.0.1:8000/docs
```

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
