<?php

//ユーザー名
$user = "root";
//パスワード
$pass = "";
//データベース名
$database = "teamprojectB";
//サーバー名
$server = "localhost:3308";

//DNS文字列の生成
$dns = "mysql:host={$server};dbname={$database};charset=utf8";


//mysql
try{
    //PDOクラスのインスタンスを作成してDBに接続する
    $pdo = new PDO($dns,$user,$pass);
    //プリペアドステートメントのエミュレーションを無効化
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    //例外がスローされるようにする
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo "データベースに接続しました";
}catch(Exception $e){
    echo "DB接続エラー:";
    // echo $e->getMessage;
    exit();
}

?>