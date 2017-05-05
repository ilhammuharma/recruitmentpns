<?php
	session_start();
	$title = "resume";
	include("../assets/dbconfig.php");
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
		{
			if(isset($_POST['throw_edit']))
			{
				include("templates/head.php");
				$idExp = $_POST['id-exp'];

				$queryShowForEdit = "SELECT * FROM pengalamanWorker WHERE idPengalaman = $idExp";
				$execShowForEdit = mysql_query($queryShowForEdit);
				$resultShowForEdit = mysql_fetch_array($execShowForEdit);
				?>
				<h3>Edit Pengalaman</h3>
				<form action="resume.php" method="post" role="form" class="form-horizontal">
					<div class="form-group">
						<input type="hidden" name="id-exp" value="<?php echo $idExp;?>">
						<label for="perusahaan-pengalaman" class="col-sm-2 control-label">Nama Perusahaan</label>
						<div class="col-sm-5">
							<input type="text" name="perusahaan-pengalaman" class="form-control" id="perusahaan-pengalaman" value="<?php echo $resultShowForEdit['namaPerusahaan'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="bidang-pengalaman" class="col-sm-2 control-label">Bidang Usaha</label>
						<div class="col-sm-5">
							<select name="bidang-pengalaman" id="bidang-pengalaman" class="form-control">
								<?php
									$queryBidangUsaha = "SELECT * FROM bidangUsaha ORDER BY namaBidangUsaha ASC";
									$execBidangUsaha = mysql_query($queryBidangUsaha);
									while($listBidangUsaha = mysql_fetch_array($execBidangUsaha))
									{
										?>
											<option value="<?php echo $listBidangUsaha['idUsaha'];?>" <?php if($listBidangUsaha['idUsaha'] == $resultShowForEdit['bidangUsaha']){echo "selected";}?>> <?php echo $listBidangUsaha['namaBidangUsaha'];?> </option>
										<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="posisi-pengalaman" class="col-sm-2 control-label">Jabatan</label>
						<div class="col-sm-5">
							<input type="text" name="posisi-pengalaman" class="form-control" id="posisi-pengalaman" value="<?php echo $resultShowForEdit['posisi'];?>">
						</div>
					</div>		
					<div class="form-group">
						<label for="lokasi-pengalaman" class="col-sm-2 control-label">Lokasi</label>
						<div class="col-sm-5">
							<select name="lokasi-pengalaman" id="lokasi-pengalaman" class="form-control">
								<?php
									$queryProvinsi = "SELECT * FROM tableProvinsi";
									$execProvinsi = mysql_query($queryProvinsi);
									while($listProvinsi = mysql_fetch_array($execProvinsi))
									{
										?>
											<option value="<?php echo $listProvinsi['idProvinsi']?>" <?php if($listProvinsi['idProvinsi'] == $resultShowForEdit['lokasi']){ echo "selected";}?>><?php echo $listProvinsi['namaProvinsi'];?></option>
										<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Periode Kerja</label>
						<div class="col-sm-2">
							<?php 
								$start = new DateTime($resultShowForEdit['awalKerja']);
								$startKerja = $start->format('d-m-Y');
							?>
							<input class="form-control" name="start-date-work" id="start-date-work" placeholder="Awal masa kerja" value="<?php echo $startKerja;?>">
						</div>
						<label class="col-sm-1 control-label">Hingga</label>
						<div id="hideEndKerja" <?php if($resultShowForEdit['akhirKerja'] == "0000-00-00"){ echo "style='display:none;'";}?>>
							<div class="col-sm-2">
								<?php 
									if($resultShowForEdit['akhirKerja'] != "0000-00-00")
									{
										$end = new DateTime($resultShowForEdit['akhirKerja']);
										$endKerja = $end->format('d-m-Y');
									}
									else
									{
										$endKerja = "";
									}
								?>
								<input class="form-control" name="end-date-work" id="end-date-work" placeholder="Akhir masa kerja" value="<?php echo $endKerja;?>">
							</div>
						</div>
						<div class="col-sm-2">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="endNow" id="endNow" value="1" <?php if($resultShowForEdit['akhirKerja'] == "0000-00-00"){ echo "checked";}?>>Sekarang
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="gaji-pengalaman" class="col-sm-2 control-label">Gaji Terakhir</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon"><u>+</u> Rp</div>
								<input type="text" class="form-control" name="gaji-pengalaman" id="gaji-pengalaman" placeholder="Total Gaji Per Bulan" value="<?php echo $resultShowForEdit['gaji'];?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="grossNett-pengalaman<?php echo $resultShowForEdit['idPengalaman'];?>" class="col-sm-2 control-label">Gross/Nett</label>
						<div class="col-sm-5">
							<label class="radio-inline"><input type="radio" name="grossNett-pengalaman" id="gross<?php echo $resultShowForEdit['idPengalaman'];?>" value="Gross" default><?php if($resultShowForEdit['grossNett'] == "Gross"){ echo "checked";}?> Gross</label>
							<label class="radio-inline"><input type="radio" name="grossNett-pengalaman" id="nett<?php echo $resultShowForEdit['idPengalaman'];?>" value="Nett"><?php if($resultShowForEdit['grossNett'] == "Nett"){ echo "checked";}?> Nett</label>
						</div>
					</div>
					<div class="form-group">
						<label for="bawahan-pengalaman" class="col-sm-2 control-label">Jumlah Bawahan</label>
						<div class="col-sm-5">
							<input type="number" name="bawahan-pengalaman" class="form-control" id="bawahan-pengalaman" placeholder="Jumlah Bawahan" value="<?php echo $resultShowForEdit['jumlahBawahan'];?>"required>
						</div>
					</div>
					<div class="form-group">
						<label for="alasan-pengalaman" class="col-sm-2 control-label">Alasan Pindah</label>
						<div class="col-sm-5">
							<textarea name="alasan-pengalaman" id="alasan-pengalaman" rows="3" class="form-control"><?php echo $resultShowForEdit['deskripsi'];?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="namaAtasan-pengalaman" class="col-sm-2 control-label">Nama Atasan</label>
						<div class="col-sm-5">
							<input name="namaAtasan-pengalaman" id="namaAtasan-pengalaman" rows="3" class="form-control" value="<?php echo $resultShowForEdit['namaAtasan'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="telpAtasan-pengalaman" class="col-sm-2 control-label">Nomor Telepon/HP Atasan</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">+62</div>
								<input type="tel" class="form-control" name="telpAtasan-pengalaman" id="telpAtasan-pengalaman" value="<?php echo $resultShowForEdit['telpAtasan'];?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="jabatanAtasan-pengalaman" class="col-sm-2 control-label">Jabatan Atasan</label>
						<div class="col-sm-5">
							<input name="jabatanAtasan-pengalaman" id="jabatanAtasan-pengalaman" rows="3" class="form-control" value="<?php echo $resultShowForEdit['jabatanAtasan'];?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-8">
							<button type="submit" class="btn btn-primary" name="update-exp">Simpan</button>
						</div>
					</div>
				</form>
			<?php			
			include("templates/foot.php");
			}
			else
			{
				header("Location:resume.php");
			}
		}
		else
		{
			if(isset($_SESSION['admin']))
			{
				header("Location:../admin/");
			}
			else
			{
				header("Location:../hrd/");
			}
		}
	}
?>