<?php
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title> 中古教科書フリマシステム </title>
</head>
<body>

<?php
if(isset($_SESSION['login'])==true)
{
	echo 'ログインされています。<br />';
	echo '<a href="../account_login/logout.php">ログアウト画面へ</a>';
	exit();
}

$name=$_POST['name'];
$address=$_POST['address'];
$tel=$_POST['tel'];
$mail=$_POST['mail'];
$pass=$_POST['pass'];
$pass2=$_POST['pass2'];

$name= htmlspecialchars($name,ENT_QUOTES,'UTF-8');
$address= htmlspecialchars($address,ENT_QUOTES,'UTF-8');
$tel= htmlspecialchars($tel,ENT_QUOTES,'UTF-8');
$mail= htmlspecialchars($mail,ENT_QUOTES,'UTF-8');
$pass= htmlspecialchars($pass,ENT_QUOTES,'UTF-8');
$pass2= htmlspecialchars($pass2,ENT_QUOTES,'UTF-8');

if($name=='')
{
	echo'名前が入力されていません。<br/>';
}
else
{
	echo'名前:';
	echo $name;
	echo'<br/>';
}
if($address=='')
{
	echo'住所が入力されていません。<br/>';
}
else
{
	echo'住所:';
	echo $address;
	echo'<br/>';
}
if($tel=='')
{
	echo'電話番号が入力されていません。<br/>';
}
else
{
	echo'電話番号:';
	echo $tel;
	echo'<br/>';
}
if($mail=='')
{
	echo'メールアドレスが入力されていません。<br/>';
}
else
{
	echo'メールアドレス:';
	echo $mail;
	echo'<br/>';
}
$pass=$_REQUEST['pass'];
if($pass=='')
{
	echo'パスワードが入力されていません。<br/>';
}

if(preg_match('/\A[a-z\d]{8,16}+\z/i',$pass)==false)
{
	echo'パスワードが適切ではありません。<br/>';
}

if($pass!=$pass2)
{
	echo'パスワードが一致しません。<br/>';
}

if($name==''||$address==''||$tel==''||$mail==''||$pass==''||$pass!=$pass2||preg_match('/\A[a-z\d]{8,16}+\z/i',$pass)==false)
{
	echo'<form>';
	echo'<input type="button"onclick="history.back()"value="戻る">';
	echo'</form>';
}
else
{
	$pass=md5($pass);
	echo'<form method="post"action="add_done.php">';
	echo'<input type="hidden"name="name"value="'.$name.'">';
	echo'<input type="hidden"name="address"value="'.$address.'">';
	echo'<input type="hidden"name="tel"value="'.$tel.'">';
	echo'<input type="hidden"name="mail"value="'.$mail.'">';
	echo'<input type="hidden"name="pass"value="'.$pass.'">';
	echo'<br/>';
	echo'上記の内容で追加しますか？<br/>';
	echo'<input type="button"onclick="history.back()"value="戻る">';
	echo'<input type="submit"value="OK">';
	echo'</form>';
}

?>

</body>
</html>
