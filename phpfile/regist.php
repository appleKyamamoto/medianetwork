<?php
  //文字化け防止
header('Content-Type: text/html; charset=UTF-8');

$id=htmlspecialchars($_POST["id"]);
$pw=htmlspecialchars($_POST["pw"]);
$filename="./list.csv";

//空白チェック
if(strcmp($id,"")==0 || strcmp($pw,"")==0)
  exit("エラー:IDまたはPWが空白です");

if(!file_exists($filename))
  touch($filename);
$fp=fopen($filename,"r+");
flock($fp,LOCK_EX);
$flag=false;
while($line = fgetcsv($fp))
  if(strcmp($line[0],$id)==0)
    {
      $flag=true;
      break;
    }

if($flag)
  exit("すでに登録されているIDです.");
else
  fputcsv($fp,Array($id,hash("sha256",$pw)));

flock($fp,LOCK_UN);
fclose($fp);
?>

<!DOCTYPE html>
<html lang=ja>
<head>
  <title>ユーザー登録完了</title>
</head>
<body>
  <header>
  <h1>登録が完了しました</h1>
  </header>
  ユーザー名:<?php echo $id ?><br>
  パスワード:<?php echo $pw ?><br>
  <a href="../regist.html" target="_self">登録画面に戻る</a>
  <footer>
  <p><small>&copy; copyright 2015 e.hashimoto</small></p>
  </footer>
</body>
</html>
