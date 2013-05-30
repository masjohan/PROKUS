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
	
	$id		= addslashes($_POST['id']);
	$kode	= addslashes($_POST['kode']);
	$user	= addslashes($_POST['username']);
	$nama	= addslashes($_POST['nama']);
	$email = addslashes($_POST['email']);
	$submit	= addslashes($_POST['submit']);
	
	if($submit){
		if(empty($nama)or empty($email)or empty($id)or empty($kode) or empty($user)){
			echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$dokter = mysql_query("SELECT * FROM dokter WHERE id_dokter='$id' AND kode_dokter='$kode' AND username='$user'");
			$row = mysql_num_rows($dokter);
			if($row==1){
				$update = mysql_query("UPDATE dokter SET nama='$nama', email='$email' WHERE id_dokter='$id' AND kode_dokter='$kode' AND username='$user'");
				if($update){
					echo "$suksesEdit<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
				}else{
					echo "$gagalEdit<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
				}
			}else{
				echo "$DNF<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}
		}
	}
	
?>