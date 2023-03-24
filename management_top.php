<?php
    //session start
    session_start();

    //データベース接続用ファイルを読み込む
    require_once 'db_connect.php';
/*login*/
    $motourl = $_SERVER['HTTP_REFERER'];
    if($motourl === 'http://localhost/php_demo/teamprojectB/login.php'){
        $error = false;
        //session
        if(!empty($_POST)){
            //name
            $_SESSION["user_name"] = htmlspecialchars($_POST["user_name"],ENT_QUOTES,"UTF-8");
            //pw
            $_SESSION["pw"] = htmlspecialchars($_POST["password"],ENT_QUOTES,"UTF-8");
        }

        $sql = "SELECT * FROM account WHERE user_name = :user_name";

        $stm = $pdo->prepare($sql);
        $stm->bindValue(':user_name', $_SESSION["user_name"], PDO::PARAM_STR);
        $stm->execute();
        $login_result = $stm->fetchAll(PDO::FETCH_ASSOC);

        //error check

            if($login_result === null) {
                $error = true;
                $_SESSION["error_db"] = "IDやパスワードが間違っていませんか";
            } else {
                //name
                $user_name = trim($_POST["user_name"], "\x20\t\n\r\0\v");
                if(empty($user_name)){
                    $error = true;
                    $_SESSION["error_user_name"] = "ユーザーIDは必須です。";
                } else if(preg_match("/^[0-9a-zA-Z]*$/u",$user_name) === 0) {
                    $error = true;
                    $_SESSION["error_user_name"] = "ユーザーIDは半角英数字のみです。";
                } 
                //pw
                $pw= trim($_POST["password"], "\x20\t\n\r\0\v");
                if(empty($pw)){
                    $error = true;
                    $_SESSION["error_pw"] = "パスワードは必須です。";
                } else if($login_result[0]["password"] !== $pw){
                    $error = true;
                    $_SESSION["error_pw"] = "パスワードが間違っています。";
                }
            }
    
        //入力エラーがどこかで発生したらリダイレクトする。
        if($error){
            header('Location: login.php');
            exit();
        }
    }
    
/*top*/
    if(!empty($login_result[0]["user_id"])){
        $_SESSION["user_id"] = $login_result[0]["user_id"];
    }
    $user_id = $_SESSION["user_id"];
    
    $sql = "SELECT * FROM blog WHERE user_id = :user_id AND deletes = 0";

    $stm = $pdo->prepare($sql);
    $stm->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT * FROM account WHERE user_id = :user_id";

    $stm = $pdo->prepare($sql);
    $stm->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stm->execute();
    $account_result = $stm->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($account_result)){
        $_SESSION["user_name"] = $account_result[0]["user_name"];
    }
    $user_name = $_SESSION["user_name"];

    $_SESSION["blog_id"] = [];
    $_SESSION["title"] = [];
    $_SESSION["text"] = [];
    $_SESSION["release"] = [];
    $_SESSION["theme"] = [];

    $_SESSION["error_title"] = [];
    $_SESSION["error_text"] = [];
    $_SESSION["error_release"] = [];
    $_SESSION["error_theme"] = [];

    // $_SESSION["user_name"] = [];
    $_SESSION["pw"] = [];
    $_SESSION["error_db"] = [];
    $_SESSION["error_user_name"] = [];
    $_SESSION["error_pw"] = [];

 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理 トップページ</title>
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
    
    <div class="mana_d_main_container">
        <div class="mana_d_left_container">
            <a href="confirm.php" class="mana_d_new"><div class="mana_d_circle">新規投稿</div></a>
            <div class="mana_d_left_profile"><a href="management_profile.php"><?php echo $_SESSION["user_name"]; ?>さん</a></div>
            <img src="./img/girl.png" alt="img">
        </div>

        <div class="mana_d_right_container">
            <h1>一覧</h1>
            <table>
        <?php
            foreach($result as $data) {
                echo<<<"EOD"
                        <tr>
                            <td class="mana_d_title"><a href="">{$data['title']}</a></td>
                            <td class=""><a class="mana_d_buttom mana_d_update" href="update.php?blog_id={$data['blog_id']}">編集</a></td>
                            <td class=""><a class="mana_d_buttom mana_d_delete" href="delete.php?blog_id={$data['blog_id']}">削除</a></td>
                        </tr>
                EOD;
            }    
        ?>
            </table>    
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