[回上層目錄](../README.md)

# # Bootstrap(樣式)

## **敘述**
Bootstrap是一種前端樣式樣板。

## **教學&範例**
### 安裝
```
npm install -save bootstrap jquery popper.js
```

### 設定
```js
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
```
main.js

### 使用JQuery
```vue
<script>
import $ from 'jquery'
export default {
  name: 'Home',
  mounted () {
    // 查詢jQuery版本
    console.log($().jquery)
  }
}
</script>
```

## **參考文章**
[參考文件](網址)

## **作者**
`Mr. Will`
