<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続： db_conn()
function db_conn(){
try {
    // return new PDO('mysql:dbname=thigashino_db;charset=utf8;host=mysql743.db.sakura.ne.jp', 'thigashino', 'Shinon0409');  
    return new PDO('mysql:dbname=yellow;charset=utf8;host=localhost','root','root');  
} catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
  }
}


//SQLエラー: sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}



//リダイレクト: redirect($file_name)
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

//SESSION_Check関数
session_start();
function chkSsid(){
if(!isset($_SESSION["chk_ssid"])||
  $_SESSION["chk_ssid"] != session_id()
){
 exit("Login Error.");
}else{
 session_regenerate_id(true);
  $_SESSION["chk_ssid"]=session_id();
}
}



