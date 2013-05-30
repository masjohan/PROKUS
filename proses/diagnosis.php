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
	$kode	= addslashes($_SESSION['kodedokter']);
	$diag	= addslashes($_POST['diagnosis']);
	$date = date('Y-m-d');
	$submit	= addslashes($_POST['submit']);
	$status		= addslashes('sudah');
	
	if($submit){
		if(empty($id) or empty($kode) or empty($diag) or empty($date) or empty($status)){
			echo "$NotEmpty<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$dokter = mysql_query("SELECT * FROM dokter WHERE kode_dokter='$kode'");
			$row = mysql_num_rows($dokter);
			if($row==1){
				$data=mysql_fetch_array($dokter);
				$diagnosis = mysql_query("INSERT INTO diagnosis(id_periksa,id_dokter,tanggal,diagnosis)
										VALUES('$id','$data[id_dokter]','$date','$diag')");
				if($diagnosis){
					$update = mysql_query("UPDATE periksa SET status='$status' WHERE id_periksa='$id'");
					if($update){
					echo "$suksesInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
					}else{
						$delete = mysql_query("DELETE FROM diagnosis WHERE id_periksa='$id'");
						echo "$gagalInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
					}
				}else{
					echo "$gagalInput<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
				}
			}else{
				echo "$DNF<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}
		}
	}
	
?>