<?php
if(isset($_COOKIE['name'])){
}else{
  $msg="ログインしてください。<br>";
  $msg.="<a href='./login.html'>ログインする</a>";
  exit($msg);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="utf-8">
   <title>掲示板の追加</title>
   <link rel="stylesheet" href="styleIndex.css" type="text/css">
</head>
<body>
  <div id="title">
    <h1>新しい掲示板の作成</h1>
  </div>
  <div id="body">
      <div id="menu">
	<ul>
         <?php
	 if(is_file("./urlList.csv")){
	   if(is_readable("./urlList.csv")){
	     $fp=fopen("./urlList.csv","r");
	     flock($fp,LOCK_SH);
	     while(!feof($fp)){
	       $line=fgets($fp);
	       $content=explode(",",$line);
	       if(count($content)==2){
		 echo "<li><a href=\"$content[0]\">".$content[1]."</a></li>";
	       }
	     }
	   flock($fp,LOCK_UN);
	   fclose($fp);
	   }
	 else
	   echo "ファイルが開けません";
	 }
	?>
	</ul>
      </div><!-- menu -->
      <div id="content">
	以下の項目を入力してください<br>
	<form method ="POST"action="./board/createView.php">
	  <table>
	    <p>
	      <tr>
		<td><label>授業学年</label>:</td>
		<td>
		  <input type="radio" name="name" value="3"checked>３年<br>
		  <input type="radio" name="name" value="2">２年<br>
		  <input type="radio" name="name" value="1">１年<br>
		  <input type="radio" name="name" value="S">再履<br>
		</td>
	      </tr>
	      <tr>
		<td><label>授業名</label>:</td>
		<td><input type="text" name="class" required="required"></td><br>
	      </tr>
	    </p>
	  </table>
	  <input type="submit"value="送信">
      </div><!-- content //-->
  </div><!-- body //-->
   <footer>
     <p><small>&copy;| copyright 2017 nara     </small></p>
</footer>
  </form>
</body>
</html>
