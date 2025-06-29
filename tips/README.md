# tips

## 🔴nmap
## 🔴hosts設定

## 🔴仮想pipinstallが必要な場合

### 1. directory作成
sudo apt update

sudo apt install python3-venv python3-pip -y

mkdir -p ~/venv/tf

### 2. 仮想環境を作成（Python3のvenvモジュール使用）

python3 -m venv ~/venv/tf

### 3. 仮想環境を有効化

source ~/venv/tf/bin/activate

## 🔴Dockerが必要な場合

sudo apt update

sudo apt install -y docker.io

sudo systemctl start docker

sudo systemctl enable docker

sudo docker run hello-world

sudo usermod -aG docker $USER

newgrp docker

## 🔴pwntools

sudo apt update

sudo apt install -y python3-pip python3-dev libssl-dev libffi-dev build-essential

pip3 install --upgrade pip

pip3 install pwntools

python3 -c "from pwn import *; print('pwntools is installed')"



## 🔴サブドメイン列挙
### Sublist3r
git clone https://github.com/aboul3la/Sublist3r.git

cd Sublist3r

python3 sublist3r.py -d ドメイン -o hoge_subdomains.txt

### FFUF
ffuf -w -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt -u http://ドメイン -mc 200 -fs 0

## 🔴directory列挙

### dirb
dirb http://ドメイン/

### FFUF
ffuf -u http://ドメイン/FUZZ -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt -c -t 50

### gobuster
gobuster dir -u http://ドメイン/ -w /usr/share/wordlists/dirb/common.txt

### dirsearch
dirsearch -u http://ドメイン/ -x 403,404,400  

## 🔴ユーザー列挙

ffuf -w /usr/share/wordlists/seclists/Usernames/Names/names.txt \
     -u "http://ドメイン/view.php?username=FUZZ&file=file.pdf" \
     -H "Cookie: PHPSESSID=xxx" \
     -fr "User not found."

## 🔴ファイルのパスを検索

### Windows

C:\> where /r C:\ user.txt

### linux

find /home -name "user.txt" 2>/dev/null

## 🔴SSHコマンド

ssh user@hoge.com

## 🔴SMB

### 列挙

crackmapexec smb xxx.xxx.xxx.xxx -u xxxuserxxx -p 'xxx' --users

smbmap -H xxx.xxx.xxx.xxx -u xxxuserxxx -p 'xxx'

### 一覧

smbclient -L //xxx.xxx.xxx.xxx/IPC -U xxxuserxxx --password=xxx

### アクセス 

smbclient //xxx.xxx.xxx.xxx/ADMIN$ -U xxxuserxxx --password=xxx

### ファイルアップロード

put exploit.zip exploit.zip

### ファイルダウンロード

get file.txt

## 🔴tools

