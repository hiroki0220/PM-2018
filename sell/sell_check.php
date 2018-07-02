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
?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> 中古教科書フリマシステム </title>
</head>
<body>
	<?php



// $image=$_FILES['image'];
// $image=$_POST['image'];
// $type=$_POST['type'];
$name=$_POST['name'];
$price=$_POST['price'];
$status=$_POST['status'];
$memo=$_POST['memo'];

// $type= htmlspecialchars($type,ENT_QUOTES,'UTF-8');
$name= htmlspecialchars($name,ENT_QUOTES,'UTF-8');
$price= htmlspecialchars($price,ENT_QUOTES,'UTF-8');
$status= htmlspecialchars($status,ENT_QUOTES,'UTF-8');
$memo= htmlspecialchars($memo,ENT_QUOTES,'UTF-8');


    if (isset($_FILES['image'])==true) {
        $tmp_name = $_FILES['image']['tmp_name'];
        if ($tmp_name != '') {//ファイルがアップロードされた
            //ファイルタイプを確認する☆レシピ124☆の準備が必要
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $type = $finfo->file($tmp_name);
            //アップロードされ，一時保管されたファイルを読み出す
            $file = fopen($_FILES['image']['tmp_name'], 'rb');
			$image = fread($file, $_FILES['image']['size']);
			$image = base64_encode($image);
			echo "<br><img src='data:$type;base64,$image'><br>";
			
        }
		  }
		  else {
			  echo "画像が入力されていません<br/>";
		  }
if($name=='')
{
	echo'商品名が入力されていません。<br/>';
}
else
{
	echo'商品名:';
	echo $name;
	echo'<br/>';
}
if($price=='')
{
	echo'価格が入力されていません。<br/>';
}
else
{
	echo'価格:';
	echo $price;
	echo'<br/>';
}
if($status=='')
{
	echo'商品状態が入力されていません。<br/>';
}
else
{
	echo'商品状態:';
	echo $status;
	echo'<br/>';
}
if($memo=='')
{
	echo'商品説明が入力されていません。<br/>';
}
else
{
	echo'説明:';
	echo $memo;
	echo'<br/>';
}
if(isset($image)==false||$name==''||$price==''||$status==''||$memo=='')
{
	echo'<form>';
	echo'<input type="button"onclick="history.back()"value="戻る">';
	echo'</form>';
}
else
{
	echo'<form method="post"action="sell_done.php" enctype="multipart/form-data">';
	echo'<input type="hidden" name="image" value="'.$image.'">';
	echo'<input type="hidden"name="type"value="'.$type.'">';
	echo'<input type="hidden"name="status"value="'.$status.'">';
	echo'<input type="hidden"name="name"value="'.$name.'">';
	echo'<input type="hidden"name="price"value="'.$price.'">';
	echo'<input type="hidden"name="memo"value="'.$memo.'">';
	echo'<br/>';
	echo'上記の内容で追加しますか？<br/>';
	echo'<input type="button"onclick="history.back()"value="戻る">';
	echo'<input type="submit"value="OK">';
	echo'</form>';
}
