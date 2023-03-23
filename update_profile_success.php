<?php
    session_start();
    $error = false;

//session
    if(!empty($_POST)){
        $_SESSION["name"] = htmlspecialchars($_POST["name"],ENT_QUOTES,"UTF-8");
        $_SESSION["profession"] = htmlspecialchars($_POST["profession"],ENT_QUOTES,"UTF-8");
        $_SESSION["introduction"] = htmlspecialchars($_POST["introduction"],ENT_QUOTES,"UTF-8");
    }

//error check
    //title
    $name= trim($_POST["name"], "\x20\t\n\r\0\v");
    if(empty($name)){
        $error = true;
        $_SESSION["error_name"] = "名前は必須です。";
    }

    /*$profession = trim($_POST["profession"], "\x20\t\n\r\0\v");
    if(empty($profession)){
        $error = true;
        $_SESSION["error_profession"] = "本文は必須です。";
    } 

    $introduction = trim($_POST["introduction"], "\x20\t\n\r\0\v");
    if(empty($introduction)){
        $error = true;
        $_SESSION["error_introduction"] = "テーマは必須です。";
    }*/


    //入力エラーがどこかで発生したらリダイレクトする。
    if($error){
        header('Location: update_profile.php');
        exit();
    } 

    //データベース接続用ファイルを読み込む
    require_once 'db_connect.php';

    $name = $_SESSION["name"];
    $profession = $_SESSION["profession"];
    $introduction = $_SESSION["introduction"];


    $sql = "UPDATE profile SET name = :name, profession = :profession, introduction = :introduction WHERE user_id = :user_id";

    $stm = $pdo->prepare($sql);

    $stm->bindValue(':name', $name, PDO::PARAM_STR);
    $stm->bindValue(':profession', $profession, PDO::PARAM_STR);
    $stm->bindValue(':introduction', $introduction, PDO::PARAM_STR);
    $stm->bindValue(':user_id', $_SESSION["user_id"], PDO::PARAM_STR);
    $stm->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集完了</title>
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

            <a class="header1_buttom_logout" hlef="">ログアウト</a>
        </div>
        <svg class="header1_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,100 0,100"/>
        </svg>
    </header>

    <div class="update_success_main_container">
        <h1>編集</h1>
        <div class="update_success_center">
            <p>更新が完了しました。</p>
            <a href="management_profile.php">プロフィールへ</a>
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