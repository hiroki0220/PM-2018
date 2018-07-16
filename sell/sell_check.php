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

try{

	$name=$_POST['name'];
	$price=$_POST['price'];
	$status=$_POST['status'];
	$memo=$_POST['memo'];

	$name= htmlspecialchars($name,ENT_QUOTES,'UTF-8');
	$price= htmlspecialchars($price,ENT_QUOTES,'UTF-8');
	$status= htmlspecialchars($status,ENT_QUOTES,'UTF-8');
	$memo= htmlspecialchars($memo,ENT_QUOTES,'UTF-8');

	function ua_smt (){
//ユーザーエージェントを取得
$ua = $_SERVER['HTTP_USER_AGENT'];
//スマホと判定する文字リスト
$ua_list = array('iPhone','iPad','iPod','Android');
 foreach ($ua_list as $ua_smt) {
//ユーザーエージェントに文字リストの単語を含む場合はTRUE、それ以外はFALSE
  if (strpos($ua, $ua_smt) !== false) {
   return true;
  }
 } return false;
}	
	$h = 200; // リサイズしたい大きさを指定
	$w = 200;
	
	$file = $_FILES['image']['tmp_name']; // 加工したいファイルを指定
	
	
	if (empty($file)!=true) {
		// 加工前の画像の情報を取得
		list($original_w, $original_h, $type) = getimagesize($file);
		
		// 加工前のファイルをフォーマット別に読み出す（この他にも対応可能なフォーマット有り）
		switch ($type) {
			case IMAGETYPE_JPEG:
			$original_image = imagecreatefromjpeg($file);
			$mine='jpg';
			break;
			case IMAGETYPE_PNG:
			$original_image = imagecreatefrompng($file);
			$mine='png';
			
			break;
			case IMAGETYPE_GIF:
			$original_image = imagecreatefromgif($file);
			$mine='gif';
			break;
			default:
			throw new RuntimeException('対応していないファイル形式です。: ', $type);
		}
if (ua_smt() == true) {
	//スマホの場合の処理
	// 画像の向き(Exif)を取得(8段階)
	$exif = @exif_read_data($file);
	if(isset($exif["Orientation"])){
		$orientation = $exif["Orientation"];
		// echo $exif["Orientation"];
		// 向きで回転するべき角度を判別
		if($original_image){
			if($orientation == 3){
				$original_image = imagerotate($original_image,180,0);
			}
			else if($orientation == 5){
				$original_image = imagerotate($original_image,270,0);
			}
			else if($orientation == 6){
				$original_image = imagerotate($original_image,270,0);
			}
			else if($orientation == 7){
				$original_image = imagerotate($original_image,90,0);
			}
			else if($orientation == 8){
				$original_image = imagerotate($original_image,90,0);
			}
			// else{
			// 	echo '正常';
			// }
		}
	}
} else {
 //それ以外の場合の処理
}
		// echo $mine;
		// 新しく描画するキャンバスを作成
		$canvas = imagecreatetruecolor(150,200);
		imagecopyresampled($canvas, $original_image, 0,0,0,0, $w, $h, $original_w, $original_h);
		
		
		if (empty($file)!=true) {
			// 加工前の画像の情報を取得
			list($original_w, $original_h, $type) = getimagesize($file);
			
			// 加工前のファイルをフォーマット別に読み出す（この他にも対応可能なフォーマット有り）
			switch ($type) {
				case IMAGETYPE_JPEG:
				$original_image = imagecreatefromjpeg($file);
				$mine='jpg';
				break;
				case IMAGETYPE_PNG:
				$original_image = imagecreatefrompng($file);
				$mine='png';
				
				break;
				case IMAGETYPE_GIF:
				$original_image = imagecreatefromgif($file);
				$mine='gif';
				break;
				default:
				throw new RuntimeException('対応していないファイル形式です。: ', $type);
			}
			if (ua_smt() == true) {
				//スマホの場合の処理
				// 画像の向き(Exif)を取得(8段階)
				$exif = @exif_read_data($file);
				if(isset($exif["Orientation"])==true){
					$orientation = $exif["Orientation"];
					// echo $exif["Orientation"];
					// 向きで回転するべき角度を判別
					
					if($orientation == 3){
						$original_image = imagerotate($original_image,180,0);
					}
					else if($orientation == 5){
						$original_image = imagerotate($original_image,270,0);
					}
					else if($orientation == 6){
						$original_image = imagerotate($original_image,270,0);
					}
					else if($orientation == 7){
						$original_image = imagerotate($original_image,90,0);
					}
					else if($orientation == 8){
						$original_image = imagerotate($original_image,90,0);
					}
					// else{
						// 	echo '正常';
						// }
					}
			} 
				
				
			// echo $mine;
			// 新しく描画するキャンバスを作成
			$canvas = imagecreatetruecolor($w, $h);
			imagecopyresampled($canvas, $original_image, 0,0,0,0, $w, $h, $original_w, $original_h);
			
			$resize_path = './new.'.$mine.''; // 保存先を指定
			
		switch ($type) {
			case IMAGETYPE_JPEG:
			imagejpeg($canvas, $resize_path);
			break;
			case IMAGETYPE_PNG:
			imagepng($canvas, $resize_path, 9);
			break;
			case IMAGETYPE_GIF:
			imagegif($canvas, $resize_path);
			break;
		}
		
		// 読み出したファイルは消去
		imagedestroy($original_image);
		imagedestroy($canvas);
		
		$mine = 'image/'.$mine.'';
		
		$image=$resize_path;
		$file = fopen($image, 'rb');
		$image = fread($file, $_FILES['image']['size']);
		$image = base64_encode($image);
		echo "<br><img src='data:$mine;base64,$image'><br>";
		
		
		
	}
}
		else {
			echo "画像が入力されていません。<br/>";
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
		?>
		<?php
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
			echo'<input type="hidden"name="type"value="'.$mine.'">';
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


}
catch(Exception $e)
{
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
	?>

	
	</body>

</html>

