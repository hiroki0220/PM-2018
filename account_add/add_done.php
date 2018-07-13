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
require_once '../conf.php';


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

echo 'そのままログインしますか?';
echo '<form method="post" action="login.php">';
echo  '<input type="hidden" name="mail" value="'.$mail.'">';
echo  '<input type="hidden" name="pass" value="'.$pass.'">';
echo  '<input type="submit"value="ログイン">';
echo '</form>';

echo '<form method="get" action="../index.php">';
echo '<input type="submit" value="スタート画面へ">';
echo '</form>';
}

catch (Exception $e)
{
echo'ただいま障害により大変ご迷惑をおかけしております。';
exit();
}

?>



