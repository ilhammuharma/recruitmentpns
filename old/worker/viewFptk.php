<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/print.css" type="text/css"  />
	</head>
	<style>
		@media print 
		{
			input.noPrint { display: none; }
		}
	</style>
	
	<body class="body">
		<div id="wrapper">
			<?php
				session_start();
				$liat = "fptk";
				include("../assets/dbconfig.php");
				include("templates/head.php");
				if(!isset($_GET['id']))
				{
					?>
						<div class="container">
							<div class="row">
								<div class="col-md-9">
									<h3><?php echo "Link is not valid";?> </h3>
								</div>
								<?php include("templates/right-menu.php");?>
							</div>
						</div>
					<?php
				}
				else
				{
					$id = $_GET['id'];
					$queryShowFptk = "SELECT f.idFptk, f.namaPemohon, f.nikPemohon, f.posisiPemohon, kk1.namaKategori as posisi1, f.departemenPosisi, kde1.namaDepartemen as departemen1, 
									f.divisiPosisi, kdi.namaDivisi, f.departemenPosisi, kde2.namaDepartemen as departemen2, f.jabatanPosisi, kk2.namaKategori as posisi2, f.levelPosisi, kl.namaLevel, f.lokasiPosisi, tpr.namaProvinsi, f.jumlahPosisi, 
									f.tujuanPosisi, f.mppPosisi, f.keteranganPosisi, f.tanggalPosisi, f.jobdesPosisi, f.statusPosisi, 
									f.jumlahlKualifikasi, f.jumlahpKualifikasi, f.usiaKualifikasi, f.pendidikanKualifikasi, tpe.namaPendidikan, f.jurusanKualifikasi, tj.namaJurusan, f.pengalamanKualifikasi, f.lainlainKualifikasi, f.nomorFptk FROM fptk f ";
					$queryShowFptk .= "JOIN kategoriKerja kk1 ON kk1.idKategori = f.posisiPemohon ";
					$queryShowFptk .= "JOIN kategoriDepartemen kde1 ON kde1.idDepartemen = f.departemenPemohon ";
					$queryShowFptk .= "JOIN kategoriDivisi kdi ON kdi.idDivisi = f.divisiPosisi ";
					$queryShowFptk .= "JOIN kategoriDepartemen kde2 ON kde2.idDepartemen = f.departemenPosisi ";
					$queryShowFptk .= "JOIN kategoriKerja kk2 ON kk2.idKategori = f.jabatanPosisi ";
					$queryShowFptk .= "JOIN kategoriLevel kl ON kl.idLevel = f.levelPosisi ";
					$queryShowFptk .= "JOIN tableProvinsi tpr ON tpr.idProvinsi = f.lokasiPosisi ";
					$queryShowFptk .= "JOIN tingkatPendidikan tpe ON tpe.gradePendidikan = f.pendidikanKualifikasi ";
					$queryShowFptk .= "JOIN tableJurusan tj ON tj.idJurusan = f.jurusanKualifikasi ";
					$queryShowFptk .= "WHERE idFptk = $id";
									
					$execShowFptk = mysql_query($queryShowFptk);
					$resultFptk = mysql_fetch_array($execShowFptk);
					if(mysql_num_rows($execShowFptk) < 1)
					{
						?>
							<div class="container">
								<div class="row">
									<div class="col-md-9">
										<h3><?php echo "Not valid";?> </h3>
									</div>
									<?php include("templates/right-menu.php");?>
								</div>
							</div>
						<?php
					}
					else
					{
						?>
							<div class="container">
								<div class="row">
									<div class="col-md-9">
										<div class="box-no-border">
											<div class="row" align="center">
												<h3><strong><td>FORMULIR PERMINTAAN TENAGA KERJA</td></strong></h3>
												<h3><strong><td>No: <?php echo $resultFptk['nomorFptk'];?></td></strong></h3>
											</div>
											
											<hr>
											<div class="row">
												<h4><strong><span class="glyphicon glyphicon-user"></span> I. PEMOHON</strong></h4>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Nama Pemohon</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['namaPemohon'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">NIK Pemohon</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['nikPemohon'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Posisi Pemohon</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['posisi1'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Departemen Pemohon</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['departemen1'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
											</div>
												
											<hr>
											<div class="row">
												<h4><strong><span class="glyphicon glyphicon-user"></span> II. INFORMASI POSISI</strong></h4>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Divisi</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['namaDivisi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Departemen</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['departemen2'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Posisi/Jabatan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['posisi2'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Level</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['namaLevel'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Lokasi Penempatan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['namaProvinsi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Jumlah Kebutuhan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['jumlahPosisi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Tujuan Permintaan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['tujuanPosisi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Sesuai MPP?</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['mppPosisi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Keterangan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['keteranganPosisi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Tanggal Dibutuhkan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['tanggalPosisi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Job Description</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['jobdesPosisi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Status Karyawan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['statusPosisi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
											</div>
												
												
											<hr>
											<div class="row">
												<h4><strong><span class="glyphicon glyphicon-search"></span> III. KUALIFIKASI</strong></h4>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Jumlah Dibutuhkan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<p class="help-block">Laki-Laki</p>
															<tbody>
																<tr><td><?php echo $resultFptk['jumlahlKualifikasi'];?></td></tr>
															</tbody>
															<p class="help-block">Perempuan</p>
															<tbody>
																<tr><td><?php echo $resultFptk['jumlahpKualifikasi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Usia</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['usiaKualifikasi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Pendidikan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['namaPendidikan'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Jurusan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['namaJurusan'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Pengalaman</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['pengalamanKualifikasi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Lain-Lain</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<tbody>
																<tr><td><?php echo $resultFptk['lainlainKualifikasi'];?></td></tr>
															</tbody>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
					}
				}
			include("templates/foot.php");
			?>
			<div style="text-align:center;padding:20px;">
				<input class="noPrint" type="button" value="Cetak" onclick="window.print()">
			</div>
		</div>
	</body>
</html>