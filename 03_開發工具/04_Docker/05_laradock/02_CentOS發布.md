[回上層目錄](../README.md)

# 環境部署

## **Description [描述]**
GCP上發佈laradock。

## **Teaching & Examples [教學&範例]**

# 安裝Docker
```bash
# 更新yum套件工具
sudo yum update

# 安裝以下套件
sudo yum install -y yum-utils device-mapper-persistent-data lvm2

# 添加倉庫
sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo

# 安裝最新版本的Docker引擎
sudo yum install docker-ce docker-ce-cli containerd.io

# 啟動Docker服務
sudo systemctl start docker

# 查看Docker版本
docker -v
Docker version 19.03.5

# 啟動Docker
sudo systemctl start docker

# 將目前使用者加進docker群組
sudo gpasswd -a ${USER} docker
# 需要重新登入
```

# 安裝Docker Compose
```bash
# 下載執行檔
sudo curl -L "https://github.com/docker/compose/releases/download/1.23.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

# 設定權限
sudo chmod +x /usr/local/bin/docker-compose

# 建立軟連結
sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose

# 查看Docker Compose版本
docker-compose -v
docker-compose version 1.25.3
```

# 安裝Laradock
```bash
# 從 GitHub 上將 Laradock 下載下來
git clone https://github.com/Laradock/laradock.git Laradock

# 複製範本 env-example 檔作為設定檔
cd ~/Laradock && cp env-example .env

# 修改 .env 檔的 APP_CODE_PATH_HOST 參數到指定的映射路徑
APP_CODE_PATH_HOST=/var/www

# 使用 docker-compose 啟動 Laradock
cd ~/Laradock
docker-compose up -d nginx mysql redis workspace
# 停止容器運作
docker-compose stop
# 停止容器運作外加上移除容器
docker-compose down

# 查容器
docker ps -a
docker exec -it <Container ID> bash
docker exec -it 4684f212da83 bash
```

# 疑難排除
```bash
# ERROR: Couldn't connect to Docker daemon at http+docker://localhost - is it running?
# If it's at a non-standard location, specify the URL with the DOCKER_HOST environment variable.

# 啟動Docker
sudo systemctl start docker
```

## **Reference article [參考文章]**
[參考文件](https://blog.epoch.tw/2020/02/06/%E5%9C%A8-CentOS-%E4%B8%8A%E5%BB%BA%E7%AB%8B-Laradock-%E7%92%B0%E5%A2%83/)

## **Author [作者]**
`Mr. Will`
