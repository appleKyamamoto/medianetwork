<html>
  <head>
    <meta charset="utf-8">
    <title>課題トップページ</title>
    <link rel="stylesheet" href="styleIndex.css" type="text/css">
  </head>
  <body>
    <div id="title">
      <h1>ようこそ講義掲示板へ!</h1>
    </div>
<!--    <div id="control">
      <form action"./phpfile/login.php" method="POST">
	<table border ="0">
	  <tr><td>管理者画面:PW</td>
	    <td><input type="text" name="pw"></td>
	    <td><input type="submit" value="送信"></td>
	  <tr>
	</table>
      </form>
    </div> --> <!-- control -->

    <hr>
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
	<h1>最初に</h1>
	<div id="news">
	  <h3 style="color: #ff0000;">News</h3>
	    なし<br>
	</div> <!-- news --> 
	<div id="notice">
	  <h3 style="color: #ff0000;">注意事項</h3>
	   マナーを守って使いましょう<br>
	   誹謗中傷厳禁！<br>
	   掲示板を作るにはログインしてね！<br>
	</div><!-- notice -->
      </div><!-- content -->
    </div><!-- body -->
    <p>
      <footer>
	<p><small>&copy: copyright 2017- k.yamamoto</small></p>
      </footer>
    </p>
  </body>
</html>
