<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	print 'ログインされていません。<br />';
	print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['staff_name'];
	print 'さんログイン中<br />';
	print '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> ろくまる農園</title>
</head>
<body>

トップメニュー<br />
<br />
<a href="">出品</a><br />
<br />
<a href="../product/pro_list.php">商品検索</a><br />
<br />
<a href="../order/order_download.php">マイページ</a><br />
<br />
<a href="staff_logout.php">ログアウト</a><br />

</body>
</html>