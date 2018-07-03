<?php
    session_start();
    session_regenerate_id(true);
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
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title> 中古教科書フリマシステム</title>
    </head>

    <body>

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