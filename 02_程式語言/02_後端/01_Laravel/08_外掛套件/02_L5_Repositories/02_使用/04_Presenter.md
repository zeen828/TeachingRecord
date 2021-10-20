[回上層目錄](../README.md)

# 程式語言 / 後端 / Laravel / 外掛套件 / L5 Repositories / 使用 / `Presenter`的教學

## **Description [描述]**
Presenter - 呈現器,常用於前端模板格式化輸出

## **Teaching & Examples [教學&範例]**
### 執行指令
```bash
php artisan make:presenter "Folder/Presenter"
# App\Transformers\Folder\PresenterTransformerPresenter created successfully.
#  Would you like to create a Transformer? [y|N] (yes/no) [no]:
#  > yes
# Transformer created successfully.

# 增加的檔案
# app/Presenters/Folder/PresenterPresenter.php
# app/Transformers/Folder/PresenterTransformer.php
```

### 基礎
```php
<?php

namespace App\Presenters\Folder;

use App\Transformers\Folder\PresenterTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PresenterPresenter.
 *
 * @package namespace App\Presenters\Folder;
 */
class PresenterPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PresenterTransformer();
    }
}
```

```php
<?php

namespace App\Transformers\Folder;

use League\Fractal\TransformerAbstract;
use App\Entities\Folder\Presenter;

/**
 * Class PresenterTransformer.
 *
 * @package namespace App\Transformers\Folder;
 */
class PresenterTransformer extends TransformerAbstract
{
    /**
     * Transform the Presenter entity.
     *
     * @param \App\Entities\Folder\Presenter $model
     *
     * @return array
     */
    public function transform(Presenter $model)
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

### 去除單筆回傳格式多個data，對集合無效，自訂一個規則改寫集合體
```php
# config/repository.php
    /*
    |--------------------------------------------------------------------------
    | Fractal Presenter Config
    |--------------------------------------------------------------------------
    |

    Available serializers:
    ArraySerializer
    DataArraySerializer
    JsonApiSerializer

    */
    'fractal'    => [
        'params'     => [
            'include' => 'include'
        ],
        // 'serializer' => League\Fractal\Serializer\DataArraySerializer::class
        // 'serializer' => League\Fractal\Serializer\ArraySerializer::class
        'serializer' => App\Serializers\SimpleArraySerializer::class
    ],
```

```php
<?php

namespace App\Serializers;

use League\Fractal\Serializer\ArraySerializer;

/**
 * 自訂改寫集合體回傳不要有'data'
 */
class SimpleArraySerializer extends ArraySerializer
{
    public function collection($resourceKey, array $data)
    {
        return $data;
    }
}
```

### Controller使用
```php
$this->repository->setPresenter("App\Presenters\Folder\PresenterPresenter");
```

### Repository使用設定
```php
namespace App\Repositories\Folder;

// 略...

class RepositoryRepositoryEloquent extends BaseRepository implements RepositoryRepository
{
    // 略...

    /**
     * 略過Presenter開關
     * @var bool
     */
    protected $skipPresenter = false;

    public function presenter()
    {
        return "App\Presenters\Folder\PresenterPresenter";
    }
}
```

### 使用Tmp
```php
$repository = app('App\PostRepository');
$repository->setPresenter("Prettus\Repository\Presenter\ModelFractalPresenter");

//Getting the result transformed by the presenter directly in the search
$post = $repository->find(1);

print_r( $post ); //It produces an output as array

...

//Skip presenter and bringing the original result of the Model
$post = $repository->skipPresenter()->find(1);

print_r( $post ); //It produces an output as a Model object
print_r( $post->presenter() ); //It produces an output as array
```


### 將原生modl或去的資料做格式化
```php
use App\Entities\Model;

        $modelId = 1;
        $data = Model::find($modelId);

        $presenter = app('App\Presenters\ModelMiniPresenter');
        $formatData = $presenter->present($data);
        print_r($formatData);
```

### Controller使用
```php
$this->repository->setPresenter("App\Presenters\Folder\PresenterPresenter");
```

## **Reference article [參考文章]**
[參考文件](https://github.com/joaosalless/laravel-codedelivery/tree/master/app/Transformers)

## **Author [作者]**
`Mr. Will`
