<?php
	session_start();
	$title = "fptk";
	include("../assets/dbconfig.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
		{
			include("templates/head.php");
			function populate_word($url)
			{
				error_reporting(E_ALL & ~E_NOTICE);
				$fd = @fopen($url, "r");
				$word = "";
				while(!feof($fd))
				{
					$buffer = fgets($fd,1024);
					$buffer = trim($buffer);
					$buffer = strip_tags($buffer);
					$explode = explode(" ", $buffer);
					for($i = 0 ; $i<=sizeof($explode); $i++)
					{
						$kata = stripslashes(strtolower($explode[$i]));
						$word .= $kata." ";
					}
				}
				return $word;
			}
			
			$idLogin = $_SESSION['idLogin'];
			//$tab = "";
			$queryGetUser = "SELECT * FROM userWorker WHERE idLogin = '$idLogin'";
			$execGetUser = mysql_query($queryGetUser);
			$resultGetUser = mysql_fetch_array($execGetUser);
			$idWorker = $resultGetUser['idWorker'];
				
			$getStatusFptk = "SELECT * FROM fptk WHERE idWorker = '$idWorker'";
			$execStatusFptk = mysql_query($getStatusFptk);
			$statusFptk = mysql_num_rows($execStatusFptk);
				
				?>
					<div class="row">
						<div class="col-md-5">
							<h3><strong>Form Permintaan Tenaga Kerja <button type="button" class="btn btn-primary btn-success" id="addFptk">Add FPTK</button></strong></h3>
						</div>
					</div>
					<div id="addFptk2" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-fptk" action="fptkProcess.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
								<h4>I. Pemohon</h4>
								<div class="form-group">
									<label for="pemohonNama" class="col-sm-2 control-label">Nama Pemohon</label>
									<div class="col-sm-5">
										<input type="text" name="pemohonNama" class="form-control" id="pemohonNama" placeholder="Nama Pemohon" required>
									</div>
								</div>
								<div class="form-group">
									<label for="pemohonNik" class="col-sm-2 control-label">NIK</label>
									<div class="col-sm-5">
										<input type="text" name="pemohonNik" class="form-control" id="pemohonNik" placeholder="NIK" required>
									</div>
								</div>
								<div class="form-group">
									<label for="pemohonPosisi" class="col-sm-2 control-label">Posisi/Jabatan</label>
									<div class="col-sm-5">
										<select name="pemohonPosisi" id="pemohonPosisi" class="form-control" required>
											<option value="" disabled>-- Pilih posisi --</option>
											<?php
												$queryPosisi = "SELECT * FROM kategoriKerja ORDER BY idKategori ASC";
												$execPosisi = mysql_query($queryPosisi);
												while($resultPosisi = mysql_fetch_array($execPosisi))
												{
													?><option value="<?php echo $resultPosisi['idKategori'];?>"><?php echo $resultPosisi['namaKategori'];?></option><?php
												}
											?>
										</select>
										<div class="input-group">
											<input type="text" id="pemohonPosisiBaru" name="pemohonPosisiBaru" placeholder="Nama posisi baru" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group" id="show"></div>
								<div class="form-group">
									<label for="pemohonDepartemen" class="col-sm-2 control-label">Departemen</label>
									<div class="col-sm-5">
										<?php
											$queryDepartemen = "SELECT * FROM kategoriDepartemen ORDER BY namaDepartemen ASC";
											$execDepartemen = mysql_query($queryDepartemen);
										?>
										<select name="pemohonDepartemen" id="pemohonDepartemen" class="form-control" required>
											<option value="" disabled>-- Pilih departemen --</option>
											<?php
												while($resultDepartemen = mysql_fetch_array($execDepartemen))
												{
													?><option value="<?php echo $resultDepartemen['idDepartemen'];?>"><?php echo $resultDepartemen['namaDepartemen'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
								
								<h4>II. Informasi Posisi</h4>
								<div class="form-group">
									<label for="posisiDivisi" class="col-sm-2 control-label">Divisi</label>
									<div class="col-sm-5">
										<?php
											$queryDivisi = "SELECT * FROM kategoriDivisi ORDER BY namaDivisi ASC";
											$execDivisi = mysql_query($queryDivisi);
										?>
										<select name="posisiDivisi" id="posisiDivisi" class="form-control" required>
											<option value="" disabled>-- Pilih divisi --</option>
											<?php
												while($resultDivisi= mysql_fetch_array($execDivisi))
												{
													?><option value="<?php echo $resultDivisi['idDivisi'];?>"><?php echo $resultDivisi['namaDivisi'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="posisiDepartemen" class="col-sm-2 control-label">Departemen</label>
									<div class="col-sm-5">
										<?php
											$queryDepartemen2 = "SELECT * FROM kategoriDepartemen ORDER BY namaDepartemen ASC";
											$execDepartemen2 = mysql_query($queryDepartemen2);
										?>
										<select name="posisiDepartemen" id="posisiDepartemen" class="form-control" required>
											<option value="" disabled>-- Pilih departemen --</option>
											<?php
												while($resultDepartemen2 = mysql_fetch_array($execDepartemen2))
												{
													?><option value="<?php echo $resultDepartemen2['idDepartemen'];?>"><?php echo $resultDepartemen2['namaDepartemen'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="posisiJabatan" class="col-sm-2 control-label">Posisi/Jabatan</label>
									<div class="col-sm-5">
										<?php
											$queryPosisi2 = "SELECT * FROM kategoriKerja ORDER BY idKategori ASC";
											$execPosisi2 = mysql_query($queryPosisi2);
										?>
										<select name="posisiJabatan" id="posisiJabatan" class="form-control" required>
											<option value="" disabled>-- Pilih posisi --</option>
											<?php
												while($resultPosisi2 = mysql_fetch_array($execPosisi2))
												{
													?><option value="<?php echo $resultPosisi2['idKategori'];?>"><?php echo $resultPosisi2['namaKategori'];?></option><?php
												}
											?>
										</select>
										<div class="input-group">
											<input type="text" id="posisiJabatanBaru" name="posisiJabatanBaru" placeholder="Nama posisi baru" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="posisiLevel" class="col-sm-2 control-label">Level</label>
									<div class="col-sm-5">
										<?php
											$queryLevel = "SELECT * FROM kategoriLevel ORDER BY namaLevel ASC";
											$execLevel = mysql_query($queryLevel);
										?>
										<select name="posisiLevel" id="posisiLevel" class="form-control" required>
											<option value="" disabled>-- Pilih level --</option>
											<?php
												while($resultLevel = mysql_fetch_array($execLevel))
												{
													?><option value="<?php echo $resultLevel['idLevel'];?>"><?php echo $resultLevel['namaLevel'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="posisiLokasi" class="col-sm-2 control-label">Lokasi Penempatan</label>
									<div class="col-sm-5">
										<?php
											$queryProvinsi = "SELECT * FROM tableProvinsi ORDER BY namaProvinsi ASC";
											$execProvinsi = mysql_query($queryProvinsi);
										?>
										<select name="posisiLokasi" id="posisiLokasi" class="form-control" required>
											<option value="" disabled>-- Pilih lokasi penempatan --</option>
												<?php
													while($resultProvinsi = mysql_fetch_array($execProvinsi))
													{ 
														?><option value="<?php echo $resultProvinsi['idProvinsi'];?>"><?php echo $resultProvinsi['namaProvinsi'];?></option><?php
													}
												?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="posisiJumlah" class="col-sm-2 control-label">Jumlah Kebutuhan</label>
									<div class="col-sm-5">
										<input type="text" name="posisiJumlah" class="form-control" id="posisiJumlah" placeholder="Jumlah Kebutuhan" required>
									</div>
								</div>
								<div class="form-group">
									<label for="posisiTujuan" class="col-sm-2 control-label">Tujuan Permintaan</label>
									<div class="col-sm-5">
										<label class="radio-inline"><input type="radio" name="posisiTujuan" id="posisiTujuanBaru" value="Rekrut Baru" default>Rekrut Baru</label>
										<label class="radio-inline"><input type="radio" name="posisiTujuan" id="posisiTujuanGanti" value="Penggantian">Penggantian</label>
										<div class="input-group">
											<input type="text" id="posisiPengganti" name="posisiPengganti" placeholder="Penggantian, Atas Nama" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="posisiTanggal" class="col-sm-2 control-label">Tanggal Dibutuhkan</label>
									<div class="col-sm-5">
										<?php $lahir = new DateTime;?>
										<input type="date" class="form-control" name="posisiTanggal" id="posisiTanggal" value="<?php echo $lahir->format('d-m-Y');?>" required>
									</div>
								</div>
								<div class="form-group">
									<label for="posisiJobdes" class="col-sm-2 control-label">Deskripsi Kerja</label>
									<div class="col-sm-5">
										<label class="radio-inline"><input type="radio" name="posisiJobdes" id="posisiJobdesAda" value="Ada" default>Ada</label>
										<label class="radio-inline"><input type="radio" name="posisiJobdes" id="posisiJobdesTidak" value="Tidak Ada">Tidak Ada</label>
										<p class="help-block">*Jika tidak ada, wajib membuat dan melampirkan.</p>
									</div>
								</div>
								<div class="form-group">
									<label for="posisiStatus" class="col-sm-2 control-label">Status Karyawan</label>
									<div class="col-sm-5">
										<label class="radio-inline"><input type="radio" name="posisiStatus" id="posisiStatusBulanan" value="Bulanan" default>Bulanan</label>
										<label class="radio-inline"><input type="radio" name="posisiStatus" id="posisiStatusHarian" value="Harian">Harian</label>
									</div>
								</div>
								
								<h4>III. Kualifikasi</h4>
								<div class="form-group">
									<label for="kualifikasiJumlahl" class="col-sm-2 control-label">Jumlah Dibutuhkan</label>
									<div class="col-sm-5">
										<div class="input-group">
											<div class="input-group-addon">Laki-Laki</div>
											<input type="text" name="kualifikasiJumlahl" class="form-control" id="kualifikasiJumlahl">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-5">
										<div class="input-group">
											<div class="input-group-addon">Perempuan</div>
											<input type="text" name="kualifikasiJumlahp" class="form-control" id="kualifikasiJumlahp">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="kualifikasiUsia" class="col-sm-2 control-label">Usia</label>
									<div class="col-sm-5">
										<input type="text" name="kualifikasiUsia" class="form-control" id="kualifikasiUsia" placeholder="Usia" required>
									</div>
								</div>
								<div class="form-group">
									<label for="kualifikasiPendidikan" class="col-sm-2 control-label">Pendidikan</label>
									<div class="col-sm-5">
										<?php
											$queryPendidikan = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
											$execPendidikan = mysql_query($queryPendidikan);
										?>
										<select name="kualifikasiPendidikan" id="kualifikasiPendidikan" class="form-control" required>
											<?php
												while($resultPendidikan = mysql_fetch_array($execPendidikan))
												{
													?><option value="<?php echo $resultPendidikan['gradePendidikan'];?>"><?php echo $resultPendidikan['namaPendidikan'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="kualifikasiJurusan" class="col-sm-2 control-label">Jurusan</label>
									<div class="col-sm-5">
										<?php
											$queryJurusan = "SELECT * FROM tableJurusan ORDER BY namaJurusan ASC";
											$execJurusan = mysql_query($queryJurusan);
										?>
										<select name="kualifikasiJurusan" id="kualifikasiJurusan" class="form-control" required>
											<?php
												while($resultJurusan = mysql_fetch_array($execJurusan))
												{
													?><option value="<?php echo $resultJurusan['idJurusan'];?>"><?php echo $resultJurusan['namaJurusan'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="kualifikasiPengalaman" class="col-sm-2 control-label">Pengalaman</label>
									<div class="col-sm-5">
										<input type="text" name="kualifikasiPengalaman" class="form-control" id="kualifikasiPengalaman" placeholder="Pengalaman" required>
									</div>
								</div>
								<div class="form-group">
									<label for="kualifikasiLainlain" class="col-sm-2 control-label">Lain-Lain</label>
									<div class="col-sm-5">
										<textarea type="text" name="kualifikasiLainlain" class="form-control" placeholder="Lain-Lain" id="kualifikasiLainlain"></textarea>
									</div>
								</div>
								
								<!-- <h4>IV. Untuk Karyawan Bulanan</h4>
								<div class="form-group">
									<label for="bulananTglditerima" class="col-sm-2 control-label">Tanggal FPTK Diterima</label>
									<div class="col-sm-5">
										<?php //$lahir = new DateTime;?>
										<input type="date" class="form-control" name="bulananTglditerima" id="bulananTglditerima" value="<?php //echo $lahir->format('d-m-Y'); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="bulananPic" class="col-sm-2 control-label">PIC</label>
									<div class="col-sm-5">
										<input type="text" name="bulananPic" id="bulananPic" class="form-control"  placeholder="PIC">
									</div>
								</div>
								<div class="form-group">
									<label for="bulananTglclosing" class="col-sm-2 control-label">Tanggal Closing</label>
									<div class="col-sm-5">
										<?php //$lahir = new DateTime;?>
										<input type="date" class="form-control" name="bulananTglclosing" id="bulananTglclosing" value="<?php //echo $lahir->format('d-m-Y'); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="bulananPemenuhan" class="col-sm-2 control-label">Lama Pemenuhan</label>
									<div class="col-sm-5">
										<input type="text" name="bulananPemenuhan" id="bulananPemenuhan" class="form-control"  placeholder="Lama Pemenuhan">
									</div>
								</div>
								<div class="form-group">
									<label for="bulananKaryawan" class="col-sm-2 control-label">Karyawan a.n.</label>
									<div class="col-sm-5">
										<input type="text" name="bulananKaryawan" id="bulananKaryawan" class="form-control"  placeholder="Nama Karyawan">
									</div>
								</div>
								<div class="form-group">
									<label for="bulananTglmasuk" class="col-sm-2 control-label">Tanggal Masuk</label>
									<div class="col-sm-5">
										<?php //$lahir = new DateTime;?>
										<input type="date" class="form-control" name="bulananTglmasuk" id="bulananTglmasuk" value="<?php //echo $lahir->format('d-m-Y'); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="bulananSbrinternal" class="col-sm-2 control-label">Sumber Rekrutmen</label>
									<div class="col-sm-5">
										<div class="input-group">
											<div class="input-group-addon">Internal</div>
											<input type="text" class="form-control"  name="bulananSbrinternal" id="bulananSbrinternal">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-5">
										<div class="input-group">
											<div class="input-group-addon">Eksternal</div>
											<?php
												//$queryReferensi = "SELECT * FROM referensiEksternal ORDER BY idRefeksternal ASC";
												//$execReferensi = mysql_query($queryReferensi);
											?>
											<select name="bulananSbreksternal" id="bulananSbreksternal" class="form-control">
												<?php
													/*while($resultReferensi = mysql_fetch_array($execReferensi))
													{
														?><option value="<?php echo $resultReferensi['idRefeksternal'];?>"><?php echo $resultReferensi['namaRefeksternal'];?></option><?php
													}*/
												?>
											</select>
										</div>
										<div class="input-group">
											<input type="text" id="bulananLaineksternal" name="bulananLaineksternal" placeholder="Sebutkan Jika Tidak Tersedia" class="form-control">
										</div>
									</div>
								</div>
								
								<h4>IV. Untuk Karyawan Harian</h4>
								<div class="form-group">
									<label for="harianTglditerima" class="col-sm-2 control-label">Tanggal FPTK Diterima</label>
									<div class="col-sm-5">
										<?php //$lahir = new DateTime;?>
										<input type="date" class="form-control" name="harianTglditerima" id="harianTglditerima" value="<?php //echo $lahir->format('d-m-Y'); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="harianTglclosing" class="col-sm-2 control-label">Tanggal Closing</label>
									<div class="col-sm-5">
										<?php //$lahir = new DateTime;?>
										<input type="date" class="form-control" name="harianTglclosing" id="harianTglclosing" value="<?php //echo $lahir->format('d-m-Y'); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="harianPemenuhan" class="col-sm-2 control-label">Lama Pemenuhan</label>
									<div class="col-sm-5">
										<input type="text" name="harianPemenuhan" id="harianPemenuhan" class="form-control" placeholder="Lama Pemenuhan">
									</div>
								</div>-->
								<div class="form-group">
									<div class="col-md-offset-2 col-md-6">
										<button type="submit" class="btn btn-primary" id="saveFptk" name="saveFptk">Save</button>
										<button type="button" class="btn btn-default" id="batalFptk">Cancel</button>
									</div>
								</div>
						</form>
					</div>
					
					<div id="listFptk" class="show-list row">
						<div class="table-responsive">
							<div class="col-md-9">
								<?php
									$per_page = 50;
									$totalFptk = "SELECT * FROM fptk";
									$getTotalFptk = mysql_query($totalFptk);
									$resultTotalFptk = mysql_num_rows($getTotalFptk);
									$pages = ceil($resultTotalFptk/$per_page);
									//$queryShowFptk = "SELECT * from fptk ORDER BY namaPemohon ASC LIMIT 0, $per_page";
									$queryShowFptk = "SELECT * FROM fptk f ";
									$queryShowFptk .= "JOIN kategoriKerja kk1 ON kk1.idKategori = f.posisiPemohon ";
									$queryShowFptk .= "JOIN kategoriDepartemen kde1 ON kde1.idDepartemen = f.departemenPemohon ";
									$queryShowFptk .= "ORDER BY nomorFptk ASC LIMIT 0, $per_page";
									//$queryShowFptk .= "WHERE akunPemohon = '".$_SESSION['username']."'";
									
									$execShowFptk = mysql_query($queryShowFptk);
									if(mysql_num_rows($execShowFptk) < 1)
									{
										echo "<em>Tidak ada FPTK</em>";
									}
									else
									{
										?>
											<input type="hidden" value="<?php echo $pages;?>" id="pages">
											<div class="table-responsive" id="total-fptk">
												<table class="table table-hover table-condensed" style="width: 1000px; border: 1px #333;">
													<thead>
														<tr>
															<th>Action</th>
															<th>Nomor FPTK</th>
															<th>Nama Pemohon</th>
															<th>NIK Pemohon</th>
															<th>Posisi Pemohon</th>
															<th>Departemen Pemohon</th>
														</tr>
													</thead>
													<tbody>
														<?php
															while($result = mysql_fetch_array($execShowFptk))
															{
																?>
																	<tr>
																		<td>
																			<?php 
																				if ($result['namaManager']!='')
																				{}
																				else
																				{
																					?>
																						<button class="btn btn-primary btn-default" data-toggle="modal" data-target="#update-fptk<?php echo $result['idFptk'];?>">Edit</button> 
																						<button class="btn btn-primary btn-danger" data-toggle="modal" data-target="#delete-fptk<?php echo $result['idFptk'];?>">Delete</button>
																					<?php 
																				}
																			?>
																		</td>
																		<td><?php echo $result['nomorFptk']?></td>
																		<td><?php echo $result['namaPemohon']?></td>
																		<td><?php echo $result['nikPemohon']?></td>
																		<td><?php echo $result['namaKategori']?></td>
																		<td><?php echo $result['namaDepartemen']?></td>
																	</tr>
																	
																	<!-- Modal DELETE FPTK-->
																	<div class="modal fade" id="delete-fptk<?php echo $result['idFptk'];?>" tabindex="-1" role="dialog" aria-labelledby="label-delete-fptk<?php echo $result['idFptk'];?>" aria-hidden="true">
																		<div class="modal-dialog">
																			<div class="modal-content">
																				<div class="modal-header">
																					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																					<h4 class="modal-title" id="label-delete-fptk<?php echo $result['idFptk'];?>"><?php echo $result['namaPemohon'];?></h4>
																				</div>
																				<div class="modal-body">Apakah Anda yakin ingin menghapus FPTK ini?</div>
																				<div class="modal-footer">
																					<form action="fptkProcess.php" role="form" id="delete-fptk<?php echo $result['idFptk'];?>" method="post">
																						<input type="hidden" name="id-fptk" value="<?php echo $result['idFptk'];?>">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																						<button type="submit" class="btn btn-primary" name="delete-fptk">Delete</button>
																					</form>
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	<!-- Modal Update FPTK-->
																	<div class="modal fade" id="update-fptk<?php echo $result['idFptk'];?>" tabindex="-1" role="dialog" aria-labelledby="update-modal-label-fptk<?php echo $result['idFptk'];?>" aria-hidden="true">
																		<div class="modal-dialog">
																			<div class="modal-content">
																				<div class="modal-header">
																					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																					<h4 class="modal-title" id="update-modal-label-fptk<?php echo $result['idFptk'];?>"><?php echo $result['namaPemohon'];?></h4>
																				</div>
																				<div class="modal-body">
																					<form action="fptkProcess.php" role="form" id="update-fptk<?php echo $result['idFptk'];?>" method="post">
																						<input type="hidden" name="id-fptk" value="<?php echo $result['idFptk'];?>">
																						<h4>I. Pemohon</h4>
																						<div class="form-group">
																							<label for="pemohon-nama<?php echo $result['idFptk'];?>">Nama Pemohon</label>
																							<input type="text" name="pemohon-nama" id="pemohon-nama<?php echo $result['idFptk'];?>" class="form-control" value="<?php echo $result['namaPemohon'];?>">
																						</div>
																						<div class="form-group">
																							<label for="pemohon-nik<?php echo $result['idFptk'];?>">NIK</label>
																							<input type="text" name="pemohon-nik" class="form-control" id="pemohon-nik" value="<?php echo $result['nikPemohon'];?>">
																						</div>
																						<div class="form-group">
																							<label for="pemohon-posisi<?php echo $result['idFptk'];?>">Posisi/Jabatan</label>
																							<?php
																								$queryPosisi = "SELECT * FROM kategoriKerja ORDER BY namaKategori ASC";
																								$execPosisi = mysql_query($queryPosisi);
																							?>
																							<select name="pemohon-posisi" id="pemohon-posisi<?php echo $result['idFptk'];?>" class="form-control">
																								<option value="" disabled>-- Pilih posisi --</option>
																								<?php
																									while($resultPosisi = mysql_fetch_array($execPosisi))
																									{
																										?><option value="<?php echo $resultPosisi['idKategori'];?>" <?php if($resultPosisi['idKategori'] == $result['posisiPemohon']) {echo "selected";}?>> <?php echo $resultPosisi['namaKategori'];?></option><?php
																									}
																								?>
																							</select>
																							<div class="input-group">
																								<input type="text" id="pemohon-posisiBaru<?php echo $result['idFptk'];?>" name="pemohon-posisiBaru" class="form-control" value="<?php echo $result['posisiBaruPemohon'];?>">
																							</div>
																						</div>
																						<div class="form-group">
																							<label for="pemohon-departemen<?php echo $result['idFptk'];?>">Departemen</label>
																							<?php
																								$queryDepartemen = "SELECT * FROM kategoriDepartemen ORDER BY namaDepartemen ASC";
																								$execDepartemen = mysql_query($queryDepartemen);
																							?>
																							<select name="pemohon-departemen" id="pemohon-departemen<?php echo $result['idFptk'];?>" class="form-control">
																								<option value="" disabled>-- Pilih departemen --</option>
																								<?php
																									while($resultDepartemen = mysql_fetch_array($execDepartemen))
																									{
																										?><option value="<?php echo $resultDepartemen['idDepartemen'];?>" <?php if($resultDepartemen['idDepartemen'] == $result['departemenPemohon']) {echo "selected";}?>> <?php echo $resultDepartemen['namaDepartemen'];?></option><?php
																									}
																								?>
																							</select>
																						</div>
																						
																						<h4>II. Informasi Posisi</h4>
																						<div class="form-group">
																							<label for="posisi-divisi<?php echo $result['idFptk'];?>">Divisi</label>
																							<?php
																								$queryDivisiPosisi = "SELECT * FROM kategoriDivisi ORDER BY namaDivisi ASC";
																								$execDivisiPosisi = mysql_query($queryDivisiPosisi);
																							?>
																							<select name="posisi-divisi" id="posisi-divisi<?php echo $result['idFptk'];?>" class="form-control">
																								<option value="" disabled>-- Pilih divisi --</option>
																								<?php
																									while($resultDivisiPosisi= mysql_fetch_array($execDivisiPosisi))
																									{
																										?><option value="<?php echo $resultDivisiPosisi['idDivisi'];?>" <?php if($resultDivisiPosisi['idDivisi'] == $result['divisiPosisi']) {echo "selected";}?>> <?php echo $resultDivisiPosisi['namaDivisi'];?></option><?php
																									}
																								?>
																							</select>
																						</div>
																						<div class="form-group">
																							<label for="posisi-departemen<?php echo $result['idFptk'];?>">Departemen</label>
																							<?php
																								$queryDepartemenPosisi = "SELECT * FROM kategoriDepartemen ORDER BY namaDepartemen ASC";
																								$execDepartemenPosisi = mysql_query($queryDepartemenPosisi);
																							?>
																							<select name="posisi-departemen" id="posisi-departemen<?php echo $result['idFptk'];?>" class="form-control">
																								<option value="" disabled>-- Pilih departemen --</option>
																								<?php
																									while($resultDepartemenPosisi = mysql_fetch_array($execDepartemenPosisi))
																									{
																										?><option value="<?php echo $resultDepartemenPosisi['idDepartemen'];?>" <?php if($resultDepartemenPosisi['idDepartemen'] == $result['departemenPosisi']) {echo "selected";}?>> <?php echo $resultDepartemenPosisi['namaDepartemen'];?></option><?php
																									}
																								?>
																							</select>
																						</div>
																						<div class="form-group">
																							<label for="posisi-jabatan<?php echo $result['idFptk'];?>">Posisi/Jabatan</label>
																							<?php
																								$queryPosisi2 = "SELECT * FROM kategoriKerja ORDER BY namaKategori ASC";
																								$execPosisi2 = mysql_query($queryPosisi2);
																							?>
																							<select name="posisi-jabatan" id="posisi-jabatan<?php echo $result['idFptk'];?>" class="form-control">
																								<option value="" disabled>-- Pilih posisi --</option>
																								<?php
																									while($resultPosisi2 = mysql_fetch_array($execPosisi2))
																									{
																										?><option value="<?php echo $resultPosisi2['idKategori'];?>" <?php if($resultPosisi2['idKategori'] == $result['jabatanPosisi']) {echo "selected";}?>> <?php echo $resultPosisi2['namaKategori'];?></option><?php
																									}
																								?>
																							</select>
																							<div class="input-group">
																								<input type="text" id="posisi-jabatanBaru<?php echo $result['idFptk'];?>" name="posisi-jabatanBaru" class="form-control" value="<?php echo $result['jabatanBaruPosisi'];?>">
																							</div>
																						</div>
																						<div class="form-group">
																							<label for="posisi-level<?php echo $result['idFptk'];?>">Level</label>
																							<?php
																								$queryLevel = "SELECT * FROM kategoriLevel ORDER BY namaLevel ASC";
																								$execLevel = mysql_query($queryLevel);
																							?>
																							<select name="posisi-level" id="posisi-level<?php echo $result['idFptk'];?>" class="form-control">
																								<option value="" disabled>-- Pilih level --</option>
																								<?php
																									while($resultLevel = mysql_fetch_array($execLevel))
																									{
																										?><option value="<?php echo $resultLevel['idLevel'];?>" <?php if($resultLevel['idLevel'] == $result['levelPosisi']) {echo "selected";}?>> <?php echo $resultLevel['namaLevel'];?></option><?php
																									}
																								?>
																							</select>
																						</div>
																						<div class="form-group">
																							<label for="posisi-lokasi<?php echo $result['idFptk'];?>">Lokasi Penempatan</label>
																							<?php
																								$queryProvinsi = "SELECT * FROM tableProvinsi ORDER BY namaProvinsi ASC";
																								$execProvinsi = mysql_query($queryProvinsi);
																							?>
																							<select name="posisi-lokasi" id="posisi-lokasi<?php echo $result['idFptk'];?>" class="form-control">
																								<option value="" disabled>-- Pilih lokasi penempatan --</option>
																								<?php
																									while($resultProvinsi = mysql_fetch_array($execProvinsi))
																									{ 
																										?><option value="<?php echo $resultProvinsi['idProvinsi'];?>" <?php if($resultProvinsi['idProvinsi'] == $result['lokasiPosisi']) {echo "selected";}?>> <?php echo $resultProvinsi['namaProvinsi'];?></option><?php
																									}
																								?>
																							</select>
																						</div>
																						<div class="form-group">
																							<label for="posisi-jumlah<?php echo $result['idFptk'];?>">Jumlah Kebutuhan</label>
																							<input type="text" name="posisi-jumlah" class="form-control" id="posisi-jumlah" value="<?php echo $result['jumlahPosisi'];?>">
																						</div>
																						<div class="form-group">
																							<label for="posisi-tujuan<?php echo $result['idFptk'];?>">Tujuan Permintaan</label>
																							<label class="radio-inline"><input type="radio" name="posisi-tujuan" id="posisi-tujuanBaru" <?php if($result['tujuanPosisi'] == "Rekrut Baru"){ echo "checked";}?> value="Rekrut Baru" default>Rekrut Baru</label>
																							<label class="radio-inline"><input type="radio" name="posisi-tujuan" id="posisi-tujuanGanti" <?php if($result['tujuanPosisi'] == "Penggantian"){ echo "checked";}?> value="Penggantian">Penggantian</label>
																							<div class="input-group">
																								<input type="text" id="posisi-pengganti" name="posisi-pengganti" class="form-control" value="<?php echo $result['penggantiPosisi'];?>">
																							</div>
																						</div>
																						
																						<div class="form-group">
																							<label for="posisi-keterangan<?php echo $result['idFptk'];?>">Keterangan</label>
																							<textarea type="text" name="posisi-keterangan" class="form-control" id="posisi-keterangan" value="<?php echo $result['keteranganPosisi'];?>"></textarea>
																						</div>
																						<div class="form-group">
																							<label for="posisi-tanggal<?php echo $result['idFptk'];?>">Tanggal Dibutuhkan</label>
																							<?php $lahir = new DateTime($result['tanggalPosisi']);?>
																							<input type="date" class="form-control" name="posisi-tanggal" id="posisi-tanggal" value="<?php echo $lahir->format('d-m-Y');?>">
																						</div>
																						<div class="form-group">
																							<label for="posisi-jobdes<?php echo $result['idFptk'];?>">Deskripsi Kerja</label>
																							<label class="radio-inline"><input type="radio" name="posisi-jobdes" id="posisi-jobdesAda" <?php if($result['jobdesPosisi'] == "Ada"){ echo "checked";}?> value="Ada" default>Ada</label>
																							<label class="radio-inline"><input type="radio" name="posisi-jobdes" id="posisi-jobdesTidak" <?php if($result['jobdesPosisi'] == "Tidak Ada"){ echo "checked";}?> value="Tidak Ada">Tidak Ada</label>
																							<p class="help-block">*Jika tidak ada, wajib membuat dan melampirkan.</p>
																						</div>
																						<div class="form-group">
																							<label for="posisi-status<?php echo $result['idFptk'];?>">Status Karyawan</label>
																							<label class="radio-inline"><input type="radio" name="posisi-status" id="posisi-statusBulanan" <?php if($result['statusPosisi'] == "Bulanan"){ echo "checked";}?> value="Bulanan" default>Bulanan</label>
																							<label class="radio-inline"><input type="radio" name="posisi-status" id="posisi-statusHarian" <?php if($result['statusPosisi'] == "Harian"){ echo "checked";}?> value="Harian">Harian</label>
																						</div>
																						
																						<h4>III. Kualifikasi</h4>
																						<div class="form-group">
																							<label for="kualifikasi-jumlahl<?php echo $result['idFptk'];?>">Jumlah Dibutuhkan</label>
																							<div class="input-group">
																								<div class="input-group-addon">Laki-Laki</div>
																								<input type="text" name="kualifikasi-jumlahl" class="form-control" id="kualifikasi-jumlahl" value="<?php echo $result['jumlahlKualifikasi'];?>">
																							</div>
																						</div>
																						<div class="form-group">
																							<div class="input-group">
																								<div class="input-group-addon">Perempuan</div>
																								<input type="text" name="kualifikasi-jumlahp" class="form-control" id="kualifikasi-jumlahp" value="<?php echo $result['jumlahpKualifikasi'];?>">
																							</div>
																						</div>
																						<div class="form-group">
																							<label for="kualifikasi-usia<?php echo $result['idFptk'];?>">Usia</label>
																							<input type="text" name="kualifikasi-usia" class="form-control" id="kualifikasi-usia" placeholder="Usia" value="<?php echo $result['usiaKualifikasi'];?>">
																						</div>
																						<div class="form-group">
																							<label for="kualifikasi-pendidikan<?php echo $result['idFptk'];?>">Pendidikan</label>
																							<?php
																								$queryPendidikan = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
																								$execPendidikan = mysql_query($queryPendidikan);
																							?>
																							<select name="kualifikasi-pendidikan" id="kualifikasi-pendidikan<?php echo $result['idFptk'];?>" class="form-control">
																								<?php
																									while($resultPendidikan = mysql_fetch_array($execPendidikan))
																									{
																										?><option value="<?php echo $resultPendidikan['gradePendidikan'];?>" <?php if($resultPendidikan['gradePendidikan'] == $result['pendidikanKualifikasi']) {echo "selected";}?>> <?php echo $resultPendidikan['namaPendidikan'];?></option><?php
																									}
																								?>
																							</select>
																						</div>
																						<div class="form-group">
																							<label for="kualifikasi-jurusan<?php echo $result['idFptk'];?>">Jurusan</label>
																							<?php
																								$queryJurusan = "SELECT * FROM tableJurusan ORDER BY namaJurusan ASC";
																								$execJurusan = mysql_query($queryJurusan);
																							?>
																							<select name="kualifikasi-jurusan" id="kualifikasi-jurusan<?php echo $result['idFptk'];?>" class="form-control">
																								<?php
																									while($resultJurusan = mysql_fetch_array($execJurusan))
																									{
																										?><option value="<?php echo $resultJurusan['idJurusan'];?>" <?php if($resultJurusan['idJurusan'] == $result['jurusanKualifikasi']) {echo "selected";}?>> <?php echo $resultJurusan['namaJurusan'];?></option><?php
																									}
																								?>
																							</select>
																						</div>
																						<div class="form-group">
																							<label for="kualifikasi-pengalaman<?php echo $result['idFptk'];?>">Pengalaman</label>
																							<input type="text" name="kualifikasi-pengalaman" class="form-control" id="kualifikasi-pengalaman" value="<?php echo $result['pengalamanKualifikasi'];?>">
																						</div>
																						<div class="form-group">
																							<label for="kualifikasi-lainlain<?php echo $result['idFptk'];?>">Lain-Lain</label>
																							<textarea type="text" name="kualifikasi-lainlain" class="form-control" id="kualifikasi-lainlain" placeholder="Lain-Lain" value="<?php echo $result['lainlainKualifikasi'];?>"></textarea>
																						</div>
																				</div>
																						<div class="modal-footer">
																							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																							<button type="submit" class="btn btn-primary" name="update-fptk">Update</button>
																					</form>
																						</div>
																			</div>
																		</div>
																	</div>
																<?php
															}
														?>
													</tbody>
												</table>
											</div>
										<?php
									} 
								?>
								<?php if($pages > 1){ ?><ul id="pagination" class="pagination-sm"></ul><?php }?>
							</div>
						</div>
					</div>
				<?php
			include("templates/foot.php");
		}
		else if(isset($_SESSION['admin']))
		{
			header("Location:../admin/");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>