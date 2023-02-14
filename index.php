<?php
    //データベース接続用ファイルを読み込む
    require_once 'db_connect.php';
    
    $sql = "SELECT * FROM blog JOIN account ON blog.user_id = account.user_id WHERE releases = 1 AND deletes = 0";

    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>php</title>
    <meta name="description"  content="">

    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/css/6-1-6.css">
    <!-- <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" /> -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/browse_style.css">

</head>

<body>
    <header class="header1">
        <div class="header1_container">
            <a href="management_top.php"><img src="./img/logo.png" alt=""></a>
            <a class="header1_buttom" href="">ログイン</a>
        </div>
        <svg class="header1_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,100 0,100"/>
        </svg>
    </header>

    <div class="browse_main_container">
        <ul class="slider">
            <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_01.jpg" alt=""></li>
            <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_02.jpg" alt=""></li>
            <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_03.jpg" alt=""></li>
            <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_04.jpg" alt=""></li>
            <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_05.jpg" alt=""></li>
            <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_06.jpg" alt=""></li>
            <!--/slider-->
        </ul>
        
        <table>
        <?php
            foreach($result as $data) {
                echo<<<"EOD"
                    <tr>
                        <td class="browse_title"><a href="">{$data['title']}</a></td>
                        <td class="browse_name"><a href="">{$data['user_name']}</a></td>
                    </tr>
                EOD;
            }    
        ?>
        </table> 
    </div>

    <footer class="footer1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 5.29" preserveAspectRatio="none">
        <polygon points="0,0 100,0 100,5.29"/>
        </svg>
        <div class="footer1_container">
            <a class="footer1_title" href="management_top.php">BLOG</a>
            <ul>
                <li><a href="">ログイン</a></li>
            </ul>
            <p class="footer1_c">&copy; Bチーム</p>
        </div>
    </footer>
  
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/js/6-1-6.js"></script>


</body>
</html>