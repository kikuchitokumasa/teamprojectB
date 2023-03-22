<?php    
    session_start();
    
    require_once 'db_connect.php';

    if(!empty($_SESSION["r_user_name"])){
        $sql = "INSERT INTO account VALUE (0, :user_name, :pw)";

        $stm = $pdo->prepare($sql);
        $stm->bindValue(':user_name', $_SESSION["r_user_name"], PDO::PARAM_STR);
        $stm->bindValue(':pw', $_SESSION["r_pw"], PDO::PARAM_STR);
        $stm->execute();
        $login_result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $user_name = $_SESSION["r_user_name"];

        //id 検索
        $sql = "SELECT * FROM account WHERE user_name = :user_name";

        $stm = $pdo->prepare($sql);
        $stm->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        $stm->execute();
        $id_result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $user_id = $id_result[0]["user_id"];

        //profile db
        $sql = "INSERT INTO profile (user_id,name) VALUES (:user_id,:name)";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stm->bindValue(':name', $user_name, PDO::PARAM_STR);
        $stm->execute();
        $profile_result = $stm->fetchAll(PDO::FETCH_ASSOC);

    
        //セッションの破棄
        $_SESSION = [];
        //セッションの鍵(cookie)を削除
        if(isset($_COOKIE[session_name()])){
            setcookie(session_name(),"",time() -1800);
        }
        //セッションファイルの破棄
        session_destroy();
    }

        

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login_style.css">
    
    <link rel="icon" href="./img/favicon.ico">
</head>
<body>
    <header class="header2">
        <a href="index.php"><img src="./img/logo.png" alt="logo"></a>
    </header>
    <div class="login_main_container">
        <h1>ログイン</h1>
        <div class="login_error">
            <?php
            //エラーを表示
                if(!empty($_SESSION["error_db"])) {
                    echo $_SESSION["error_db"]."<br>";
                }
                if(!empty($_SESSION["error_user_name"])) {
                    echo $_SESSION["error_user_name"]."<br>";
                }
                if(!empty($_SESSION["error_pw"])) {
                    echo $_SESSION["error_pw"]."<br>";
                }
            ?>
        </div>
        <form action="management_top.php" method="post">
            <div class="login_table">
                <table>
                    <tr>
                        <th>ユーザーID</th>
                        <td><input type="text" name="user_name"></td>
                    </tr>
                    <tr>
                        <th class="login_thm"></th>
                        <td class="login_tdm"></td>
                    </tr>
                    <tr>
                        <th>パスワード</th>
                        <td><input type="password" name="password"></td>
                    </tr>
                </table>
            </div>
            <input type="submit" value="ログイン">
        </form>
        <a href="register_account.php">-新規会員登録-</a>
    </div>
    <footer class="footer2">
        <p class="footer2_c">&copy; Bチーム</p>
    </footer>
</body>
</html>
