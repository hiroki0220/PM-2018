<?php
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>中古教科書フリマシステム</title>
    </head>
    <body>
        <?php
        if(isset($_SESSION['login'])==true)
        {
            echo 'ログインされています。<br />';
            echo '<a href="./account_login/logout.php">ログアウト画面へ</a>';
            exit();
        }
		echo '<a href="./account_add/add.php">新規登録画面</a><br />';
		echo '<a href="./account_login/login.html">ログイン画面</a><br />';
		echo '<a href="./tes.php">画面</a><br />';
        ?>
    </body>
</html>
