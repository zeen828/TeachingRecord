[回上層目錄](../README.md)

# Bootstrap(樣式)

## **Description [描述]**
Bootstrap是一種前端樣式樣板。

## **Teaching & Examples [教學&範例]**
### 安装
```
npm install --save bootstrap
```

### 引用
```js
// main.js中引入
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'
```

### 測試範例
```vue
<template>
  <button class="btn btn-primary" data-bs-target="#collapseTarget" data-bs-toggle="collapse">
    Bootstrap collapse
  </button>
  <div class="collapse py-2" id="collapseTarget">
    This is the toggle-able content!
  </div>
</template>
```

## **Reference article [參考文章]**
[參考文件](https://stackoverflow.com/questions/65547199/using-bootstrap-5-with-vue-3)

## **Author [作者]**
`Mr. Will`
