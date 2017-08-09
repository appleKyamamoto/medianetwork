<?php
  //文字化け防止
header('Content-Type: text/html; charset=UTF-8');

$id=htmlspecialchars($_POST["id"]);
$pw=htmlspecialchars($_POST["pw"]);

$filename="./phpfile/list.csv";
$dest="./phpfile/secret.php";

if(strcmp($id,"") ==0||strcmp($pw,"")==0)
  exit("エラー:IDまたはPWが空白です.");

if(!file_exists($filename))
  exit("だれも登録していません");

$fp =fopen($filename,"r");
flock($fp,LOCK_EX);

$flag=false;

while($line=fgetcsv($fp))
  if(strcmp($line[0],$id)==0 && strcmp($line[1],hash("sha256",$pw))==0)
    {
      $flag=true;
      break;
    }

flock($fp,LOCK_UN);
fclose($fp);

if($flag)
  {
    //クッキー設定 有効期限10秒
    setcookie('name',$id,time()+10,"/~y1510153/");
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: $dest");
    exit;
  }
else
  exit("IDまたはパスワードが違います.");
?>
