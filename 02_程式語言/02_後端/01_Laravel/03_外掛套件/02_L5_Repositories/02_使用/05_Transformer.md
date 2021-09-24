[回上層目錄](../README.md)

# 程式語言 / 後端 / Laravel / 外掛套件 / L5 Repositories / 使用 / `Transformer`的教學

## **Description [描述]**
Transform - 轉換器,用於Model數據格式化輸出

## **Teaching & Examples [教學&範例]**
### 執行指令
```bash
php artisan make:transformer "Folder/Transformer"
# Transformer created successfully.

# 增加的檔案
# app/Transformers/Folder/TransformerTransformer.php
```

### 基礎
```php
<?php

namespace App\Transformers\Folder;

use League\Fractal\TransformerAbstract;
use App\Entities\Folder\Transformer;

/**
 * Class TransformerTransformer.
 *
 * @package namespace App\Transformers\Folder;
 */
class TransformerTransformer extends TransformerAbstract
{
    /**
     * Transform the Transformer entity.
     *
     * @param \App\Entities\Folder\Transformer $model
     *
     * @return array
     */
    public function transform(Transformer $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
```

### 關聯的處理
```php
<?php

namespace App\Transformers\Folder;

use League\Fractal\TransformerAbstract;
use App\Entities\Folder\Transformer;
// Transformer
use App\Transformers\Users\UserTransformer;
use App\Transformers\Users\UserListTransformer;

class TransformerTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['user'];// 預設顯示該關聯結構
    protected $availableIncludes = ['user', 'friend'];// 可以引用的關聯結構(http://127.0.0.1/demo?include=friend)

    public function transform(Transformer $model)
    {
        return [
            'id'         => (int) $model->id,

            'user' => [],
            'friend' => [],
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    // 關聯
    public function includeUser(Item $model)
    {
        // 單筆
        return $this->item($model->rUser, new UserTransformer());
    }

    // 關聯
    public function includeFriend(Item $model)
    {
        // 集合
        return $this->collection($model->rFriend, new UserListTransformer());
    }
}
```

## **Reference article [參考文章]**
[參考文件](https://segmentfault.com/a/1190000021698434)

## **Author [作者]**
`Mr. Will`
