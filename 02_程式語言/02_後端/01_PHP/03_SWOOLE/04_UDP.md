[回上層目錄](../README.md)

# 教學用 > 後端 > PHP > SWOOLE > UDP

## **Description [描述]**
屁話一段

## **Teaching & Examples [教學&範例]**
### 簡易程式碼
```php
// swoole_udp_server.php
<?php
use Swoole\Server;
// 建立Server對象，監聽127.0.0.1:3000
$server = new Swoole\Server('127.0.0.1', 3000, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
// 監聽：接收資料
$server->on('Packet', function ($server, $data, $clientInfo) {
    var_dump($clientInfo);
    $server->sendto($clientInfo['address'], $clientInfo['port'], "Server：{$data}");
});
// 啟動
$server->start();
```

### 指令
```bash
# 運作指令
php swoole_udp_server.php
# 測試(需要安裝netcat)
netcat -u 127.0.0.1 3000
```

## **Reference article [參考文章]**
[參考文件](https://wiki.swoole.com/#/start/start_udp_server)

## **Author [作者]**
`Mr. Will`
