<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> 中古教科書フリマシステム </title>
</head>
<body>

<?php

try
{

  $name = $_POST['name'];
  $address = $_POST['address'];
  $tel = $_POST['tel'];
  $mail = $_POST['mail'];
  $pass = $_POST['pass'];

  $name = htmlspecialchars($name,ENT_QUOTES,'UTF-8');
  $address= htmlspecialchars($address,ENT_QUOTES,'UTF-8');
  $tel= htmlspecialchars($tel,ENT_QUOTES,'UTF-8');
  $mail= htmlspecialchars($mail,ENT_QUOTES,'UTF-8');
  $pass = htmlspecialchars($pass,ENT_QUOTES,'UTF-8');

  //データベース接続設定
  $dbServer = '127.0.0.1';
  $dbName = 'yabukib';
  $dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
  $dbUser = 'root';
  $dbPass = '';
  
  $db = new PDO($dsn,$dbUser,$dbPass);
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql = 'INSERT INTO customers (mail,password,name,address,tel) VALUES (?,?,?,?,?)';
  $prepare =$db->prepare($sql);
  $data[] = $mail; 
  $data[] = $pass;
  $data[] = $name;
  $data[] = $address;
  $data[] = $tel;
  
  
  $prepare->execute($data);

  $db = null;

  echo $name;
  echo'さんを追加しました。 <br/>';


}

  catch (Exception $e)
  {
    echo'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
  }

 ?>

 <a href="../account_login/login.html">ログイン画面へ</a>
</body>
</html>
