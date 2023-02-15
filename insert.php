<?php
require_once 'db_connect.php';

$title = $_POST['title'];
$text = $_POST['text'];
$theme = $_POST['theme'];
$release = $_POST['release'];

$sql = "insert into blog (title, text, theme, release) values(:title, :text, :theme, :release)";

$stm = $pdo->prepare($sql);
$stm->bindValue(':title', $title, PDO::PARAM_STR);
$stm->bindValue(':text', $text, PDO::PARAM_STR);
$stm->bindValue(':theme', $theme, PDO::PARAM_STR);
$stm->bindValue(':release', $release, PDO::PARAM_STR);
$stm->execute();
?>
<p>とうろくしました</p>
<a href="index.php">一覧へ戻る</a>