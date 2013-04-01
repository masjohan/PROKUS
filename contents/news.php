<?php
	if(!isset($_GET['id'])){

?>
<div id="leftPan">
	<p><span>Berita terbaru</span></p><hr>
	<?php
		$batas = 25;
		if(!isset($_GET['page'])){
			$start=0;
		}else{
			$page =addslashes($_GET['page']);
			if(is_numeric($page)){
				if(!empty($page)){
					$hal=$page-1;
					$start = $batas * $hal;
				}else if(!empty($page) and $page==1){
					$start=0;
				}else if(empty($page)){
					$start=0;
				}
			}else{
				$start =0;
			}
		}
		$news = mysql_query("SELECT * FROM berita ORDER BY tanggal_posting DESC LIMIT $start,$batas");
		while($data = mysql_fetch_array($news)){
			echo"<a href=\"?act=news&id=$data[id_berita]\">&raquo; $data[judul_berita] &raquo; Datepost ($data[tanggal_posting])</a></br>";
		}
		$cekquery=mysql_query("SELECT * FROM berita ORDER BY tanggal_posting DESC");
		$jumlah=mysql_num_rows($cekquery);
		if($jumlah > $batas){
			echo '<div class="halaman">';
			$a=explode(".", $jumlah/$batas);
			$b=$a[0]; $c=$b+1;
			for($i=1;$i<=$c;$i++){
				echo "<div><a href='?act=news&page=$i'>$i</a></div>";
			}
			echo'</div>';
		}
	?>
	</p>
	<p class="bottompadding">&nbsp;</p>
  </div>
  
  <div id="bodyrightPan">
  	<h2>Selamat Datang</h2>
	<p>APOTIKUIN-Online</p>
  </div>
<?php
	}else{
		$id= addslashes($_GET['id']);
		$news=mysql_query("SELECT * FROM berita WHERE id_berita='$id'");
		$rows=mysql_num_rows($news);
		if($rows==1){
			$data=mysql_fetch_array($news);
			echo"<div id=\"leftPan\"><p><span>$data[judul_berita]</span></p>";
			echo"<p>$data[isi_berita]</p>
			<div id=\"bodyleftlinkboxonePan\">
				<ul><li class=\"datepost\">Datepost<span class=\"boldtext\">: $data[tanggal_posting]</span></li></ul>
			</div>
			<div id=\"hr\"></div>
			<p class=\"bottompadding\">&nbsp;</p></div>";
			//<div id=\"bodyrightPan\"><h2>Selamat Datang</h2><p>APOTIKUIN-Online</p></div>";
		}else{
			echo "$DNF<meta http-equiv='refresh' content='2;url=?act=news'>";
		}
	}
?>