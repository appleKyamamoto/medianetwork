<?php
    $myname=str_replace("/~y1510153/board/","",dirname($_SERVER["SCRIPT_NAME"]));
    if(is_file("../dirList.csv")){
	if(is_readable("../dirList.csv")){
	$fp=fopen("../dirList.csv","r");
	flock($fp,LOCK_SH);
	while(!feof($fp)){
	    $line=fgets($fp);
	    $content=explode(",",$line);
	    if(count($content)==3){
		if($myname==$content[1]){
			$class=$content[0];
		}
	    }
	}
	flock($fp,LOCK_UN);
	fclose($fp);
	}
    }
?>

<!DOCTYPE html>
<html lang=ja>
<head>
  <meta charset="utf-8">
  <title>掲示板</title>
  <title>アンケートフォーム</title>
  <link rel="stylesheet" href="../stylePhp.css" type="text/css">
</head>
<body>
  <header>
  <h1><?php echo $class; ?></h1>
  </header>
  <hr>
  <div id="body">
      <div id="menu">
	<ul>
      <?php
	 if(is_file("../../urlList.csv")){
	   if(is_readable("../../urlList.csv")){
	     $fp=fopen("../../urlList.csv","r");
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
   <p>
   <h3>投稿フォーム</h3>
   <form method ="POST" action="./post.php">
   名前<br><input type="text" name="name"><br>
   投稿内容<br>
   <textarea name ="content" size=50></textarea><br>
   <input type="submit" value="投稿">
   </form>
   </p>
   <hr>
   <?php
   if(is_file("./log.csv")){
     if(is_readable("./log.csv")){
       $fp=fopen("./log.csv","r");
       flock($fp,LOCK_SH);
       $contents=array();
       
       while(!feof($fp)){
	 $line=fgets($fp);
	 $content=explode(",",$line);
	 array_push($contents,$content);
       }
       for($i=count($contents)-1;$i>=0;$i--){
	 $content=$contents[$i];
	 if(count($content)==3){
	   $content[2]=preg_replace("[<bgq>]",",",$content[2]);
	   echo "<p>".($i+1);
	   echo ":<strong>名前:".$content[0]."</strong> ";
	   echo "投稿日時:<time>".$content[1]."</time><br>".$content[2]."</p>\n";
	   echo "<hr>\n";
	 }
       }
       
       flock($fp,LOCK_UN);
       fclose($fp);
     }
     else
       echo "ファイルが開けません";
   }
   else
     echo "だれも投稿していません";
   ?>
     </div><!-- content //-->
   </div><!-- body //-->
   <footer>
     <p><small>&copy;| copyright 2017 K.yamamoto </small></p>
</footer>
</body>
</html>
