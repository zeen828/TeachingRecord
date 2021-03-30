[回上層目錄](../README.md)

# 路由

## **Description [描述]**
透過路由控制所有的路徑訪問頁面。

## **Teaching & Examples [教學&範例]**
### 路由設定
```js
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('@/views/home/pages/Index.vue')
    children: [
      {
        // 階層子目錄
        path: ':id/index',
        name: 'HomeIndex',
        component: () => import('@/views/home/pages/Index.vue')
      },
      {
        path: ':id/demo',
        name: 'HomeDemo',
        // 自訂欄位
        meta: {
          title: '標題',
          keywird: '關鍵字',
          // 可以放層級結構
          breadcrumb: [
            {
              i18n: 'menu.home.name',
              toName: 'Home'
            }
          ]
        },
        component: () => import('@/views/home/pages/Index.vue')
      }
    ]
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

### 超連結(帶變數)
```html
<router-link :to="{ name: 'HomeIndex', params: { id: id } }">超連結</router-link>
```

### 取用自訂值
```js
var meta = this.$route.meta
```

### 透過陸游取得參數值
```js
export default {
  name: 'HomeIndex',
  computed: {
    homeId: {
      get () {
        return this.$route.params.id
      }
    }
  }
}
```

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
