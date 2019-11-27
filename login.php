<?PHP
include("head.php");
?>

<title>ログイン</title>
</head>
<body>

<!-- <header>
  <nav class="navbar navbar-default">LOGIN</nav>
</header> -->

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post">
ID:<input type="text" name="lid" />
PW:<input type="password" name="lpw" />
<input type="submit" value="LOGIN" />
</form>
<a href="index.php">新規登録はこちら</a></<a>

</body>
</html>