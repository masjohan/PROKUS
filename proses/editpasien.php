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
	
	$nama	= addslashes($_POST['nama']);
	$jk		= addslashes($_POST['jk']);
	$alamat = addslashes($_POST['alamat']);
	$submit	= addslashes($_POST['submit']);
	$id		= addslashes($_POST['id']);
	$kode	= addslashes($_POST['kode']);
	$user	= addslashes($_POST['username']);
	
	if($submit){
		if(empty($nama)or empty($jk) or empty($alamat)or empty($id)or empty($kode) or empty($user)){
			echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$pasien = mysql_query("SELECT * FROM pasien WHERE id_pasien='$id' AND kode_pasien='$kode' AND username='$user'");
			$row = mysql_num_rows($pasien);
			if($row==1){
				$update = mysql_query("UPDATE pasien SET nama='$nama', jk='$jk', alamat='$alamat' WHERE id_pasien='$id' AND kode_pasien='$kode' AND username='$user'");
				if($update){
					echo "$suksesEdit<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
				}else{
					echo "$gagalEdit<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
				}
			}else{
				echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}
		}
	}
	
?>