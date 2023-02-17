<?php
    session_start();

    require_once 'db_connect.php';

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header class="header1">
        <div class="header1_container">
            <a href="management_top.php"><img src="./img/logo.png" alt=""></a>
            
            <form action="browse_selectLike.php" method="post">
                <input type="text" name="keyword">
                <div class="header1_submit"><input type="submit" value="検索"></div>
            </form>

            <a class="header1_buttom" href="">ログアウト</a>
        </div>
        <svg class="header1_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,100 0,100"/>
        </svg>
    </header>

    <div class="browse_d_main_container">
        <div class="browse_d_article_move">

        </div>
        <div class="browse_d_main_contents">
            <div class="browse_d_article">
                <h1>タイトル</h1>
                <p>投稿者:</p>
                <p>テーマ:</p>
                <p>本文</p>
            </div>
        </div>
        <div class="browse_d_article_move">
            
        </div>
        <a href="">トップページへ</a>
    </div>

    <footer class="footer1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 5.29" preserveAspectRatio="none">
        <polygon points="0,0 100,0 100,5.29"/>
        </svg>
        <div class="footer1_container">
            <a class="footer1_title" href="index.php">BLOG</a>
            <ul>
                <li><a href="">新規投稿</a></li>
                <li><a href="">ログアウト</a></li>
            </ul>
        <p class="footer1_c">&copy; Bチーム</p>
        </div>
    </footer>
</body>
</html>