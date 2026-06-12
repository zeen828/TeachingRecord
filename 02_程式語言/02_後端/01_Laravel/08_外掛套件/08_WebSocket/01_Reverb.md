[回上層目錄](../README.md)

# Reverb 套件

## **Menu [目錄]**
看需要決定

## **Description [描述]**
Laravel 12 安裝套件 laravel/reverb 讓專案實現 WebSocket，建立事件可以在 WebSocket 發送是濺訊息。

### 安裝
```bash
# 安裝
composer require laravel/reverb
# 安裝-追加 env 設定
php artisan reverb:install
# 安裝-追加 env 設定(PASS問答都預設值)
php artisan reverb:install --no-interaction
# 運行
php artisan reverb:start
# 運行(指定PORT)
php artisan reverb:start --port=7272
# 運行(除錯資訊)
php artisan reverb:start --debug
# 清除全部緩存(改ENV時能用)
php artisan optimize:clear
```

### 參考ENV
.env 的設定跟 config 上的要對一下，他有分 SERVER 端跟 Cline 端
```bash
BROADCAST_CONNECTION=reverb

REVERB_APP_ID=826593
REVERB_APP_KEY=rpxfhb01c7vvng8ccpry
REVERB_APP_SECRET=vnka046wgxvlnhnmx1nx

# Reverb Server 自己監聽
REVERB_SERVER_PORT=7272

# Laravel 要連去哪裡(LaraDocker 需要看執行容器決定 Host)
# REVERB_HOST="localhost"
REVERB_HOST="workspace"
REVERB_PORT=7272
REVERB_SCHEME=http
```

### 建立EVENT測試
```bash
# 建立TestMessage事件
php artisan make:event TestChannelMessage
```
```php
<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// class TestChannelMessage
class TestChannelMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public string $message)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            // new PrivateChannel('test-channel'),
            new Channel('test-channel'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'test.message';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
        ];
    }
}
```

### 測試
```
php artisan tinker
> event(new \App\Events\TestChannelMessage('Hello'))
```

### PostMan
設定一個WebSocket頁面
ws://localhost:7272/app/rpxfhb01c7vvng8ccpry
```json
# 加入頻道
{
    "event": "pusher:subscribe",
    "data": {
        "channel": "test-channel"
    }
}
```

## **Replenish [補充]**

<details>
    <summary>LaraDocker 環境下額外處理</summary>

### Docker開對應PORT
```yml
# (Laradock的docker-compose.yml)
### Workspace Utilities ##################################
    workspace:
        略過...
      ports:
        略過...
        - "7272:7272"
```

### 調整port後Docker需要重建
```bash
# 單獨停止並刪除 workspace 容器 (其他如 nginx、mysql 不受影響)
docker-compose stop workspace
docker-compose rm -f workspace
# 重新啟動 workspace (此時 Docker 就會套用你剛改好的 7272 Port 設定)
docker-compose up -d workspace
# 查看Docker開那些對應port
docker ps
```

### Nginx 要開 WebSocket Proxy
```conf
location /app {
    proxy_pass http://127.0.0.1:8080;

    proxy_http_version 1.1;

    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "Upgrade";

    proxy_set_header Host $host;
}
```


</details>
<div style="margin-bottom: 20px;"></div>


<details>
    <summary>Supervisor(常駐程式管理)</summary>

### 安裝
1. 安裝 Supervisor
```bash
# Ubuntu
sudo apt update
sudo apt install supervisor -y
systemctl status supervisor

# CentOS / Rocky / AlmaLinux
sudo yum install supervisor -y
systemctl status supervisord

# 啟動
sudo systemctl enable supervisord
sudo systemctl start supervisord
```

2. 建立 Reverb 服務
```bash
# 例如專案放在：
# /var/www/temple

# WebSocket 套件 - php artisan reverb:start (WebSocket 伺服器)
vi /etc/supervisor/conf.d/reverb.conf
```

設定範例-Reverb
```conf
[program:reverb]
process_name=%(program_name)s
; 專案目錄
directory=/var/www/temple
; 指定執行指令
command=/usr/bin/php artisan reverb:start
; 自動啟動與自動重啟
autostart=true
autorestart=true
; 設定執行使用者 (Ubuntu 通常是 www-data)
user=www-data
; 同時啟動多少個 Worker (併發處理)
numprocs=1

redirect_stderr=true
; 錯誤與輸出日誌
stdout_logfile=/var/www/temple/storage/logs/reverb-out.log
stderr_logfile=/var/www/temple/storage/logs/reverb-error.log

stopwaitsecs=3600
```

2-2. 建立 Queue (執行序)服務
```bash
# Laravel 排序 - php artisan queue:work (隊列 / 任務處理器)
vi /etc/supervisor/conf.d/laravel-worker.conf
```

設定範例-Laravel執行序
```conf
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
; 專案目錄
directory=/var/www/temple
; 指定執行指令
command=/usr/bin/php artisan queue:work --sleep=3 --tries=3
; 自動啟動與自動重啟
autostart=true
autorestart=true
; 設定執行使用者 (Ubuntu 通常是 www-data)
user=www-data
; 同時啟動多少個 Worker (併發處理)
numprocs=2

redirect_stderr=true
; 錯誤與輸出日誌
stdout_logfile=/var/www/temple/storage/logs/queue-out.log
stderr_logfile=/var/www/temple/storage/logs/queue-error.log
```

2-3. 建立 schedule (排程)服務
```bash
# Laravel 排程 - php artisan schedule:work (排程排班表)
```

設定範例-Laravel排程
```conf
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
; 專案目錄
directory=/var/www/temple
; 指定執行指令
command=/usr/bin/php artisan schedule:work --sleep=3 --tries=3
; 自動啟動與自動重啟
autostart=true
autorestart=true
; 設定執行使用者 (Ubuntu 通常是 www-data)
user=www-data
; 同時啟動多少個 Worker (併發處理)
numprocs=2

redirect_stderr=true
; 錯誤與輸出日誌
stdout_logfile=/var/www/temple/storage/logs/schedule-out.log
stderr_logfile=/var/www/temple/storage/logs/schedule-error.log
```

3. 載入設定
```bash
# 重新掃描
sudo supervisorctl reread
# 套用設定
sudo supervisorctl update
# 啟動
sudo supervisorctl start reverb
# 停止
sudo supervisorctl stop reverb
# 重啟
sudo supervisorctl restart reverb
# 重啟全部
sudo supervisorctl restart all
# 查看
sudo supervisorctl status
# 正常
reverb RUNNING
```

</details>
<div style="margin-bottom: 20px;"></div>


## **Teaching & Examples [教學&範例]**
實作範例期望每個人照步驟都可以有一個成功範例

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
