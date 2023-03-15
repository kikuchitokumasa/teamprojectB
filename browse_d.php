<?php
    session_start();
    require_once 'db_connect.php';

    $blog_id = $_GET['blog_id'];

    //現在表示する記事
    $sql = "SELECT * FROM blog JOIN account ON blog.user_id = account.user_id WHERE blog_id = :blog_id";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':blog_id', $blog_id, PDO::PARAM_INT);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    $text = nl2br($result[0]['text']);

    //そのユーザーの記事
    $sql = "SELECT blog_id FROM blog WHERE user_id = :user_id AND releases = 1 AND deletes = 0";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':user_id', $result[0]['user_id'], PDO::PARAM_INT);
    $stm->execute();
    $blog_result = $stm->fetchAll(PDO::FETCH_ASSOC);

    //次の記事　
    $count = count($blog_result);
    for($i = 0 ; $i < $count ; $i++){
        if($blog_id+1 === $blog_result[$i]['blog_id']){
            $next_blog_id = $blog_result[$i]['blog_id'];
        }
    }

    echo "<pre>";
    var_dump($blog_result);
    echo "</pre>";
    var_dump($count);



?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/browse_style.css">
    
    <link rel="icon" href="./img/favicon.ico">
</head>
<body>
    <header class="header1">
        <div class="header1_container">
            <a href="management_top.php"><img src="./img/logo.png" alt=""></a>
            
            <form action="browse_selectLike.php" method="post">
                <input type="text" name="keyword">
                <div class="header1_submit"><input type="submit" value="検索"></div>
            </form>

            <a class="header1_buttom_logout" href="">ログアウト</a>
        </div>
        <svg class="header1_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,100 0,100"/>
        </svg>
    </header>

    <div class="browse_d_main_container">
        <div class="browse_d_article_move">
            <a href="browse_d.php?blog_id=<?php echo $prev_blog_id ?>">＜ 前の記事</a>
            <a href="browse_d.php?blog_id=<?php echo $next_blog_id ?>">次の記事 ＞</a>
        </div>

        <div class="browse_d_main_contents">
            <div class="browse_d_article">
                <h1><?php echo $result[0]["title"] ?></h1>
                <p>投稿者:<?php echo $result[0]["user_name"] ?></p>
                <p>テーマ:<?php echo $result[0]["theme"] ?></p>
                <p><?php echo $text ?></p>
            </div>
        </div>

        <div class="browse_d_article_move">
            <a href="">＜ 前の記事</a>
            <a href="">次の記事 ＞</a>
        </div>
        <a href="index.php">トップページへ</a>
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