[回上層目錄](../README.md)

# 教學用 > 後端 > Laravel > 套件 > SwooleTW

## **Menu [目錄]**
看需要決定

## **Description [描述]**
屁話一段

## **Teaching & Examples [教學&範例]**
### 安裝
```bash
composer require swooletw/laravel-swoole
```

### 設定
```php
// confin/app.php
    'providers' => [
        SwooleTW\Http\LaravelServiceProvider::class,
    ],
```

### 建立設定檔
```bash
php artisan vendor:publish --tag=laravel-swoole
```

### 在排程使用寫法
```php
<?php
namespace App\Console\Commands\Demos;
// 模型
use App\Models\User\User;
// Redis
use Redis as NewRedis;
// 時間
use Carbon\Carbon;
// Swoole
use Co;

class loopJob extends Command
{
    public function handle()
    {
        // 開始消息
        $this->line('[' . date('Y-m-d H:i:s') . '] START');
        // NewRedis
        $domain = '127.0.0.1';
        $redisNew = new NewRedis();
        $redisNew->connect($domain, 6379);
        $users = User::get();
        if($users->isEmpty()) {
            $this->error('[' . date('Y-m-d H:i:s') . '] Not Found！');
            return false;
        }
        // swoole多執行序
        Co\run(function() use ($redisNew, $users)
        {
            foreach($users as $user)
            {
                go(function() use ($redisNew, $user)
                {
                    // 取值
                    $keyUser = sprintf('binary_database_user:%s:info', $user->id);
                    $jsonUser = $redisNew->get($keyUser);
                    if(empty($dataForecast))
                    {
                        return false;
                    }
                    $dataUser = json_decode($jsonUser, true);
                    $dataUser[] = [
                        'id' => $user->id,
                        'name' => $user->name,
                    ];
                    if(count($dataUser) >= 20)
                    {
                        $this->comment('[' . date('Y-m-d H:i:s') . '] Data count max! Delete Data count!');
                        array_shift($$dataUser);
                    }
                    // 頻道
                    $channelName = 'user-channel-name';
                    $redisNew->publish($channelName, json_encode($dataUser));
                    // 寫值
                    $redisNew->set($keyUser, json_encode($dataUser));
                });
            }
        });
        // 結束消息
        $this->line('[' . date('Y-m-d H:i:s') . '] END');
        return true;
    }
}
```

## **Reference article [參考文章]**
[參考文件](https://www.swoole.co.uk/article/laravel)

## **Author [作者]**
`Mr. Will`
