<?php
   if(isset($_COOKIE['name'])){
   }else{
     $msg="ログインしてください<br>";
     $msg.="<a href='../login.html'>ログインする</a>";
     exit($msg);
   }
?>
<!DOCTYPE html>
<html lang=ja>
  <title>秘密基地</title>
  <meta charset="utf-8">
</html>
<body>
  <h1>ようこそ<?php echo $_COOKIE['name'] ?>さん</h1>
  <a href='../createpage.php'>掲示板を作成する</a>
</body>
</html>
