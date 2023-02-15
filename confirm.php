<head>
    <link rel="stylesheet" href="css/style.css">
</head>
<form action="insert.php" method="post">
	<div class="inputs">
		<label class="label">タイトル</label>
		<input class="input_form" type="text" name="title">
	</div>
	</div>
	<div class="inputs">
		 <label class="label">本文</label>
		 <textarea name=text class="input_form" rows="4" cols="40"></textarea>
	</div>
    <div class="inputs">
		<label class="label">テーマ</label>
		<input class="input_form" type="text" name="theme">
	</div>
    <div class="inputs">
        <label class="label">公開設定</label>
    <input id="radio01" type="radio" name="release" value="1" checked><label for="radio01">非公開</label>
    <input id="radio02" type="radio" name="release" value="2"><label for="radio02">公開</label>
	<div class="btn-area">
		<input type="reset" value="リセット"><input type="submit" value="登録">
	</div>
</form>