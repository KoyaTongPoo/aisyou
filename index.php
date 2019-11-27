
<?PHP
include("head.php");
include("funcs.php");
?>

<div id="center">
<form action="insert.php" method="post">
<h2>新規登録へようこそ</h2>
<table border="3"><th>
メールアドレス(ログインID):<input type="text" name="lid" />
<span style="font-size:12px">IDが被ると登録できません</span>
<br>
パスワード:<input type="password" name="lpw" />
<span style="font-size:12px">パスワードはハッシュ化され、安全に保護されます。</span>
<table border="1">
        <tr>
        <th>あなたの姓</th>
        <th>あなたの名</th>
        <th>性別</th>
        <th>生まれた年</th>
        <th>生まれた月</th>
        <th>生まれた日にち</th>
        <th>血液型</th>

    </tr>

        <tr>
          <th><input type="text" id=sei name="sei"></th>
          <th><input type="text" id=mei name="mei"></th>
          <td><select name='sex'id=sex>
              <option value='men'>男性</option>
              <option value='women'>女性</option>
          </select></td>
          <td><select name='year'id=year><?php
for ($year = 1950; $year<= date(Y); $year = $year+1) {
    echo '<option value="', $year, '">', $year.年, '</option>';
} 
          ?></select></td>

          <td><select name='month'id=month><?php
for ($month = 1; $month<= 12; $month = $month+1) {
    echo '<option value="', $month, '">', $month.月, '</option>';
} 
          ?></select></td>

          <td><select name='day'id=day><?php
for ($day = 1; $day<= 31; $day = $day+1) {
    echo '<option value="', $day, '">', $day.日, '</option>';
} 
          ?></select></td>
          <td><select name='blood'id=blood>
              <option value='A'>A型</option>
              <option value='B'>B型</option>
              <option value='O'>O型</option>
              <option value='AB'>AB型</option>
          </select></td>

        </tr>
        
      </table>
      <input type="submit" id="sendsend" value="送信"></form> 
    </span>

    </table>

    <a class="navbar-brand" href="logout.php">ログインはこちら</a>

<!-- 
    <script type="text/javascript">
    $("#send").on("click",function(){
      let sei = $("#sei").val();
      let year = $("#year").val();
      let month = $("#month").val();
      let day = $("#day").val();
      let blood = $("#blood").val();
      let sex = $("#sex").val();
 
    localStorage.setItem('mySei', sei);
    localStorage.setItem('myYear', year);
    localStorage.setItem('myMonth', month);
    localStorage.setItem('myDay', day);
    localStorage.setItem('myBlood', blood);
    localStorage.setItem('mySex', sex);

    });
 
</script> -->




    <!-- <div class="camera">
        <video id="video">Video stream not available.</video>
    </div><br>
    <button id="startbutton">Take photo</button><br>
    <canvas id="canvas">
    <textarea id="readStr"></textarea>
    </canvas> -->


<!-- 
    <script>
let width = 320    // We will scale the photo width to this
let height = 0     // This will be computed based on the input stream

let streaming = false

let video = null
let canvas = null
let photo = null
let startbutton = null
let constrains = { video: true, audio: false }
let check = null

/**
 * ユーザーのデバイスによるカメラ表示を開始し、
 * 各ボタンの挙動を設定する
 *
 */
function startup() {
  video = document.getElementById('video')
  canvas = document.getElementById('canvas')
  photo = document.getElementById('photo')
  startbutton = document.getElementById('startbutton')

  videoStart()

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width)

      video.setAttribute('width', width)
      video.setAttribute('height', height)
      canvas.setAttribute('width', width)
      canvas.setAttribute('height', height)
      streaming = true
    }
  }, false)

  // 「take photo」ボタンをとる挙動を定義
  startbutton.addEventListener('click', function(ev){
    takepicture()
    ev.preventDefault()
  }, false);

  clearphoto()
}

/**
 * カメラ操作を開始する
 */
function videoStart() {
  streaming = false
  navigator.mediaDevices.getUserMedia(constrains)
  .then(function(stream) {
      video.srcObject = stream
      video.play()
  })
  .catch(function(err) {
      console.log("An error occured! " + err)
  })
}
/**
 * canvasの写真領域を初期化する
 */
function clearphoto() {
  let context = canvas.getContext('2d')
  context.fillStyle = "#AAA"
  context.fillRect(0, 0, canvas.width, canvas.height)
}

/**
 * カメラに表示されている現在の状況を撮影する
 */
function takepicture() {
  let context = canvas.getContext('2d')
  if (width && height) {
    canvas.width = width
    canvas.height = height
    context.drawImage(video, 0, 0, width, height)
    send()
    check=1
    console.log(check);
  } else {
    clearphoto()
  }
}
function send() {
    data = canvas.toDataURL('image/png').replace(/^.*,/, '')
    $.ajax('/uranai/read.php',{
        method: 'POST',
        data: {img: data}
        
    }).then(res => {
        $('#readStr').val(res)
    })
}

function send2() {
    data = canvas.toDataURL('image/png').replace(/^.*,/, '')
    $.ajax('/uranai/read.php',{
        method: 'POST',
        data: {img2: data}
        
    }).then(res => {
        $('#readStr').val(res)
    })
}

$("#sendsend").on("click",function(){
  $('#startbutton')[0].click(); 

});

// function check(){
//     if(check==1){

//     }else{
//         alert("未入力の項目があります。");
//         return false;
//     }
// }


startup()





</script> -->


 <!-- <ul>
// <li><a href="get.php">form(get)</a></li>
// <li><a href="post.php">form(post)</a></li>
// <li><a href="hensu.php">変数</a></li>
// <li><a href="hairetsu.php">配列</a></li>
// <li><a href="kansu.php">関数</a></li>
// <li><a href="phpinfo.php">PHP設定情報</a></li>
// </ul>
// <ul>
// <li><a href="write.php">ファイル書き込み</a></li>
// <li><a href="read.php">ファイル読み込む</a></li>
// </ul> -->
</body>
</html>