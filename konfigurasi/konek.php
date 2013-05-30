<?php

	$host 	= "localhost";
	$user 	= "root";
	$pass 	= "";
	$db		= "apotik";

	$konek = mysql_connect($host,$user,$pass);
	if($konek){
		$selectDb = mysql_select_db($db,$konek);
		if(!$selectDb){
			echo "Database '$db' tidak ditemukan!";
		}
	}else{
		echo"Koneksi keserver gagal!. Sistem tidak dapat dijalankan.";
	}
	
	//Link website
	$linkHome="http://localhost/PROKUS/PROKUS";
	
	//============ kumpulan Alert ==========
	
	// Data Not Found
	$DNF ="<script>alert('Data tidak ditemukan');</script>";
	
	// Authotentifikasi
	$Autho ="<script>alert('Anda Tidak berhak mengakses File ini!');</script>";
	
	// Form Not Empty
	$NotEmpty ="<script>alert('Harap isi semua Form yang ada!');</script>";
	
	// Sukses input data
	$suksesInput ="<script>alert('Data berhasil dimasukan');</script>";
	
	// gagal input data
	$gagalInput ="<script>alert('Data gagal dimasukan');</script>";
	
	// sukses edit data
	$suksesEdit ="<script>alert('Data berhasil diedit');</script>";
	
	// gagal edit data
	$gagalEdit ="<script>alert('Data gagal diedit');</script>";
	
	// sukses edit data
	$suksesHapus ="<script>alert('Data berhasil dihapus');</script>";
	
	// gagal edit data
	$gagalHapus ="<script>alert('Data gagal dihapus');</script>";
	
?>