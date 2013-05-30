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
	
	$judul = addslashes($_POST['judul']);
	$isi = addslashes($_POST['isi']);
	$tgl = addslashes(date("Y-m-d H:i:s"));
	$submit = addslashes($_POST['submit']);
	
	if($submit){
		if(empty($judul)or empty($isi)){
			echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$berita = mysql_query("SELECT MAX(id_berita) as no FROM berita");
			$no = mysql_fetch_array($berita);
			$id = $no['no']+1;
			$admin = mysql_query("SELECT * FROM administrator WHERE kode_administrator='$_SESSION[kodeadmin]' and username='$_SESSION[username]' and email='$_SESSION[email]'");
			$row = mysql_num_rows($admin);
			if($row==1){
				$data = mysql_fetch_array($admin);
				$insert = mysql_query("INSERT INTO berita(id_berita,id_administrator,judul_berita,isi_berita,tanggal_posting)
				VALUES('$id','$data[id_administrator]','$judul','$isi','$tgl')");
				if($insert){
					echo "$suksesInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
				}else{
					echo "$gagalInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
				}
			}else{
				echo "$DNF<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}
		}
	}
	
?>