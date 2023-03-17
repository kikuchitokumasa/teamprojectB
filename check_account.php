<?php
    session_start();

    require_once "db_connect.php";
    
    $error = false;
    //session
    if(!empty($_POST)){
        //name
        $_SESSION["r_user_name"] = htmlspecialchars($_POST["user_name"],ENT_QUOTES,"UTF-8");
        //pw
        $_SESSION["r_pw"] = htmlspecialchars($_POST["pw"],ENT_QUOTES,"UTF-8");
        $_SESSION["r_pw_c"] = htmlspecialchars($_POST["pw_c"],ENT_QUOTES,"UTF-8");
    }
    
    //error check
    //name
    $user_name = trim($_POST["user_name"], "\x20\t\n\r\0\v");
    if(empty($user_name)){
        $error = true;
        $_SESSION["r_error_user_name"] = "ユーザーIDは必須です。";
    } else if(preg_match("/^[0-9a-zA-Z]*$/u",$user_name) === 0) {
        $error = true;
        $_SESSION["r_error_user_name"] = "ユーザーIDは半角英数字のみです。";
    } 
    //pw
    $pw= trim($_POST["pw"], "\x20\t\n\r\0\v");
    $pw_c= trim($_POST["pw_c"], "\x20\t\n\r\0\v");
    if(empty($pw)){
        $error = true;
        $_SESSION["r_error_pw"] = "パスワードは必須です。";
    } else if(empty($pw_c)){
        $error = true;
        $_SESSION["r_error_pw"] = "パスワードは必須です。";
    }else if($pw !== $pw_c){
        $error = true;
        $_SESSION["r_error_pw"] = "パスワードが間違っています。";
    }
  
    //入力エラーがどこかで発生したらリダイレクトする。
    if($error){
        header('Location: register_account.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録内容の確認</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login_style.css">
    
    <link rel="icon" href="./img/favicon.ico">
</head>
<body>
    <header class="header2">
        <a href="index.php"><img src="./img/logo.png" alt="logo"></a>
    </header>

    <div class="register_c_main_container">
        <h1>登録内容の確認</h1>
        <div class="register_c_table">
            <table>
                <tr>
                    <th class="register_c_h">ユーザーID</th>
                    <td class="register_c_d"><?php echo $_SESSION["r_user_name"]; ?></td>
                </tr>
                <tr>
                    <th class="register_c_thm"></th>
                    <td class="register_c_tdm"></td>
                </tr>
                <tr>
                    <th class="register_c_h">パスワード</th>
                    <td class="register_c_d"><?php echo $_SESSION["r_pw"]; ?></td>
                </tr>
            </table>
        </div>
        <div class="register_c_buttom"><a class="register_c_login" href="login.php">登録</a></div>
        <a class="register_c_back" href="register_account.php">戻る</a>
    </div>

    <footer class="footer2">
        <p class="footer2_c">&copy; Bチーム</p>
    </footer>
</body>
</html>