[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
CentOS 7 服務器安裝

## **Teaching & Examples [教學&範例]**

### 更新
```bash
# 系統更新
sudo yum -y update
# 系統包含安裝軟件更新
sudo yum -y upgrade
```

### 服務器名稱
```bash
# 查看
hostnamectl
# 設定
sudo hostnamectl set-hostname YOUR_HOSTNAME
```

### 設定時區
```bash
# 查詢可設置時區
timedatectl list-timezones
# 設置台灣時區
sudo timedatectl set-timezone Asia/Taipei
```

### 安裝額外的軟體包
```bash
sudo yum install -y epel-release
```

### 安裝資料庫MySQL/MariaDB
```bash
# 安裝 
sudo yum install -y mariadb-server mariadb

# 啟動
sudo systemctl start mariadb
# 停止
sudo systemctl stop mariadb
# 重新啟動
sudo systemctl restart mariadb
# 刷新設定
sudo systemctl reload mariadb
# 查詢狀態
sudo systemctl status mariadb
# 開幾自動起動
sudo systemctl enable mariadb
# 開幾不啟動
sudo systemctl disable mariadb
```

#### 設定MariaDB
```bash
# 設定
sudo mysql_secure_installation
# 輸入密碼（第一次直接按確認）
Enter current password for root (enter for none): 
# 設定root密碼
Set root password? [Y/n] Y
New password: qaz123
Re-enter new password:qaz123 
# 刪除預設用戶
Remove anonymous users? [Y/n] Y
# 禁止遠程root登入
Disallow root login remotely? [Y/n] Y
# 刪除測試資料
Remove test database and access to it? [Y/n] Y
# 重新加載設定後權限
Reload privilege tables now? [Y/n] Y

# 連線測試
mysql -u root -p
```

### 安裝資料庫Redis
```bash

```

### 安裝PHP 7.4
```bash
# 加載外部資源包
sudo yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
sudo yum install -y epel-release yum-utils

# 設定預設使用版本（設定後就不需要指定版本php74操作）
sudo yum-config-manager --enable remi-php74

# 安裝
sudo yum install -y php php-fpm
# 查看版本
php -v
# PHP套件資料庫相關
sudo yum install -y php-mysqlnd php-pdo php-pear
# PHP套件
sudo yum install -y php-devel php-xmlrpc php-bcmath php-recode php-enchant php-common php-cli php-gd php-embedded php-ldap php-process php-pecl-zip php-pgsql php-dba php-json php-soap php-odbc php-intl php-xml php-snmp php-mbstring php-imagick

# 啟動
sudo systemctl start php-fpm
# 停止
sudo systemctl stop php-fpm
# 重新啟動
sudo systemctl restart php-fpm
# 刷新設定
sudo systemctl reload php-fpm
# 查詢狀態
sudo systemctl status php-fpm
# 開幾自動起動
sudo systemctl enable php-fpm
# 開幾不啟動
sudo systemctl disable php-fpm
```

#### PHP設定
```bash
# 設定
sudo vi /etc/php-fpm.d/www.conf

; user = apache
user = nginx

; group = apache
group = nginx

# Nginx啟用PHP時要配合這設定
; Note: This value is mandatory.
listen = 127.0.0.1:9000
```


### 安裝網頁服務器Nginx
```bash
# 安裝
sudo yum install -y nginx

# 啟動
sudo systemctl start nginx
# 停止
sudo systemctl stop nginx
# 重新啟動
sudo systemctl restart nginx
# 刷新設定
sudo systemctl reload nginx
# 查詢狀態
sudo systemctl status nginx
# 開幾自動起動
sudo systemctl enable nginx
# 開幾不啟動
sudo systemctl disable nginx
```

### Nginx設置自訂配置目錄
```bash
# 建立目錄
mkdir /etc/nginx/sites-available
# 設定增加引用
sudo vi /etc/nginx/nginx.conf
# 修改描述
http {

    # 原本的server{}整段用#在前面註解掉

    # 自訂設定檔
    include /etc/nginx/sites-available/*.conf;
}
```

## PHP設置自訂配置目錄

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
