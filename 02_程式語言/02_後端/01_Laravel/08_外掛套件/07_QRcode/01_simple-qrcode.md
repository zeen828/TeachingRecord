[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
屁話一段

## **Teaching & Examples [教學&範例]**
### 安裝
```bash
composer require simplesoftwareio/simple-qrcode
```

### 安裝配置
```php
# 配置/config/app.php
    return [

    'providers' => [
        ....                
        SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class,
    ],
    
    'aliases' => [
        ....                
        'QrCode' => SimpleSoftwareIO\QrCode\Facades\QrCode::class,
    ]
```

### 前端QRcode

## **Reference article [參考文章]**
[參考文件](https://techvblogs.com/blog/generate-qr-code-laravel-8)

## **Author [作者]**
`Mr. Will`
