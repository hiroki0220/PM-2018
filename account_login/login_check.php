<?php

try
{
$staff_mail=$_POST['mail'];
$staff_pass=$_POST['pass'];

$staff_mail= htmlspecialchars($staff_mail,ENT_QUOTES,'UTF-8');
$staff_pass = htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

$staff_pass=md5($staff_pass);

$dbServer = '127.0.0.1';
$dbName = 'yabukib';
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
$dbUser = 'root';
$dbPass = '';

$db= new PDO($dsn,$dbUser,$dbPass);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT name FROM customers WHERE mail=? AND password=?';
$prepare=$db->prepare($sql);
$data[]=$staff_mail;
$data[]=$staff_pass;
$prepare->execute($data);

$db=null;

$result=$prepare->fetch(PDO::FETCH_ASSOC);

if($result==false)
{
	print 'メールアドレスかパスワードが間違っています。<br />';
	print '<a href="staff_login.html"> 戻る</a>';
}
else
{
	session_start();
	$_SESSION['login']=1;
	$_SESSION['staff_mail']=$staff_mail;
	$_SESSION['staff_name']=$result['name'];
	header('Location:staff_top.php');
	exit();
}

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>