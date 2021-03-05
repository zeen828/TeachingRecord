[回上層目錄](../README.md)

# 路由

## **敘述**
透過路由控制所有的路徑訪問頁面。

## **教學&範例**
### 路由設定
```js
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/home/pages/Index.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
```

### 超連結
```html
<router-link :to="{ name: 'Home' }">超連結</router-link>
```

### 取用自訂值
```js
var meta = this.$route.meta
```

## **參考文章**
[參考文件](網址)

## **作者**
`Mr. Will`
