# payloads

## 🔴nmap
## 🔴hosts設定

## 🔴仮想pipinstallが必要な場合

### 1. directory作成
mkdir -p ~/htb_env
cd ~/htb_env

### 2. 仮想環境を作成（Python3のvenvモジュール使用）
python3 -m venv htb_venv

### 3. 仮想環境を有効化
source htb_venv/bin/activate


## 🔴サブドメイン列挙
git clone https://github.com/aboul3la/Sublist3r.git
cd Sublist3r
python3 sublist3r.py -d domain -o hoge_subdomains.txt

ffuf -w -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt -u http://domain.com -mc 200 -fs 0

## 🔴directory列挙

dirb http://ドメイン/
ffuf -u http://ドメイン/FUZZ -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt -c -t 50
gobuster dir -u http://domain/ -w /usr/share/wordlists/dirb/common.txt
dirsearch -u http://domain/ -x 403,404,400  

## 🔴ユーザー列挙

ffuf -w /usr/share/wordlists/seclists/Usernames/Names/names.txt \
     -u "http://nocturnal.htb/view.php?username=FUZZ&file=file.pdf" \
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

