<?php

	if(!defined("apotikuin")){
		die("Anda tidak dapat mengakses file ini!");
	}

	if(file_exists('proses/cek_session_dokter.php')){
		include "proses/cek_session_dokter.php";
	}else if(file_exists('../proses/cek_session_dokter.php')){
		include "../proses/cek_session_dokter.php";
	}else if(file_exists('../../proses/cek_session_dokter.php')){
		include "../../proses/cek_session_dokter.php";
	}else if(file_exists('../../../proses/cek_session_dokter.php')){
		include "../../../proses/cek_session_dokter.php";
	}else{
		die("file 'cek_session_dokter.php' tidak ditemukan!. Sistem APOTIKUIN tidak dapat dijalankan.");
	}
?>
<div id="leftPan">
	<p><span>Selamat Datang Dokter</span></p><hr>
		<div id="label">
			<a href="<?php echo $linkHome."/?act=periksa";?>" title="Lihat Data Pasien"><img src="<?php echo $linkHome."/images/hdpi/user.png";?>"/></a>
		</div>
	<p class="bottompadding">&nbsp;</p>
</div>