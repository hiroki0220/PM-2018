<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	echo 'ログインされていません。<br />';
	echo '<a href="./account_login/login.html">ログイン画面へ</a>';
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
if (isset($_POST['keyword'])){
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

$sql='SELECT id,image,type,name,price,status,memo FROM products WHERE name like :keyword and buyer_id is  null';
$prepare=$db->prepare($sql);
$prepare->bindValue(':keyword', '%' . $_POST['keyword'] . '%', PDO::PARAM_STR);
$prepare->execute();

$db=null;
$result=$prepare->fetchAll(PDO::FETCH_ASSOC);


foreach ($result as $person) {
	echo $person['name'];//手抜き
	echo "<br/>";
	if (isset($person['type'], $person['image'])) {//画像がある場合
		$type = $person['type'];
		$image = base64_encode($person['image']);
		echo '<a href="detail.php?id='.$person['id'].'">';
		echo "<br><img src='data:$type;base64,$image'><br>";
		echo "</a>";
	  } else {//画像がない場合
		echo "画像なし"; //2重引用符の中に変数を書くと展開される。
		echo "<br/>";
	  }
	
	// echo $person['price'];//手抜き
	// echo "円";
	// echo "<br/>";
	// echo $person['status'];//手抜き
	// echo "<br/>";
	// echo $person['memo'];//手抜き
	// echo "<br/>";
  }
//   //結果を表示
// echo "name = ".$result['name'];
}



catch(Exception $e)
{
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> 中古教科書フリマシステム </title>
</head>
<body>
<form  action="../top.php"> 
        <p><input type="submit" value="トップへ"></p>
</form>
</body>
</html>
