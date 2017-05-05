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
				$head = "";
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
					$queryShowWorker = "SELECT * FROM userWorker WHERE idWorker = $id";
					$execShowWorker = mysql_query($queryShowWorker);
					$resultWorker = mysql_fetch_array($execShowWorker);
					if(mysql_num_rows($execShowWorker) < 1)
					{
						?>
							<div class="container">
								<div class="row">
									<div class="col-md-9">
										<h3><?php echo "Not a valid worker";?> </h3>
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
											<div class="media">
												<img src="
												<?php 
													if($resultWorker['pathFoto'] != $webRoot.'upload/default.gif')
													{
														echo $resultWorker['pathFoto'];
													}
													else
													{
														echo $webRoot.'upload/default_avatar-300x300.png';
													}
												?>" alt="" class="pull-left" width="200px">
												<div class="media-body">
													<h3 class="media-header"><?php echo $resultWorker['namaUser'];?></h3>
													<div class="row">
														<div class="col-md-6">
															<p class="help-block"><i class="fa fa-home"></i> <?php echo $resultWorker['alamat'];?></p>
															<?php
																$birth = new DateTime($resultWorker['birthday']);
																$now = new DateTime();
																$age = $now->diff($birth);
															?>
															<p class="help-block">
																<i class="fa fa-user"></i> 
																<?php 
																	echo $age->y." tahun, ".$age->m." bulan (";
																	if($resultWorker['gender'] == "L"){
																		echo "<i class='fa fa-male'></i>)";
																	}else{
																		echo "<i class='fa fa-female'></i>)";
																	}
																?>
															</p>
														</div>
														<div class="col-md-6">
															<p class="help-block"><i class="fa fa-mobile-phone"></i> 
																<?php 
																	echo $resultWorker['noPonsel'];
																	if($resultWorker['otherPonsel'] != "+62"){
																		echo ", ".$resultWorker['otherPonsel'];
																	}
																?>
															</p>
															<p class="help-block"><i class="fa fa-at"></i> <?php echo $resultWorker['emailUser'];?></p>
														</div>
													</div>
												</div>
											</div>
											
											<hr>
											<div class="row">
												<h4><span class="fa fa-university"></span> Pendidikan</h4>
												<?php
													$queryShowPendidikan = "SELECT pw.namaInstansi, tp.namaProvinsi, tpend.namaPendidikan, tj.namaJurusan, pw.nilai, pw.tahunLulus FROM pendidikanWorker pw ";
													$queryShowPendidikan .= "JOIN tableProvinsi tp ON pw.lokasiInstansi = tp.idProvinsi ";
													$queryShowPendidikan .= "JOIN tingkatPendidikan tpend ON pw.kualifikasiPendidikan = tpend.gradePendidikan ";
													$queryShowPendidikan .= "JOIN tableJurusan tj ON pw.jurusanPendidikan = tj.idJurusan ";
													$queryShowPendidikan .= "WHERE idWorker = $id ORDER BY tahunLulus DESC";

													$execShowPendidikan = mysql_query($queryShowPendidikan);
													while($resultPendidikan = mysql_fetch_array($execShowPendidikan))
													{
														?>
															<div class="row">
																<div class="col-md-3">
																	<p class="help-block"><?php echo $resultPendidikan['tahunLulus'];?></p>
																</div>
																<div class="col-md-9">
																	<?php
																		echo "<strong> ".$resultPendidikan['namaInstansi']." </strong> [".$resultPendidikan['namaPendidikan']."]<br>";
																		echo $resultPendidikan['namaJurusan']." <br>";
																		echo "IPK/Nilai: ".$resultPendidikan['nilai']." <br>";
																		echo "<p><em> ".$resultPendidikan['namaProvinsi']." </em></p>"
																	?>
																</div>
															</div>
														<?php
													}
												?>
											</div>
									
											<hr>
											<div class="row">
												<h4><span class="glyphicon glyphicon-briefcase"></span> Pengalaman Kerja</h4>
												<?php
													$queryShowPengalaman = "SELECT pw.posisi, pw.namaPerusahaan, bu.namaBidangUsaha, tp.namaProvinsi, pw.awalKerja, pw.akhirKerja, pw.deskripsi FROM pengalamanWorker pw ";
													$queryShowPengalaman .= "JOIN bidangUsaha bu ON bu.idUsaha = pw.bidangUsaha ";
													$queryShowPengalaman .= "JOIN tableProvinsi tp ON tp.idProvinsi = pw.lokasi ";
													$queryShowPengalaman .= "WHERE idWorker = $id ORDER BY awalKerja DESC";

													$execShowPengalaman = mysql_query($queryShowPengalaman);
													while($resultPengalaman = mysql_fetch_array($execShowPengalaman))
													{
														$start = new DateTime($resultPengalaman['awalKerja']);
														if($resultPengalaman['akhirKerja'] == "0000-00-00")
														{
															$akhir = new DateTime();
															$end = "sekarang";
															$long = $start->diff($akhir);
														}
														else
														{
															$akhir = new DateTime($resultPengalaman['akhirKerja']);
															$end = $akhir->format("d M Y");
															$long = $start->diff($akhir);
														}
														?>
															<div class="row">
																<div class="col-md-3">
																	<?php echo "<p class='help-block'>".$start->format('d M Y')." - ".$end."</p>";?>
																	<?php echo "<p class='help-block'><em>(".$long->y." tahun, ".$long->m." bulan)</em></p>";?>
																</div>
																<div class="col-md-9">
																	<?php 
																		echo "<strong> ".$resultPengalaman['posisi']." </strong><br>";
																		echo "<p> ".$resultPengalaman['namaPerusahaan']." | ".$resultPengalaman['namaProvinsi']." <br>";
																		if($resultPengalaman['deskripsi'] != "")
																		{
																			echo "<em> ".$resultPengalaman['deskripsi']." </em></p>";
																		}
																	?>
																</div>
															</div>
														<?php
													}
												?>
											</div>
											
											<hr>
											<div class="row">
												<h4><span class="glyphicon glyphicon-certificate"></span> Keahlian/Skill</h4>
												<?php
													$queryBahasa = "SELECT sbw.idTable, sbw.idBahasa, tb.namaBahasa, sbw.tingkatLisan, tkl.tingkatKeahlian as lisan, sbw.tingkatMenulis, tkt.tingkatKeahlian as menulis, 
																	sbw.tingkatMembaca, tkb.tingkatKeahlian as membaca, sbw.keteranganBahasa FROM skillBahasaWorker sbw ";
													$queryBahasa .= "JOIN tableBahasa tb ON tb.idBahasa = sbw.idBahasa ";
													$queryBahasa .= "JOIN tingkatKeahlian tkl ON tkl.gradeKeahlian = sbw.tingkatLisan ";
													$queryBahasa .= "JOIN tingkatKeahlian tkt ON tkt.gradeKeahlian = sbw.tingkatMenulis ";
													$queryBahasa .= "JOIN tingkatKeahlian tkb ON tkb.gradeKeahlian = sbw.tingkatMembaca ";
													$queryBahasa .= "WHERE idWorker = $id";
													$execBahasa = mysql_query($queryBahasa);
												?>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Keahlian Bahasa</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr>
																		<th>Keahlian Bahasa</th>
																		<th>Lisan</th>
																		<th>Menulis</th>
																		<th>Membaca</th>
																		<th>Keterangan</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		while($resultBahasa = mysql_fetch_array($execBahasa))
																		{
																			?>
																				<tr>
																					<td><?php echo $resultBahasa['namaBahasa'];?></td>
																					<td><?php echo $resultBahasa['lisan'];?></td>
																					<td><?php echo $resultBahasa['menulis'];?></td>
																					<td><?php echo $resultBahasa['membaca'];?></td>
																					<td><?php echo $resultBahasa['keteranganBahasa'];?></td>
																				</tr>
																			<?php
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
													
												<?php
													$querySkill = "SELECT sw.idSkill, sw.namaSkill, sw.tingkatSkill, tk.tingkatKeahlian as grade FROM skillWorker sw ";
													$querySkill .= "JOIN tingkatKeahlian tk ON tk.gradeKeahlian = sw.tingkatSkill ";
													$querySkill .= "WHERE idWorker = $id";
													$execSkill = mysql_query($querySkill);
												?>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Keahlian Lain</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr>
																		<th>Nama Keahlian</th>
																		<th>Tingkat Keahlian</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		while($resultSkill = mysql_fetch_array($execSkill))
																		{
																			?>
																				<tr>
																					<td><?php echo $resultSkill['namaSkill'];?></td>
																					<td><?php echo $resultSkill['grade'];?></td>
																				</tr>
																			<?php
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												
												<?php
													$queryMengemudi = "SELECT smw.idTableM, smw.idMengemudi, tm.namaMengemudi, smw.keahlianMengemudi, tkm.tingkatKeahlian as ahliMengemudi, smw.noSim FROM skillMengemudiWorker smw ";
													$queryMengemudi .= "JOIN tableMengemudi tm ON tm.idMengemudi = smw.idMengemudi ";
													$queryMengemudi .= "JOIN tingkatKeahlian tkm ON tkm.gradeKeahlian = smw.keahlianMengemudi ";
													$queryMengemudi .= "WHERE idWorker = $id";
													$execMengemudi = mysql_query($queryMengemudi);
												?>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Keahlian Mengemudi</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr>
																		<th>Nama Keahlian</th>
																		<th>Tingkat Keahlian</th>
																		<th>Nomor SIM</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		while($resultMengemudi = mysql_fetch_array($execMengemudi))
																		{
																			?>
																				<tr>
																					<td><?php echo $resultMengemudi['namaMengemudi'];?></td>
																					<td><?php echo $resultMengemudi['ahliMengemudi'];?></td>
																					<td><?php echo $resultMengemudi['noSim'];?></td>
																				</tr>
																			<?php
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												
												<?php
													$queryShowTraining = "SELECT stw.idTraining, stw.namaTraining, stw.penyelenggaraTraining, stw.tahunTraining, stw.keteranganTraining, tkt.tingkatKetTraining as gradeTraining FROM skillTrainingWorker stw ";
													$queryShowTraining .= "JOIN tingkatKetTraining tkt ON tkt.gradeKetTraining = stw.keteranganTraining ";
													$queryShowTraining .= "WHERE idWorker = $id";
													$execShowTraining = mysql_query($queryShowTraining) or die();
												?>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Training</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr>
																		<th>Nama Training/Seminar/Workshop</th>
																		<th>Lembaga Penyelenggara</th>
																		<th>Tahun</th>
																		<th>Keterangan</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		while($resultShowTraining = mysql_fetch_array($execShowTraining))
																		{
																			?>
																				<tr>
																					<td><?php echo $resultShowTraining['namaTraining'];?></td>
																					<td><?php echo $resultShowTraining['penyelenggaraTraining'];?></td>
																					<td><?php echo $resultShowTraining['tahunTraining'];?></td>
																					<td><?php echo $resultShowTraining['gradeTraining'];?></td>
																				</tr>
																			<?php
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											
											<hr>
											<div class="row">
												<h4><span class="glyphicon glyphicon-user"></span> Lingkungan Keluarga</h4>
												<?php
													$queryShowInti = "SELECT ki.idInti, ki.hubunganInti, hk.namaHubungan, ki.namaInti, ki.genderInti, ki.tempatLahirInti, ki.birthdayInti, ki.pendidikanInti, tp.namaPendidikan, 
																	ki.pekerjaanInti, ki.perusahaanInti FROM keluargaInti ki ";
													$queryShowInti .= "JOIN hubunganKeluarga hk ON hk.gradeHubungan = ki.hubunganInti ";
													$queryShowInti .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = ki.pendidikanInti ";
													$queryShowInti .= "WHERE idWorker = $id";
													$execShowInti = mysql_query($queryShowInti) or die();
												?>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Keluarga Inti</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr>
																		<th>Status Hubungan</th>
																		<th>Nama</th>
																		<th>Jenis Kelamin</th>
																		<th>Tempat Lahir</th>
																		<th>Tanggal Lahir</th>
																		<th>Pendidikan</th>
																		<th>Pekerjaan</th>
																		<th>Perusahaan</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		while($resultShowInti = mysql_fetch_array($execShowInti))
																		{
																			?>
																				<tr>
																					<td><?php echo $resultShowInti['namaHubungan'];?></td>
																					<td><?php echo $resultShowInti['namaInti'];?></td>
																					<td><?php echo $resultShowInti['genderInti'];?></td>
																					<td><?php echo $resultShowInti['tempatLahirInti'];?></td>
																					<td><?php echo $resultShowInti['birthdayInti'];?></td>
																					<td><?php echo $resultShowInti['namaPendidikan'];?></td>
																					<td><?php echo $resultShowInti['pekerjaanInti'];?></td>
																					<td><?php echo $resultShowInti['perusahaanInti'];?></td>
																				</tr>
																			<?php
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												
												<?php
													$queryShowBesar = "SELECT kb.idBesar, kb.hubunganBesar, hk.namaHubungan, kb.namaBesar, kb.genderBesar, kb.tempatLahirBesar, kb.birthdayBesar, kb.pendidikanBesar, tp.namaPendidikan, 
													kb.pekerjaanBesar, kb.perusahaanBesar FROM keluargaBesar kb ";
													$queryShowBesar .= "JOIN hubunganKeluarga hk ON hk.gradeHubungan = kb.hubunganBesar ";
													$queryShowBesar .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = kb.pendidikanBesar ";
													$queryShowBesar .= "WHERE idWorker = $id";
													$execShowBesar = mysql_query($queryShowBesar) or die();
												?>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Keluarga Besar</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr>
																		<th>Status Hubungan</th>
																		<th>Nama</th>
																		<th>Jenis Kelamin</th>
																		<th>Tempat Lahir</th>
																		<th>Tanggal Lahir</th>
																		<th>Pendidikan</th>
																		<th>Pekerjaan</th>
																		<th>Perusahaan</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		while($resultShowBesar = mysql_fetch_array($execShowBesar))
																		{
																			?>
																				<tr>
																					<td><?php echo $resultShowBesar['namaHubungan'];?></td>
																					<td><?php echo $resultShowBesar['namaBesar'];?></td>
																					<td><?php echo $resultShowBesar['genderBesar'];?></td>
																					<td><?php echo $resultShowBesar['tempatLahirBesar'];?></td>
																					<td><?php echo $resultShowBesar['birthdayBesar'];?></td>
																					<td><?php echo $resultShowBesar['namaPendidikan'];?></td>
																					<td><?php echo $resultShowBesar['pekerjaanBesar'];?></td>
																					<td><?php echo $resultShowBesar['perusahaanBesar'];?></td>
																				</tr>
																			<?php
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											</div>
											
											<hr>
											<div class="row">
												<h4><span class="glyphicon glyphicon-search"></span> Minat Kerja</h4>
												
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Cita-Cita</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr><th>Uraian</th></tr>
																</thead>
																<tbody>
																	<tr><td><?php echo $resultWorker['citaCita'];?></td></tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Motivasi Utama Bekerja</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr><th>Uraian</th></tr>
																</thead>
																<tbody>
																	<tr><td><?php echo $resultWorker['motivasiBekerja'];?></td></tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Alasan Bekerja</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr><th>Uraian</th></tr>
																</thead>
																<tbody>
																	<tr><td><?php echo $resultWorker['alasanBekerja'];?></td></tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Negotiable/Tidak</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr><th>Pilihan</th></tr>
																</thead>
																<tbody>
																	<tr><td><?php echo $resultWorker['negosiasiGaji'];?></td></tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Fasilitas/Tunjangan Yang Diharapkan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr><th>Uraian</th></tr>
																</thead>
																<tbody>
																	<tr><td><?php echo $resultWorker['tunjanganFasilitas'];?></td></tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Waktu Mulai Bekerja Jika Diterima</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr><th>Waktu</th></tr>
																</thead>
																<tbody>
																	<tr><td><?php echo $resultWorker['waktuBekerja'];?></td></tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<?php
													$queryKerjaDisukai = "SELECT jp1.namaJenisPekerjaan as jenis1, jp2.namaJenisPekerjaan as jenis2, jp3.namaJenisPekerjaan as jenis3, 
																		jp4.namaJenisPekerjaan as jenis4, jp5.namaJenisPekerjaan as jenis5 FROM userWorker pw ";
													$queryKerjaDisukai .= "JOIN jenisPekerjaan jp1 ON jp1.idJenisPekerjaan = pw.jenisPekerjaanDisukai1 ";
													$queryKerjaDisukai .= "JOIN jenisPekerjaan jp2 ON jp2.idJenisPekerjaan = pw.jenisPekerjaanDisukai2 ";
													$queryKerjaDisukai .= "JOIN jenisPekerjaan jp3 ON jp3.idJenisPekerjaan = pw.jenisPekerjaanDisukai3 ";
													$queryKerjaDisukai .= "JOIN jenisPekerjaan jp4 ON jp4.idJenisPekerjaan = pw.jenisPekerjaanDisukai4 ";
													$queryKerjaDisukai .= "JOIN jenisPekerjaan jp5 ON jp5.idJenisPekerjaan = pw.jenisPekerjaanDisukai5 ";
													$queryKerjaDisukai .= "WHERE idWorker = $id";
													$execKerjaDisukai = mysql_query($queryKerjaDisukai);
												?>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Prioritas Pekerjaan Yang Disukai</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr>
																		<th>Prioritas 1</th>
																		<th>Prioritas 2</th>
																		<th>Prioritas 3</th>
																		<th>Prioritas 4</th>
																		<th>Prioritas 5</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		while($resultKerjaDisukai = mysql_fetch_array($execKerjaDisukai))
																		{
																			?>
																				<tr>
																					<td><?php echo $resultKerjaDisukai['jenis1'];?></td>
																					<td><?php echo $resultKerjaDisukai['jenis2'];?></td>
																					<td><?php echo $resultKerjaDisukai['jenis3'];?></td>
																					<td><?php echo $resultKerjaDisukai['jenis4'];?></td>
																					<td><?php echo $resultKerjaDisukai['jenis5'];?></td>
																				</tr>
																			<?php
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<?php
													$queryLingkerDisukai = "SELECT lk1.namaLingkunganKerja as lingker1, lk2.namaLingkunganKerja as lingker2, lk3.namaLingkunganKerja as lingker3, 
																			lk4.namaLingkunganKerja as lingker4, lk5.namaLingkunganKerja as lingker5, lk6.namaLingkunganKerja as lingker6 FROM userWorker pw ";
													$queryLingkerDisukai .= "JOIN lingkunganKerja lk1 ON lk1.idLingkunganKerja = pw.lingkerDisukai1 ";
													$queryLingkerDisukai .= "JOIN lingkunganKerja lk2 ON lk2.idLingkunganKerja = pw.lingkerDisukai2 ";
													$queryLingkerDisukai .= "JOIN lingkunganKerja lk3 ON lk3.idLingkunganKerja = pw.lingkerDisukai3 ";
													$queryLingkerDisukai .= "JOIN lingkunganKerja lk4 ON lk4.idLingkunganKerja = pw.lingkerDisukai4 ";
													$queryLingkerDisukai .= "JOIN lingkunganKerja lk5 ON lk5.idLingkunganKerja = pw.lingkerDisukai5 ";
													$queryLingkerDisukai .= "JOIN lingkunganKerja lk6 ON lk6.idLingkunganKerja = pw.lingkerDisukai6 ";
													$queryLingkerDisukai .= "WHERE idWorker = $id";
													$execLingkerDisukai = mysql_query($queryLingkerDisukai);
												?>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Prioritas Lingkungan Pekerjaan Yang Disukai</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr>
																		<th>Prioritas 1</th>
																		<th>Prioritas 2</th>
																		<th>Prioritas 3</th>
																		<th>Prioritas 4</th>
																		<th>Prioritas 5</th>
																		<th>Prioritas 6</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		while($resultLingkerDisukai = mysql_fetch_array($execLingkerDisukai))
																		{
																			?>
																				<tr>
																					<td><?php echo $resultLingkerDisukai['lingker1'];?></td>
																					<td><?php echo $resultLingkerDisukai['lingker2'];?></td>
																					<td><?php echo $resultLingkerDisukai['lingker3'];?></td>
																					<td><?php echo $resultLingkerDisukai['lingker4'];?></td>
																					<td><?php echo $resultLingkerDisukai['lingker5'];?></td>
																					<td><?php echo $resultLingkerDisukai['lingker6'];?></td>
																				</tr>
																			<?php
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<?php
													$queryLokasi = "SELECT tp1.namaProvinsi as lokasi1, tp2.namaProvinsi as lokasi2, tp3.namaProvinsi as lokasi3 FROM userWorker pw ";
													$queryLokasi .= "JOIN tableProvinsi tp1 ON tp1.idProvinsi = pw.lokasiKerja1 ";
													$queryLokasi .= "JOIN tableProvinsi tp2 ON tp2.idProvinsi = pw.lokasiKerja2 ";
													$queryLokasi .= "JOIN tableProvinsi tp3 ON tp3.idProvinsi = pw.lokasiKerja3 ";
													$queryLokasi .= "WHERE idWorker = $id";
													$execLokasi = mysql_query($queryLokasi);
												?>
												<div class="row">
													<div class="col-md-3">
														<p class="help-block">Prioritas Lokasi Tempat Kerja Yang Diharapkan</p>
													</div>
													<div class="col-md-9">
														<div class="table-responsive">
															<table class="table table-hover table-condensed">
																<thead>
																	<tr>
																		<th>Prioritas 1</th>
																		<th>Prioritas 2</th>
																		<th>Prioritas 3</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		while($resultLokasi = mysql_fetch_array($execLokasi))
																		{
																			?>
																				<tr>
																					<td><?php echo $resultLokasi['lokasi1'];?></td>
																					<td><?php echo $resultLokasi['lokasi2'];?></td>
																					<td><?php echo $resultLokasi['lokasi3'];?></td>
																				</tr>
																			<?php
																		}
																		if($resultWorker['bersedia'] == 1)
																		{
																			echo "<i class='fa fa-check-circle'></i> Bersedia ditempatkan dimana saja";
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												
										
											
										<div class="row">
											<div class="col-md-3">
												<p class="help-block">Penempatan kerja yang diharapkan</p>
											</div>
											<div class="col-md-9">
												<?php
													$queryLokasi = "SELECT tp1.namaProvinsi as lokasi1, tp2.namaProvinsi as lokasi2, tp3.namaProvinsi as lokasi3, kk.namaKategori FROM userWorker pw ";
													$queryLokasi .= "JOIN tableProvinsi tp1 ON tp1.idProvinsi = pw.lokasiKerja1 ";
													$queryLokasi .= "JOIN tableProvinsi tp2 ON tp2.idProvinsi = pw.lokasiKerja2 ";
													$queryLokasi .= "JOIN tableProvinsi tp3 ON tp3.idProvinsi = pw.lokasiKerja3 ";
													$queryLokasi .= "JOIN kategoriKerja kk ON pw.cariKerja = kk.idKategori ";
													$queryLokasi .= "WHERE idWorker = $id";
													$execLokasi = mysql_query($queryLokasi);
													$resultLokasi = mysql_fetch_array($execLokasi);
													echo "Prioritas 1: ".$resultLokasi['lokasi1']." <br>";
													echo "Prioritas 2: ".$resultLokasi['lokasi2']." <br>";
													echo "Prioritas 3: ".$resultLokasi['lokasi3']." <br>";
													if($resultWorker['bersedia'] == 1){
														echo "<i class='fa fa-check-circle'></i> Bersedia ditempatkan dimana saja";
													}
												?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<p class="help-block"> Bidang pekerjaan yang diminati </p>
											</div>
											<div class="col-md-9">
												<p> <?php echo $resultLokasi['namaKategori'];?> </p>
											</div>
										</div>
									</div>
									<hr>
								</div>
							</div>
							<?php include("templates/right-menu.php");?>
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