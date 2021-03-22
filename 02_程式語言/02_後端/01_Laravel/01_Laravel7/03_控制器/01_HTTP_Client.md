[回上層目錄](../README.md)

# Laravel 控制 HTTP_Client

## **敘述**
這是用來處理後端訪問其他站點的功能也可以訪問API，前身是guzzlehttp/guzzle第三方套件在某個版本laravel把它涵蓋進標準裡面了。

## **教學&範例**
### 安裝guzzlehttp/guzzle
如果你的laravel版本沒有內建HTTP你可以自行安裝。
```bash
composer require guzzlehttp/guzzle
```

### 基本使用
```php
// 引用
use Illuminate\Support\Facades\Http;
```
```php
public function demoGET()
{
    $apiUrl = 'https://reqbin.com/echo/get/json';
    $response = Http::get($apiUrl);
    if ($response->ok()) {
        var_dump($response->body());
    }
}
```
```php
public function demoPOST()
{
    $apiUrl = 'https://reqbin.com/echo/post/json';
    $formData = [
        'debug' => true,
    ];
    $response = Http::post($apiUrl, $formData);
    if ($response->ok()) {
        var_dump($response->body());
    }
}
```

### 回傳處理
```php
// 狀態碼>=200 <300之間的都成功
$response->successful();
// 狀態碼>=400的都失敗
$response->failed();
// 狀態碼400
$response->clientError();
// 狀態碼500
$response->serverError();
```

```php
$response->body() : string;
$response->json() : array|mixed;
$response->status() : int;
$response->ok() : bool;
$response->successful() : bool;
$response->failed() : bool;
$response->serverError() : bool;
$response->clientError() : bool;
$response->header($header) : string;
$response->headers() : array;
```

### 改變傳遞類型
http預設是使用application/json
```php
public function demoFORM()
{
    $apiUrl = 'https://reqbin.com/echo/post/json';
    $formData = [
        'debug' => true,
    ];
    // 透過asForm()可改為application/x-www-form-urlencoded
    $response = Http::asForm()->post($apiUrl, $formData);
    if ($response->ok()) {
        var_dump($response->body());
    }
}
```

### 傳遞檔案

### 設定表頭
```php
public function demoHEADER()
{
    $apiUrl = 'https://reqbin.com/echo/post/json';
    $headerData = [
        'X-First' => 'foo',
        'X-Second' => 'bar'
    ];
    $formData = [
        'debug' => true,
    ];
    // 透過asForm()可改為application/x-www-form-urlencoded
    $response = Http::withHeaders($headerData)->post($apiUrl, $formData);
    if ($response->ok()) {
        var_dump($response->body());
    }
}
```

### 認證token
```php
public function demoPOST()
{
    $apiUrl = 'https://reqbin.com/echo/post/json';
    $formData = [
        'debug' => true,
    ];
    // 透過withToken('token')他會產生header[Authorization] = Bearer token
    $response = Http::withToken('token')->post($apiUrl, $formData);
    if ($response->ok()) {
        var_dump($response->body());
    }
}
```

### 超時
```php
public function demoPOST()
{
    $apiUrl = 'https://reqbin.com/echo/post/json';
    $formData = [
        'debug' => true,
    ];
    // 透過timeout(3)設定他結束訪問時間
    $response = Http::timeout(3)->post($apiUrl, $formData);
    if ($response->ok()) {
        var_dump($response->body());
    }
}
```

### 拋出異常
```php
public function demoPOST()
{
    $apiUrl = 'https://reqbin.com/echo/post/json';
    $formData = [
        'debug' => true,
    ];
    // 透過timeout(3)設定他結束訪問時間
    $response = Http::post($apiUrl, $formData);
    $response->throw(function ($response, $e) {
        // 異常處理
    });
    if ($response->ok()) {
        var_dump($response->body());
    }
}
```

### 模擬測試
```php
public function demoPOST()
{
    $resHeaderData = [
        'content-type' => 'application/json',
    ];
    $resData = [
        'success' => true,
        'data' => [
            'access_token' => 'test_token',
            'expires_in' => '86400',
        ]
    ];
    // 這個可以模擬你訪問的請求回傳指定內容
    Http::fake([
        'github.com/*' => Http::response($resData, 200, $resHeaderData),
        '*' => Http::response($resData, 200, $resHeaderData),
    ]);

    $apiUrl = 'https://reqbin.com/echo/post/json';
    $formData = [
        'debug' => true,
    ];
    $response = Http::post($apiUrl, $formData);
    if ($response->ok()) {
        var_dump($response->body());
    }
}
```

## **參考文章**
[Laravel官方教學](https://laravel.com/docs/8.x/http-client)

## **作者**
`Mr. Will`
