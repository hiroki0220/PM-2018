<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> ろくまる農園 </title>
</head>
<body>

<?php

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
	print'名前が入力されていません。<br/>';
}
else
{
	print'名前:';
	print $name;
	print'<br/>';
}
if($address=='')
{
	print'住所が入力されていません。<br/>';
}
else
{
	print'住所:';
	print $address;
	print'<br/>';
}
if($tel=='')
{
	print'電話番号が入力されていません。<br/>';
}
else
{
	print'電話番号:';
	print $tel;
	print'<br/>';
}
if($mail=='')
{
	print'メールアドレスが入力されていません。<br/>';
}
else
{
	print'メールアドレス:';
	print $mail;
	print'<br/>';
}

if($pass=='')
{
	print'パスワードが入力されていません。<br/>';
}

if($pass!=$pass2)
{
	print'パスワードが一致しません。<br/>';
}

if($name==''||$address==''||$tel==''||$mail==''||$pass==''||$pass!=$pass2)
{
	print'<form>';
	print'<input type="button"onclick="history.back()"value="戻る">';
	print'</form>';
}
else
{
	$pass=md5($pass);
	print'<form method="post"action="add_done.php">';
	print'<input type="hidden"name="name"value="'.$name.'">';
	print'<input type="hidden"name="address"value="'.$address.'">';
	print'<input type="hidden"name="tel"value="'.$tel.'">';
	print'<input type="hidden"name="mail"value="'.$mail.'">';
	print'<input type="hidden"name="pass"value="'.$pass.'">';
	print'<br/>';
	print'上記の内容で追加しますか？<br/>';
	print'<input type="button"onclick="history.back()"value="戻る">';
	print'<input type="submit"value="OK">';
	print'</form>';
}

?>

</body>
</html>
