<?php
	session_start();
	$email = addslashes($_POST['email']);
	$pass = addslashes($_POST['pass']);
	$sbg = addslashes($_POST['sbg']);
	$login = addslashes($_POST['login']);
	if(isset($login)){
		if($sbg=='administrator'){
			//isset($_SESSION['login'],$_SESSION['admin'],$_SESSION['email'],$_SESSION['nama']);
			 $_SESSION['login'] = true;
			//$_SESSION['email'] = $a['email'];
			 $_SESSION['admin']="Admin";
			 $_SESSION['email']=$email;
			 $_SESSION['nama']="Admin";
		}else if($sbg=='dokter'){
			//isset($_SESSION['login'],$_SESSION['dokter'],$_SESSION['email'],$_SESSION['nama']);
			 $_SESSION['login']=true;
			 $_SESSION['dokter']="Dokter";
			 $_SESSION['email']=$email;
			 $_SESSION['nama']="Admin";
		}
		echo "Loading... Redirect<br><meta http-equiv='refresh' content='2;url=../index.php'>";
	}
?>