[回上層目錄](../README.md)

# 教學用 > 後端 > PHP > SWOOLE > TCP

## **Description [描述]**
屁話一段

## **Teaching & Examples [教學&範例]**
### 簡易程式碼
```php
// swoole_tcp_server.php
<?php
use Swoole\Server;
// 建立Server對象，監聽127.0.0.1:3000
$server = new Swoole\Server('127.0.0.1', 3000);
// 監聽：建立連線
$server->on('Connect', function ($server, $fd) {
    echo "Client: Connect.\n";
});
// 監聽：接收資料
$server->on('Receive', function ($server, $fd, $reactor_id, $data) {
    $server->send($fd, "Server: {$data}");
});
// 監聽：中斷連線
$server->on('Close', function ($server, $fd) {
    echo "Client: Close.\n";
});
// 啟動
$server->start(); 
```

### 指令
```bash
# 運作指令
php swoole_tcp_server.php
# 測試(需要安裝telnet)
telnet 127.0.0.1 3000
# 測試
curl -v telnet://127.0.0.1:3000
```

## **Reference article [參考文章]**
[參考文件](https://wiki.swoole.com/#/start/start_tcp_server)

## **Author [作者]**
`Mr. Will`
