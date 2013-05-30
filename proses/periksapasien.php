<?php
	session_start();
	if(file_exists('konfigurasi/konek.php')){
		include "konfigurasi/konek.php";
	}else if(file_exists('../konfigurasi/konek.php')){
		include "../konfigurasi/konek.php";
	}else if(file_exists('../../konfigurasi/konek.php')){
		include "../../konfigurasi/konek.php";
	}else if(file_exists('../../../konfigurasi/konek.php')){
		include "../../../konfigurasi/konek.php";
	}else{
		die("Beberapa file tidak ditemukan!. Sistem APOTIKUIN tidak dapat dijalankan.");
	}
	
	if(isset($_SESSION['login'])){
		if(isset($_SESSION['kodeadmin'],$_SESSION['username'],$_SESSION['nama'],$_SESSION['email'],$_SESSION['password'])){
			//$login = "administrator";
		}else{
			die("Anda tidak berhak mengakses file ini!");
		}
	}else{
		die("Anda tidak berhak mengakses file ini!");
	}
	
	$id	= addslashes($_POST['id']);
	$kode	= addslashes($_POST['kode']);
	$username	= addslashes($_POST['username']);
	$keluhan		= addslashes($_POST['keluhan']);
	$date = date('Y-m-d');
	$submit	= addslashes($_POST['submit']);
	$status		= addslashes('belum');
	
	if($submit){
		if(empty($id) or empty($kode) or empty($username) or empty($keluhan) or empty($date) or empty($status)){
			echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$pasien = mysql_query("SELECT * FROM pasien WHERE id_pasien='$id' AND kode_pasien='$kode' AND username='$username'");
			$row = mysql_num_rows($pasien);
			if($row==1){
				$periksa = mysql_query("INSERT INTO periksa(id_pasien,tanggal_periksa,keluhan,status)
										VALUES('$id','$date','$keluhan','$status')");
				if($periksa){
					echo "$suksesInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
				}else{
					echo "$gagalInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
				}
			}else{
				echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}
		}
	}
	
?>