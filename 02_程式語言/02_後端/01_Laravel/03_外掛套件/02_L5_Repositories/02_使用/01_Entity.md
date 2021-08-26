[回上層目錄](../README.md)

# 程式語言 / 後端 / Laravel / 外掛套件 / L5 Repositories / 使用 / `Entity`的教學

## **Description [描述]**
Entity - 是L5 Repositories為了避免與Model干擾，所以才將Model定義成Entity避免混淆，在Entity裡面建議只設定結構跟關聯，查詢處理方面則交給Repository來。

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

### 常用函式
```php
Prettus\Repository\Contracts\RepositoryInterface
    all($columns = array('*'))
    first($columns = array('*'))
    paginate($limit = null, $columns = ['*'])
    find($id, $columns = ['*'])
    findByField($field, $value, $columns = ['*'])
    findWhere(array $where, $columns = ['*'])
    findWhereIn($field, array $where, $columns = [*])
    findWhereNotIn($field, array $where, $columns = [*])
    create(array $attributes)
    update(array $attributes, $id)
    updateOrCreate(array $attributes, array $values = [])
    delete($id)
    deleteWhere(array $where)
    orderBy($column, $direction = 'asc');
    with(array $relations);
    has(string $relation);
    whereHas(string $relation, closure $closure);
    hidden(array $fields);
    visible(array $fields);
    scopeQuery(Closure $scope);
    getFieldsSearchable();
    setPresenter($presenter);
    skipPresenter($status = true);
```

```php
Prettus\Repository\Contracts\CacheableInterface
    setCacheRepository(CacheRepository $repository)
    getCacheRepository()
    getCacheKey($method, $args = null)
    getCacheMinutes()
    skipCache($status = true)
```

```php
Prettus\Repository\Contracts\PresenterInterface
    present($data);
```

```php
Prettus\Repository\Contracts\Presentable
    setPresenter(PresenterInterface $presenter);
    presenter();
```

```php
Prettus\Repository\Contracts\CriteriaInterface
    apply($model, RepositoryInterface $repository);
```

```php
Prettus\Repository\Contracts\Transformable
    transform();
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

### 將Model改成擁有授權認證的版本
```php
namespace App\Entities\Users;

// use Illuminate\Database\Eloquent\Model;

// 略...

// Auth
use Illuminate\Foundation\Auth\User as Authenticatable;
// JWT(如果使用tymon/jwt-auth)
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User.
 *
 * @package namespace App\Entities\Users;
 */
// class User extends Model implements Transformable, JWTSubject
// 改成下面
class User extends Authenticatable implements Transformable, JWTSubject
{
    // 略...
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
