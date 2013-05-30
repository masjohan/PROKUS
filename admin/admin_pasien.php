<?php

	if(!defined("apotikuin")){
		die("Anda tidak dapat mengakses file ini!");
	}

	if(!isset($_GET['action'])){
		?>
		<div id="leftPan">
			<p><span>Data Pasien</span></p><hr>
				<table style="width:100%;border:1px solid #ccc;">
					<tr>
						<th style="width:20%;background:#ccb;">Kode Pasien</th>
						<th style="width:20%;background:#ccb;">Nama Pasien</th>
						<th style="width:35%;background:#ccb;">Alamat</th>
						<th style="width:25%;background:#ccb;">Action</th>
					</tr>
					<?php
						$pasien = mysql_query("SELECT * FROM pasien ORDER BY nama");
						$no=1;
						while($data = mysql_fetch_array($pasien)){
							if($no%2==0){
								echo"<tr>";
							}else{
								echo"<tr style=\"background:#ccc;\">";
							}
							echo "<td>$data[kode_pasien]</td>
								<td>$data[nama]</td>
								<td>$data[alamat]</td>
								<td style=\"text-align:center\">
								<a href=\"$linkHome/?act=pasien&action=edit&id=$data[id_pasien]\" title=\"Edit Data Pasien\"><img src=\"$linkHome/images/mdpi/edit.png\"></img></a>
								<a href=\"$linkHome/?act=pasien&action=periksa&id=$data[id_pasien]\" title=\"Periksa\"><img src=\"$linkHome/images/mdpi/6_social_add_person.png\"></img></a>
								<a href=\"$linkHome/?act=pasien&action=history&id=$data[id_pasien]\" title=\"Lihat Histori Pasien\"><img src=\"$linkHome/images/mdpi/history.png\"></img></a></td>
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
				<form method="post" action="<?php echo $linkHome."/proses/addpasien.php";?>">
					<div id="centerform">
						<div class="centerform">
						<div class="divtext"><input type="text" name="nama" class="inputtext" placeholder="Nama Pasien"></div><br>
						<div class="divtext">
							<select name="jk" class="selecttext">
								<option value="">Jenis Kelamin</option>
								<option value="l">Laki - Laki</option>
								<option value="p">Perempuan</option>
							</select>
						</div><br>
						<div class="divtext"><textarea type="text" name="alamat" class="inputtext" placeholder="Alamat Pasien"></textarea></div>
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
			$pasien = mysql_query("SELECT * FROM pasien WHERE id_pasien='$id'");
			$row = mysql_num_rows($pasien);
			if($row==1){
				$data = mysql_fetch_array($pasien);
				?>
				<div id="leftPan">
					<p><span>Edit Pasien <?php echo $data['nama']; ?></span></p><hr>
						<form method="post" action="<?php echo $linkHome."/proses/editpasien.php";?>">
							<div id="centerform">
								<div class="centerform">
								<div class="divtext">
									<input type="hidden" name="id" value="<?php echo $data['id_pasien'];?>">
									<input type="hidden" name="kode" value="<?php echo $data['kode_pasien'];?>">
									<input type="hidden" name="username" value="<?php echo $data['username'];?>">USERNAME : <?php echo $data['username']." ($data[kode_pasien])";?></div><br>
								<div class="divtext"><input type="text" name="nama" value="<?php echo $data['nama'];?>" class="inputtext" placeholder="Nama Pasien"></div><br>
								<div class="divtext">
									<select name="jk" class="selecttext">
										<option value="">Jenis Kelamin</option>
										<?php
											if($data['jk']=='l'){
												echo"<option value=\"l\" selected>Laki - Laki</option><option value=\"p\">Perempuan</option>";
											}else{
												echo"<option value=\"l\">Laki - Laki</option><option value=\"p\" selected>Perempuan</option>";
											}
										?>
									</select>
								</div><br>
								<div class="divtext"><textarea type="text" name="alamat" class="inputtext" placeholder="Alamat Pasien"><?php echo $data['alamat'];?></textarea></div>
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
				echo "<meta http-equiv='refresh' content='2;url=$linkHome/?act=pasien'>";
		}else{
			$id = addslashes($_GET['id']);?>
			<div id="leftPan">
				<p><span><a href="<?php echo $linkHome."/?act=pasien";?>">Pasien<a> / Diagnosis</span></p><hr>
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
									<td><a href=\"$linkHome/?act=pasien&action=resep&id=$data[id_diagnosis]\">Resep Obat<a></td>
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
				echo "<meta http-equiv='refresh' content='2;url=$linkHome/?act=pasien'>";
		}else{
			$id = addslashes($_GET['id']);
			?>
			<div id="leftPan">
				<p><span><a href="<?php echo $linkHome."/?act=pasien";?>">Pasien<a> / <a href="<?php echo $linkHome."/?act=pasien&action=history&id=$id";?>">Diagnosis<a> / Resep Obat</span></p><hr>
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
	}else if($_GET['action']=='periksa'){
		if(!isset($_GET['id'])){
				echo "<meta http-equiv='refresh' content='2;url=$linkHome/?act=pasien'>";
		}else{
			$id = addslashes($_GET['id']);
			$pasien = mysql_query("SELECT * FROM pasien WHERE id_pasien='$id'");
			$row = mysql_num_rows($pasien);
			if($row==1){
				$data = mysql_fetch_array($pasien);
				?>
				<div id="leftPan">
					<p><span>Periksa Pasien <?php echo $data['nama']; ?></span></p><hr>
						<form method="post" action="<?php echo $linkHome."/proses/periksapasien.php";?>">
							<div id="centerform">
								<div class="centerform">
								<div class="divtext">
									<input type="hidden" name="id" value="<?php echo $data['id_pasien'];?>">
									<input type="hidden" name="kode" value="<?php echo $data['kode_pasien'];?>">
									<input type="hidden" name="username" value="<?php echo $data['username'];?>">USERNAME : <?php echo $data['username']." ($data[kode_pasien])";?></div><br>
								<div class="divtext">
									Keluhan:<br>
									<textarea type="text" name="keluhan" placeholder="Keluhan" cols="35" rows="10"></textarea>
								</div><br>
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
	}
?>