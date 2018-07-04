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
            <p ><span style="visibility : hidden;"id="src-width-height"></span></p>
            <p><span style="visibility : hidden;"id="dst-width-height"></span></p>
            <p><input type="file" name="image" accept="image/*" id="file-image"></p>
            <canvas id="mycanvas">Canvasに対応しているブラウザを使用して下さい。</canvas>
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
        <script>
    (function() {
      var canvas = document.getElementById('mycanvas');
      window.onload = function(){
        if ( checkFileApi() && checkCanvas(canvas) ){
          //ファイル選択
          var file_image = document.getElementById('file-image');
          file_image.addEventListener('change', selectReadfile, false);
        }
      }
      //canvas に対応しているか
      function checkCanvas(canvas){
        if (canvas && canvas.getContext){
          return true;
        }
        alert('Not Supported Canvas.');
        return false;
      }
      // FileAPIに対応しているか
      function checkFileApi() {
        // Check for the various File API support.
        if (window.File && window.FileReader && window.FileList && window.Blob) {
          // Great success! All the File APIs are supported.
          return true;
        }
        alert('The File APIs are not fully  in this browser.');
        return false;
      }
      //ファイルが選択されたら読み込む
      function selectReadfile(e) {
        var file = e.target.files;
        var reader = new FileReader();
        //dataURL形式でファイルを読み込む
        reader.readAsDataURL(file[0]);
        //ファイルの読込が終了した時の処理
        reader.onload = function(){
          readDrawImg(reader, canvas, 0, 0);
        }
      }
      function readDrawImg(reader, canvas, x, y){
        var img = readImg(reader);
        img.onload = function(){
          var w = img.width;
          var h = img.height;
          printWidthHeight( 'src-width-height', true, w, h);
            var resize = resizeWidthHeight(1024, w, h);
            printWidthHeight( 'dst-width-height', resize.flag, resize.w, resize.h);
            drawImgOnCav(canvas, img, x, y, resize.w, resize.h);
          
        }
      }
      //ファイルの読込が終了した時の処理
      function readImg(reader){
        //ファイル読み取り後の処理
        var result_dataURL = reader.result;
        var img = new Image();
        img.src = result_dataURL;
        return img;
      }
      //キャンバスにImageを表示
      function drawImgOnCav(canvas, img, x, y, w, h) {
        var ctx = canvas.getContext('2d');
        canvas.width = w;
        canvas.height = h;
        ctx.drawImage(img, x, y, w, h);
      }
      // リサイズ後のwidth, heightを求める
      function resizeWidthHeight(target_length_px, w0, h0){
        //リサイズの必要がなければ元のwidth, heightを返す
        var length = Math.max(w0, h0);
        //リサイズの計算
        var w1;
        var h1;
        if(w0 >= h0){
          w1 = 200;
          h1 = 200;
        }else{
          w1 = 200;
          h1 = 200;
        }
        return {
          flag: true,
          w: parseInt(w1),
          h: parseInt(h1)
        };
      }
      function printWidthHeight( width_height_id, flag, w, h) {
        var wh = document.getElementById(width_height_id);
        if(!flag){
          wh.innerHTML = "なし";
          return;
        }
        wh.innerHTML = 'width:' + w + ' height:' + h;
      }
    })();
    </script>
    </body>

</html>