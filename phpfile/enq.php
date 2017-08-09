<?php
if(strlen($_POST["eval"])!=0){
  $eval=$_POST["eval"];
  //ファイルへのの書き込み
  $fp=fopen("./result.csv","a+");
  flock($fp,LOCK_EX);
  $output=join(",",array($eval))."\n";
  fputs($fp,$output);
  flock($fp,LOCK_UN);
  fclose($fp);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>アンケート受付完了</title>
    </head>
    <body background="../LemonMint.jpg">
    <?php if(strlen($_POST["eval"])!=0): ?>
   <header>
      <h1>回答ありがとうございました</h1>
      回答内容は以下の通りです.
      </header>
      <p>
      評価内容:
      <?php switch($eval){
    case "S": ?> とても使いやすい
    <?php break;
    case "A": ?> 使いやすい
    <?php break;
    case "B": ?> 普通
    <?php break;
    case "C": ?> 使いづらい
    <?php break;
    case "E": ?> とても使いづらい
    <?php break; }?>
      </p>
      
      <p>
      <a href="../index.php" target="_self">トップぺージに戻る</a>
      </p>
      <?php else: ?>
      <p>アンケート入力が不備のようです<br>アンケート入力画面に戻って再入力をお願いします。</p>
	 <?php endif; ?>
<footer
<p><small>&copy; copyright 2017 K.yamamoto</small></p>
				      </footer>
				      </body>
				      </html>
