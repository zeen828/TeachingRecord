[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
屁話一段

## **Teaching & Examples [教學&範例]**

#### 添加PHP 8.2設定
```bash
vi .env
# 增加一個設定
PHP_VERSION_82=8.2
```

#### 複製PHP設定檔
```bash
# 複製文件PHP設定檔
cp -r php-fpm/ php-fpm-82/
```

#### 修改Docker設定
```bash
# 編輯Docker文件，複製原本的PHP-FPM出來修改版本
vi docker-compose.yml 

### PHP-FPM For PHP 8.2 ##############################################
    php-fpm-82:
      build:
        context: ./php-fpm-82
        args:
          - CHANGE_SOURCE=${CHANGE_SOURCE}
          - BASE_IMAGE_TAG_PREFIX=${PHP_FPM_BASE_IMAGE_TAG_PREFIX}
          # PHP版本設定
          - LARADOCK_PHP_VERSION=${PHP_VERSION_82}
          - LARADOCK_PHALCON_VERSION=${PHALCON_VERSION}
          - INSTALL_BZ2=${PHP_FPM_INSTALL_BZ2}
...(內容忽略)
          - no_proxy
      volumes:
        # 調整PHP設定檔位置
        - ./php-fpm/php${PHP_VERSION_82}.ini:/usr/local/etc/php/php.ini
...(內容忽略)
```

#### 修改Nginx設定
```bash
server {
...(內容忽略)
    location ~ \.php$ {
        try_files $uri /index.php =404;
        #fastcgi_pass php-upstream;
        fastcgi_pass php-fpm-82:9000;
    }
...(內容忽略)
}
```

#### 服務器啟動與重啟
```bash
# 建立新服務容器
docker-compose up -d php-fpm-82
# 重啟Nginx服務
docker-compose restart nginx
```

#### 複製Workspace設定檔
```bash
# 複製文件PHP設定檔
cp -r workspace/ workspace-82/
```

#### 修改Docker設定
```bash
# 編輯Docker文件，複製原本的PHP-FPM出來修改版本
vi docker-compose.yml 

### Workspace Utilities For PHP 8.2 ##################################
    workspace-82:
      build:
        context: ./workspace-82
        args:
          - CHANGE_SOURCE=${CHANGE_SOURCE}
          - SHELL_OH_MY_ZSH=${SHELL_OH_MY_ZSH}
          - SHELL_OH_MY_ZSH_AUTOSUGESTIONS=${SHELL_OH_MY_ZSH_AUTOSUGESTIONS}
          - SHELL_OH_MY_ZSH_ALIASES=${SHELL_OH_MY_ZSH_ALIASES}
          - BASE_IMAGE_TAG_PREFIX=${WORKSPACE_BASE_IMAGE_TAG_PREFIX}
          # PHP版本設定
          - LARADOCK_PHP_VERSION=${PHP_VERSION_82}
...(內容忽略)
      ports:
        # port與舊的衝突需要設定其他的來用
        - "8222:22"
        - "8230:3000"
        - "8231:3001"
        - "8280:8080"
        - "8281:8000"
        - "8242:4200"
        - "8251:5173"
...(內容忽略)
```

#### 服務器啟動與重啟
```bash
docker-compose build workspace-82
# 建立新服務容器
docker-compose up -d workspace-82
# 進入workspace容器
docker-compose exec workspace-82 bash
```

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
