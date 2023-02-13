<?php
    //session start
    session_start();

    //データベース接続用ファイルを読み込む
    require_once 'db_connect.php';

    if(!empty($_GET["user_id"])){
        $_SESSION["user_id"] = $_GET["user_id"];
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
</head>
<body>
    <div class="mana_d_main_container">
        <div class="mana_d_left_container">
            <div class="mana_d_circle"><a href="">新規投稿</a></div>
            <p><?php echo $_SESSION["user_name"]; ?>さん</p>
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

    <footer>
        
    </footer>
</body>
</html>