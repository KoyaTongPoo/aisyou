<?PHP
include("uranaidate.php");
// //1. POSTデータ取得
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = 0;
$life_flg = 0;

$lpw = password_hash($lpw,PASSWORD_DEFAULT);


$sei = $_POST["sei"];
$mei = $_POST["mei"];
$sex = $_POST["sex"];
$year =  $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];
$blood = $_POST["blood"];
$subete = 0;
$seikai = 0;
$mysubete = 0;
$myseikai = 0;


$result = $y[$year][$month-1];
$result =intval($day)+intval($result);
if($result>=61){
  $result = $result-60;
}



// var_dump($_POST);
// exit();


//2. DB接続します
include("funcs.php");
$pdo = db_conn();



//３．データ登録SQL作成
$sql = "INSERT INTO y_m(lid,lpw,kanri_flg,life_flg,result,sei,mei,sex,year,month,day,blood,indate,subete,seikai,mysubete,myseikai) VALUES(:lid, :lpw, :kanri_flg, :life_flg,:result, :sei, :mei, :sex, :year, :month, :day, :blood,  sysdate(),:subete,:seikai,:mysubete,:myseikai)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':result', $result, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sei', $sei, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':mei', $mei, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':year', $year, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':month', $month, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':day', $day, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':blood', $blood, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':subete', $subete, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':seikai', $seikai, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':mysubete', $mysubete, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':myseikai', $myseikai, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// $stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．index.phpへリダイレクト

redirect("login.php");
}


?> 