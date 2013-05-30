<?php

	if(!defined("apotikuin")){
		die("Anda tidak dapat mengakses file ini!");
	}

	if(isset($_SESSION['login'])){
		if(isset($_SESSION['kodedokter'],$_SESSION['username'],$_SESSION['nama'],$_SESSION['email'],$_SESSION['password'])){
			//return true;
		}else{
			session_destroy();
			echo "$Autho<meta http-equiv='refresh' content='2;url=?act=home'>";
		}
	}else{
		session_destroy();
		echo "$Autho<meta http-equiv='refresh' content='2;url=?act=home'>";
	}

?>