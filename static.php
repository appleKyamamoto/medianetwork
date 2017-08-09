<?php
function logread($fname){
  //ファイル読み込み(＋確認)
  $cnt=0;
  if(is_file($fname)){
      if(is_readable($fname)){
	$fp=fopen($fname,"r");
	flock($fp,LOCK_SH);
	while($csvline=fgets($fp)){
	  $data=explode(",",trim($csvline,"\n"));
	  if(count($data)==3){
	    $cnt++;
	  }
	}
	flock($fp,LOCK_UN);
	return $cnt;
      }
    }
  }

function cntyear($x){
  $dirnames=glob("board/".$x."*");
  $cnt=0;
  for($i=count($dirnames)-1;$i>=0;$i--){
    $line=$dirnames[$i];
    $cnt+=logread($line."/log.csv");
  }
  return $cnt;
}

    //集計用変数初期化
    $cnt["s1"]=cntyear("1");//１年
    $cnt["s2"]=cntyear("2");//２年
    $cnt["s3"]=cntyear("3");//３年
    $cnt["s4"]=cntyear("4");//再履
    //割合変数初期化
    $per["s1"]=0;
    $per["s2"]=0;
    $per["s3"]=0;
    $per["s4"]=0;
    if(($cnt["s1"]+$cnt["s2"]+$cnt["s3"]+$cnt["s4"])!=0){
    $per["s1"]=$cnt["s1"]/($cnt["s1"]+$cnt["s2"]+$cnt["s3"]+$cnt["s4"])*100;
    $per["s2"]=$cnt["s2"]/($cnt["s1"]+$cnt["s2"]+$cnt["s3"]+$cnt["s4"])*100;
    $per["s3"]=$cnt["s3"]/($cnt["s1"]+$cnt["s2"]+$cnt["s3"]+$cnt["s4"])*100;
    $per["s4"]=$cnt["s4"]/($cnt["s1"]+$cnt["s2"]+$cnt["s3"]+$cnt["s4"])*100;
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>アンケート結果</title>
    <link rel="stylesheet" href="phpfile/stylePhp.css" type="text/css">
    <!--[if IE]><script type="text/javascript" src="../html5jp/excanvas/excanvas.js">
    </script><![endif]-->
    <script type="text/javascript" src="./html5jp/graph/circle.js"></script>
    <script type="text/javascript">
    window.onload=function(){
    var cg=new html5jp.graph.circle("sample");
    if(!cg){return;}
    var items=[
	       ["３年",<?php echo $cnt["s3"]?>],
	       ["２年",<?php echo $cnt["s2"]?>],
	       ["１年",<?php echo $cnt["s1"]?>],
	       ["再履",<?php echo $cnt["s4"]?>]
	       ];
    cg.draw(items);
    };
    </script>
  </head>
<body>
<header>
<div id="title">
<h1>投稿数結果</h1>
</div>
</header>
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
   現時点での学年別投稿数結果です.
   <p>
   <table >
     <tr>
       <td>学年</td><td投稿数</td><td>割合</td>
     </tr><tr>
       <td>３年</td><td><?php echo $cnt["s1"]?></td>
       <td><?php echo round($per["s3"],1)?>%</td>
     </tr><tr>
       <td>２年</td><td><?php echo $cnt["s2"]?></td>
       <td><?php echo round($per["s2"],1)?>%</td>
     </tr><tr>
       <td>１年</td><td><?php echo $cnt["s3"]?></td>
       <td><?php echo round($per["s1"],1)?>%</td>
     </tr><tr>
       <td>再履</td><td><?php echo $cnt["s4"]?></td>
       <td><?php echo round($per["s4"],1)?>%</td>
     </tr>
   </table>
   </p>
     <div id="graph"><canvas width="450"height="300"id="sample"></canvas></div>
    </div> <!-- notice//--> 
    </div> <!-- body //-->
    <footer>
    <p><small>&copy; copyright 2017 k.yamamoto</small></p>
    </footer>
    </body>
</html>
