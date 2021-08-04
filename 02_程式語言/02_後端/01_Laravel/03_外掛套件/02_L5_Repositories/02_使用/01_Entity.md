[回上層目錄](../README.md)

# 程式語言 / 後端 / Laravel / 外掛套件 / L5 Repositories / 使用 / `Entity`的教學

## **Description [描述]**
Entity是L5 Repositories為了避免與Model干擾，所以才將Model定義成Entity避免混淆，在Entity裡面建議只設定結構跟關聯，查詢處理分面則交給Repository來。

## **Teaching & Examples [教學&範例]**

### 執行指令
```bash
php artisan make:entity "Folder/Entity"
#  Would you like to create a Presenter? [y|N] (yes/no) [no]:
#  > yes
# App\Transformers\Folder\EntityTransformerPresenter created successfully.

#  Would you like to create a Transformer? [y|N] (yes/no) [no]:
#  > yes
# Transformer created successfully.

#  Would you like to create a Validator? [y|N] (yes/no) [no]:
#  > yes
# Validator created successfully.

#  Would you like to create a Controller? [y|N] (yes/no) [no]:
#  > yes
# Request created successfully.
# Request created successfully.
# Controller created successfully.
# Repository created successfully.
# Provider created successfully.
# Bindings created successfully.

# 增加的檔案
# app/Entities/Folder/Entity.php
# app/Http/Controllers/EntitiesController.php
# app/Http/Requests/Folder/EntityCreateRequest.php
# app/Http/Requests/Folder/EntityUpdateRequest.php
# app/Presenters/Folder/EntityPresenter.php
# app/Providers/RepositoryServiceProvider.php
# app/Repositories/Folder/EntityRepository.php
# app/Repositories/Folder/EntityRepositoryEloquent.php
# app/Transformers/Folder/EntityTransformer.php
# app/Validators/Folder/EntityValidator.php
# database/migrations/2021_08_03_174643_create_folder/_entities_table.php
```

### 基礎
```php
<?php

namespace App\Entities\Folder;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Entity.
 *
 * @package namespace App\Entities\Folder;
 */
class Entity extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
```

### 額外可配置欄位
```php
namespace App\Entities\Folder;

// 略...

class Entity extends Model implements Transformable
{
    // 略...

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    // 略...

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The other attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
}
```

### 軟刪除
```php
namespace App\Entities\Folder;

// 略...
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model implements Transformable
{
    // 略...
    use SoftDeletes;

    // 略...
}
```

## **Reference article [參考文章]**
[參考文件](https://www.jianshu.com/p/d640a61d8631)

## **Author [作者]**
`Mr. Will`
