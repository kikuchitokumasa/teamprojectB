<?php
    //データベース接続用ファイルを読み込む
    require_once 'db_connect.php';
    
    session_start();

    //セッションの破棄
    $_SESSION = [];
    //セッションの鍵(cookie)を削除
    if(isset($_COOKIE[session_name()])){
         setcookie(session_name(),"",time() -1800);
    }
    //セッションファイルの破棄
    session_destroy();

    
    $sql = "SELECT * FROM blog JOIN account ON blog.user_id = account.user_id WHERE releases = 1 AND deletes = 0";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ブログ</title>
    <meta name="description"  content="">

    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-1/css/6-1-1.css">    <!-- <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" /> -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/browse_style.css">

    <link rel="icon" href="./img/favicon.ico">
</head>
<style type="text/css">
    /*=== 画像の表示エリア ================================= */
    .slide {
        position   : relative;
        overflow   : hidden;
                            /* 画像のサイズに合わせて変更ください */
        width      : 992.37px;
        height     : 219.84px;
        /* margin     : auto;      サンプルは中央寄せの背景：白 */
        background : #FAFCFD;
    }
    
    /*=== 画像の設定 ======================================= */
    .slide img {
        display    : block;
        position   : absolute;
                            /* 画像のサイズを表示エリアに合せる */
        width      : inherit;
        height     : inherit;
        left       : 100%;
        animation  : slideAnime 15s ease infinite;

        object-fit: cover;
    }
    
    /*=== スライドのアニメーションを段差で開始する ========= */
    .slide img:nth-of-type(1) { animation-delay: 0s }
    .slide img:nth-of-type(2) { animation-delay: 5s }
    .slide img:nth-of-type(3) { animation-delay: 10s }
    
    /*=== スライドのアニメーション ========================= */
    @keyframes slideAnime{
        0% { left: 100%  }
        4% { left: 0     }
        29% { left: 0     }
        33% { left: -100% }
        100% { left: -100% }
    }

    /* レスポンシブ */
    @media(max-width: 600px) {
        /*=== 画像の表示エリア ================================= */
        .slide {
            /* width      : 343.51px; */
            width      : 100%;
            height     : 86.91px;
        }
    }
</style>

<body>
    <header class="header1">
        <div class="header1_container">
            <a href="index.php"><img src="./img/logo.png" alt="logo"></a>

            <form action="browse_selectLike.php" method="post">
                <input type="text" name="keyword">
                <div class="header1_submit"><input type="submit" value="検索"></div>
            </form>
            
            <a class="header1_buttom_login" href="login.php">ログイン</a>
        </div>
        <svg class="header1_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,100 0,100"/>
        </svg>
    </header>

    <div class="browse_main_container">
        <div class="browse_wrapper">
            <div class="slide" id="makeImg">
                <img src="img/register_account.png"alt="spring_fes">
                <img src="img/spring_fes.png"alt="spring_fes">
                <img src="img/summer_fes.png"alt="spring_fes">
            </div>
        </div>
        
        <table>
        <?php
            foreach($result as $data) {
                echo<<<"EOD"
                    <tr>
                        <td class="browse_title"><a href="browse_d.php?blog_id={$data['blog_id']}">{$data['title']}</a></td>
                        <td class="browse_name"><a href="browse_d.php?blog_id={$data['blog_id']}">{$data['user_name']}</a></td>
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
            <a class="footer1_title" href="index.php">BLOG</a>
            <ul>
                <li><a href="login.php">ログイン</a></li>
            </ul>
            <p class="footer1_c">&copy; Bチーム</p>
        </div>
    </footer>
  
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-1/js/6-1-1.js"></script>
</body>
</html>
