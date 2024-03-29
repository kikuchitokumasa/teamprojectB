<?php
    session_start();
    require_once 'db_connect.php';

    $title = $_POST['title'];
    $text = $_POST['text'];
    $theme = $_POST['theme'];
    $release = $_POST['release'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO blog (title, text, theme, releases, user_id) VALUES(:title, :text, :theme, :releases, :user_id)";

    $stm = $pdo->prepare($sql);
    $stm->bindValue(':title', $title, PDO::PARAM_STR);
    $stm->bindValue(':text', $text, PDO::PARAM_STR);
    $stm->bindValue(':theme', $theme, PDO::PARAM_STR);
    $stm->bindValue(':releases', $release, PDO::PARAM_INT);
    $stm->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stm->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規投稿完了</title>
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

            <a class="header1_buttom_logout" href="index.php">ログアウト</a>
        </div>
        <svg class="header1_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,100 0,100"/>
        </svg>
    </header>
    <div class="post_success_main_container">
        <h1>新規投稿</h1>
        <div class="post_success_center">
            <p>投稿が完了しました。</p>
            <a href="management_top.php">トップページへ</a>
        </div>
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
</html>