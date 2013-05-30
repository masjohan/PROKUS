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
	
	$nama = addslashes($_POST['nama']);
	$jk = addslashes($_POST['jk']);
	$alamat = addslashes($_POST['alamat']);
	$submit = addslashes($_POST['submit']);
	
	if($submit){
		if(empty($nama)or empty($jk) or empty($alamat)){
			echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$pasien = mysql_query("SELECT MAX(id_pasien) as no FROM pasien");
			$no = mysql_fetch_array($pasien);
			$id = $no['no']+1;
			if(strlen($id)==1){
				$kode = "APKUIN000$id";
			}else if(strlen($id)==2){
				$kode = "APKUIN00$id";
			}else if(strlen($id)==3){
				$kode = "APKUIN0$id";
			}else if(strlen($id)==4){
				$kode = "APKUIN$id";
			}else{
				$kode = "";
			}
			$username =preg_replace("/\s/","",strtolower($nama));
			$query = mysql_query("SELECT * FROM pasien WHERE username='$username'");
			$row = mysql_num_rows($query);
			if($row==0){
				$user = $username;
			}else{
				$user = $username.$id;
			}
			
			$insert = mysql_query("INSERT INTO pasien(id_pasien,kode_pasien,username,nama,jk,alamat)
			VALUES('$id','$kode','$user','$nama','$jk','$alamat')");
			if($insert){
				echo "$suksesInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}else{
				echo "$gagalInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}
		}
	}
	
?>