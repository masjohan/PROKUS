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
		die("file 'konek.php' tidak ditemukan!. Sistem APOTIKUIN tidak dapat dijalankan.");
	}
	$email = addslashes($_POST['email']);
	$pass = addslashes(sha1($_POST['pass']));
	$sbg = addslashes($_POST['sbg']);
	$login = addslashes($_POST['login']);
	if(isset($login)){
		if($sbg=='administrator'){
			$login = mysql_query("SELECT * FROM administrator WHERE email='$email' AND password='$pass'");
			$rows= mysql_num_rows($login);
			if($rows==1){
				$data = mysql_fetch_array($login);
				$_SESSION['login']		= true;
				$_SESSION['kodeadmin']	= $data['kode_administrator'];
				$_SESSION['username']	= $data['username'];
				$_SESSION['nama']		= $data['nama'];
				$_SESSION['email']		= $email;
				$_SESSION['password']	= $pass;
			}else{
				echo"$DNF";
			}
		}else if($sbg=='dokter'){
			$login = mysql_query("SELECT * FROM dokter WHERE email='$email' AND password='$pass'");
			$rows= mysql_num_rows($login);
			if($rows==1){
				$data = mysql_fetch_array($login);
				$_SESSION['login']		= true;
				$_SESSION['kodedokter']	= $data['kode_dokter'];
				$_SESSION['username']	= $data['username'];
				$_SESSION['nama']		= $data['nama'];
				$_SESSION['email']		= $email;
				$_SESSION['password']	= $pass;
			}else{
				echo"$DNF";
			}
			/*if(isset($_SESSION['kodedokter'],$_SESSION['username'],$_SESSION['nama'],$_SESSION['email'],$_SESSION['password']))
			 $_SESSION['login']=true;
			 $_SESSION['dokter']="Dokter";
			 $_SESSION['email']=$email;
			 $_SESSION['nama']="Admin";*/
		}
		echo "<meta http-equiv='refresh' content='2;url=../?act=home'>";
	}
?>