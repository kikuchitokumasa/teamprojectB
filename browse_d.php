<?php
    session_start();
    require_once 'db_connect.php';

    $blog_id = $_GET['blog_id'];

    //現在表示する記事
    $sql = "SELECT * FROM blog JOIN account ON blog.user_id = account.user_id WHERE blog_id = :blog_id";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':blog_id', $blog_id, PDO::PARAM_INT);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    $text = nl2br($result[0]['text']);

    //そのユーザーの記事
    $sql = "SELECT blog_id FROM blog WHERE user_id = :user_id AND releases = 1 AND deletes = 0";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':user_id', $result[0]['user_id'], PDO::PARAM_INT);
    $stm->execute();
    $blog_result = $stm->fetchAll(PDO::FETCH_ASSOC);

    //次の記事
    //現在表示している記事のIDより大きい公開されていて削除されていない記事のIDを取得する
    $sql = "select blog_id from blog where blog_id > :blog_id and releases = 1 and deletes = 0 LIMIT 1";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':blog_id', $blog_id, PDO::PARAM_INT);
    $stm->execute();
    $result2 = $stm->fetch(PDO::FETCH_ASSOC);
    if($result2 !== false){
        $next_blog_id = $result2["blog_id"]; 
    }

    
    //前の記事
    //現在表示している記事のIDより小さい公開されていて削除されていない記事のIDを取得する
    $sql = "select blog_id from blog where blog_id < :blog_id and releases = 1 and deletes = 0  order by blog_id desc LIMIT 1";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':blog_id', $blog_id, PDO::PARAM_INT);
    $stm->execute();
    $result3 = $stm->fetch(PDO::FETCH_ASSOC);
    if($result3 !== false){
        $prev_blog_id = $result3["blog_id"];
    }
    
    $count = count($blog_result);
    for($i = 0 ; $i < $count ; $i++){
        if($blog_id+1 === $blog_result[$i]['blog_id']){
            $next_blog_id = $blog_result[$i]['blog_id'];
        }
    }
    




?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索結果</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/browse_style.css">
    <!-- <link rel="stylesheet" href="./css/management_style.css"> -->
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-1/css/6-1-1.css">  
     
   
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

<body id="browse">
    <header class="header1">
        <div class="header1_container">
            <a href="index.php"><img src="./img/logo.png" alt=""></a>
            
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

    <div class="browse_d_main_container">
        <!-- <div class="browse_wrapper">
            <ul class="slider">
                <li class="slider-item"><img src="./img/kouyou.jpg" alt="img"></li>
                <li class="slider-item"><img src="./img/sakura.jpg" alt="img"></li>
                <li class="slider-item"><img src="./img/wasitu.jpg" alt="img"></li>
            </ul>
        </div> -->
        <div class="browse_wrapper">
            <div class="slide" id="makeImg">
                <img src="img/register_account.png"alt="spring_fes">
                <img src="img/spring_fes.png"alt="spring_fes">
                <img src="img/summer_fes.png"alt="spring_fes">
            </div>
        </div>
        <div class="browse_success_original">
            <br>
            <br>
            <?php if(isset($prev_blog_id)){?>
                <a href="browse_d.php?blog_id=<?php echo $prev_blog_id; ?>">＜ 前の記事</a>
            <?php } ?>
            <?php if(isset($next_blog_id)){ ?>
                <a href="browse_d.php?blog_id=<?php echo $next_blog_id; ?>">次の記事 ＞</a>
            <?php } ?>
        </div>
        <br>
        <br>
        <div style="padding: 100px; margin-bottom: 10px; border: 1px solid #333333;">
            <div class="browse_d_main_contents">
                <div class="browse_d_article">
                    <p><h2><?php echo $result[0]["title"] ?></h2><p>
                    <p>投稿者:<?php echo $result[0]["user_name"] ?></p>
                    <p>テーマ:<?php echo $result[0]["theme"] ?></p>
                    <p>本文:<?php echo $result[0]["text"] ?></p>
                </div>
            </div>
        </div>

        <div class="browse_success_original">
            <br><br><br><br>
        <?php if(isset($prev_blog_id)){?>
                <a href="browse_d.php?blog_id=<?php echo $prev_blog_id; ?>">＜ 前の記事</a>
            <?php } ?>
            <?php if(isset($next_blog_id)){ ?>
                <a href="browse_d.php?blog_id=<?php echo $next_blog_id; ?>">次の記事 ＞</a>
            <?php } ?>
        </div>
        <br>
        <div class="browse_success_original">
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
                <li><a href="confirm.php">新規投稿</a></li>
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