<?php




//1. POSTデータ取得
$id= $_POST["id"];
$myid= $_POST["myid"];

echo $id;
echo $myid;
 
//2. DB接続します
//*** function化する！  *****************
include("funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成
$sql="UPDATE y_m SET subete=subete+1 WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':a_a', $a_a, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':r_a', $r_a, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行
 


$sql="UPDATE y_m SET mysubete=mysubete+1 WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $myid, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':a_a', $a_a, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':r_a', $r_a, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行