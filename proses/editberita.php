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
	$judul = addslashes($_POST['judul']);
	$isi = addslashes($_POST['isi']);
	$tgl = addslashes(date("Y-m-d H:i:s"));
	$submit	= addslashes($_POST['submit']);
	
	if($submit){
		if(empty($id)or empty($judul)or empty($isi)or empty($tgl)){
			echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$berita = mysql_query("SELECT * FROM berita WHERE id_berita='$id'");
			$row = mysql_num_rows($berita);
			if($row==1){
				$update = mysql_query("UPDATE berita SET judul_berita='$judul', isi_berita='$isi', tanggal_posting='$tgl' WHERE id_berita='$id'");
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