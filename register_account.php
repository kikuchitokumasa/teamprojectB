<?php
    session_start();

    require_once "db_connect.php";


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
    <header>

    </header>

    <div class="register_a_main_container">
        <h1>新規会員登録</h1>
        <?php
        //エラーを表示
        if(!empty($_SESSION["r_error_user_name"])) {
            echo $_SESSION["r_error_user_name"]."<br>";
        }
        if(!empty($_SESSION["r_error_pw"])) {
            echo $_SESSION["r_error_pw"]."<br>";
        }
        ?>
        <form action="check_account.php" method="post">
            <table>
                <tr>
                    <th>ユーザーID</th>
                    <td><input type="text" name="user_name" value="<?php echo $_SESSION["r_user_name"] ?>"></td>
                </tr>
                <tr>
                    <th>パスワード</th>
                    <td><input type="password" name="pw"></td>
                </tr>
                <tr>
                    <th>パスワード(確認用)</th>
                    <td><input type="password" name="pw_c"></td>
                </tr>
            </table>
            <input type="submit" value="登録内容の確認">
        </form>
    </div>

    <footer>

    </footer>
</body>
</html>