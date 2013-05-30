<?php

	if(!defined("apotikuin")){
		die("Anda tidak dapat mengakses file ini!");
	}

	if(!isset($_GET['action'])){
		?>
		<div id="leftPan">
			<p><span>Data Pemeriksaan Hari ini</span></p><hr>
				<table style="width:100%;border:1px solid #ccc;">
					<tr>
						<th style="width:20%;background:#ccb;">Kode Pasien</th>
						<th style="width:30%;background:#ccb;">Nama Pasien</th>
						<th style="width:15%;background:#ccb;">Action</th>
					</tr>
					<?php
						$date=date('Y-m-d');
						$dokter = mysql_query("SELECT * FROM periksa p,pasien ps WHERE p.id_pasien=ps.id_pasien AND p.tanggal_periksa='$date' ORDER BY id_periksa");
						$no=1;
						while($data = mysql_fetch_array($dokter)){
							if($no%2==0){ echo"<tr>"; }else{ echo"<tr style=\"background:#ccc;\">"; }
							echo "<td>$data[kode_pasien]</td>
								<td>$data[nama]</td>
								<td style=\"text-align:center\">
								<a href=\"$linkHome/?act=periksa&action=diagnosis&id=$data[id_periksa]\" title=\"Diagnosis Pasien\"><img src=\"$linkHome/images/mdpi/edit.png\"></img></a>
								<a href=\"$linkHome/?act=periksa&action=history&id=$data[id_pasien]\" title=\"Lihat Histori Pasien\"><img src=\"$linkHome/images/mdpi/history.png\"></img></a></td>
							</tr>";
							$no++;
						}
					?>
				</table>
			<p class="bottompadding">&nbsp;</p>
		</div>
		<?php
	}else if($_GET['action']=='history'){
		if(!isset($_GET['id'])){
				echo "<meta http-equiv='refresh' content='2;url=$linkHome/?act=periksa'>";
		}else{
			$id = addslashes($_GET['id']);?>
			<div id="leftPan">
				<p><span><a href="<?php echo $linkHome."/?act=periksa";?>">Pasien<a> / Diagnosis</span></p><hr>
				<table style="width:100%;border:1px solid #ccc;">
					<tr>
						<th style="width:20%;background:#ccb;">Tanggal Periksa</th>
						<th style="width:20%;background:#ccb;">Keluhan</th>
						<th style="width:30%;background:#ccb;">Diagnosis</th>
						<th style="width:20%;background:#ccb;">Lihat</th>
					</tr>
					<?php
						$history = mysql_query("SELECT * FROM periksa p,diagnosis d WHERE p.id_periksa=d.id_periksa AND p.id_pasien='$id' AND status='sudah' ORDER BY tanggal_periksa");
						$no=1;
						$rows = mysql_num_rows($history);
						if($rows==0){
							echo"<tr><td colspan=\"100%\"><center>Histori pasien masih kosong</center></td></tr>";
						}else{
							while($data = mysql_fetch_array($history)){
								if($no%2==0){ echo"<tr>"; }else{ echo"<tr style=\"background:#ccc;\">"; }
								echo "<td>$data[tanggal_periksa]</td>
									<td>$data[keluhan]</td>
									<td>$data[diagnosis]</td>
									<td><a href=\"$linkHome/?act=periksa&action=resep&id=$data[id_diagnosis]\">Resep Obat<a></td>
								</tr>";
								$no++;
							}
						}
					?>
				</table>
				<p class="bottompadding">&nbsp;</p>
			</div>
			<?php
		}
	}else if($_GET['action']=='resep'){
		if(!isset($_GET['id'])){
				echo "<meta http-equiv='refresh' content='2;url=$linkHome/?act=periksa'>";
		}else{
			$id = addslashes($_GET['id']);
			?>
			<div id="leftPan">
				<p><span><a href="<?php echo $linkHome."/?act=periksa";?>">Pasien<a> / <a href="<?php echo $linkHome."/?act=periksa&action=history&id=$id";?>">Diagnosis<a> / Resep Obat</span></p><hr>
				<table style="width:100%;border:1px solid #ccc;">
					<tr>
						<th style="width:20%;background:#ccb;">Nama Obat</th>
						<th style="width:20%;background:#ccb;">Aturan Pakai</th>
					</tr>
					<?php
			$resep = mysql_query("SELECT * FROM resep WHERE id_diagnosis='$id'");
			$rows = mysql_num_rows($resep);
			if($rows==0){
				echo"<tr><td colspan=\"100%\"><center>Resep pasien masih kosong</center></td></tr>";
			}else{
				while($data = mysql_fetch_array($resep)){
					if($no%2==0){ echo"<tr>"; }else{ echo"<tr style=\"background:#ccc;\">"; }
					echo "<td>$data[nama_obat]</td>
						<td>$data[aturan_pakai]</td>
					</tr>";
					$no++;
				}
			}
					?>
				</table>
				<p class="bottompadding">&nbsp;</p>
			</div>
			<?php
		}
	}else if($_GET['action']=='diagnosis'){
		if(!isset($_GET['id'])){
				echo "<meta http-equiv='refresh' content='2;url=$linkHome/?act=periksa'>";
		}else{
			$id = addslashes($_GET['id']);
			$diag = mysql_query("SELECT * FROM diagnosis WHERE id_periksa='$id'");
			if(mysql_num_rows($diag)==0){
				$periksa = mysql_query("SELECT * FROM periksa WHERE id_periksa='$id'");
				$data = mysql_fetch_array($periksa);
				?>
				<div id="leftPan">
					<p><span>Diagnosis</span></p><hr>
						<form method="post" action="<?php echo $linkHome."/proses/diagnosis.php";?>">
							<div id="centerform">
								<div class="centerform">
								<div class="divtext">
									Keluhan :<br><?php echo $data['keluhan'];?></div>
								<div class="divtext"><br>
								<div class="divtext">
									<input type="hidden" name="id" value="<?php echo $data['id_periksa'];?>"></div>
								<div class="divtext"><br>
									<textarea type="text" name="diagnosis" class="inputtext" placeholder="Diagnosisa Penyakit Pasien"></textarea>
								</div><br>
								<div><input type="submit" name="submit" value="Simpan" class="button"></div>
								</div>
							</div>
						</form>
					<p class="bottompadding">&nbsp;</p>
				</div>
				<?php
			}else{
				$diagnosis = mysql_fetch_array($diag);?>
				<div id="leftPan">
					<p><span>Resep Obat</span></p><hr>
					<table style="width:100%;border:1px solid #ccc;">
					<tr>
						<th title="Diagnosis dari dokter" style="width:20%;background:#ccb;height:40px" colspan="3"><?php echo $diagnosis['diagnosis'];?></th>
					</tr>
					<tr>
						<th style="width:20%;background:#ccb;">Nama Obat</th>
						<th style="width:20%;background:#ccb;">Aturan Pakai</th>
						<th style="width:20%;background:#ccb;">Action</th>
					</tr>
					<?php
						$history = mysql_query("SELECT * FROM resep WHERE id_diagnosis='$diagnosis[id_diagnosis]' ORDER BY nama_obat");
						$no=1;
						$rows = mysql_num_rows($history);
						if($rows==0){
							echo"<tr><td colspan=\"100%\"><center>Resep obat pasien masih kosong</center></td></tr>";
						}else{
							while($data = mysql_fetch_array($history)){
								if($no%2==0){ echo"<tr>"; }else{ echo"<tr style=\"background:#ccc;\">"; }
								echo "<td>$data[nama_obat]</td>
									<td>$data[aturan_pakai]</td>
									<td><a href=\"$linkHome/?act=periksa&action=editresep&id=$data[id_resep]\">Edit Resep Obat<a></td>
								</tr>";
								$no++;
							}
						} ?>
					</table>
						<form method="post" action="<?php echo $linkHome."/proses/tambahObat.php";?>">
							<div id="centerform">
								<div class="centerform">
								<div class="divtext"></div>
								<div class="divtext"><br>
								<div class="divtext">
									<input type="hidden" name="id" value="<?php echo $diagnosis['id_diagnosis'];?>">
									<input type="text" name="nama" class="inputtext" placeholder="Nama Obat"></div>
								<div class="divtext"><br>
									<textarea type="text" name="aturan" class="inputtext" placeholder="Aturan Pakai"></textarea>
								</div><br>
								<div><input type="submit" name="submit" value="Tambah" class="button"></div>
								</div>
							</div>
						</form>
					<p class="bottompadding">&nbsp;</p>
				</div>
				<?php
			}
		}
	}else if($_GET['action']=='editresep'){
		if(!isset($_GET['id'])){
				echo "<meta http-equiv='refresh' content='2;url=$linkHome/?act=periksa'>";
		}else{
			$id = addslashes($_GET['id']);
			$resep= mysql_query("SELECT * FROM resep WHERE id_resep='$id'");
			$data = mysql_fetch_array($resep);
			?>
				<div id="leftPan">
					<p><span>Edit Resep Obat</span></p><hr>
						<form method="post" action="<?php echo $linkHome."/proses/tambahObat.php";?>">
							<div id="centerform">
								<div class="centerform">
								<div class="divtext"></div>
								<div class="divtext"><br>
								<div class="divtext">
									<input type="hidden" name="id" value="<?php echo $data['id_resep'];?>">
									<input type="text" name="nama" class="inputtext" placeholder="Nama Obat" value="<?php echo $data['nama_obat'];?>"></div>
								<div class="divtext"><br>
									<textarea type="text" name="aturan" class="inputtext" placeholder="Aturan Pakai"><?php echo $data['aturan_pakai'];?></textarea>
								</div><br>
								<div><input type="submit" name="submit" value="Ubah" class="button"></div>
								</div>
							</div>
						</form>
					<p class="bottompadding">&nbsp;</p>
				</div>
				<?php
		}
	}
?>