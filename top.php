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

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> 中古教科書フリマシステム</title>
</head>
<body>

トップメニュー<br />
<br />

<form action="./sell/sell.html">
<button>出品</button> 
</form>

<a href="./mypage/mypage.php">マイページ</a><br />
<br />
<a href="./account_login/logout.php">ログアウト</a><br />

<form method = "post" action = "./buy/search.php">
<input type = "text" name = "keyword" "style="width:200px">
<input type="submit" value="検索">
</form>

<br />
</body>
</html>