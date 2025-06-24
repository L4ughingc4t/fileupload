# payloads

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


## 🔴サブドメイン列挙
git clone https://github.com/aboul3la/Sublist3r.git

cd Sublist3r

python3 sublist3r.py -d ドメイン -o hoge_subdomains.txt

ffuf -w -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt -u http://ドメイン -mc 200 -fs 0

## 🔴directory列挙

dirb http://ドメイン/

ffuf -u http://ドメイン/FUZZ -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt -c -t 50

gobuster dir -u http://ドメイン/ -w /usr/share/wordlists/dirb/common.txt

dirsearch -u http://ドメイン/ -x 403,404,400  

## 🔴ユーザー列挙

ffuf -w /usr/share/wordlists/seclists/Usernames/Names/names.txt \
     -u "http://ドメイン/view.php?username=FUZZ&file=file.pdf" \
     -H "Cookie: PHPSESSID=xxx" \
     -fr "User not found."

## 🔴ファイルのパスを検索

Windows

C:\> where /r C:\ user.txt

linux

find /home -name "user.txt" 2>/dev/null

## 🔴SSHコマンド

ssh user@hoge.com

## 🔴SMB

列挙

crackmapexec smb xxx.xxx.xxx.xxx -u xxxuserxxx -p 'xxx' --users

smbmap -H xxx.xxx.xxx.xxx -u xxxuserxxx -p 'xxx'

一覧

smbclient -L //xxx.xxx.xxx.xxx/IPC -U xxxuserxxx --password=xxx

アクセス 

smbclient //xxx.xxx.xxx.xxx/ADMIN$ -U xxxuserxxx --password=xxx

ファイルアップロード

put exploit.zip exploit.zip

