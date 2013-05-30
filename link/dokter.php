<?php

	if(!isset($_GET['act'])){
		include"admin/dokter.php";
	}else if($_GET['act']=='home'){
		include"admin/dokter.php";
	}else if($_GET['act']=='periksa'){//link lain buat user=>dokter
		//include"admin/news.php";
		include "admin/dokter_periksa.php";
	}else if($_GET['act']=='logout'){
		include"proses/logout.php";
	}else{
		include"admin/dokter.php";
	}

?>