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
		if(!isset($_SESSION['kodedokter'],$_SESSION['username'],$_SESSION['nama'],$_SESSION['email'],$_SESSION['password'])){
			die("Anda tidak berhak mengakses file ini!");
		}
	}else{
		die("Anda tidak berhak mengakses file ini!");
	}
	
	$id	= addslashes($_POST['id']);
	$nama	= addslashes($_POST['nama']);
	$aturan	= addslashes($_POST['aturan']);
	$submit	= addslashes($_POST['submit']);
	
	if($submit=='Tambah'){
		if(empty($id) or empty($nama) or empty($aturan)){
			echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$resep = mysql_query("INSERT INTO resep(id_diagnosis,nama_obat,aturan_pakai) VALUES('$id','$nama','$aturan')");
			if($resep){
				echo "$suksesInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=periksa&action=diagnosis&id=$id'>";
			}else{
				echo "$gagalInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=periksa'>";
			}
		}
	}else if($submit=='Ubah'){
		if(empty($id) or empty($nama) or empty($aturan)){
			echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$resep = mysql_query("SELECT * FROM resep WHERE id_resep='$id'");
			if(mysql_num_rows($resep)==1){
				$update = mysql_query("UPDATE resep SET nama_obat='$nama', aturan_pakai='$aturan' WHERE id_resep='$id'");
				if($update){
					$data = mysql_fetch_array($resep);
					echo "$suksesEdit<meta http-equiv='refresh' content='2;url=$linkHome/?act=periksa&action=diagnosis&id=$data[id_diagnosis]'>";
				}else{
					echo "$gagalEdit<meta http-equiv='refresh' content='2;url=$linkHome/?act=periksa'>";
				}
			}else{
				echo "$DNF<meta http-equiv='refresh' content='2;url=$linkHome/?act=periksa'>";
			}
			
		}
	}
	
?>