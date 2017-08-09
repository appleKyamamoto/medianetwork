<?php
function show_all($ar){
  if(isset($ar[0])){
    for($i=0;$i<floor(count($ar)/2);$i++){
      echo "<a href=\"".$ar[$i*2+1]."\">".$ar[$i*2]."</a><br>";
    }
  }else{
    echo "掲示板はありません";
  } 
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>掲示板一覧</title>
    <link rel="stylesheet" href="styleIndex.css" type="text/css">
  </head>
  <body>
    <div id="title">
      <h1>現在の掲示板一覧</h1>
    </div>
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
	<?php
	  $th=array(); $se=array(); $fi=array(); $sa=array();
	  if(is_file("./board/dirList.csv")){
		if(is_readable("./board/dirList.csv")){
		  $fp=fopen("./board/dirList.csv","r");
		  flock($fp,LOCK_SH); 
		  while(!feof($fp)){
		    $line=fgets($fp);
		    $content=explode(",",$line);
		    if(count($content)==3){
			switch(floor(intval($content[1])/100000)){
			  case 3:
			    array_push($th,$content[0],$content[2]);  break;
			  case 2:
			    array_push($se,$content[0],$content[2]); break;
			  case 1:
			    array_push($fi,$content[0],$content[2]); break;
			  case 4: 
			    array_push($sa,$content[0],$content[2]); break;
			}
			
		    }
		  }
		  flock($fp,LOCK_UN);
		  fclose($fp);
		}else{ echo "ファイルが読み込めません";} 
	  }
	?>
	<div id="boardList">
	<table boader=1>
	  <tr><td>3年</td><td>2年</td><td>1年</td><td>再履</td></tr>
	  <tr><td>
	    <?php show_all($th);?>
	  </td><td>
	    <?php show_all($se);?>
	  </td><td>
	    <?php show_all($fi);?>
	  </td><td>
	    <?php show_all($sa);?>
	  </td></tr>
	</table>
	</div>
      </div><!-- content -->
    </div><!-- body -->
    <p>
      <footer>
	<p><small>&copy: copyright 2017- k.yamamoto</small></p>
      </footer>
    </p>
  </body>
</html>
