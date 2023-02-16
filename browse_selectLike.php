<?php
    session_start();
    require_once "db_connect.php";

    $keyword = $_POST["keyword"];
    $key = '%'.$keyword.'%';

    $sql = "SELECT * FROM blog JOIN account ON blog.user_id = account.user_id  WHERE releases = 1 AND deletes = 0 AND theme LIKE :keyword";

    $stm = $pdo->prepare($sql);
    $stm->bindValue(':keyword', $key, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="./css/browse_style.css">
</head>
<body>
<header class="header1">
        <div class="header1_container">
            <a href="management_top.php"><img src="./img/logo.png" alt=""></a>
            
            <form action="browse_selectLike.php" method="post">
                <input type="text" name="keyword">
                <div class="header1_submit"><input type="submit" value="検索"></div>
            </form>

            <a class="header1_buttom" href="">ログアウト</a>
        </div>
        <svg class="header1_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,100 0,100"/>
        </svg>
    </header>
    
    <div class="select_like_main_container">
        <h1>検索結果:<?php echo $keyword ?></h1>
        <table>
        <?php
            foreach($result as $data) {
                echo<<<"EOD"
                    <tr>
                        <td class="select_like_title"><a href="">{$data['title']}</a></td>
                        <td class="select_like_name"><a href="">{$data['user_name']}</a></td>
                    </tr>
                EOD;
            }    
        ?>
        </table> 
        <div class="selet_like_buttom">
            <a href="index.php">トップページへ</a>
        </div>    
    </div>

    <footer class="footer1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 5.29" preserveAspectRatio="none">
        <polygon points="0,0 100,0 100,5.29"/>
        </svg>
        <div class="footer1_container">
            <a class="footer1_title" href="index.php">BLOG</a>
            <ul>
                <li><a href="">新規投稿</a></li>
                <li><a href="">ログアウト</a></li>
            </ul>
        <p class="footer1_c">&copy; Bチーム</p>
        </div>
    </footer>
</body>
</html>