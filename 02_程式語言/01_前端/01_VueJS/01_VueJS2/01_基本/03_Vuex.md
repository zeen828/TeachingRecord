[回上層目錄](../README.md)

# Vuex(store)

## **Description [描述]**
Vuex是一種狀態管理的應用，在很多時候需要互相溝通確定狀態的時候非常好用。

## **Teaching & Examples [教學&範例]**
### 建構新vuex
```js
export default {
  namespaced: true,
  // 用來資料共享資料儲存
  state: {
    accessToken: '',
    signature: '',
    debug: false
  },
  // 用來註冊改變資料狀態
  // this.$store.commit('mutations function name')
  mutations: {
    setAccessToken (state, val) {
      state.accessToken = val
    },
    setSignature (state, val) {
      state.signature = val
    },
    setDebug (state, val) {
      state.debug = val
    }
  },
  // 用來對共享資料進行過濾操作
  getters: {
    getAccessToken (state) {
      return state.accessToken
    },
    getSignature (state) {
      return state.signature
    },
    getDebug (state) {
      return state.debug
    }
  },
  // 解決非同步改變共享資料
  // 建議透過這這邊執行邏輯運算後呼叫mutations
  // this.$store.dispatch('actions function name')
  actions: {
    ready (context) {
      console.log('Vues.store.model.action.ready')
    }
  }
}

```
建立/src/store/modules/user.js

### 擴展模組
```js
import Vue from 'vue'
import Vuex from 'vuex'

// module
import apiUser from './modules/user'

Vue.use(Vuex)

export default new Vuex.Store({
  // 用來資料共享資料儲存
  state: {
    debug: false
  },
  // 用來註冊改變資料狀態
  mutations: {
    setDebug (state, val) {
      state.debug = val
    }
  },
  // 用來對共享資料進行過濾操作
  getters: {
    getDebug (state) {
      return state.debug
    }
  },
  // 解決非同步改變共享資料
  actions: {
    ready: function ({ commit, dispatch, rootState, state }) {
      console.log('Vues.store.action.ready')
    }
  },
  // store的子模組，為了開發大型專案，方便狀態管理而使用的
  modules: {
    apiUser
  }
})
```
修改/src/store/index.js

### 使用範例
```js
export default {
  name: 'App',
  computed: {
    userDebug: {
      get () {
        // 取modules的值
        return this.$store.getters['module/getDebug']
      },
      set (val) {
        // 執行mutations
        this.$store.commit('module/setDebug', val)
      }
    }
  },
  mounted () {
    // 取根的值
    this.$store.getters.getDebug
    // 執行actions
    this.$store.dispatch('module/ready'),
  }
}
```
App.vue中使用範例

```js
  actions: {
    ready (context) {
      // 取本身的值
      var val = context.getters.getDebug
      // 取根的值
      var valRoot = context.rootGetters.getDebug
      // 取modules的值
      var valModule = context.rootGetters['storeFintechClient/getDebug']
      // 執行根的mutations
      context.commit('setDebug', 'false', { root: true })
      // 執行module的mutations
      context.commit('storeFintechClient/setDebug', 'false', { root: true })
      // 執行根的actions
      context.dispatch('ready', 'false', { root: true })
      // 執行module的actions
      context.dispatch('storeFintechClient/ready', 'false', { root: true })
    },
  }
```
src\store\index.js中使用範例

```js
import Store from '@/store/index.js'
// 取根的值
var valRoot = Store.getters.getDebug
// 取modules的值
var valModule = Store.getters['storeFintechClient/getDebug']
// 執行根的mutations
Store.commit('setDebug', false)
// 執行module的mutations
Store.commit('storeFintechClient/setDebug', false)
// 執行根的actions
Store.dispatch('ready')
// 執行module的actions
Store.dispatch('storeFintechClient/ready')
```
api.js整合中使用範例

> ### 同步非同步
> #### 同步 (一個動作執行完，才作下一個動作)
> ```js
> import ajaxFintechUser from '@/api/fintech/user'
>   methods: {
>     async ready () {
>       var that = this
>       // 等待排隊執行
>       try {
>         // call api one
>         const one = await ajaxFintechUser.getToken(that.account, that.password)
>         console.table('第一個 回傳結果', one)
>         window.localStorage.setItem('access_token', one.data.data.access_token)
>         // call api two
>         const two = await ajaxFintechUser.getRead()
>         console.table('第二個 回傳結果', two)
>       } catch (error) {
>         throw new Error(error)
>       }
>     }
>   }
> ```
> 
> #### 非同步 (不需要等待上一個動作完成，才作下一個動作)
> ```js
> import ajaxFintechClient from '@/api/fintech/client'
> import ajaxBetClient from '@/api/bet/client'
>   methods: {
>     ready () {
>       var that = this
>       // 同時執行
>       axios.all([
>         // call api one
>         ajaxFintechClient.getToken(),
>         // call api two
>         ajaxBetClient.getToken()
>       ]).then(axios.spread((one, two) => {
>         // axios 回傳的資料在 data 屬性
>         console.table('第一個 回傳結果', one)
>         // fetch 資料可以先在 function 內作 json()
>         console.table('第二個 回傳結果', two)
>       })).catch((err) => {
>         console.error(err)
>       })
>     }
>   }
> ```

## **Reference article [參考文章]**
[參考文件](https://vuex.vuejs.org/zh/)

## **Author [作者]**
`Mr. Will`
