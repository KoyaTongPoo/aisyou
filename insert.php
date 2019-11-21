<?PHP
include("uranaidate.php");
// //1. POSTデータ取得
$sei = $_POST["sei"];
$mei = $_POST["mei"];
$sex = $_POST["sex"];
$year =  $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];
$blood = $_POST["blood"];


$result = $y[$year][$month-1];
$result =intval($day)+intval($result);
if($result>=61){
  $result = $result-60;
}



// var_dump($_POST);
// exit();


//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=thigashino_db;charset=utf8;host=mysql743.db.sakura.ne.jp', 'thigashino', 'Shinon0409');
  // $pdo = new PDO('mysql:dbname=yellow;charset=utf8;host=localhost','root','root'); 
} catch (PDOException $e) {
  exit('DB Error:'.$e->getMessage());
}


//３．データ登録SQL作成
$sql = "INSERT INTO y_m(result,sei,mei,sex,year,month,day,blood,indate) VALUES(:result, :sei, :mei, :sex, :year, :month, :day, :blood,  sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':result', $result, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sei', $sei, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':mei', $mei, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':year', $year, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':month', $month, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':day', $day, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':blood', $blood, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL Error:".$error[2]);
}else{
  //５．index.phpへリダイレクト
header("Location: result.php?name=".$sei."&result=".$result);
exit();

}


?> 