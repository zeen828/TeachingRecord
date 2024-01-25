[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
Telegram註冊機器人與串接使用紀錄

## **Teaching & Examples [教學&範例]**
1. 註冊帳號

2. 建立機器人

    連天介面搜尋"BotFather"加入BotFather

    點擊Start會出現一大篇命令（或是輸入/start）

3. 建立機器人

    在BotFather輸入"/newbot"
    
    Alright, a new bot. How are we going to call it? Please choose a name for your bot.

    輸入機器人名稱"可中文"
    "測試機器人0802"

    Good. Now let's choose a username for your bot. It must end in `bot`. Like this, for example: TetrisBot or tetris_bot.

    輸入機器人代號"英文名稱_bot"or"英文名稱Bot"
    "TestWill0802Bot"

    註冊好會提供API Token

    Use this token to access the HTTP API:

    6239680824:AAFLy4SlzswGrJjQvO7ThD8tfgAQf87LQEs

    For a description of the Bot API, see this page: https://core.telegram.org/bots/api


4. 忘記Bot Token

    輸入"/mybots"查詢機器人

    點選對要操作的機器人

    出現介面點擊Api Token就會顯示

5. 重新產新的Bot Token

    輸入"/token"





/newbot - create a new bot
/mybots - edit your bots

Edit Bots
/setname - change a bot's name
/setdescription - change bot description
/setabouttext - change bot about info
/setuserpic - change bot profile photo
/setcommands - change the list of commands
/deletebot - delete a bot

Bot Settings
/token - generate authorization token
/revoke - revoke bot access token
/setinline - toggle inline mode
/setinlinegeo - toggle inline location requests
/setinlinefeedback - change inline feedback settings
/setjoingroups - can your bot be added to groups?
/setprivacy - toggle privacy mode in groups

Web Apps
/myapps - edit your web apps
/newapp - create a new web app
/listapps - get a list of your web apps
/editapp - edit a web app
/deleteapp - delete an existing web app

Games
/mygames - edit your games
/newgame - create a new game
/listgames - get a list of your games
/editgame - edit a game
/deletegame - delete an existing game

### 建立Bot
```bash
# 加入BotFather機器人
# 透過指令對話建立Bot
Iron Man, [Aug 9, 2023 at 6:12:20 PM]:
/newbot

BotFather, [Aug 9, 2023 at 6:12:21 PM]:
Alright, a new bot. How are we going to call it? Please choose a name for your bot.

Iron Man, [Aug 9, 2023 at 6:12:40 PM]:
Lin Wei Tong

BotFather, [Aug 9, 2023 at 6:12:41 PM]:
Good. Now let's choose a username for your bot. It must end in `bot`. Like this, for example: TetrisBot or tetris_bot.

Iron Man, [Aug 9, 2023 at 6:12:49 PM]:
LinWeiTongBot

BotFather, [Aug 9, 2023 at 6:12:50 PM]:
Done! Congratulations on your new bot. You will find it at t.me/LinWeiTongBot. You can now add a description, about section and profile picture for your bot, see /help for a list of commands. By the way, when you've finished creating your cool bot, ping our Bot Support if you want a better username for it. Just make sure the bot is fully operational before you do this.

Use this token to access the HTTP API:
6534627521:AAF7HvmGnplYM3sIZuWi9RvwFjsWZsrTTyQ
Keep your token secure and store it safely, it can be used by anyone to control your bot.

For a description of the Bot API, see this page: https://core.telegram.org/bots/api
```

### webhook設定
```bash
# 查詢Bot狀態，WebHook狀態無法查詢
https://api.telegram.org/bot6239680824:AAFLy4SlzswGrJjQvO7ThD8tfgAQf87LQEs/getUpdates
# 設置Bot透過WebHook串接控制
https://api.telegram.org/bot6239680824:AAFLy4SlzswGrJjQvO7ThD8tfgAQf87LQEs/setWebhook?url=https://ts-openai.ddiudiu.com/api/telegram/webhook
# 查詢Bot WebHook狀態
https://api.telegram.org/bot6239680824:AAFLy4SlzswGrJjQvO7ThD8tfgAQf87LQEs/getWebhookInfo
```

### 群組權限設定
```bash
/setjoingroups - can your bot be added to groups?
選機器人
Enable

/setprivacy - toggle privacy mode in groups
選機器人
Disable
```

### webhook設定
關閉對話功能
Group > Edit > Premissions 切換Send Messages
Ch

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
