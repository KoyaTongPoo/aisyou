<?PHP
session_start();


include("head.php");
include("funcs.php");
chkSsid();

$sid = session_id();
$lid = $_SESSION["id"];
include("uranaidate.php");



//1.  DB接続します
$pdo = db_conn();

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
$bad = "";
$myid = "";

if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL ERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  $view .="<table>";
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    if($r["lid"]==$lid){
      $myname .=$r["sei"];
      $result .=$r["result"];
      $myid =$r["id"];
    }

    $name = $myname;
$kekka = $result;

$aisyou = $a[$kekka];

//最高
$b0 = $aisyou[0];
//良い
$b2 = $aisyou[2];
$b3 = $aisyou[3];
$b4 = $aisyou[4];
$b5 = $aisyou[5];

//最悪
$b1 = $aisyou[1];
//悪い
$b6 = $aisyou[6];
$b7 = $aisyou[7];
$b8 = $aisyou[8];
$b9 = $aisyou[9];
//問題の起きやすい
$b10 = $aisyou[10];
$b11 = $aisyou[11];
$b12 = $aisyou[12];
$b13 = $aisyou[13];
$b14 = $aisyou[14];
$b15 = $aisyou[15];
$b16 = $aisyou[16];
$b17 = $aisyou[17];



    if($r["result"]==$b0||$r["result"]==$b2||$r["result"]==$b3||$r["result"]==$b4||$r["result"]==$b5){
      $testtest .=$r["sei"]."さん<br>";
    }
    if($r["result"]==$b1||$r["result"]==$b6||$r["result"]==$b7||$r["result"]==$b8||$r["result"]==$b9||
    $r["result"]==$b10||$r["result"]==$b11||$r["result"]==$b12||$r["result"]==$b13||$r["result"]==$b14||
    $r["result"]==$b15||$r["result"]==$b16||$r["result"]==$b17){
      $bad .=$r["sei"]."さん<br>";
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



echo "<script>$('#subTitle').html('<p style=font-size:30px>". $name . "さんの診断結果</p>')
</script>";


?>



<html>
<head>
<meta charset="utf-8">
<script src="js/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
<title>GET練習（受信）</title>
</head>
<body>


<?php
// $result = 1;
include("seikaku.php");
?>

<button id="aisyou">相性の良い人を探す！</button>
<div class="like"></div>

<div class="bad">
<button id="warui">相性の悪い人を探す？</button>
<div class="dislike"></div>
<div class="A"><button id="AAA">A</button><div class="AA"></div></div>
<div class="B"><button id="BBB">B</button><div class="BB"></div></div>
</div>

<script>

let answer="";
let score =0;
let chanse =0;
let idid =0;

function like(){
  $(".like").html('<div class="like"><?=$testtest?></div>');
};

//ABtestが長いので別ファイル化
<?=include('ABtest.php');?>

// ABtest();


$("#aisyou").on("click",function(){
  like();
  // console.log("ok");
  $("#aisyou").on("click",function(){
    like();
  });

});


$("#warui").on("click",function(){
  score =0;
  // dislike();
  ABtest();
});

$(".A").on("click",function(){
  if(answer==1){
    score+=1;
    answer = 0;
    chanse+=1;
    console.log(chanse);
    ABtest();

    $.ajax({
            url: 'seikai.php',
            type: 'post', // getかpostを指定(デフォルトは前者)
            // dataType: 'json', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
            data: { // 送信データを指定(getの場合は自動的にurlの後ろにクエリとして付加される)
                id:idid,
                myid: <?=$myid?>,

                // higashi: $higashi,

                // job: $('#job').val(),
            },
            success: function(data){
              console.log(data);
            }
        })
        // // ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき
        // .done(function (response) {
        //     $('#result').val('成功');
        //     $('#detail').val(response.data);
        // })
        // // ・サーバからステータスコード400以上が返ってきたとき
        // // ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
        // // ・通信に失敗したとき
        // .fail(function () {
        //     $('#result').val('失敗');
        //     $('#detail').val('');
        // });
    
    if(chanse==5){
      $(".bad").html("<P>結果発表</P>");
      if(score==5){
        $(".bad").append('<div class="dislike"><?=$bad?></div>');

      }else{
        $(".bad").append('<div class="dislike">間違えた箇所があります。再チャレンジしてみよう</div>');
      }
    }
  }else if(answer==2){
    answer = 0;
    chanse+=1;
    console.log(chanse);
    ABtest();
    $.ajax({
            url: 'hazure.php',
            type: 'post', 
            data: {id:idid,
              myid: <?=$myid?>,},
            success: function(data){
              console.log(data);
            }
        })
    if(chanse==5){
      $(".bad").html("<P>結果発表</P>");
      $(".bad").append('<div class="dislike">間違えた箇所があります。再チャレンジしてみよう</div>');
    }
  }

});

$(".B").on("click",function(){
  if(answer==2){
    score+=1;
    answer = 0;
    chanse+=1
    ABtest();
    $.ajax({
            url: 'seikai.php',
            type: 'post', 
            data: {id:idid,
              myid: <?=$myid?>,},
            success: function(data){
              console.log(data);
            }
        })
    if(chanse==5){
      $(".bad").html("<P>結果発表</P>");
      if(score==5){
        $(".bad").append('<div class="dislike"><?=$bad?></div>');

      }else{
        $(".bad").append('<div class="dislike">間違えた箇所があります。再チャレンジしてみよう</div>');
      }
    }
  }else if(answer==1){
    answer = 0;
    chanse+=1;
    ABtest();
    $.ajax({
            url: 'hazure.php',
            type: 'post', 
            data: {id:idid,
              myid: <?=$myid?>,},
            success: function(data){
              console.log(data);
            }
        })
    if(chanse==5){
      $(".bad").html("<P>結果発表</P>");
      $(".bad").append('<div class="dislike">間違えた箇所があります。再チャレンジしてみよう</div>');
    }
  }

});






</script>


<a class="navbar-brand" href="logout.php">ログアウト</a>

<!-- <button type=“button” onclick="location.href='match.php'">相性の良い相手を探す</button> -->
<!-- <button >相性の良い相手を探す</button> -->
<ul>

</ul>
</body>
</html>