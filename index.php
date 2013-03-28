<?php

	session_start();
	
	if(isset($_SESSION['login'])){
		if(isset($_SESSION['dokter'],$_SESSION['nama'],$_SESSION['email'])){
			$login = "dokter";
		}else if(isset($_SESSION['admin'],$_SESSION['nama'],$_SESSION['email'])){
			$login = "administrator";
		}else{
			$login = "belum";
		}
	}else{
		$login = "belum";
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>APOTIKUIN</title>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="mainPan">
  <div id="topPan">
  	<a href=""><img src="images/logo.gif" alt="Expart Vision" width="230" height="44" border="0" class="logo" /></a> 
		<ul>
			<li><a href="?act=home">Home</a></li>
			<?php
				if($login == "belum"){
					echo "<li><a href=\"?act=news\">Berita</a></li>
					<li><a href=\"?act=about\">About Us</a></li>
					<li><a href=\"?act=login\">Login</a></li>";
				}else if($login == "dokter"){
					echo "<li><a href=\"?act=periksa\">Pemeriksaan Pasien</a></li>
					<li><a href=\"?act=diagnosis\">Diagnosis Penyakit</a></li>
					<li><a href=\"?act=logout\">Logout</a></li>";
				}else if($login == "administrator"){
					echo "<li><a href=\"?act=pasien\">Data Pasien</a></li>
					<li><a href=\"?act=history\">History Pasien</a></li>
					<li><a href=\"?act=news\">Berita</a></li>
					<li><a href=\"?act=logout\">Logout</a></li>";
				}else{
					echo "<li><a href=\"?act=news\">Berita</a></li>
					<li><a href=\"?act=about\">About Us</a></li>
					<li><a href=\"?act=login\">Login</a></li>";
				}
			?>
			
		</ul>
  </div>
  <?php
	include"link.php";
  ?>
</div>

<div id="footermainPan">
	<div id="footerPan">
  <ul>
  	<li><a href="?act=home">Home </a>| </li>
  	<li><a href="?act=about">About Us</a> | </li>
  	<li><a href="?act=login">Login </a> </li>
  </ul>
  
  <ul class="info">
  	<li class="address">Copyright &copy; Universitas Islam Negeri (UIN) Sunan Kalijaga Yogyakarta</li>
	
    </ul>
  </div>
</div>
</body>
</html>
