[回上層目錄](../README.md)

# 程式語言 / 後端 / Laravel / 外掛套件 / L5 Repositories / 使用 / `Criteria`的教學

## **Description [描述]**
Criteria - 是一個查詢標準，將固定的查詢建立成不同標準，插曲資料時可以有效減少每次都重新寫條件，在查詢上也比較統一。

## **Teaching & Examples [教學&範例]**

### 執行指令
```bash
php artisan make:criteria "Folder/Criteria"
# Criteria created successfully.

# 增加的檔案
# app/Criteria/Folder/CriteriaCriteria.php
```

### 基礎
```php
<?php

namespace App\Criteria\Folder;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CriteriaCriteria.
 *
 * @package namespace App\Criteria\Folder;
 */
class CriteriaCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model;
    }
}
```

### Controller內使用
```php
$this->repository->pushCriteria(new Criteria());
// or
$this->repository->pushCriteria(Criteria::class);
// or
$this->repository->pushCriteria(app('Prettus\Repository\Criteria\Criteria'));
$datas = $this->repository->all();

$datas = $this->repository->getByCriteria(new Criteria());

# 重置Criteria
$this->repository->resetCriteria()

# 跳過Criteria不使用
$posts = $this->repository->skipCriteria()->all();

# 移除Criteria
$this->repository->popCriteria(new Criteria());
// or
$this->repository->popCriteria(Criteria::class);
```

### Repository內使用
```php
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(new Criteria());
        // or
        $this->pushCriteria(Criteria::class);
    }
```

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
