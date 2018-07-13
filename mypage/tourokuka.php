<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	echo 'ログインされていません。<br />';
	echo '<a href="../account_login/login.html">ログイン画面へ</a>';
	exit();
}
else
{
	echo $_SESSION['name'];
	echo 'さんログイン中<br />';
	echo '<br />';
}
?>
<?php

try
{

	$dbServer = '127.0.0.1';
	$dbName = 'yabukib';
	$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
	$dbUser = 'root';
	$dbPass = '';
	
	$db= new PDO($dsn,$dbUser,$dbPass);
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	$sql='SELECT name,id,mail,tel,address,password FROM customers WHERE id=:id';
	$prepare=$db->prepare($sql);
	$prepare->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
	$prepare->execute();
	$db=null;
	
	
	$result=$prepare->fetchAll(PDO::FETCH_ASSOC);
	
	
	foreach ($result as $person){
		
		echo $person['name'];//手抜き
		echo "<br/>";
		echo $person['mail'];//手抜き
		echo "<br/>";
		echo $person['tel'];//手抜き
		echo "<br/>";
		echo $person['address'];//手抜き

		echo "<br/>";
		
	} //画像がない場合
	
	
	// session_start();
	// 	$_SESSION['login']=1;
	// 	$_SESSION['mail']=$result['mail'];
	// 	$_SESSION['password']=$result['password'];
	// 	$_SESSION['name']=$result['name'];
	// 	$_SESSION['id']=$result['id'];
	// 	$_SESSION['tel']=$result['tel'];
	// 	$_SESSION['address']=$result['address'];
	// 	exit();
	
	
	
}


   

	catch(Exception $e)
	{
		echo 'ただいま障害により大変ご迷惑をお掛けしております。';
		exit();
	}
?>



<html>
	
<head>

<meta charset="UTF-8">
<title>中古教科書フリマシステム</title>
</head>
<body>
<form method="get" action="../top.php"> 
    <p><input type="submit" value="トップへ"></p>
    </form>

</body>
</html>










