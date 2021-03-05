[回上層目錄](../README.md)

# Bootstrap-vue(樣式)

## **敘述**
Bootstrap-vue和Bootstrap不一樣，Bootstrap-vue是一個專門為Vue開發的UI套件，與原生的Bootstrap並不完全一樣。

## **教學&範例**
### 安裝
```
npm install bootstrap-vue bootstrap --save
```

### 設定
```js
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
```
main.js

## **參考文章**
[參考文件](https://bootstrap-vue.org/docs/)

## **作者**
`Mr. Will`
