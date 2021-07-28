[回上層目錄](../README.md)

# 教學用 > 後端 > PHP > SWOOLE > MyQSL

## **Description [描述]**
如何在Swoole下操作MySQL。

## **Teaching & Examples [教學&範例]**
### 簡易程式碼
```php
// swoole_mysql.php
<?php
Swoole\Coroutine\run(function () {
    // 建立物件
    $mysql = new Swoole\Coroutine\MySQL();
    // 連線資料庫
    $res = $mysql->connect([
        'host'     => '127.0.0.1',
        'database' => 'binary_api',
        'user'     => 'binary',
        'password' => '8GkifHD68cLyeztR',
    ]);
    // 檢查連線
    if ($res == false) {
        echo 'MySQL connect fail！', PHP_EOL;
        return;
    }
    // 查詢語法
    $ret = $mysql->query('SELECT * FROM `binary_currency_trend` WHERE `redeem` = 0 AND `status` = 1 LIMIT 50', 2);
    foreach ($ret as $key=>$data) {
        // 多執行序
        go(function () use ($data) {
            if($data['id']%2 == 0){
                sleep(3);
            }
            echo $data['id'], '-1-', $data['period'], PHP_EOL;
        });
        go(function () use ($data) {
            echo $data['id'], '-2-', $data['period'], PHP_EOL;
        });
    }
});
```

### 指令
```bash
# 運作指令
php swoole_mysql.php
```


## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
