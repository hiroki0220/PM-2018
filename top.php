<?php
session_start();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title> 中古教科書フリマシステム</title>
	</head>
	<body>
		<?php
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
		トップメニュー<br />
		<form method = "post" action = "./buy/search.php">
	<input type = "text" name = "keyword" "style="width:200px">
	<input type="submit" value="検索">
	</form>
	

<form action="./sell/sell_form.php">
<button>出品</button> 
</form>

<a href="./mypage/mypage.php">マイページ</a><br />
<br />
<a href="./account_login/logout.php">ログアウト</a><br />


<br />
</body>
</html>