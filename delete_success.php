<?php
    session_start();
    //データベース接続用ファイルを読み込む
    require_once 'db_connect.php';

    $blog_id = $_SESSION["blog_id"];

    $sql = "UPDATE blog SET deletes = '1' WHERE blog_id = :blog_id";

    $stm = $pdo->prepare($sql);

    $stm->bindValue(':blog_id', $blog_id, PDO::PARAM_INT);

    $stm->execute();

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除完了</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/management_style.css">
</head>
<body>
    <div class="delete_success_main_container">
        <h1>削除</h1>
        <div class="delete_success_center">
            <p>削除が完了しました。</p>
            <a href="management_top.php">トップページへ</a>
        </div>
    </div>
</body>
</html>