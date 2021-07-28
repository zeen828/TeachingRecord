[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
屁話一段

## **Teaching & Examples [教學&範例]**
### 簡易程式碼
```php
// swoole_redis_server.php
<?php
use Swoole\Redis;
use Swoole\Http\Request;
use Swoole\Http\Response;

$redis = new Swoole\Redis;
$redis->connect('127.0.0.1', 6379, function ($redis, $result) {
    $redis->set('test_key', 'value', function ($redis, $result) {
        $redis->get('test_key', function ($redis, $result) {
            var_dump($result);
        });
    });
});
```

### 指令
```bash
# 運作指令
php swoole_redis_server.php
```

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
