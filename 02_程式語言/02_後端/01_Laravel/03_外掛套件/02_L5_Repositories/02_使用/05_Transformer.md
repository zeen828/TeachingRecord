[回上層目錄](../README.md)

# 程式語言 / 後端 / Laravel / 外掛套件 / L5 Repositories / 使用 / `Transformer`的教學

## **Menu [目錄]**
看需要決定

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

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
