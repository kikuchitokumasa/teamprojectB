<?php
    session_start();
    
    require_once 'db_connect.php';

    if(!empty($_SESSION["user_id"])){
        $sql = "SELECT * FROM profile WHERE user_id = :user_id";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':user_id', $_SESSION["user_id"], PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION["name"] = $result[0]["name"];
        $_SESSION["profession"] = $result[0]["profession"];
        $_SESSION["introduction"] = $result[0]["introduction"];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール編集</title>
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
    
    <div class="update_main_container">
        <h1>プロフィール編集</h1>
        <div class="update_error">
        <?php
        //エラーを表示
            //title
            if(!empty($_SESSION["error_name"])) {
                echo $_SESSION["error_name"]."<br>";
            }
        ?>
        </div>
        <form action="update_profile_success.php" method="post">
            <table>
                <tr>
                    <th class="update_upper">名前</th>
                    <td><input type="text" class="update_text" name="name" value=<?php echo $_SESSION["name"]; ?>></td>
                </tr>
                <tr>
                    <th class="update_upper">職業</th>
                    <td><input type="text" class="update_text" name="profession" value=<?php echo $_SESSION["profession"]; ?>></td>

                </tr>
                <tr>
                    <th class="update_upper">自己紹介</th>
                    <td>
                        <textarea name="introduction" class="update_textarea" cols="30" rows="5">
                            <?php echo $_SESSION["introduction"];; ?>
                        </textarea>
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
                <li><a href="confirm.php">新規投稿</a></li>
                <li><a href="index.php">ログアウト</a></li>
            </ul>
        <p class="footer1_c">&copy; Bチーム</p>
        </div>
    </footer>

</body>
</html>