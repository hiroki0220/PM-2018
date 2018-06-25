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


 
try{
    $id = $_GET['id'];
    $dbServer = '127.0.0.1';
    $dbName = 'yabukib';
    $dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
    $dbUser = 'root';
    $dbPass = '';

    $db= new PDO($dsn,$dbUser,$dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='SELECT image,type,name,price,status,memo FROM products WHERE id = ?';
    $prepare=$db->prepare($sql);
    $data[]=$id;
    $prepare->execute($data);

    $result=$prepare->fetch(PDO::FETCH_ASSOC);
    $type = $result['type'];
    $image = base64_encode($result['image']);
    $name = $result['name'];
    $price = $result['price'];
    $status = $result['status'];
    $memo = $result['memo'];

    $db = null;


   

} 
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>中古教科書フリマシステム</title>
</head>
<body>

商品画像<br>
<?php
echo "<br><img src='data:${type};base64,${image}'><br>"; ?>
<br>商品名<br>
<?php echo $name; 
echo "<br>";?>
<br>商品価格<br>
<?php
echo $price;
echo "<br>";
?>
<br>商品ステータス<br>
<?php
echo $status;
echo "<br>";?>
<br>商品説明<br>
<?php
echo $memo;
echo "<br>";
?>

<form method="get" action="../top.php">
        <p><input type="submit" value="トップへ"></p>
</form>

</body>
</html>