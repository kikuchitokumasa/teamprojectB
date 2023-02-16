<?php
    session_start();

    require_once "db_connect.php";

    $user_name = "";

    if(!empty($_SESSION["r_user_name"])) {
        $user_name = $_SESSION["r_user_name"];
    }


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
    <link rel="stylesheet" href="./css/login_style.css">
    
    <link rel="icon" href="./img/favicon.ico">
</head>
<body>
    <header class="header2">
        <img src="./img/logo.png" alt="logo">
    </header>

    <div class="register_main_container">
        <h1>新規会員登録</h1>
        <div class="register_error">
            <?php
            //エラーを表示
            if(!empty($_SESSION["r_error_user_name"])) {
                echo $_SESSION["r_error_user_name"]."<br>";
            }
            if(!empty($_SESSION["r_error_pw"])) {
                echo $_SESSION["r_error_pw"]."<br>";
            }
            ?>
        </div>
        <form action="check_account.php" method="post">
            <div class="register_table">
                <table>
                    <tr>
                        <th>ユーザーID</th>
                        <td><input type="text" name="user_name" value="<?php echo $user_name; ?>"></td>
                    </tr>
                    <tr>
                            <th class="register_thm"></th>
                            <td class="register_tdm"></td>
                    </tr>
                    <tr>
                        <th>パスワード</th>
                        <td><input type="password" name="pw"></td>
                    </tr>
                    <tr>
                            <th class="register_thm"></th>
                            <td class="register_tdm"></td>
                    </tr>
                    <tr>
                        <th>パスワード(確認用)</th>
                        <td><input type="password" name="pw_c"></td>
                    </tr>
                </table>
            </div>
            <input type="submit" value="登録内容の確認">
        </form>
    </div>

    <footer class="footer2">
        <p class="footer2_c">&copy; Bチーム</p>
    </footer>
</body>
</html>