<head>
	<link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/management_style.css">
	
    <link rel="icon" href="./img/favicon.ico">
</head>
<body>
<header class="header1">
        <div class="header1_container">
            <a href="management_top.php"><img src="./img/logo.png" alt="logo"></a>

			<form action="management_selectLike.php" method="post">
                <input type="text" name="keyword">
                <div class="header1_submit"><input type="submit" value="検索"></div>
            </form>

            <a class="header1_buttom" href="index.php">ログアウト</a>
        </div>
        <svg class="header1_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,100 0,100"/>
        </svg>
    </header>
<div class="post_main_container">
	<h1>新規投稿</h1>
<form action="insert.php" method="post">
	<table>
		<tr>
			<th class="post_upper">タイトル</th>
			<td>
			<input class="post_text" type="text" name="title">
			</td>
		</tr>
		<tr>
			<th class="post_upper">本文</th>
			<td>
			<textarea name=text class="post_textarea" rows="5" cols="30"></textarea>
			</td>
		</tr>
		<tr>
			<th class="post_upper">テーマ</th>
			<td>
			<input class="post_text" type="text" name="theme">
			</td>
		</tr>
		<tr>
			<th class="post_upper">公開設定</th>
			<td class="post_release">
			<label><input class="post_radio" type="radio" name="release" value="0">非公開</label>
    		<label><input class="post_radio" type="radio" name="release" value="1">公開</label>
			</td>
		</tr>
	</table>
		<input type="submit" value="登録">
</form>
</div>
<footer class="footer1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 5.29" preserveAspectRatio="none">
        <polygon points="0,0 100,0 100,5.29"/>
        </svg>
        <div class="footer1_container">
            <a class="footer1_title" href="management_top.php">BLOG</a>
            <ul>
                <li><a href="confirm.php">新規投稿</a></li>
                <li><a href="index.php">ログアウト</a></li>
            </ul>
        <p class="footer1_c">&copy; Bチーム</p>
        </div>
    </footer>
</body>