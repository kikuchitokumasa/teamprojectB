<?php
    //session start
    session_start();

    //データベース接続用ファイルを読み込む
    require_once 'db_connect.php';

    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["user_name"];

    $_SESSION["name"] = [];
    $_SESSION["profession"] = [];
    $_SESSION["introduction"] = [];

    /* ユーザープロフィールの作成 */
    $sql = "SELECT * FROM profile WHERE user_id = :user_id";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':user_id', $_SESSION["user_id"], PDO::PARAM_STR);
    $stm->execute();
    $profile_result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($profile_result[0]["user_id"])){
        $_SESSION["user_id"] = $profile_result[0]["user_id"];
    }
    $user_id = $_SESSION["user_id"];

    if(!empty($profile_result[0]["name"])){
        $_SESSION["name"] = $profile_result[0]["name"];
    }
    $name = $_SESSION["name"];

    if(!empty($profile_result[0]["profession"])){
        $_SESSION["profession"] = $profile_result[0]["profession"];
    }
    $profession = $_SESSION["profession"];

    if(!empty($profile_result[0]["introduction"])){
        $_SESSION["introduction"] = $profile_result[0]["introduction"];
    }
    $introduction = $_SESSION["introduction"];
    
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ログイン</title>
    <meta name="description"  content="">

    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-1/css/6-1-1.css">    <!-- <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" /> -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/browse_style.css">

    <link rel="icon" href="./img/favicon.ico">
</head>

<body>
    <header class="header1">
        <div class="header1_container">
            <a href="index.php"><img src="./img/logo.png" alt="logo"></a>

            <form action="browse_selectLike.php" method="post">
                <input type="text" name="keyword">
                <div class="header1_submit"><input type="submit" value="検索"></div>
            </form>
            
            <a class="header1_buttom_login" href="login.php">ログイン</a>
        </div>
        <svg class="header1_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,100 0,100"/>
        </svg>
    </header>

    <div class="browse_profile_main_container">
        <h3>プロフィール</h3>

        <h4 class="browse_profile_name"><?php echo $name ?></h4>
        <p><?php echo $profession ?></p>
        <div class="browse_profile_pre"><pre><?php echo $introduction ?></pre></div>

        <div class="browse_profile_buttom_top"><a href="index.php">トップページへ</a></div>

    </div>

    <footer class="footer1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 5.29" preserveAspectRatio="none">
        <polygon points="0,0 100,0 100,5.29"/>
        </svg>
        <div class="footer1_container">
            <a class="footer1_title" href="index.php">BLOG</a>
            <ul>
                <li><a href="login.php">ログイン</a></li>
            </ul>
            <p class="footer1_c">&copy; Bチーム</p>
        </div>
    </footer>
</body>
</html>