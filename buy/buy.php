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
            echo '<a href="../account_login/login.html">ログイン画面へ</a>';
            exit();
        }
        else
        {
            echo $_SESSION['name'];
            echo 'さんログイン中<br />';
            echo '<br />';
        }

    $id = $_GET['id'];
    $id= htmlspecialchars($id,ENT_QUOTES,'UTF-8');
    try{
require_once '../conf.php';

        $db= new PDO($dsn,$dbUser,$dbPass);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql='UPDATE products SET buyer_id=:buyer_id WHERE id = :pro_id';
        $prepare=$db->prepare($sql);
        $prepare->bindValue(':buyer_id',$_SESSION['id'], PDO::PARAM_INT);
        $prepare->bindValue(':pro_id',$_GET['id'], PDO::PARAM_INT);
        $prepare->execute();

        $db=null;
    
        echo "購入しました";








    }
    catch(Exception $e)
    {	
        echo 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();


    }

?>
    <form method="get" action="../top.php"> 
    <p><input type="submit" value="トップへ"></p>
    </form>
	</body>

</html>