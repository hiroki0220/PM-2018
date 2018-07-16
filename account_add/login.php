<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title> 中古教科書フリマシステム </title>
</head>
<body>
<?php

try
{
$mail=$_POST['mail'];
$pass=$_POST['pass'];

$mail= htmlspecialchars($mail,ENT_QUOTES,'UTF-8');
$pass = htmlspecialchars($pass,ENT_QUOTES,'UTF-8');


require_once '../conf.php';
$db= new PDO($dsn,$dbUser,$dbPass);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT name,id FROM customers WHERE mail=? AND password=?';
$prepare=$db->prepare($sql);
$data[]=$mail;
$data[]=$pass;
$prepare->execute($data);

$db=null;

$result=$prepare->fetch(PDO::FETCH_ASSOC);

if($result==false)
{
	echo 'メールアドレスかパスワードが間違っています。<br />';
    echo '<a href="
"> 戻る</a>';
}
else
{
	session_start();
	$_SESSION['login']=1;
	$_SESSION['mail']=$mail;
	$_SESSION['name']=$result['name'];
	$_SESSION['id']=$result['id'];
	header('Location:../top.php');
	exit();
}

}
catch(Exception $e)
{
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>
</body>
</html>