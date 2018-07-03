<?php
$h = 200; // リサイズしたい大きさを指定
$w = 200;

$file = $_FILES['image']['tmp_name']; // 加工したいファイルを指定
if (isset($file)) {
  
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
}
    // echo $mine;
    $mine = 'image/'.$mine.'';
    // echo $mine;
    // echo $resize_path;
    // $file = $resize_path;



header('Content-Type: '.$mine.'');
readfile(''.$resize_path.'');