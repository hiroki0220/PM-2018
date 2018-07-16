<?php
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> 中古教科書フリマシステム</title>
</head>
<body>
<?php
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

try
{

require_once '../conf.php';
	
	$db= new PDO($dsn,$dbUser,$dbPass);
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	// $sql='SELECT name,id,mail,tel,address,password FROM customers WHERE id=:id';

	$sql='SELECT id,image,type,name,price,status,memo FROM products WHERE seller_id=:seller_id';


	$prepare=$db->prepare($sql);
	$prepare->bindValue(':seller_id', $_SESSION['id'], PDO::PARAM_INT);
	$prepare->execute();
	$db=null;
	
	
	$result=$prepare->fetchAll(PDO::FETCH_ASSOC);
	

  }



   

	catch(Exception $e)
	{
		echo 'ただいま障害により大変ご迷惑をお掛けしております。';
		exit();
	}
?>


マイページ<br />
<br />
<form action="../sell/sell_form.php">
<button>出品</button> 
</form>
<form action="./tourokuka.php">
<button>登録情報</button> 
</form>
<br>
<form action="./syuppin.php">
<button>出品情報</button> 
</form>

 <form method="get" action="../top.php"> 
 
    <p><input type="submit" value="トップへ"></p>
    </form>
<a href="../account_login/logout.php">ログアウト</a><br />



<br />
</body>
</html>
