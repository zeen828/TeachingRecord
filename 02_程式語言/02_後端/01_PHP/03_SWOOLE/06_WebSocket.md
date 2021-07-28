[回上層目錄](../README.md)

# 教學用 > 後端 > PHP > SWOOLE > WebSocket

## **Description [描述]**
透過swoole來實作websocket服務器。

## **Teaching & Examples [教學&範例]**
### 簡易程式碼
```php
// swoole_websocket_server.php
<?php
use Swoole\Websocket\Server;
// 建立websocket物件，監聽 0.0.0.0:8080 連接埠
$ws = new Swoole\WebSocket\Server('0.0.0.0', 3000);
// 監聽WebSocket連線事件
$ws->on('Open', function ($ws, $request) {
    $ws->push($request->fd, "hello, welcome\n");
});
// 監聽WebSocket訊息事件
$ws->on('Message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "server: {$frame->data}");
});
// 監聽WebSocket關閉事件
$ws->on('Close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});
// 啟動
$ws->start();
```

### 指令
```bash
# 運作指令(關閉SSH後就停止了)
php swoole_websocket_server.php

# 常駐運作指令(需要自行安裝)
screen php swoole_websocket_server.php

# 測試指令(要安裝wscat)加入ws#需同一台機器
wscat -c ws://localhost:3000/test
```

### 前端
```js
var wsServer = 'ws://127.0.0.1:3000';
var websocket = new WebSocket(wsServer);
websocket.onopen = function (evt) {
    console.log("Connected to WebSocket server.");
};

websocket.onclose = function (evt) {
    console.log("Disconnected");
};

websocket.onmessage = function (evt) {
    console.log('Retrieved data from server: ' + evt.data);
};

websocket.onerror = function (evt, e) {
    console.log('Error occured: ' + evt.data);
};
```

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
