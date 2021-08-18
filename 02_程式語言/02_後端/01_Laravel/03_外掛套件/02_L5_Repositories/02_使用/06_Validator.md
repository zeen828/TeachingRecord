[回上層目錄](../README.md)

# 程式語言 / 後端 / Laravel / 外掛套件 / L5 Repositories / 使用 / `Validator`的教學

## **Description [描述]**
Validator - 寫入資料庫時的資料檢查

## **Teaching & Examples [教學&範例]**

### 執行指令
```bash
php artisan make:validator "Folder/Validator"
# Validator created successfully.

# 增加的檔案
# app/Validators/Folder/ValidatorValidator.php
```

### 基礎
```php
<?php

namespace App\Validators\Folder;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ValidatorValidator.
 *
 * @package namespace App\Validators\Folder;
 */
class ValidatorValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
```

## **Reference article [參考文章]**
[參考文件]()

## **Author [作者]**
`Mr. Will`
