<?php
    session_start();
    $error = false;

//session
    if(!empty($_POST)){
        //タイトル
        $_SESSION["title"] = htmlspecialchars($_POST["title"],ENT_QUOTES,"UTF-8");
        //本文
        $_SESSION["text"] = htmlspecialchars($_POST["text"],ENT_QUOTES,"UTF-8");
        //テーマ
        $_SESSION["theme"] = htmlspecialchars($_POST["theme"],ENT_QUOTES,"UTF-8");
        //公開非公開設定
        //postに値があったらセッションに代入
        if(isset($_POST["release"])) {
            $_SESSION["release"] = $_POST["release"];            
        }
    }

//error check
    //title
    $title= trim($_POST["title"], "\x20\t\n\r\0\v");
    if(empty($title)){
        $error = true;
        $_SESSION["error_title"] = "タイトルは必須です。";
    }
    //text
    $text = trim($_POST["text"], "\x20\t\n\r\0\v");
    if(empty($text)){
        $error = true;
        $_SESSION["error_text"] = "本文は必須です。";
    } else 
    //theme
    $theme = trim($_POST["theme"], "\x20\t\n\r\0\v");
    if(empty($theme)){
        $error = true;
        $_SESSION["error_theme"] = "テーマは必須です。";
    }
    //release
    if(!isset($_POST["release"])){
        $error = true;
        $_SESSION["error_release"] = "公開非公開設定は必須です。";
    }

    //入力エラーがどこかで発生したらリダイレクトする。
    if($error){
        header('Location: update.php');
        exit();
    } 

    //データベース接続用ファイルを読み込む
    require_once 'db_connect.php';

    $blog_id = $_SESSION["blog_id"];
    $title = $_SESSION["title"];
    $text = $_SESSION["text"];
    $theme = $_SESSION["theme"];
    $release = $_SESSION["release"];
    $update_date = date('Y-m-d H:i:s');

    $sql = "UPDATE blog SET title = :title, text = :text, theme = :theme, releases = :release, update_date = :update_date WHERE blog_id = :blog_id";

    $stm = $pdo->prepare($sql);

    $stm->bindValue(':title', $title, PDO::PARAM_STR);
    $stm->bindValue(':text', $text, PDO::PARAM_STR);
    $stm->bindValue(':theme', $theme, PDO::PARAM_STR);
    $stm->bindValue(':release', $release, PDO::PARAM_BOOL);
    $stm->bindValue(':update_date', $update_date, PDO::PARAM_STR);
    $stm->bindValue(':blog_id', $blog_id, PDO::PARAM_INT);

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