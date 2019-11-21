<?php
include("uranaidate.php");
$name = $_GET[name];
$kekka = $_GET[result];
// var_dump($name);var_dump($kekka);
// $sei = $_POST["sei"];
// $mei = $_POST["mei"];
// $sex = $_POST["sex"];
// $year =  $_POST["year"];
// $month = $_POST["month"];
// $day = $_POST["day"];
// $blood = $_POST["blood"];
$test = $a[$kekka];

//最高
$b0 = $test[0];
//良い
$b2 = $test[2];
$b3 = $test[3];
$b4 = $test[4];
$b5 = $test[5];
// var_dump($b0);
// echo($b2);
// echo($b3);
// echo($b4);
// echo($b5);

// $result = $y[$year][$month-1];



//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=thigashino_db;charset=utf8;host=mysql743.db.sakura.ne.jp', 'thigashino', 'Shinon0409');
    // $pdo = new PDO('mysql:dbname=yellow;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DB ConnectionError'.$e->getMessage());
  }
  
  //２．データ登録SQL作成
  $sql = "SELECT * FROM y_m ORDER BY indate DESC";
  $stmt = $pdo->prepare("$sql");
  $status = $stmt->execute();
  
  //３．データ表示
  $view="";

$sei = "";
$mei = "";
$sex = "";
$year =  "";
$month = "";
$day = "";
$blood = "";
$testtest = "";

  if($status==false) {
      //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("SQL ERROR:".$error[2]);
  
  }else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    $view .="<table>";
    while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
      if($r["result"]==$b0||$r["result"]==$b2||$r["result"]==$b3||$r["result"]==$b4||$r["result"]==$b5){
        $testtest .=$r["sei"]."さん<br>";
      }
      $view .= "<tr><td>".$r["id"]."</td><td>".$r["sei"]."</td></tr>";
      $sei .= $r["sei"];
      $mei .= $r["mei"];
      $sex .= $r["sex"];
      $year .=  $r["year"];
      $month .= $r["month"];
      $day .= $r["day"];
      $blood .= $r["blood"];
    }
    $view .="</table>";
  
  }




// $str = $result.",".$sei.",".$mei.",".$sex.",".$year.",".$month.",".$day.",".$blood;
// $file = fopen("data/data.txt","a");	// ファイル読み込み
// fwrite($file, $str."\n");
// fclose($file);
?>



<html>
<head>
<meta charset="utf-8">
<script src="js/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
<title>GET練習（受信）</title>
</head>
<body>
<!-- 
<div>
    <div class="container jumbotron"><?=$view?></div>
</div> -->

<div class="name"><?=$name?>さんの診断結果</div>

<!-- 
<script type="text/javascript">


let mySei = localStorage.getItem('mySei');
let myYear = localStorage.getItem('myYear');
let myMonth = localStorage.getItem('myMonth');
let myDay = localStorage.getItem('myDay');
let myBlood = localStorage.getItem('myBlood');
let mySex = localStorage.getItem('mySex');
let myMonth2 = myMonth-1


 
</script> -->

<?php
// $result = 1;
include("seikaku.php");
?>

<button id="aisyou">相性の良い人を探す！</button>
<div class="like"></div>
<script>

function like(){
  $(".like").html('<div class="like"><?=$testtest?></div>');
};


$("#aisyou").on("click",function(){
  like();
  console.log("ok");
  $("#aisyou").on("click",function(){
    like();
  });


});




</script>


<!-- <button type=“button” onclick="location.href='match.php'">相性の良い相手を探す</button> -->
<!-- <button >相性の良い相手を探す</button> -->
<ul>
<a href="index.php">最初のページに戻る</a></<a>
</ul>
</body>
</html>