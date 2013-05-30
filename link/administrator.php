<?php

	if(!defined("apotikuin")){
		die("Anda tidak dapat mengakses file ini!");
	}

	if(!isset($_GET['act'])){
		include"admin/administrator.php";
	}else if($_GET['act']=='home'){
		include"admin/administrator.php";
	}else if($_GET['act']=='news'){
		include"admin/news.php";
	}else if($_GET['act']=='pasien'){
		include"admin/admin_pasien.php";
	}else if($_GET['act']=='dokter'){
		include"admin/admin_dokter.php";
	}else if($_GET['act']=='logout'){
		include"proses/logout.php";
	}else{
		include"admin/administrator.php";
	}

?>