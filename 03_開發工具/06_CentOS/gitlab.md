[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
在CentOS下安裝版本控管套件GitLab與配置流程。

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

### 設定時區
```bash
sudo timedatectl set-timezone Asia/Taipei
```

### 安裝基礎軟體
```bash
sudo yum -y install wget
sudo yum -y install vim
```


```bash
sudo yum install -y curl policycoreutils-python openssh-server perl
# Enable OpenSSH server daemon if not enabled: sudo systemctl status sshd
sudo systemctl enable sshd
sudo systemctl start sshd
# Check if opening the firewall is needed with: sudo systemctl status firewalld
sudo firewall-cmd --permanent --add-service=http
sudo firewall-cmd --permanent --add-service=https
sudo systemctl reload firewalld
```


```bash
sudo yum install postfix
sudo systemctl enable postfix
sudo systemctl start postfix
```


```bash
curl https://packages.gitlab.com/install/repositories/gitlab/gitlab-ee/script.rpm.sh | sudo bash
```


```bash
sudo EXTERNAL_URL="http://gitlab.cookietag.com" yum install -y gitlab-ee
```

root
cat /etc/gitlab/initial_root_password
qaz123wsx

## **Reference article [參考文章]**
[參考文件]()

## **Author [作者]**
`Mr. Will`
