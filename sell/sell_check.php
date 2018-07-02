<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> 中古教科書フリマシステム </title>
</head>
<body>
<?php

$image=$_FILES['image']['name'];
$type=$_POST['type'];
$name=$_POST['name'];
$price=$_POST['price'];
$status=$_POST['status'];
$memo=$_POST['memo'];

$type= htmlspecialchars($type,ENT_QUOTES,'UTF-8');
$name= htmlspecialchars($name,ENT_QUOTES,'UTF-8');
$price= htmlspecialchars($price,ENT_QUOTES,'UTF-8');
$status= htmlspecialchars($status,ENT_QUOTES,'UTF-8');
$memo= htmlspecialchars($memo,ENT_QUOTES,'UTF-8');


echo $image;
if(isset($image,$type))
{
	echo'画像:';
	
	// $image = base64_encode($image);
	// echo "<img src='data:$type;base64,$image'>";
	echo "<img src='$image'>";
	echo'<br/>';
}
else
{
	echo'画像が入力されていません。<br/>';
}
if($type=='')
{
	echo'画像形式が入力されていません。<br/>';
}
else
{
	echo'画像形式:';
	echo $type;
	echo'<br/>';
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
if(isset($image)==false||$type==''||$name==''||$price==''||$status==''||$memo=='')
{
	echo'<form>';
	echo'<input type="button"onclick="history.back()"value="戻る">';
	echo'</form>';
}
else
{
	echo'<form method="post"action="add_done.php" enctype="multipart/form-data">';
	// echo'<input type="hidden"name="image"value="'.$image.'">';
	echo'<input type="hidden"name="type"value="'.$type.'">';
	echo'<input type="hidden"name="name"value="'.$name.'">';
	echo'<input type="hidden"name="price"value="'.$price.'">';
	echo'<input type="hidden"name="memo"value="'.$memo.'">';
	echo'<br/>';
	echo'上記の内容で追加しますか？<br/>';
	echo'<input type="button"onclick="history.back()"value="戻る">';
	echo'<input type="submit"value="OK">';
	echo'</form>';
}
?>