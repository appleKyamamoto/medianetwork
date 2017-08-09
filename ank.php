<!DOCTYPE html>
<html lang="ja">
<head.
   <meta charset="utf-8">
   <title>アンケートフォーム</title>
   <link rel="stylesheet" href="styleIndex.css" type="text/css">
</head>
<body>
  <div id="title">
    <h1>アンケートフォーム</h1>
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
	<form method ="POST"action="./phpfile/enq.php">
	  <table>
	    <p>
	      <tr>
		<td><label>このサイトの使いやすさ</label>:</td>
		<td>
		  <input type="radio" name="eval" value="S"checked>とても使いやすい<br>
		  <input type="radio" name="eval" value="A">使いやすい<br>
		  <input type="radio" name="eval" value="B">普通<br>
		  <input type="radio" name="eval" value="C">使いにくい<br>
		  <input type="radio" name="eval" value="D">とても使いにくい<br>
		</td>
	      </tr>
	    </p>
	  </table>
	  <input type="submit"value="送信"><br><br><br>
	<img src="./thank.jpeg" width="500px" height="400px" alt="thank you!">
      </div><!-- content //-->
  </div><!-- body //-->
   <footer>
     <p><small>&copy;| copyright 2017 nara     </small></p>
</footer>
  </form>
</body>
</html>
