<?php
header('Content-type:text/html; charset=utf-8');
    function random_name(){
    if(isset($_POST["name"])){
        if(strlen($_POST["name"])!=0){
	    if($_POST["name"]=="3"){
	        $name=mt_rand(300000,399999);
	    }else if($_POST["name"]=="2"){
	        $name=mt_rand(200000,299999);
	    }else if($_POST["name"]=="1"){
	        $name=mt_rand(100000,199999);
	    }else if($_POST["name"]=="S"){
	        $name=mt_rand(400000,499999);
	    }else{
		exit("error:".$_POST["name"]);
	    }
	}
    }
    return $name;
    }

    if(isset($_POST["class"])){
	$class=htmlspecialchars($_POST["class"]);

	//ファイルへの書き込み
	$name=random_name();
	
	if(file_exists("./".$name)){
	    //すでに同じ名前のディレクトリが存在
	    while(file_exists("./".$name)){
	    	$name=random_name();
	    }
	}else{
	    $dname=$name;
	    //ディレクトリ作成
	    if(mkdir($dname)){
		//ディレクトリのパーミッション変更
		chmod($dname,0777);
		if(copy("./view/view.php" , $dname."/view.php") &&
		   copy("./view/post.php" , $dname."/post.php") ){
		    //ファイルパーミッション変更
		    chmod($dname."/view.php",0755);
		    chmod($dname."/post.php",0755);
		    echo "ページ作成成功<br>";
		    $fname="http://medianet.inf.uec.ac.jp/~y1510153/board/".$dname."/view.php";
		    echo "<a href=\"$fname\">掲示板に行く</a>";

		    //作成したディレクトリの登録
		   $fp=fopen("./dirList.csv","a+");
		   flock($fp,LOCK_EX);
		   $line=$class.",".$dname.",".$fname."\n";
		   fputs($fp,$line);

		   flock($fp,LOCK_UN);
		   fclose($fp);
		 }
	    }else{
	        echo "ディレクトリ作成失敗<br>";
		echo "<a href=\"http://medianet.inf.uec.ac.jp/~y1510153/\">
		      トップページに戻る</a>";
	    }
	}
    }
?>
