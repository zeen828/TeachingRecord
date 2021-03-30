[回上層目錄](../README.md)

# axios

## **Description [描述]**
用過JQuery的人相信都寫過AJAX，axios是Vue.js用來處理call api用的方法。

## **Teaching & Examples [教學&範例]**
### 安裝
```
npm install --save axios
```

### 建立基礎架構
```js
import axios from 'axios'

export default () => {
  /**
   * axios實利
   */
  var ajaxBase = axios.create({
    // 判斷是否垮域,用來解決CORS
    withCredentials: false,
    baseURL: process.env.VUE_APP_BET_API_PROTOCOL + '://' + process.env.VUE_APP_BET_API_DOMAIN + '/' + process.env.VUE_APP_BET_API_VERSION,
    // 表頭
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
      'Accept-Language': process.env.VUE_APP_LANGUAGE,
      'X-Timezone': process.env.VUE_APP_TIMEZONE,
      Authorization: 'Bearer ' + window.localStorage.getItem('access_token')
    },
    // 請求超時1000毫秒(1秒)
    timeout: 3000,
    // onUploadProgress(progressEvt) {},
    // onDownloadProgress(progressEvt) {},
    // 資料發送至伺服器前，可作資料處理
    // 陣列中最後的函式必須返回字串、ArrayBuffer、Stream
    transformRequest: [
      function (data, headers) {
        return data
      }
    ]
    // 在進入 then / catch 前可作資料處理
    // transformResponse: [function(data) {return data;}]
  })

  return ajaxBase
}
```
建立目錄和檔案src/api/base.js

### 建立API用
```js
import Api from '@/api/bet/base'

export default {
  getToken () {
    console.log('api.bet.client.js > getToken()')
    const formData = new FormData()
    formData.append('client_id', process.env.VUE_APP_BET_CLIENT_ID)
    formData.append('client_secret', process.env.VUE_APP_BET_CLIENT_SECRET)
    // formData.append('client_id', 'ebb3c65c371144d0840149d5776f914d')
    // formData.append('client_secret', '5f0f4f5202125160f02dcec44e7cfab6')
    return Api().post('/auth/token', formData)
    // return Api().post('http://localhost:8000/api/v1/auth/token', formData)
  }
}
```
建立目錄和檔案src/api/api.js

### 使用範例
```js
import ajaxApi from '@/api/fintech/api'

export default {
  name: 'App',
  beforeCreate () {},
  created () {},
  mounted () {
    console.log('App.vue > mounted ()')
    this.ready()
  },
  beforeDestroy () {},
  destroyed () {},
  methods: {
    ready () {
      var that = this
      that.callApi()
    },
    callApi () {
      var that = this
      ajaxApi.getToken().then(function (result) {
        console.log(result)
        if (result.status === 200 && result.request.readyState === 4) {
          // 打API成功處理動作
          const apiData = result.data
          if (apiData !== null && apiData.success === true) {
            console.log(apiData)
            // 回傳成功處理動作
          }
        }
      })
    }
  }
}
```
App.vue中使用範例

## **Reference article [參考文章]**
[參考文件](https://developer.aliyun.com/mirror/npm/package/vue-axios)

## **Author [作者]**
`Mr. Will`
