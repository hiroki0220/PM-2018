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

<?php

try
{

	$dbServer = '127.0.0.1';
	$dbName = 'yabukib';
	$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
	$dbUser = 'root';
	$dbPass = '';
	
	$db= new PDO($dsn,$dbUser,$dbPass);
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	// $sql='SELECT name,id,mail,tel,address,password FROM customers WHERE id=:id';

	$sql='SELECT id,image,type,name,price,status,memo FROM products WHERE seller_id=:seller_id';


	$prepare=$db->prepare($sql);
	$prepare->bindValue(':seller_id', $_SESSION['id'], PDO::PARAM_INT);
	$prepare->execute();
	$db=null;
	
	
	$result=$prepare->fetchAll(PDO::FETCH_ASSOC);

  }

	catch(Exception $e)
	{
		echo 'ただいま障害により大変ご迷惑をお掛けしております。';
		exit();
	}?>

<html>
<head>
<meta charset="UTF-8">
<title>中古教科書フリマシステム</title>
<style>

@charset "Shift_JIS";

/*============================================
全般的なスタイル
============================================*/
* {
	margin:0; padding:0; 	/*全要素のマージン・パディングをリセット*/
	line-height:1.5;	/*全要素の行の高さを1.5倍にする*/
	color:#333333;		/*文字色*/

} 
body {
	background-color:#999999;	/*ページ全体の背景色*/
	text-align:center;		/*IE6以下でセンタリングするための対策*/
}
div#pagebody {
	width:796px; margin:0 auto;	/*内容全体をセンタリング*/
	text-align:left;	/*テキストの配置を左揃えにする*/
	background-image:url("images/bg_pagebody.gif");	/*内容全体の背景*/
	background-repeat:repeat-y;		/*背景画像を縦方向に繰り返す*/
	background-color:#ffffff;		/*内容全体の背景色*/
}

/*============================================
ヘッダ
============================================*/
div#header {
	height:77px;	/*背景画像のサイズに合わせてボックスの高さを指定*/
	background-image:url("images/bg_header.jpg");	/*ヘッダ部分の背景画像*/
	background-repeat:no-repeat;		/*背景画像を繰り返さない*/
	background-color:#cccccc;		/*ヘッダ部分の背景色*/
}
h1 {
	padding:20px 0px 0px 30px;		/*見出し内容の位置調整*/
	font-family:Arial, Helvetica, sans-serif;	/*フォントの種類*/
}
h1 a {text-decoration:none;} 			/*リンクの下線を無くす*/

/*============================================
メインメニュー
============================================*/
ul#menu {
	height:200px; background-color:#eeeeee; font-weight:bold;
}


/*ボタン01～05にはそれぞれ異なる背景画像を指定する*/


/*============================================
サブメニュー（左カラム）
============================================*/
div#submenu {
	width:140px;			/*幅の指定*/
	margin:10px 10px 10px 10px;	/*位置調整（IE6のバグに注意）*/
	display:inline;			/*IE6のマージン算出のバグ対策*/
	float:left;			/*サブメニューのカラムを左寄せにする*/
}

/*サブメニューのヘッダ部分（余白調整・背景画像・背景色・文字サイズなど）*/
div#submenu_header {
	height:26px; padding:4px 0px 0px 0px;
	background-image:url("images/bg_submenu_header.gif");
	background-repeat:no-repeat; background-position:top;
	background-color:#cccccc;
	font-size:90%; font-weight:bold; text-align:center;
}

/*サブメニューのボディ部分（余白調整・背景画像・背景色）*/
ul#submenu_body {
	padding-bottom:6px;
	background-image:url("images/bg_submenu_footer.gif");
	background-repeat:no-repeat; background-position:bottom;
	background-color:#cccccc;
}
ul#submenu_body li {
	font-size:90%;			/*文字サイズを90%にする*/
	list-style-type:none;		/*リストマーカー無しにする*/
	display:inline;			/*リスト項目をインライン表示にする*/
}
ul#submenu_body li a {
	display:block;			/*リンクをブロック表示にする*/
	margin:0px 4px 0px 4px;		/*サブメニュー項目のマージン*/
	padding:2px 0px 2px 20px;	/*サブメニュー項目のパディング*/
	background-color:#eeeeee;	/*サブメニュー項目の背景色*/
	text-decoration:none;		/*リンクの下線を無くす*/
}
ul#submenu_body li a:hover {
	background-color:#ffffff;	/*リンクにマウスが乗ったら色を変える*/
}


/*============================================
フッタ
============================================*/
div#footer {
	height:42px; text-align:center;
	clear:both;					/*回り込みを解除する*/
	background-image:url("images/bg_footer.jpg");	/*フッタ部分の背景画像*/
	background-repeat:no-repeat;			/*背景画像を繰り返さない*/
	background-color:#cccccc;			/*フッタ部分の背景色*/
}
address {
	font-style:normal;			 /*フォントスタイルを標準にする*/
	font-size:small;			 /*フォントサイズを小さくする*/
	padding:5px 0px 5px 0px;		 /*要素内容の位置調整*/
}


</style>
</head>
<body>
<!-- メインメニュー -->
<ul id="menu">
<hr><table><tr>
  <?php
	 foreach ( $result as $person ) {

		echo $person['name'];//手抜き
		echo "<br/>";
		if (isset($person['type'], $person['image'])) {//画像がある場合
			$type = $person['type'];
			$image = base64_encode($person['image']);
			
			echo '<a href="../buy/detail.php?id='.$person['id'].'">';
			
			echo "<br><img src='data:${type};base64,${image}'><br>";
			echo "</a>";
		  } else {//画像がない場合
			echo "画像なし"; //2重引用符の中に変数を書くと展開される。
			echo "<br/>";
		  } 
		 
		  
	}
	?></tr></table>
	</ul>
	
<!-- サブメニュー（左カラム） -->
	<div id="submenu">
		<div id="submenu_header">目的で探す</div>
		<ul id="submenu_body">
			<li><a href="xxx.html">CSSの適用</a></li>
			<li><a href="xxx.html">セレクタ</a></li>
			<li><a href="xxx.html">フォント</a></li>
			<li><a href="xxx.html">テキスト</a></li>
			<li><a href="xxx.html">文字色・背景</a></li>
			<li><a href="xxx.html">幅・高さ・余白</a></li>
			<li><a href="xxx.html">ボーダー</a></li>
			<li><a href="xxx.html">表示・配置</a></li>
			<li><a href="xxx.html">リスト</a></li>
			<li><a href="xxx.html">テーブル</a></li>
			<li><a href="xxx.html">生成内容の挿入</a></li>
			<li><a href="xxx.html">インターフェース</a></li>
			<li><a href="xxx.html">フィルタ・ズーム</a></li>
			<li><a href="xxx.html">テキスト（IE独自）</a></li>
			<li><a href="xxx.html">印刷</a></li>
			<li><a href="xxx.html">音声</a></li>
		</ul>
	</div>
	<form method="get" action="../top.php"> 
    <p><input type="submit" value="トップへ"></p>
    </form>
</body>
</html>