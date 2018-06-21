<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> 中古教科書フリマシステム </title>
</head>
<body>

スタッフ追加 <br/>
<br/>
<form method="post"action="add_check.php">
名前を入力してください。 <br/>
<input type="text"name="name"style="width:200px"><br/>
住所を入力してください。 <br/>
<input type="text"name="address"style="width:200px"><br/>
電話番号を入力してください。 <br/>
<input type="text"name="tel"style="width:200px"><br/>
メールアドレスを入力してください。 <br/>
<input type="text"name="mail"style="width:200px"><br/>
パスワードを入力してください。 <br/>
<input type="password"name="pass"style="width:100px"><br/>
パスワードをもう一度入力してください。<br/>
<input type="password"name="pass2"style="width:100px"><br/>
<br/>
<input type="button" onclick="history.back()"value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>