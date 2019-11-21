hello world



<?php





// POSTされた画像データの取得
$img= $_POST["img"];
 
// ヘッダに「data:image/png;base64,」が付いているので、それは外す
$img= preg_replace("/data:[^,]+,/i","",$img);
 
// 残りのデータはbase64エンコードされているので、デコードする
$img= base64_decode($img);
  
// 文字列状態から画像リソース化
$image = imagecreatefromstring($img);
  
//画像として保存（ディレクトリは任意）
$date = date(YmdHis);
imagesavealpha($image, TRUE); // 透明色の有効
imagepng($image ,'./'.$date.'.png');
?>

<?php
// POSTされた画像データの取得
$img2= $_POST["img"];
 
// ヘッダに「data:image/png;base64,」が付いているので、それは外す
$img2= preg_replace("/data:[^,]+,/i","",$img2);
 
// 残りのデータはbase64エンコードされているので、デコードする
$img2= base64_decode($img2);
  
// 文字列状態から画像リソース化
$image = imagecreatefromstring($img2);
  
//画像として保存（ディレクトリは任意）
$date = date(YmdHis);
imagesavealpha($image, TRUE); // 透明色の有効
imagepng($image ,'./a'.$date.'png');
?>