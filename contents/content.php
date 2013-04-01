  <div id="leftPan">
	<?php
		$batas = 5;
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
			echo"<p><span>$data[judul_berita]</span></p>";
			if(strlen($data['isi_berita'])>=150){
				$ket=nl2br($data['isi_berita']);
				$k=substr($ket,0,150);
				$k=substr($ket,0,strrpos($k," "));
			}else{
				$k = $data['isi_berita'];
			}
			echo"<p>$k</p>
			<div id=\"bodyleftlinkboxonePan\">
				<ul><li class=\"datepost\">Datepost<span class=\"boldtext\">: $data[tanggal_posting]</span></li>
					<li class=\"continue\"><a href=\"?act=news&id=$data[id_berita]\">Continue reading....</a></li></ul>
			</div>
			<div id=\"hr\"></div>";
		}
		
		$cekquery=mysql_query("SELECT * FROM berita ORDER BY tanggal_posting DESC");
		$jumlah=mysql_num_rows($cekquery);
		if($jumlah > $batas){
			echo '<div class="halaman">';
			$a=explode(".", $jumlah/$batas);
			$b=$a[0]; $c=$b+1;
			for($i=1;$i<=$c;$i++){
				echo "<div><a href='?act=home&page=$i'>$i</a></div>";
			}
			echo'</div>';
		}
	?>
	
	<p class="bottompadding">&nbsp;</p>
  </div>
  
  <div id="bodyrightPan">
  	<h2>Selamat Datang</h2>
	<p>APOTIKUIN-Online</p>
  </div>