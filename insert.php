<?php
//1. POSTデータ取得
$bs64 = $_POST["img_id"];

//2. DB接続します
include("funcs.php");
$pdo = dbcons();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_img_table(bs64) VALUES(:bs64)");
$stmt->bindValue(':bs64',  $bs64,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: select.php");
  exit();
}
?>