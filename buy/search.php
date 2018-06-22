<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	print 'ログインされていません。<br />';
	print '<a href="./account_login/login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['name'];
	print 'さんログイン中<br />';
	print '<br />';
}
?>

<?php

try
{

$keyword=$_POST['keyword'];
$keyword= htmlspecialchars($keyword,ENT_QUOTES,'UTF-8');
    
$dbServer = '127.0.0.1';
$dbName = 'yabukib';
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
$dbUser = 'root';
$dbPass = '';

$db= new PDO($dsn,$dbUser,$dbPass);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT id,image,type,name,price,status,memo FROM products WHERE buyer_id is not null';
$prepare=$db->prepare($sql);

$prepare->execute();

$db=null;
$result=$prepare->fetchAll(PDO::FETCH_ASSOC);
echo $keyword;

foreach ($result as $person) {
	echo $person['id'];
	echo ',';
	echo $person['image'];//手抜き
	echo $person['price'];//手抜き
	echo $person['status'];//手抜き
	echo $person['memo'];//手抜き
	echo "<br/>";
  }
//   //結果を表示
// echo "name = ".$result['name'];
}



catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}



?>