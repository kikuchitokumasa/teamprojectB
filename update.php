<?php
    session_start();
    
    require_once 'db_connect.php';

    if(!empty($_GET["blog_id"])){
        $_SESSION["blog_id"] = $_GET["blog_id"];
        $sql = "SELECT * FROM blog WHERE blog_id = :blog_id";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':blog_id', $_SESSION["blog_id"], PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION["title"] = $result[0]["title"];
        $_SESSION["text"] = $result[0]["text"];
        $_SESSION["theme"] = $result[0]["theme"];
        $_SESSION["releases_f"] = "";
        $_SESSION["releases_t"] = "";
        if(isset($result[0]["releases"])) {
            $_SESSION["releases"] = $result[0]["releases"];
            if($release = $result[0]["releases"] === 0) {
                $_SESSION["releases_f"] = "checked";
            } else if($release = $result[0]["releases"] === 1) {
                $_SESSION["releases_t"] = "checked";
            }
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
        <div class="update_error">
        <?php
        //エラーを表示
            //title
            if(!empty($_SESSION["error_title"])) {
                echo $_SESSION["error_title"]."<br>";
            }
            //text
            if(!empty($_SESSION["error_text"])) {
                echo $_SESSION["error_text"]."<br>";
            }
            //theme
            if(!empty($_SESSION["error_theme"])) {
                echo $_SESSION["error_theme"]."<br>";
            }
            //release
            if(!empty($_SESSION["error_release"])) {
                echo $_SESSION["error_release"]."<br>";
            }
        ?>
        </div>
        <form action="update_success.php" method="post">
            <table>
                <tr>
                    <th class="update_upper">タイトル</th>
                    <td><input type="text" class="update_text" name="title" value=<?php echo $_SESSION["title"]; ?>></td>
                </tr>
                <tr>
                    <th class="update_upper">本文</th>
                    <td>
                        <textarea name="text" class="update_textarea" cols="30" rows="5">
                            <?php echo $_SESSION["text"];; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <th class="update_upper">テーマ</th>
                    <td><input type="text" class="update_text" name="theme" value=<?php echo $_SESSION["theme"]; ?>></td>
                </tr>
                <tr>
                    <th class="update_upper">公開設定</th>
                    <td class="update_release">
                        <label><input type="radio" class="update_radio" name="release" value="1" <?php echo $_SESSION["releases_t"] ?>>公開</label>
                        <label><input type="radio" class="update_radio" name="release" value="0" <?php echo $_SESSION["releases_f"] ?>>非公開</label>
                    </td>
                </tr>
            </table>
            <input type="submit" value="更新"> 
        </form>
    </div>

    <footer class="footer1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 5.29" preserveAspectRatio="none">
        <polygon points="0,0 100,0 100,5.29"/>
        </svg>
        <div class="footer1_container">
            <a class="footer1_title" href="management_top.php">BLOG</a>
            <ul>
                <li><a href="">新規投稿</a></li>
                <li><a href="">ログアウト</a></li>
            </ul>
        <p class="footer1_c">&copy; Bチーム</p>
        </div>
    </footer>

</body>
</html>