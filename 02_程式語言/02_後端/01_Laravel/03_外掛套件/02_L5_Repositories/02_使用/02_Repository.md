[回上層目錄](../README.md)

# 程式語言 / 後端 / Laravel / 外掛套件 / L5 Repositories / 使用 / `Repository`的教學

## **Description [描述]**
Repository - 主要是用來處理查詢的，我們將Entity保持乾淨狀態只有結構跟關係，其他的查詢或自訂透過這裡來處理，可以搭配Criteria一起使用。

## **Teaching & Examples [教學&範例]**

### 執行指令
```bash
php artisan make:repository "Folder/Repository"
# Repository created successfully.

# 增加的檔案
# app/Entities/Folder/Repository.php
# app/Repositories/Folder/RepositoryRepository.php
# app/Repositories/Folder/RepositoryRepositoryEloquent.php
# database/migrations/2021_08_03_174908_create_folder/_repositories_table.php
```

### 基礎
```php
<?php

namespace App\Repositories\Folder;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RepositoryRepository.
 *
 * @package namespace App\Repositories\Folder;
 */
interface RepositoryRepository extends RepositoryInterface
{
    //
}
```

```php
<?php

namespace App\Repositories\Folder;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Folder\RepositoryRepository;
use App\Entities\Folder\Repository;
use App\Validators\Folder\RepositoryValidator;

/**
 * Class RepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Folder;
 */
class RepositoryRepositoryEloquent extends BaseRepository implements RepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Repository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
```

### 緩存
```php
namespace App\Repositories\Folder;

// 略...
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

class RepositoryRepositoryEloquent extends BaseRepository implements RepositoryRepository
{
    use CacheableRepository;

    // 略...
}
```

### 引用一個Repository
```php
$repository = app('App\Repositories\Folder\RepositoryRepository');
```

## **Reference article [參考文章]**
[參考文件](https://www.jianshu.com/p/d640a61d8631)

## **Author [作者]**
`Mr. Will`
