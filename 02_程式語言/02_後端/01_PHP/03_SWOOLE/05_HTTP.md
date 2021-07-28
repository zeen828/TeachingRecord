[回上層目錄](../README.md)

# 教學用 > 後端 > PHP > SWOOLE > HTTP

## **Description [描述]**
透過swoole來實作web服務器。

## **Teaching & Examples [教學&範例]**
### 簡易程式碼
```php
// swoole_http_server.php
<?php
use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;
// 建立Server對象，監聽127.0.0.1:3000
$http = new Swoole\HTTP\Server('0.0.0.0', 3000);

$http->on("start", function (Server $server) {
    echo "Swoole http server is started at http://127.0.0.1:3000\n";
});

$http->on("request", function (Request $request, Response $response) {
    if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
        $response->end();
        return;
    }
    var_dump($request->get, $request->post);
    $response->header('Content-Type', 'text/html; charset=utf-8');
    $response->end('<h1>Hello Swoole. #' . rand(1000, 9999) . '</h1>');
});
// 啟動
$http->start();
```

### 指令
```bash
# 運作指令
php swoole_http_server.php
```

## **Reference article [參考文章]**
[參考文件](https://wiki.swoole.com/#/start/start_http_server)

## **Author [作者]**
`Mr. Will`
