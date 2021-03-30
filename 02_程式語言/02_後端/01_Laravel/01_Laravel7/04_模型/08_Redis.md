[回上層目錄](../README.md)

# Redis

## **敘述**
Laravel預設沒有安裝redis套件，需要使用視需要自行額外再安裝的，這間會列出如何安裝設定跟基本使用方式。

## **教學&範例**
### 安裝
```bash
composer require predis/predis
```

### 設定
```env
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 使用
```php
use Illuminate\Support\Facades\Redis;

class Demo
{
    public function test ()
    {
        // Redis
        // Redis連線
        $redis = Redis::connection();
        // 建立一個值
        $redis->set('name', 'Taylor');
        // 取得一個值
        $name = $redis->get('name');
        $values = $redis->lrange('names', 5, 10);

        // 設定一個儲存資料，賦予一個Key給予一個Value
        Redis::set('key', 'value');

        // 取得一個指定Key的Value，如果Key不存在返回一個NULL
        Redis::get('key');

        // 刪除一個指定Key
        Redis::del('key');

        // Mget儲存多筆資料，以陣列[Key=>Value]方式儲存
        $array= array(
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        );
        Redis::mset($array);

        // Mget返回所有的key指定值，如果Key不存在返回一個NULL
        Redis::mget(array_keys( $array));

        // 取得指定Key儲存的字串長度
        Redis::strlen('key');

        // 獲取指定Key的值，指定第0~2位元字
        Redis::substr('key', 0, 2);

        // 根據Key做模糊搜尋
        Redis::keys('use*');

        // 獲取緩存時間
        Redis::ttl('str2');

        // 檢查是否存在某個Key
        Redis::exists('foo');


        // 隊列操作
        //rpush/rpushx 有序列表操作,从队列后插入元素；lpush/lpushx 和 rpush/rpushx 的区别是插入到队列的头部,同上,'x'含义是只对已存在的 key 进行操作
        Redis::rpush('fooList', 'bar1'); // 返回列表长度 1
        Redis::lpush('fooList', 'bar2'); // 返回列表长度 2
        Redis::rpushx('fooList', 'bar3'); // 返回 3, rpushx只对已存在的队列做添加,否则返回 0


//llen返回当前列表长度
var_dump(Redis::llen('fooList')); //返回3

//lrange 返回队列中一个区间的元素
var_dump(Redis::lrange ('fooList', 0, 1)); // 返回数组包含第 0 个至第 1 个, 共2个元素
var_dump(Redis::lrange ('fooList', 0, -1)); //返回第0个至倒数第一个, 相当于返回所有元素

//lindex 返回指定顺序位置的 list 元素
var_dump(Redis::lindex('fooList', 1)); // 返回'bar1

//lset 修改队列中指定位置的value
Redis::lset('fooList', 1, '123'); // 修改位置 1 的元素, 返回 true

//lrem 删除队列中左起指定数量的字符
Redis::lrem('fooList', 1, '_') ; // 删除队列中左起(右起使用-1) 1个 字符'_'(若有)

//lpop/rpop 类似栈结构地弹出(并删除)最左或最右的一个元素
Redis::lpop('fooList') ; // 返回 'bar0'
Redis::rpop('fooList') ; // 返回 'bar2'

//ltrim队列修改，保留左边起若干元素，其余删除
Redis::ltrim('fooList', 0, 1) ; // 保留左边起第 0 个至第 1 个元素

//rpoplpush 从一个队列中 pop 出元素并 push 到另一个队列
Redis::rpush('list1', 'ab0');
Redis::rpush('list1', 'ab1');
Redis::rpush('list2', 'ab2');
Redis::rpush('list2', 'ab3');
Redis::rpoplpush('list1', 'list2'); // 结果list1 =>array('ab0'), list2 =>array('ab1','ab2','ab3')
Redis::rpoplpush('list2', 'list2'); // 也适用于同一个队列, 把最后一个元素移到头部 list2 =>array('ab3','ab1','ab2')

//linsert在队列的中间指定元素前或后插入元素
Redis::linsert('list2', 'before', 'ab1', '123'); //表示在元素 'ab1' 之前插入 '123'
Redis::linsert('list2', 'after', 'ab1', '456'); //表示在元素 'ab1' 之后插入 '456'

//blpop/brpop 阻塞并等待一个列队不为空时，再pop出最左或最右的一个元素（这个功能在php以外可以说非常好用）
Redis::blpop('list3', 10) ; // 如果 list3 为空则一直等待,直到不为空时将第一元素弹出, 10 秒后超时

排序操作:
//sort 排序
Redis::rpush('tab', 3);
Redis::rpush('tab', 2);
Redis::rpush('tab', 17);
Redis::sort('tab'); // 返回 array(2,3,17)

// 使用参数,可组合使用 array('sort' => 'desc','limit' => array(1, 2))
Redis::sort('tab', array('sort' => 'desc')); // 降序排列，返回 array(17,3,2)
Redis::sort('tab', array('limit' => array(1, 2))); //返回顺序位置中1的元素2个(这里的2是指个数,而不是位置)，返回array(3,17)
Redis::sort('tab', array('limit' => array('alpha' => true))); //按首字符排序返回array(17,2,3)，因为17的首字符是'1'所以排首位置
Redis::sort('tab', array('limit' => array('store' => 'ordered'))); //表示永久性排序，返回元素个数
Redis::sort('tab', array('limit' => array('get' => 'pre_*'))); //使用了通配符'*'过滤元素，表示只返回以'pre_'开头的元素

管理操作：
//info 显示服务当状态信息
Redis::info();

//select 指定要操作的数据库
Redis::select(4); // 指定数据库的下标

//flushdb 清空当前库
Redis::flushdb();

//move 移动当库的元素到其它数据库
Redis::set('tomove', 'bar');
Redis::move('tomove', 4);

//slaveof 配置从服务器
Redis::slaveof('127.0.0.1', 80); // 配置 127.0.0.1 端口 80 的服务器为从服务器
Redis::slaveof(); // 清除从服务器

//同步保存服务器数据到磁盘
Redis::save();

//异步保存服务器数据到磁盘
Redis::bgsave ();

//返回最后更新磁盘的时间
Redis::lastsave();

set 集合操作  sadd增加set集合元素， 返回true， 重复返回false
Redis::sadd('set1', 'ab');
Redis::sadd('set1', 'cd');
Redis::sadd('set1', 'ef');

//srem 移除指定元素
Redis::srem('set1', 'cd'); // 删除'cd'元素

//spop 弹出首元素
Redis::spop('set1'); // 返回 'ab'

//smove 移动当前set集合的指定元素到另一个set集合
Redis::sadd('set2', '123');
Redis::smove('set1', 'set2', 'ab'); // 移动'set1'中的'ab'到'set2', 返回true or false；此时 'set1'集合不存在 'ab' 这个值

//scard 返回当前set表元素个数
Redis::scard('set2'); // 返回 2

//sismember 判断元素是否属于当前set集合
Redis::sismember('set2', '123'); // 返回 true or false

//smembers 返回当前set集合的所有元素
Redis::smembers('set2'); // 返回 array('123','ab')

//sinter/sunion/sdiff 返回两个表中元素的交集/并集/补集
Redis::sadd('set1', 'ab') ;
Redis::sinter('set2', 'set1') ; //返回array('ab')

//sinterstore/sunionstore/sdiffstore 将两个表交集/并集/补集元素 copy 到第三个表中
Redis::set('foo', 0);
Redis::sinterstore('foo', 'set1'); // 等同于将'set1'的内容copy到'foo'中，并将'foo'转为set表
Redis::sinterstore('foo', array('set1', 'set2')); // 将'set1'和'set2'中相同的元素 copy 到'foo'表中, 覆盖'foo'原有内容

//srandmember 返回表中一个随机元素
Redis::srandmember('set1') ;

//hset/hget 存取hash表的数据
Redis::hset('hash1', 'key1', 'v1'); //将key为'key1' value为'v1'的元素存入hash1表
Redis::hset('hash1', 'key2', 'v2');
Redis::hget('hash1', 'key1'); //取出表'hash1'中的key 'key1'的值,返回'v1'

//hexists 返回hash表中的指定key是否存在
Redis::hexists('hash1', 'key1') ; //true or false

//hdel 删除hash表中指定key的元素
Redis::hdel('hash1', 'key2') ; //true or false

//hlen 返回hash表元素个数
Redis::hlen('hash1'); // 返回 1

//hsetnx 增加一个元素,但不能重复
Redis::hsetnx('hash1', 'key1', 'v2') ; // false
Redis::hsetnx('hash1', 'key2', 'v2') ; // true

//hmset/hmget 存取多个元素到hash表
Redis::hmset('hash1', array('key3' => 'v3', 'key4' => 'v4'));
Redis::hmget('hash1', array('key3', 'key4')); // 返回相应的值 array('v3','v4')

//hincrby 对指定key进行累加
Redis::hincrby('hash1', 'key5', 3); // 不存在，则存储并返回 3；存在，即返回 原有值 + 3；
Redis::hincrby('hash1', 'key5', 10); // 返回13

//hkeys 返回hash表中的所有key
Redis::hkeys('hash1'); // 返回array('key1', 'key2', 'key3', 'key4', 'key5')

//hvals 返回hash表中的所有value
Redis::hvals('hash1'); // 返回 array('v1','v2','v3','v4',13)

//hgetall 返回整个hash表元素
Redis::hgetall('hash1'); // 返回 array('key1'=>'v1','key2'=>'v2','key3'=>'v3','key4'=>'v4','key5'=>13)
    }
}
```

## **參考文章**
[參考文件](網址)

## **作者**
`Mr. Will`
