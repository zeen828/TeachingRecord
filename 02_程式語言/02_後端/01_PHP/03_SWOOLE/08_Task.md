[回上層目錄](../README.md)

# 教學用 > 後端 > PHP > SWOOLE > md

## **Menu [目錄]**
看需要決定

## **Description [描述]**
屁話一段

## **Teaching & Examples [教學&範例]**
### 簡易程式碼
```php
// swoole_task_server.php
<?php
Swoole\Coroutine\run(function () {
    var_dump(Co\System::gethostbyname('www.baidu.com'));
});

Swoole\Coroutine\run(function () {
    go(function () {
        var_dump(Co\System::gethostbyname('www.baidu.com'));
    });
    go(function () {
        var_dump(Co\System::gethostbyname('www.zhihu.com'));
    });
});
```

### 指令
```bash
# 運作指令
php swoole_task_server.php
```

## **Reference article [參考文章]**
[參考文件](https://segmentfault.com/a/1190000038848791)
[參考文件](https://www.swoole.co.uk/docs/modules/swoole-coroutine)

## **Author [作者]**
`Mr. Will`
