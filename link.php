<?php

	if(!isset($_GET['act'])){
		include"contents/content.php";
	}else if($_GET['act']=='home'){
		include"contents/content.php";
	}else if($_GET['act']=='news'){
		include"contents/news.php";
	}else if($_GET['act']=='about'){
		include"contents/about.php";
	}else if($_GET['act']=='login'){
		include"contents/login.php";
	}else if($_GET['act']=='logout'){
		include"proses/logout.php";
	}else{
		include"contents/content.php";
	}

?>