<?php
//データベース接続用ファイルを読み込む
    require_once 'db_connect.php';
    
    $sql = "SELECT * FROM blog WHERE release = 1 AND deletes = 0";

    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);


php?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>php課題</title>
<meta name="description"  content="">

<meta name="viewport" content="width=device-width,initial-scale=1.0">
<!--==============レイアウトを制御する独自のCSSを読み込み===============-->
<link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/css/6-1-6.css">

</head>

<body>
<h2>ロゴ</h2>

<ul class="slider">
  <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_01.jpg" alt=""></li>
  <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_02.jpg" alt=""></li>
  <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_03.jpg" alt=""></li>
  <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_04.jpg" alt=""></li>
  <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_05.jpg" alt=""></li>
  <li><img src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/img/img_06.jpg" alt=""></li>
<!--/slider--></ul>


  
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-6/js/6-1-6.js"></script>

<table>
        <?php
            foreach($result as $data) {
                echo<<<"EOD"
                        <tr>
                            <td class="mana_d_title"><a href="">{$data['title']}</a></td>
                            <td class="mana_d_title"><a href="">{$data['user_id']}</a></td>
                        </tr>
                EOD;
            }    
        ?>
            </table>  
</body>
</html>
