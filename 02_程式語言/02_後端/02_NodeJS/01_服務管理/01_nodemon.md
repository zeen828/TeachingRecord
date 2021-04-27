[回上層目錄](../README.md)

# 程式語言 / 後端 / Node.js / 服務管理 / `nodemon`

## **Description [描述]**
開發時會使用這一套來做服務器狀態管理，在正式環境會以pm2來管理。

## **Teaching & Examples [教學&範例]**
### 安裝
```bash
# 安裝nodemon
npm install -g nodemon
```

### 運行指令
```bash
# 原本運作指令
node main.js
# 使用nodemon運作指令
nodemon main.js
```

### 設定
```json
// nodemon.json
{
  "verbose": false,
  "ignore": ["static_files/*"],
  "delay": 2500
}
```
| 套件 | 說明 |
| :---- | :---- |
| verbose | 設定為 true 時會顯示 nodemon 監控到了什麼檔案變動了，並且依據 pattern 是否會重啟 |
| ignore | 設定哪些檔案有變動時不需重啟伺服器 |
| delay | 檔案變更後多少時間才會重新啟動伺服器(單位為毫秒)，可以在檔案很多變動時避免一直重新啟動 |

## **Reference article [參考文章]**
[參考文件](https://xenby.com/b/283-%E6%8E%A8%E8%96%A6-%E9%96%8B%E7%99%BC-node-js-server-%E8%87%AA%E5%8B%95%E9%87%8D%E5%95%9F%E5%A5%BD%E5%B7%A5%E5%85%B7-nodemon)

## **Author [作者]**
`Mr. Will`
