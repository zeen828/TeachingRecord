[回上層目錄](../README.md)

# 主題

## **Menu [目錄]**
看需要決定

## **Description [描述]**
這是用金鑰做ssh的登入

## **Teaching & Examples [教學&範例]**
### 建立金鑰
```bash
# 建立key
ssh-keygen
# 建立key(額外指定加密模式)
ssh-keygen -m PEM -t rsa -b 4096

# Generating public/private rsa key pair.
# 輸入金鑰存放位置與名稱
# Enter file in which to save the key (/root/.ssh/id_rsa): /var/jenkins_home/key/gcpTestDockerJenkins
# Enter passphrase (empty for no passphrase): 
# Enter same passphrase again: 
# Your identification has been saved in /var/jenkins_home/key/gcpTestDockerJenkins
# Your public key has been saved in /var/jenkins_home/key/gcpTestDockerJenkins.pub
# The key fingerprint is:
# SHA256:ip6WetcuV0sdstu+HuTHFClSxyftWb4vRdPrTW2BLPQ root@d0ed4248cbf8
# The key's randomart image is:
# +---[RSA 4096]----+
# |            .... |
# |           o .o.+|
# |          o + +=+|
# |          .o.E ==|
# |        S  +o...*|
# |     . .  +o.o o=|
# |    .... o +o ++o|
# |   .+.o o o .o..o|
# |  .+o. +.  o+. . |
# +----[SHA256]-----+
# root@d0ed4248cbf8:/var/jenkins_home/key#
```

### 註冊GCP中繼資料
```bash
cat gcpTestDockerJenkins.pub 
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQDOAgNIwaTwHbxfoz/krezbEvFUHkm3JOxdI1WcuRZIcJjMVTFtSJ1amqkcFTBy+v0ZdLeNdbX2eK1gFGc0rf7/oXw3kpfIaFK70tFd3WtIwC6HFik0SOfNblTMvKJDF4EMp/1SI2nU1q0ULI0wUImp9vR2Lz/Hk9VWaNp4S3h+RvvLuzIZ7oNcq7eI7hz45pDZT3iH+vnURSi0R73/twCG8N0A8o27PAPzWlhf5ZWpQDSCtjWIXHei0+vDQWBuNFpKlU0iNRoREcp9NyVLAb6KWxgk1w88W87OlDapRyM6lm3VrRceC9vvuYLJIMs3Cb/+NXBEyeF9BCM+YxK0EFq+QZI5unwRYqbpIrRDXz1H+Y6fStwpGL5EqhoGjEccZgOW5gaZ7A5lySa0P5dFDbDLc4s6UL9a0jZOi2NfSB/KzABNycI5A9sze71Ylj2Qoy0elGVN1kgIEgC5tDRD7qFSbUsUMVkHqEncOO1Me/FDKIkoVdufd2AtlVnM6M9r83MQPswBNV5U9mIJ2Q3FNeAfEOhVjfp/mWm7i0w5De+U/pmpDZbplxCVzNrcOyKmlxZ3ldSsu5/0lHi9+nQBVEmff1tRNTjfdhnaIa1vKzrveKHE0F/lrcNLhAqIv3qKs+B9uB8ZnL5onq2R3UzvPFN4hEzDxeMEkD43xYI+NSfpFQ== root@d0ed4248cbf8
```
最後後面root@d0ed4248cbf8是背著可以改的，在GCP是有意義的，
登入角色@哪台設備的公鑰



/data/test/app
/data/test/pc


### 問題排除

## **Reference article [參考文章]**
[參考文件](網址)

## **Author [作者]**
`Mr. Will`
