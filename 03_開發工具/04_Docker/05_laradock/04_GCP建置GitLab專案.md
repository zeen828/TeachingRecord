[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
在 GCP 上的 CentOS 系統使用 Laradock 配置服務器，透過 GitLab 建立 Nuxt(Vue.js延伸) 專案並設定 Nginx 相關設定。

## **Teaching & Examples [教學&範例]**
### 服務器建立配置網站站點
```bash
# 切換root角色
sudo su
# 查看歷史指令
history
# 切換到工作目錄
cd /data/
# 使用git下載專案（用公司個人帳號公司信箱）
git clone https://gitlab.com/cookietag-frontend/cookietag-yath.git yath-web
# 進入專案目錄
cd yath-web/
# 查看分支
git branch
git branch -r
# 切亂到要用的分支
git checkout -b dev origin/dev
# git下載
git pull
# 調整專案目錄權限
cd ..
sudo chown cookietag:google-sudoers -R yath-web/
# 設定nginx指向
cd Laradock/nginx/sites
# 複製vue配置檔案
cp new.cookietag.com.conf www.yath.co.conf
# 編輯配置
vim www.yath.co.conf
# 重啟nginx
cd ../..
docker-compose restart nginx
```

### 網站站點追加SSL(godaddy)

1. 透過servce(mac)建立key。
```bash
openssl req -new -newkey rsa:2048 -nodes -keyout www.gamibank.com.key -out www.gamibank.com.csr
# Country Name (2 letter code) []:TW
# State or Province Name (full name) []:Taiwan
# Locality Name (eg, city) []:Taipei
# Organization Name (eg, company) []:Cookietag
# Organizational Unit Name (eg, section) []:IT
# Common Name (eg, fully qualified host name) []:www.gamibank.com
# Email Address []:will@gamibank.com
# A challenge password []:test_pwd

# 會在當前目錄生成www.gamibank.com.key和www.gamibank.com.csr
```

2. 進入Godaddy管理介面，選擇SSL Certificates，點選域名進入要重新配置的SSL。

3. 選擇Manage Certificate下的Re-Key your certificate重新生成新簽章，將剛剛產生的www.gamibank.com.csr內容貼到此處。

4. 選擇Manage Certificate下的Change the site that your certificate protects重新指定要生成簽章的域名。

5. 上面的動作完成後點選Submit All Changes，等待大約二分鐘就好了。

6. Nginx配置SSL

### Nginx上配置SSL

1. 進入Godaddy管理介面，選擇SSL Certificates，點選域名進入要重新配置的SSL。

2. Download Certificate下載簽章，選折其他(Other)下載檔案。

3. 解壓縮剛剛下載的檔案後會發現有三個檔案。
```bash
# 檔案名稱下載亂數生成，
631721d169c77fb3.crt
631721d169c77fb3.pem
gd_bundle-g2-g1.crt
```

4. 合併下載檔案生成配置用簽章。
```bash
cat 631721d169c77fb3.crt gd_bundle-g2-g1.crt >> goddaddy.www.gamibank.com.crt
```

5. 將簽章和key建置到服務器上。
```bash
# /data/Laradock/nginx/ssl
vi www.gamibank.com.key
# 內容放置先前產的www.gamibank.com.key
vi www.gamibank.com.crt
# 內容放置先前下載合併的goddaddy.www.gamibank.com.crt
```

6. 設定Nginx。
```bash
# /data/Laradock/nginx/sites/www.gamibank.com.conf
server {
    listen 80;
    server_name www.gamibank.com;
#     return 301 https://www.gamibank.com$request_uri;
    return 301 https://$host$request_uri;
}

server {

    # listen 80;
    # listen [::]:80;

    # For https
    listen 443 ssl;
    # listen [::]:443 ssl ipv6only=on;
    ssl_certificate /etc/nginx/ssl/www.gamibank.com.crt;
    ssl_certificate_key /etc/nginx/ssl/www.gamibank.com.key;

    server_name www.gamibank.com;
    root /var/www/bank-web/public;
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

    error_log /var/log/nginx/www_gamibank_com_error.log;
    access_log /var/log/nginx/www_gamibank_com_access.log;
}
```

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
