[回上層目錄](../README.md)

# 教學用 > 前端 > Ｖus.js > Axios

## **Description [描述]**
Axios是一套

## **Teaching & Examples [教學&範例]**
###
HTTP 狀態碼的 5 種狀態：

1xx → 訊息
2xx → 成功
3xx → 重新導向
4xx → 客戶端錯誤
5xx → 伺服器錯誤

### 範例
```js
axios({
  method: 'get',
  baseURL: 'http://api.xxxx.com',
  url: '/users',
  headers: { 'Content-Type': 'application/json' }
}).then((result) => { 
    console.log(result.data)
}).catch((err) => {
    console.error(err)
})
// method Get 取 API
// baseURL API 主網域 (前面固定的網址部分)
// url Call API 此頁的路徑
// result 伺服器回傳類似 reponseObject，而其中 data 才是我們頁面上要的資料
// err 回傳失敗的錯誤訊息
```

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
