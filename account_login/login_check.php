<?php

try
{
$mail=$_POST['mail'];
$pass=$_POST['pass'];

$mail= htmlspecialchars($mail,ENT_QUOTES,'UTF-8');
$pass = htmlspecialchars($pass,ENT_QUOTES,'UTF-8');

$pass=md5($pass);

$dbServer = '127.0.0.1';
$dbName = 'yabukib';
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
$dbUser = 'root';
$dbPass = '';

$db= new PDO($dsn,$dbUser,$dbPass);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT name FROM customers WHERE mail=? AND password=?';
$prepare=$db->prepare($sql);
$data[]=$mail;
$data[]=$pass;
$prepare->execute($data);

$db=null;

$result=$prepare->fetch(PDO::FETCH_ASSOC);

if($result==false)
{
	print 'メールアドレスかパスワードが間違っています。<br />';
	print '<a href="login.html"> 戻る</a>';
}
else
{
	session_start();
	$_SESSION['login']=1;
	$_SESSION['mail']=$mail;
	$_SESSION['name']=$result['name'];
	header('Location:../top.php');
	exit();
}

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>