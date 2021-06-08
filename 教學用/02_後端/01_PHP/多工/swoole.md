[回上層目錄](../README.md)

# 教學用 > 後端 > PHP

## **Menu [目錄]**
看需要決定

## **Description [描述]**
屁話一段

## **Teaching & Examples [教學&範例]**
```php
<?php
echo 'PHP 資訊測試', PHP_EOL;

$start_time = microtime(TRUE);
$cmds = [
    "uname",
    "date",
    "whoami"
];
foreach ($cmds as $cmd) {
    $process = new swoole_process( "my_process", true);
    $process->start();
    $process->write($cmd); //通過管道發資料到子程序。管道是單向的：發出的資料必須由另一端讀取。不能讀取自己發出去的
    echo $rec = $process->read();//同步阻塞讀取管道資料
}
//子程序建立成功後要執行的函式
function my_process(swoole_process $worker){
sleep(1);//暫停1s
    $cmd = $worker->read();
    // $return = exec($cmd);//exec只會輸出命令執行結果的最後一行內容，且需要顯式列印輸出
    ob_start();
    passthru($cmd);//執行外部程式並且顯示未經處理的、原始輸出，會直接列印輸出。
    $return = ob_get_clean();
    if(!$return) $return = 'null';
        $worker->write($return);//寫入資料到管道
}
//子程序結束必須要執行wait進行回收，否則子程序會變成殭屍程序
while($ret = swoole_process::wait()){// $ret 是個陣列 code是程序退出狀態碼，
    $pid = $ret['pid'];
    echo PHP_EOL."Worker Exit, PID=" . $pid . PHP_EOL;
}
$end_time = microtime(TRUE);
echo sprintf("use time:%.3f s\n", $end_time - $start_time);
```
```
[root@demo05 demo05.jbgbet.com]# php info.php 
PHP 資訊測試
Linux
四  5月 27 18:09:05 CST 2021
root

Worker Exit, PID=1870359

Worker Exit, PID=1870365

Worker Exit, PID=1870367
use time:3.042 s
```

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
