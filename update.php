<?php
    session_start();

    //データベース接続用ファイルを読み込む
    require_once 'db_connect.php';

    $blog_id = $_GET["blog_id"];
    $_SESSION["blog_id"] = $blog_id; 

    $sql = "SELECT * FROM blog WHERE blog_id = :blog_id";

    $stm = $pdo->prepare($sql);
    $stm->bindValue(':blog_id', $blog_id, PDO::PARAM_INT);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($result)){
        $title = "";
        $text = "";
        $theme = "";
        $release_t = "";
        $release_f = "";

        $title = $result[0]["title"];
        $text = $result[0]["text"];
        $theme = $result[0]["theme"];
        if(isset($result[0]["releases"])) {
            if($release = $result[0]["releases"] === 0) {
                $release_f = "checked";
            } else if($release = $result[0]["releases"] === 1) {
                $release_t = "checked";
            }
        }

    } else {
        //session
        $title = "";
        $text = "";
        $theme = "";
        $release_t = "";
        $release_f = "";

        //title
        if(isset($_SESSION["title"])) {
            $title = $_SESSION["title"];
        }
        //text
        if(isset($_SESSION["text"])) {
            $title = $_SESSION["text"];
        }
        //theme
        if(isset($_SESSION["theme"])) {
            $title = $_SESSION["theme"];
        }
        //release
        if(isset($_SESSION["release"])) {
            if($release = $_SESSION["release"] === 0) {
                $release_f = "checked";
            } else if($release = $_SESSION["release"] === 1) {
                $release_t = "checked";
            }
        }

        //エラーを表示
        //title
        if(isset($_SESSION["error_title"])) {
            echo $_SESSION["error_title"]."<br>";
        }
        //text
        if(isset($_SESSION["error_text"])) {
            echo $_SESSION["error_text"]."<br>";
        }
        //theme
        if(isset($_SESSION["error_theme"])) {
            echo $_SESSION["error_theme"]."<br>";
        }
        //release
        if(isset($_SESSION["error_release"])) {
            echo $_SESSION["error_release"]."<br>";
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/management_style.css">
</head>
<body>
    <header class="header1">
        <div class="header1_container">
            <a href="management_top.php"><img src="./img/logo.png" alt=""></a>
            <a class="header1_buttom" hlef="">ログアウト</a>
        </div>
        <svg class="header1_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,100 0,100"/>
        </svg>
    </header>
    
    <div class="update_main_container">
        <h1>編集</h1>
        <form action="update_success.php" method="post">
            <table>
                <tr>
                    <th class="update_upper">タイトル</th>
                    <td><input type="text" class="update_text" name="title" value=<?php echo $title; ?>></td>
                </tr>
                <tr>
                    <th class="update_upper">本文</th>
                    <td>
                        <textarea name="text" class="update_textarea" cols="30" rows="5">
                            <?php echo $text; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <th class="update_upper">テーマ</th>
                    <td><input type="text" class="update_text" name="theme" value=<?php echo $theme; ?>></td>
                </tr>
                <tr>
                    <th class="update_upper">公開設定</th>
                    <td class="update_release">
                        <label><input type="radio" class="update_radio" name="release" value="1" <?php echo $release_t ?>>公開</label>
                        <label><input type="radio" class="update_radio" name="release" value="0" <?php echo $release_f ?>>非公開</label>
                    </td>
                </tr>
            </table>
            <input type="submit" value="更新"> 
        </form>
    </div>
</body>
</html>