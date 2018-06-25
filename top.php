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

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> 中古教科書フリマシステム</title>
</head>
<body>

トップメニュー<br />
<br />
<a href="">出品</a><br />
<br />

<a href="../order/order_download.php">マイページ</a><br />
<br />
<a href="./account_login/logout.php">ログアウト</a><br />

<form method = "post" action = "./buy/search.php">
<input type = "text" name = "keyword" "style="width:200px">
<input type="submit" value="検索">
</form>

<br />
</body>
</html>