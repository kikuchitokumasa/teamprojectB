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
    } else {
        $_SESSION[""] = "なし";
    }
    $profession = $_SESSION["profession"];

    if(!empty($profile_result[0]["introduction"])){
        $_SESSION["introduction"] = $profile_result[0]["introduction"];
    } else {
        $_SESSION[""] = "なし";
    }
    $introduction = $_SESSION["introduction"];
    
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"ontent="IE=edge">
    <meta name="viewport" content="width c=device-width, initial-scale=1.0">
    <title>プロフィール</title>
    <link rel="stylesheet" href="node_modules/ress/ress.css">
    <!-- reset.css ress -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/management_style.css">
    
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

    <div class="management_profile_main_container">
        <h3>プロフィール</h3>

        <h4 class="management_profile_name"><?php echo $name ?></h4>
        <p><?php echo $profession ?></p>
        <div class="management_profile_pre"><pre><?php echo $introduction ?></pre></div>

        <div class="management_profile_buttom"><a href="update_profile.php">編集</a></div>
        <div class="management_profile_buttom_top"><a href="management_top.php">トップページへ</a></div>

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