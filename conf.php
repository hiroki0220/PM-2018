<?php
// データベース設定（ローカルで開発するとき）
// $dbServer = '127.0.0.1';
// $dbUser = 'root';
// $dbPass = '';
// $dbName = 'yabukib';
// // データベース設定（サーバで公開するとき）
$dbServer = '127.0.0.1';
$dbUser = $_SERVER['MYSQL_USER'];
$dbPass = $_SERVER['MYSQL_PASSWORD'];
$dbName = $_SERVER['MYSQL_DB'];;
# MySQL用のDSN文字列です。
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";