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
$image=$_POST['image'];
$image = base64_decode($image);
$type=$_POST['type'];


if (isset($_POST['name'])) {
    try{
require_once '../conf.php';

        $db= new PDO($dsn,$dbUser,$dbPass);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql='INSERT INTO products (name,memo,status,price,image,type,seller_id) VALUES (:name,:memo,:status,:price,:image,:type,:seller_id)';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
        $prepare->bindValue(':memo', $_POST['memo'], PDO::PARAM_STR);
        $prepare->bindValue(':status', $_POST['status'], PDO::PARAM_STR);
        $prepare->bindValue(':price', $_POST['price'], PDO::PARAM_INT);
        $prepare->bindValue(':seller_id', $_SESSION['id'], PDO::PARAM_INT);
        // $type = null;
        // $image = null;
        // if (isset($_FILES['image'])) {
        // $tmp_name = $_FILES['image']['tmp_name'];
        // if ($tmp_name != '') {//ファイルがアップロードされた
        //     //ファイルタイプを確認する☆レシピ124☆の準備が必要
        //     $finfo = new finfo(FILEINFO_MIME_TYPE);
        //     $type = $finfo->file($tmp_name);
        //     //アップロードされ，一時保管されたファイルを読み出す
        //     $file = fopen($_FILES['image']['tmp_name'], 'rb');
        //     $image = fread($file, $_FILES['image']['size']);
        // }
        //   }
          $prepare->bindValue(':type', $type, PDO::PARAM_STR);
          $prepare->bindValue(':image', $image, PDO::PARAM_STR);
          $prepare->execute();
    $db=null;

    echo '出品しました。';
}

catch(Exception $e)
{	
    echo 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
    
    
}
}
?>
    <form method="get" action="../top.php"> 
        <p><input type="submit" value="トップへ"></p>
    </form>
	</body>

</html>