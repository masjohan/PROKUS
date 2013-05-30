<?php

	if(!defined("apotikuin")){
		die("Anda tidak dapat mengakses file ini!");
	}

	if(!isset($_GET['action'])){
		?>
		<div id="leftPan">
			<p><span>Data Dokter</span></p><hr>
				<table style="width:100%;border:1px solid #ccc;">
					<tr>
						<th style="width:20%;background:#ccb;">Kode Dokter</th>
						<th style="width:30%;background:#ccb;">Nama Dokter</th>
						<th style="width:35%;background:#ccb;">Username</th>
						<th style="width:15%;background:#ccb;">Action</th>
					</tr>
					<?php
						$dokter = mysql_query("SELECT * FROM dokter ORDER BY nama");
						$no=1;
						while($data = mysql_fetch_array($dokter)){
							if($no%2==0){ echo"<tr>"; }else{ echo"<tr style=\"background:#ccc;\">"; }
							echo "<td>$data[kode_dokter]</td>
								<td>$data[nama]</td>
								<td>$data[username]</td>
								<td style=\"text-align:center\">
								<a href=\"$linkHome/?act=dokter&action=edit&id=$data[id_dokter]\" title=\"Edit Data Dokter\"><img src=\"$linkHome/images/mdpi/edit.png\"></img></a>
								<a href=\"$linkHome/?act=dokter&action=history&id=$data[id_dokter]\" title=\"Lihat Histori Praktek Dokter\"><img src=\"$linkHome/images/mdpi/history.png\"></img></a></td>
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
			<p><span>Data Pasien</span></p><hr>
				<form method="post" action="<?php echo $linkHome."/proses/adddokter.php";?>">
					<div id="centerform">
						<div class="centerform">
						<div class="divtext"><input type="text" name="nama" class="inputtext" placeholder="Nama Dokter"></div><br>
						<div class="divtext"><input type="text" name="email" class="inputtext" placeholder="Email Dokter"></div><br>
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
			$dokter = mysql_query("SELECT * FROM dokter WHERE id_dokter='$id'");
			$row = mysql_num_rows($dokter);
			if($row==1){
				$data = mysql_fetch_array($dokter);
				?>
				<div id="leftPan">
					<p><span>Edit Pasien <?php echo $data['nama']; ?></span></p><hr>
						<form method="post" action="<?php echo $linkHome."/proses/editdokter.php";?>">
							<div id="centerform">
								<div class="centerform">
								<div class="divtext">
									<input type="hidden" name="id" value="<?php echo $data['id_dokter'];?>">
									<input type="hidden" name="kode" value="<?php echo $data['kode_dokter'];?>">
									<input type="hidden" name="username" value="<?php echo $data['username'];?>">USERNAME : <?php echo $data['username']." ($data[kode_dokter])";?></div><br>
								<div class="divtext"><input type="text" name="nama" value="<?php echo $data['nama'];?>" class="inputtext" placeholder="Nama Dokter"></div><br>
								<div class="divtext"><input type="text" name="email" value="<?php echo $data['email'];?>" class="inputtext" placeholder="Nama Dokter"></div><br>
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
	}else if($_GET['action']=='history'){
		if(!isset($_GET['id'])){
				echo "<meta http-equiv='refresh' content='2;url=$linkHome/?act=dokter'>";
		}else{
			$id = addslashes($_GET['id']);
			$dokter = mysql_query("SELECT * FROM dokter WHERE id_dokter='$id'");
			$row = mysql_num_rows($dokter);
			if($row==1){
				$data = mysql_fetch_array($dokter);
				?>
				<div id="leftPan">
					<p><span>Histori Praktek Dokter <?php echo $data['nama']; ?></span></p><hr>
					<table style="width:100%;border:1px solid #ccc;">
						<tr>
							<th style="width:20%;background:#ccb;">Tanggal Periksa</th>
							<th style="width:20%;background:#ccb;">Nama Pasien</th>
							<th style="width:30%;background:#ccb;">Sakit</th>
							<th style="width:20%;background:#ccb;">Deskripsi</th>
						</tr>
						<?php
							$history = mysql_query("SELECT * FROM history_pasien h,pasien p WHERE h.id_pasien=p.id_pasien AND h.id_dokter='$id' ORDER BY h.tanggal_periksa DESC");
							$no=1;
							$rows = mysql_num_rows($history);
							if($rows==0){
								echo"<tr><td colspan=\"100%\"><center>Histori Praktek dokter masih kosong</center></td></tr>";
							}else{
								while($data = mysql_fetch_array($history)){
									if($no%2==0){ echo"<tr>"; }else{ echo"<tr style=\"background:#ccc;\">"; }
									echo "<td>$data[tanggal_periksa]</td>
										<td>$data[nama]</td>
										<td>$data[nama_penyakit]</td>
										<td>$data[deskripsi_penyakit]</td>
									</tr>";
									$no++;
								}
							}
						?>
					</table>
					<p class="bottompadding">&nbsp;</p>
				</div>
				<?php
			}else{
				echo "$DNF<meta http-equiv='refresh' content='2;url=$linkHome/?act=home'>";
			}
		}
	}

?>