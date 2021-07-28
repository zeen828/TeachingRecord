[回上層目錄](../README.md)

# 教學用 > 前端 > JavaScript > console

## **Description [描述]**
JavaScript在ES6時

## **Teaching & Examples [教學&範例]**
### Regular(最常見的用法)
```js
console.log('HI 我是喬依司')
```

### Interpolated(於console中插入字元，也可直接使用ES6提供的寫法)
```js
console.log('HI 我是喬依司 %s','我愛貓')
//ES6
let text = '我愛貓'
console.log(`HI 我是喬依司 ${text}`)
```

### Styled(於console中插入樣式)
```js
console.log('%c HI 我是喬依司','font-size:60px; color:green;')
```

### warning!(警告)
```js
console.warn('這是警告')
```

### Error :|(錯誤)
```js
console.error('這是錯誤')
```

### Info(與log相同性質)
```js
console.info('這是Info')
```

### clearing(清除)
```js
console.clear()
```

### Testing(使用斷言進行除錯)
```js
console.assert('true','HI 我是喬依司')
console.assert('false','HI 我是Joyce')
```

### Viewing DOM Elements(查看所有可使用的屬性與方法)
```js
const p = document.querySelector('p')
console.log(p)
console.dir(p)
```

### Grouping together(歸類資料)
```js
console.groupCollapsed('分類')
console.log('分類名稱')
console.log('分類事項')
console.log('分類項目')
console.groupEnd('分類')
```

### counting(查看出現過幾次)
```js
console.count('貓出現幾次?')
console.count('貓出現幾次?')
console.count('貓出現幾次?')
console.count('貓出現幾次?')

console.count('狗出現幾次?')
console.count('狗出現幾次?')
console.count('狗出現幾次?')

console.count('貓出現幾次?')
console.count('狗出現幾次?')
console.count('貓出現幾次?')
```

### timing(計算程式運行的速度)
```js
console.time('test1')
let i
let j
for (i=0; i<10000; i++){
  j=i
}
console.timeEnd('test1')

console.time('test2')
for (let i=0; i<10000; i++){
  let j=i
}
console.timeEnd('test2')
```

## **Reference article [參考文章]**
[參考文件](https://ithelp.ithome.com.tw/articles/10241048)

## **Author [作者]**
`Mr. Will`
