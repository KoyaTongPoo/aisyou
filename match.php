<?php

$sei = $_POST["sei"];
$mei = $_POST["mei"];
$sex = $_POST["sex"];
$year =  $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];
$blood = $_POST["blood"];

$test = $_POST[$kekka];
echo 'ERROR';
?>

<html>
<head>
<meta charset="utf-8">
<title>GET練習（受信）</title>
</head>
<body>




<!-- 
<script>
let kekka = storage.getItem(kekka);


</script> -->




<button type=“button” onclick="location.href='match.php'">相性の良い相手を探す</button>
<!-- <button >相性の良い相手を探す</button> -->
<ul>
<li><a href="index.php">index.php</a></li>
</ul>
</body>
</html>