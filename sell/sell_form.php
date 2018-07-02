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
<?php
if (isset($_POST['name'])) {
    try{
        $dbServer = '127.0.0.1';
        $dbName = 'yabukib';
        $dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
        $dbUser = 'root';
        $dbPass = '';

        $db= new PDO($dsn,$dbUser,$dbPass);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql='INSERT INTO products (name,memo,status,price,image,type,seller_id) VALUES (:name,:memo,:status,:price,:image,:type,:seller_id)';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
        $prepare->bindValue(':memo', $_POST['memo'], PDO::PARAM_STR);
        $prepare->bindValue(':status', $_POST['status'], PDO::PARAM_STR);
        $prepare->bindValue(':price', $_POST['price'], PDO::PARAM_INT);
        $prepare->bindValue(':seller_id', $_SESSION['id'], PDO::PARAM_INT);
        $type = null;
        $image = null;
        if (isset($_FILES['image'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        if ($tmp_name != '') {//ファイルがアップロードされた
            //ファイルタイプを確認する☆レシピ124☆の準備が必要
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $type = $finfo->file($tmp_name);
            //アップロードされ，一時保管されたファイルを読み出す
            $file = fopen($_FILES['image']['tmp_name'], 'rb');
            $image = fread($file, $_FILES['image']['size']);
        }
          }
          $prepare->bindValue(':type', $type, PDO::PARAM_STR);
          $prepare->bindValue(':image', $image, PDO::PARAM_STR);
          $prepare->execute();
    
    
    }
        catch(Exception $e)
    {	
        echo 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();


    }
    }
?>
        <h1>出品フォーム</h1>
        <br />
        <br />

        <form method="post" action="sell_check.php" enctype="multipart/form-data">
        
        画像を選んでください。
            <br />
            <input type="file" name="image" style="width:400px">
            <br /> 商品名を入力してください。
            <br />
            <input type="text" name="name" style="width:200px">
            <br /> 価格を入力してください。
            <br />
            <input type="text" name="price" style="width:50px">
            <br /> 商品状態を入力してください。
            <br>
            <select name="status">
                <option value="未使用">未使用</option>
                <option value="未使用に近い(書き込みなし）">未使用に近い(書き込みなし）</option>
                <option value="目立った傷や汚れなし(書き込みあり）">目立った傷や汚れなし(書き込みあり）</option>
                <option value="傷や汚れ、書き込みあり">傷や汚れ、書き込みあり</option>
            </select>


            <br /> 商品説明を入力してください。
            <br>
            <textarea name="memo" rows="5" cols="50" ;></textarea>
            <br />
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="ＯＫ">
        </form>

    </body>

</html>