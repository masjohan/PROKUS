<?php

	if(!defined("apotikuin")){
		die("Anda tidak dapat mengakses file ini!");
	}

	if(!isset($_GET['action'])){
		?>
		<div id="leftPan">
			<p><span>Data Berita</span></p><hr>
				<table style="width:100%;border:1px solid #ccc;">
					<tr>
						<th style="width:20%;background:#ccb;">Tanggal Posting</th>
						<th style="width:30%;background:#ccb;">Judul Berita</th>
						<th style="width:15%;background:#ccb;">Action</th>
					</tr>
					<?php
						$dokter = mysql_query("SELECT * FROM berita ORDER BY tanggal_posting DESC");
						$no=1;
						while($data = mysql_fetch_array($dokter)){
							if($no%2==0){ echo"<tr>"; }else{ echo"<tr style=\"background:#ccc;\">"; }
							echo "<td>$data[tanggal_posting]</td>
								<td>$data[judul_berita]</td>
								<td style=\"text-align:center\">
								<a href=\"$linkHome/?act=news&action=edit&id=$data[id_berita]\" title=\"Edit Data Berita\"><img src=\"$linkHome/images/mdpi/edit.png\"></img></a>
								<a href=\"$linkHome/?act=news&action=hapus&id=$data[id_berita]\" title=\"Hapus Data Berita\" onClick=\"return confirm('Yakin akan menghapus data ini?');\"><img src=\"$linkHome/images/mdpi/delete.png\"></img></a></td>
							</tr>";
							$no++;
						}
					?>
				</table>
			<p class="bottompadding">&nbsp;</p>
		</div>
		<?php
	}else if($_GET['action']=='add'){
		?>
		<div id="leftPan">
			<p><span>Berita</span></p><hr>
				<form method="post" action="<?php echo $linkHome."/proses/addnews.php";?>">
					<div id="centerform">
						<div class="centerform">
						<div class="divtext"><input type="text" name="judul" class="inputtext" placeholder="Judul Berita"></div><br>
						<div class="divtext"><textarea type="text" name="isi" class="inputtext" placeholder="isi berita"></textarea></div><br>
						<div><input type="submit" name="submit" value="Simpan" class="button"></div>
						</div>
					</div>
				</form>
			<p class="bottompadding">&nbsp;</p>
		</div>
		<?php
	}else if($_GET['action']=='edit'){
		if(!isset($_GET['id'])){
				echo "<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$id = addslashes($_GET['id']);
			$berita = mysql_query("SELECT * FROM berita WHERE id_berita='$id'");
			$row = mysql_num_rows($berita);
			if($row==1){
				$data = mysql_fetch_array($berita);
				?>
				<div id="leftPan">
					<p><span>Edit Berita</span></p><hr>
						<form method="post" action="<?php echo $linkHome."/proses/editberita.php";?>">
							<div id="centerform">
								<div class="centerform">
								<div class="divtext">
									<input type="hidden" name="id" value="<?php echo $data['id_berita'];?>"></div><br>
								<div class="divtext"><input type="text" name="judul" value="<?php echo $data['judul_berita'];?>" class="inputtext" placeholder="Judul Berita"></div><br>
								<div class="divtext"><textarea type="text" name="isi" class="inputtext" placeholder="Isi Berita"><?php echo $data['isi_berita'];?></textarea></div><br>
								<div><input type="submit" name="submit" value="Simpan" class="button"></div>
								</div>
							</div>
						</form>
					<p class="bottompadding">&nbsp;</p>
				</div>
				<?php
			}else{
				echo "$DNF<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}
		}
	}else if($_GET['action']=='hapus'){
		if(!isset($_GET['id'])){
				echo "<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
		}else{
			$id = addslashes($_GET['id']);
			if(isset($_SESSION['login'])){
				if(isset($_SESSION['kodeadmin'],$_SESSION['username'],$_SESSION['nama'],$_SESSION['email'],$_SESSION['password'])){
					//$login = "administrator";
					$delete = mysql_query("DELETE FROM berita WHERE id_berita='$id'");
					if($delete){
						echo "$suksesHapus<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
					}else{
						echo "$gagalHapus<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
					}
				}else{
					die("Anda tidak berhak mengakses file ini!");
				}
			}else{
				die("Anda tidak berhak mengakses file ini!");
			}
	
		}
	}

?>