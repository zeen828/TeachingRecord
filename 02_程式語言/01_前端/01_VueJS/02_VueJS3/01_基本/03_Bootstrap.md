[回上層目錄](../README.md)

# Bootstrap(樣式)

## **Description [描述]**
Bootstrap是一種前端樣式樣板。

## **Teaching & Examples [教學&範例]**
### 安装Jquery
```bash
npm install --save jquery
```
### main.js中必須要引用
```js
// jQuery
import $ from 'jquery';
window.$ = $;
```

### 安装sass
```bash
npm install --save node-sass sass-loader
```

### 安装Jquery
```bash
npm install --save bootstrap
npm install --save @popperjs/core
npm install --save bootstrap-icons
```
### main.js中引用
```js
// Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'
// import 'bootstrap/dist/js/bootstrap.js'// 這個會導致js無法運作
import 'bootstrap'
// Bootstrap icon
import 'bootstrap-icons/font/bootstrap-icons.css'
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
[Bootstrap icon](https://icons.getbootstrap.com/)

## **Author [作者]**
`Mr. Will`
