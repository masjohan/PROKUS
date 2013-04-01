<?php

	$host 	= "localhost";
	$user 	= "root";
	$pass 	= "";
	$db		= "apotik";

	$konek = mysql_connect($host,$user,$pass);
	if($konek){
		$selectDb = mysql_select_db($db,$konek);
		if(!$selectDb){
			echo "Database '$db' tidak ditemukan!";
		}
	}else{
		echo"Koneksi keserver gagal!. Sistem tidak dapat dijalankan.";
	}
	
	//============ kumpulan Alert ==========
	
	// Data Not Found
	$DNF ="<script>alert('Data tidak ditemukan');</script>";
	
?>