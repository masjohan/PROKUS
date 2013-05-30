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
	$email = addslashes($_POST['email']);
	$pass = addslashes(sha1($_POST['email']));
	$submit = addslashes($_POST['submit']);
	
	if($submit){
		if(empty($nama)or empty($email)or empty($pass)){
			echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$pasien = mysql_query("SELECT MAX(id_dokter) as no FROM dokter");
			$no = mysql_fetch_array($pasien);
			$id = $no['no']+1;
			if(strlen($id)==1){
				$kode = "DTR000$id";
			}else if(strlen($id)==2){
				$kode = "DTR00$id";
			}else if(strlen($id)==3){
				$kode = "DTR0$id";
			}else if(strlen($id)==4){
				$kode = "DTR$id";
			}else{
				$kode = "";
			}
			$username =preg_replace("/\s/","",strtolower($nama));
			$query = mysql_query("SELECT * FROM dokter WHERE username='$username'");
			$row = mysql_num_rows($query);
			if($row==0){
				$user = $username;
			}else{
				$user = $username.$id;
			}
			
			$insert = mysql_query("INSERT INTO dokter(id_dokter,kode_dokter,username,nama,email,password)
			VALUES('$id','$kode','$user','$nama','$email','$pass')");
			if($insert){
				echo "$suksesInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}else{
				echo "$gagalInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}
		}
	}
	
?>