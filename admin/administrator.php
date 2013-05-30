<?php

	if(!defined("apotikuin")){
		die("Anda tidak dapat mengakses file ini!");
	}

	if(file_exists('proses/cek_session_administrator.php')){
		include "proses/cek_session_administrator.php";
	}else if(file_exists('../proses/cek_session_administrator.php')){
		include "../proses/cek_session_administrator.php";
	}else if(file_exists('../../proses/cek_session_administrator.php')){
		include "../../proses/cek_session_administrator.php";
	}else if(file_exists('../../../proses/cek_session_administrator.php')){
		include "../../../proses/cek_session_administrator.php";
	}else{
		die("file 'cek_session_administrator.php' tidak ditemukan!. Sistem APOTIKUIN tidak dapat dijalankan.");
	}
?>
<div id="leftPan">
	<p><span>Selamat Datang Administrator</span></p><hr>
		<div id="label" title="Pasien">
			<a href="<?php echo $linkHome."/?act=pasien";?>" title="Lihat Data Pasien"><img src="<?php echo $linkHome."/images/hdpi/user.png";?>"/></a>
			<a href="<?php echo $linkHome."/?act=pasien&action=add";?>" title="Tambah Data Pasien"><img src="<?php echo $linkHome."/images/hdpi/add_user.png";?>"/></a>
			<a href="<?php echo $linkHome."/?act=pasien";?>" title="Histori Pasien"><img src="<?php echo $linkHome."/images/hdpi/history.png";?>"/></a>
		</div>
		<br><br>
		<div id="label" title="Dokter">
			<a href="<?php echo $linkHome."/?act=dokter";?>" title="Lihat Data Dokter"><img src="<?php echo $linkHome."/images/hdpi/user.png";?>"/></a>
			<a href="<?php echo $linkHome."/?act=dokter&action=add";?>" title="Tambah Data Dokter"><img src="<?php echo $linkHome."/images/hdpi/add_user.png";?>"/></a>
			<a href="<?php echo $linkHome."/?act=dokter";?>" title="Histori Praktek Dokter"><img src="<?php echo $linkHome."/images/hdpi/history.png";?>"/></a>
		</div>
		<br><br>
		<div id="label" title="News">
			<a href="<?php echo $linkHome."/?act=news&action=add";?>" title="Tambah Data Berita"><img src="<?php echo $linkHome."/images/hdpi/add_news.png";?>"/></a>
			<a href="<?php echo $linkHome."/?act=news";?>" title="Lihat Data Berita"><img src="<?php echo $linkHome."/images/hdpi/history.png";?>"/></a>
		</div>
	<p class="bottompadding">&nbsp;</p>
</div>