[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
在CentOS下安裝自動部署套件Jenkins與配置流程。

## **Teaching & Examples [教學&範例]**
### 查版本
```bash
cat /etc/redhat-release
```

### 更新(挑一種)
```bash
sudo yum -y update

sudo yum -y upgrade
```

### 安裝基礎軟體
```bash
sudo yum -y install wget
sudo yum -y install vim
```

### 安裝相依軟體Java
```bash
sudo yum -y install java-11-openjdk
```

### 安裝設定
```bash
sudo wget -O /etc/yum.repos.d/jenkins.repo \
    https://pkg.jenkins.io/redhat-stable/jenkins.repo

sudo rpm --import https://pkg.jenkins.io/redhat-stable/jenkins.io.key

sudo yum -y install jenkins

sudo systemctl daemon-reload

sudo systemctl enable jenkins

sudo systemctl start jenkins

sudo systemctl status jenkins
```

### Web安裝過程
http://localhost:8080
```bash
cat /var/lib/jenkins/secrets/initialAdminPassword
```
選左邊的安裝就可以

### 配置

## **Reference article [參考文章]**
[參考文件](https://www.jenkins.io/doc/book/installing/linux/)

## **Author [作者]**
`Mr. Will`
