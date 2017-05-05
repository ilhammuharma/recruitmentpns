<style>
	.print tr td
	{
		padding:1px 0px;
		vertical-align: top;
	}
</style>
<link rel="stylesheet" href="assets/print-invoice.css" media="print">
<link rel="stylesheet" href="../assets/css/jquery.popdown.css">
<link rel="stylesheet" href="../assets/css/tinybox.css">
<script type="text/javascript" src="../assets/js/tinybox.js"></script>

<div class="page-head">
	<h3 class="m-b-less">
	Vacancy
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li><a href="">Home</a></li>
			<li><a href="">Vacancy</a></li><?if(isset($_POST['i'])){ ?>
			<li class="active">List Vacancy</li>
			<? }else{?>
			<li class="active">View Vacancy</li>
			<? } ?>
		</ol>
    </div>
</div>           
	<!--body wrapper start-->
        <div class="wrapper">
			<?
				if(isset($_POST['idvacancy']))
				{
					$idvacancy = $_POST['idvacancy'];
					//$approve = $_POST['a'];
					$kategori = "Select *, kdep.namaDepartemen, ks.namaSection, kk.namaKategori, kl.namaLevel, kdis.namaDistrik, tp.namaPendidikan, tj.namaJurusan from vacancy v ";
					$kategori .= "JOIN kategoriDepartemen kdep ON v.department = kdep.idDepartemen ";
					$kategori .= "JOIN kategoriSection ks ON v.section = ks.idSection ";
					$kategori .= "JOIN kategoriKerja kk ON v.position = kk.idKategori ";
					$kategori .= "JOIN kategoriLevel kl ON v.level = kl.idLevel ";
					$kategori .= "JOIN kategoriDistrik kdis ON v.location = kdis.idDistrik ";
					$kategori .= "JOIN tingkatPendidikan tp ON v.education = tp.gradePendidikan ";
					$kategori .= "JOIN tableJurusan tj ON v.major = tj.idJurusan ";
					$kategori .= "WHERE idvacancy = $idvacancy";
					$execkategori = mysql_query($kategori);
					//echo $showfptk;
					$cet_ven = mysql_fetch_array($execkategori);
					
					/*$sortlist = "Select *, tp.namaProvinsi, ts.namaStatus from userWorker uw ";
					$sortlist .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
					$sortlist .= "JOIN tableStatusRekrut ts ON ts.idTable = uw.statusRekrut ";
					$sortlist .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."')";
					$execsortlist = mysql_query($sortlist);
					$cet_sortlist = mysql_fetch_array($execsortlist);*/
					
					$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
					$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
					$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
					$edu .= "where idWorker in (select idWorker from `userWorker` where namaUser='".$_SESSION['nama']."') order by tahunLulus desc limit 1";
					$execedu = mysql_query($edu);
					$cet_edu = mysql_fetch_array($execedu);
					?>
						<div class="panel invoice">
							<div class="panel-body">
								<div class="row">
									<img src="assets/img/invoice-logo.png" alt="" style="position:absolute; top: 10px; left:10px;"/>
									<div class="col-xs-12">
										<div class="total-purchase text-center">
											<h3><strong>FORM LOWONGAN KERJA</strong></h3>
											<h4><strong>NO: <?php echo $cet_ven['fptk'];?></strong></h4>
										</div>
									</div>
								</div>
								<br/>
								<br/>
								
								<div class="row"><div class="col-xs-12" style="font-size:16px;"><strong>PEMOHON</strong></div></div>
								<div class="row">
									<div class="col-xs-6">
										<table border="0" width="100%" class="print">
											<tr>
												<td width="150px">Pemohon</td>
												<td width="20px">:</td>
												<td><?php echo $cet_ven['createby'];?></td>
											</tr>
											<tr>
												<td>Tanggal Dibuat</td>
												<td>:</td>
												<td><?php tanggal2($cet_ven['createdate'])?></td>
											</tr>
										</table>
									</div>
								</div>
								<br/>
								
								<div class="row"><div class="col-xs-12" style="font-size:16px;"><strong>INFORMASI POSISI</strong></div></div>
									<div class="row">
										<div class="col-xs-6">
											<table border="0" width="100%" class="print">
												<tr>
													<td width="150px">Departemen</td>
													<td width="20px">:</td>
													<td><?php echo $cet_ven['namaDepartemen'];?></td>
												</tr>
												<tr>
													<td>Section</td>
													<td>:</td>
													<td><?php echo $cet_ven['namaSection'];?></td>
												</tr>
											</table>
										</div>
										<div class="col-xs-6">
											<table border="0" width="100%" class="print">
												<tr>
													<td width="150px">Posisi / Jabatan</td>
													<td width="20px">:</td>
													<td><?php echo $cet_ven['namaKategori'];?></td>
												</tr>
												<tr>
													<td>Level</td>
													<td>:</td>
													<td><?php echo $cet_ven['namaLevel'];?></td>
												</tr>
											</table>
										</div>
									</div>
									<br/>
									
									<div class="row"><div class="col-xs-12" style="font-size:16px;"><strong>KUALIFIKASI UMUM</strong></div></div>
									<div class="row">
										<div class="col-xs-12">
											<table border="0" width="100%" class="print">
												<tr>
													<td>Lokasi Penempatan</td>
													<td>:</td>
													<td><?php echo $cet_ven['namaDistrik'];?></td>
												</tr>
												<tr>
													<td>Lama Pengalaman</td>
													<td>:</td>
													<td><?php echo $cet_ven['experience'];?> Tahun</td>
												</tr>
												<tr>
													<td>Penawaran Gaji</td>
													<td>:</td>
													<td>Rp<?=number_format($cet_ven['salary'],0,'.',',')?></td>
												</tr>
												<tr>
													<td width="150px">Pendidikan</td>
													<td width="20px">:</td>
													<td>Universitas/Instansi : <?php echo $cet_ven['namaPendidikan'];?> <span style="margin-right:30px;"></span> Jurusan : <?php echo $cet_ven['namaJurusan'];?></td>
												</tr>
												<tr>
													<td>Minimal IPK</td>
													<td>:</td>
													<td><?php echo $cet_ven['gpa'];?></td>
												</tr>
												<tr>
													<td>Maksimal Usia</td>
													<td>:</td>
													<td><?php echo $cet_ven['age'];?> Tahun</td>
												</tr>
												<tr>
													<td>Batas Akhir</td>
													<td>:</td>
													<td><?php tanggal2($cet_ven['duedate'])?></td>
												</tr>
											</table>
										</div>
									</div>
									<br/>
									
									<div class="row"><div class="col-xs-12" style="font-size:16px;"><strong>KUALIFIKASI KHUSUS</strong></div></div>
									<div class="row">
										<div class="col-xs-12">
											<table border="0" width="100%" class="print">
												<tr>
													<td><?php echo $cet_ven['other'];?></td>
												</tr>
											</table>
										</div>
									</div>
									<br/>
									
									<div class="row"><div class="col-xs-12" style="font-size:16px;"><strong>DESKRIPSI KERJA</strong></div></div>
									<div class="row">
										<div class="col-xs-12">
											<table border="0" width="100%" class="print">
												<tr>
													<td><?php echo $cet_ven['jobdes'];?></td>
												</tr>
											</table>
										</div>
									</div>
									<br/>
									
									 <!--tab nav start-->
									<section class="isolate-tabs">
										<ul class="nav nav-tabs">
											<li class="active">
												<a data-toggle="tab" href="<?=$base_url?>index.php?r=vacancy-show#sourcing-iso">Sourcing</a>
											</li>
											<li class="">
												<a data-toggle="tab" href="<?=$base_url?>index.php?r=vacancy-show#sortlist-iso">Sortlist</a>
											</li>
											<li class="">
												<a data-toggle="tab" href="<?=$base_url?>index.php?r=vacancy-show#interviewhr-iso">Interview HR</a>
											</li>
											<li class="">
												<a data-toggle="tab" href="<?=$base_url?>index.php?r=vacancy-show#psikotest-iso">Psikotest</a>
											</li>
											<li class="">
												<a data-toggle="tab" href="<?=$base_url?>index.php?r=vacancy-show#interviewuser-iso">Interview User</a>
											</li>
											<li class="">
												<a data-toggle="tab" href="<?=$base_url?>index.php?r=vacancy-show#negotiatingsalary-iso">Negotiating Salary</a>
											</li>
											<li class="">
												<a data-toggle="tab" href="<?=$base_url?>index.php?r=vacancy-show#mcu-iso">Medical Check-Up</a>
											</li>
											<li class="">
												<a data-toggle="tab" href="<?=$base_url?>index.php?r=vacancy-show#join-iso">Join/Reject</a>
											</li>
										</ul>
										
										<div class="panel-body">
											<div class="tab-content">
												<div id="sourcing-iso" class="tab-pane active">
													<div class="tab_container">
														<table class="table table-striped table-hover">
															<thead>
															<tr bgcolor="#dedede">
																<td align="center"></td>
																<td align="center"><b>Nama</b></td>
																<td align="center"><b>Email</b></td>
																<td align="center"><b>Telepon</b></td>
																<td align="center"><b>Usia</b></td>
																<td align="center"><b>Domisili</b></td>
																<td align="center"><b>Pendidikan</b></td>
																<!--<td align="center"><b>Pengalaman</b></td>-->
															</tr>
															</thead>
															<tbody>
																<form method="post" action="<?=$base_url?>index.php?r=status-proses">
																<?
																	$vacancy = "select * from vacancyapply va ";
																	$vacancy .= "where idvacancy = '".$idvacancy."' and status='1' ";
																	$execvacancy = mysql_query($vacancy);
																	while($cet_vacancy=mysql_fetch_array($execvacancy))
																	{
																		$kandidat = "Select *, tp.namaProvinsi from userWorker uw ";
																		$kandidat .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
																		$kandidat .= "where idWorker = '".$cet_vacancy['idWorker']."' order by namaUser asc ";
																		$cet_kandidat = mysql_fetch_array(mysql_query($kandidat));
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut='1' order by namaUser asc";
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut in (select status from `vacancyapply` where status='1')  order by namaUser asc";*/
																	
																		$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
																		$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
																		$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
																		$edu .= "where idWorker = '".$cet_kandidat['idWorker']."' order by tahunLulus desc limit 1";
																		$cet_edu = mysql_fetch_array(mysql_query($edu));
																		?>
																			<tr>
																				<td align="center"><input type="checkbox" name="sourcing[]" value="<?php echo $cet_kandidat['idWorker']?>"></td> 
																				<td align="center"><a href="<?=$base_url?>index.php?r=candidate-profile&id=<?=$cet_kandidat['idWorker']?>"><?=$cet_kandidat['namaUser']?></a></td>
																				<td align="center"><?=$cet_kandidat['email']?></td>
																				<td align="center"><?=$cet_kandidat['noPonsel']?></td>
																				<td align="center"><?=$cet_kandidat['usia']?> tahun</td>
																				<td align="center"><?=$cet_kandidat['namaProvinsi']?></td>
																				<td align="center">
																					<? if($cet_edu['namaPendidikan']!='')
																					{ echo $cet_edu['namaPendidikan'], $cet_edu['namaJurusan']; }
																					else
																					{ echo ''; } ?>
																				</td>
																			</tr>
																		<?
																	}
																?>
															</tbody>
														</table>
																	<div class="form-group">
																		<input class="btn btn-success" type="submit" value="Verifikasi" name="verifikasisourcing" class="alt_btn">
																	</div>
													</div>
																</form>
												</div>
												
												<div id="sortlist-iso" class="tab-pane">
													<div class="tab_container">
														<table class="table table-striped table-hover">
															<thead>
																<tr bgcolor="#dedede">
																	<td align="center"></td>
																	<td align="center"><b>Nama</b></td>
																	<td align="center"><b>Email</b></td>
																	<td align="center"><b>Telepon</b></td>
																	<td align="center"><b>Usia</b></td>
																	<td align="center"><b>Domisili</b></td>
																	<td align="center"><b>Pendidikan</b></td>
																	<!--<td align="center"><b>Pengalaman</b></td>-->
																</tr>
															</thead>
															<tbody>
																<form method="post" action="<?=$base_url?>index.php?r=status-proses">
																<?
																	$vacancy = "select * from vacancyapply va ";
																	$vacancy .= "where idvacancy = '".$idvacancy."' and status='2' ";
																	$execvacancy = mysql_query($vacancy);
																	while($cet_vacancy=mysql_fetch_array($execvacancy))
																	{
																		$kandidat = "Select *, tp.namaProvinsi from userWorker uw ";
																		$kandidat .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
																		$kandidat .= "where idWorker = '".$cet_vacancy['idWorker']."' order by namaUser asc ";
																		$cet_kandidat = mysql_fetch_array(mysql_query($kandidat));
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut='1' order by namaUser asc";
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut in (select status from `vacancyapply` where status='1')  order by namaUser asc";*/
																	
																		$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
																		$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
																		$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
																		$edu .= "where idWorker = '".$cet_kandidat['idWorker']."' order by tahunLulus desc limit 1";
																		$cet_edu = mysql_fetch_array(mysql_query($edu));
																		?>
																			<tr> 
																				<td align="center"><input type="checkbox" name="sortlist[]" value="<?php echo $cet_kandidat['idWorker']?>"></td> 
																				<td align="center"><a href="<?=$base_url?>index.php?r=candidate-profile&id=<?=$cet_kandidat['idWorker']?>"><?=$cet_kandidat['namaUser']?></a></td>
																				<td align="center"><?=$cet_kandidat['email']?></td>
																				<td align="center"><?=$cet_kandidat['noPonsel']?></td>
																				<td align="center"><?=$cet_kandidat['usia']?> tahun</td>
																				<td align="center"><?=$cet_kandidat['namaProvinsi']?></td>
																				<td align="center">
																					<? if($cet_edu['namaPendidikan']!='')
																					{ echo $cet_edu['namaPendidikan'], $cet_edu['namaJurusan']; }
																					else
																					{ echo ''; } ?>
																				</td>
																			</tr>
																		<?
																	}
																?>
															</tbody>
														</table>
																	<div class="form-group">
																		<input class="btn btn-success" type="submit" value="Verifikasi" name="verifikasisortlist" class="alt_btn">
																	</div>
																</form>
													</div>
												</div>
												
												<div id="interviewhr-iso" class="tab-pane">
													<div class="tab_container">
														<table class="table table-striped table-hover">
															<thead>
																<tr bgcolor="#dedede">
																	<td align="center"></td>
																	<td align="center"><b>Nama</b></td>
																	<td align="center"><b>Email</b></td>
																	<td align="center"><b>Telepon</b></td>
																	<td align="center"><b>Usia</b></td>
																	<td align="center"><b>Domisili</b></td>
																	<td align="center"><b>Pendidikan</b></td>
																	<td align="center"><b>Options</b></td>
																</tr>
															</thead>
															<tbody>
																<form method="post" action="<?=$base_url?>index.php?r=status-proses">
																<?
																	$vacancy = "select * from vacancyapply va ";
																	$vacancy .= "where idvacancy = '".$idvacancy."' and status='3' ";
																	$execvacancy = mysql_query($vacancy);
																	while($cet_vacancy=mysql_fetch_array($execvacancy))
																	{
																		$kandidat = "Select *, tp.namaProvinsi from userWorker uw ";
																		$kandidat .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
																		$kandidat .= "where idWorker = '".$cet_vacancy['idWorker']."' order by namaUser asc ";
																		$cet_kandidat = mysql_fetch_array(mysql_query($kandidat));
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut='1' order by namaUser asc";
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut in (select status from `vacancyapply` where status='1')  order by namaUser asc";*/
																	
																		$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
																		$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
																		$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
																		$edu .= "where idWorker = '".$cet_kandidat['idWorker']."' order by tahunLulus desc limit 1";
																		$cet_edu = mysql_fetch_array(mysql_query($edu));
																		
																		$penilaian = "select * from penilaian_summary ps ";
																		$penilaian .= "where idWorker = '".$cet_kandidat['idWorker']."' and tipe_penilaian = '1' ";
																		$cet_pen = mysql_fetch_array(mysql_query($penilaian));
																		?>
																			<tr> 
																				<td align="center"><input type="checkbox" name="interviewhr[]" value="<?php echo $cet_kandidat['idWorker']?>"></td> 
																				<td align="center"><?=$cet_kandidat['namaUser']?></td>
																				<td align="center"><?=$cet_kandidat['email']?></td>
																				<td align="center"><?=$cet_kandidat['noPonsel']?></td>
																				<td align="center"><?=$cet_kandidat['usia']?> tahun</td>
																				<td align="center"><?=$cet_kandidat['namaProvinsi']?></td>
																				<td align="center">
																					<? if($cet_edu['namaPendidikan']!='')
																					{ echo $cet_edu['namaPendidikan'], $cet_edu['namaJurusan']; }
																					else
																					{ echo ''; } ?>
																				</td>
																				<td align="center">
																					<!--<a class="btn btn-success btn-xs" href="<?=$base_url?>index.php?r=status-viewhr&id=<?=$cet_kandidat['idWorker']?>"><i class="fa fa-eye"></i></a>-->
																					<!--<a class="btn btn-primary btn-xs" href="<?=$base_url?>index.php?r=status-interviewhr"><i class="fa fa-plus"></i></a>-->
																					<? if($cet_pen['idWorker']!='') 
																						{ 
																							?><!--<button class="btn btn-success btn-xs" onclick="TINY.box.show({url:'../modal/candidate-profile.php', post:'id=<?=$cet_kandidat['idWorker']?>', width:885, height:550, opacity:80, topsplit:3})"><i class="fa fa-eye"></i></button>--><?
																							?><!--<button class="btn btn-primary btn-xs" onclick="TINY.box.show({url:'../modal/status-viewhr.php', post:'id=<?=$cet_kandidat['idWorker']?>', width:885, height:550, opacity:80, topsplit:3})"><i class="fa fa-eye"></i></button>--><?
																							?><a class="btn btn-success btn-xs" href="modal/candidate-profile.php?id=<?=$cet_kandidat['idWorker']?>" data-toggle="modal" data-target="#candidate<?=$cet_kandidat['idWorker']?>"><i class="fa fa-eye"></i></a>
																							<div id="candidate<?=$cet_kandidat['idWorker']?>" class="modal fade"><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div><?
																							?><a class="btn btn-primary btn-xs" href="modal/status-viewhr.php?id=<?=$cet_kandidat['idWorker']?>" data-toggle="modal" data-target="#viewhr<?=$cet_kandidat['idWorker']?>"><i class="fa fa-eye"></i></a>
																							<div id="viewhr<?=$cet_kandidat['idWorker']?>" class="modal fade" ><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div><?
																						}
																						else
																						{ 
																							?><!--<button class="btn btn-primary btn-xs" data-toggle="modal" data-target=".interviewhr"><i class="fa fa-plus "></i></button>--><? 
																							?><!--<button class="btn btn-primary btn-xs" onclick="TINY.box.show({url:'../modal/status-interviewhr.php', post:'id=<?=$cet_kandidat['idWorker']?>', width:1000, height:600, opacity:80, topsplit:3})"><i class="fa fa-pencil"></i></button>--><?
																							?><a class="btn btn-primary btn-xs" href="modal/status-interviewhr.php?id=<?=$cet_kandidat['idWorker']?>" data-toggle="modal" data-target="#interviewhr<?=$cet_kandidat['idWorker']?>"><i class="fa fa-pencil"></i></a>
																							<div id="interviewhr<?=$cet_kandidat['idWorker']?>" class="modal fade" ><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div><?
																						}
																					?>
																				</td>
																			</tr>
																		<?
																	}
																?>
															</tbody>
														</table>
													</div>
														<input class="btn btn-success" type="submit" value="Verifikasi" name="verifikasihr" class="alt_btn">
																</form>
												</div>
												
												<div id="psikotest-iso" class="tab-pane">
													<div class="tab_container">
														<table class="table table-striped table-hover">
															<thead>
																<tr bgcolor="#dedede">
																	<td align="center"></td>
																	<td align="center"><b>Nama</b></td>
																	<td align="center"><b>Email</b></td>
																	<td align="center"><b>Telepon</b></td>
																	<td align="center"><b>Usia</b></td>
																	<td align="center"><b>Domisili</b></td>
																	<td align="center"><b>Pendidikan</b></td>
																	<td align="center"><b>Options</b></td>
																</tr>
															</thead>
															<tbody>	
																<form method="post" action="<?=$base_url?>index.php?r=status-proses">
																<?
																	$vacancy = "select * from vacancyapply va ";
																	$vacancy .= "where idvacancy = '".$idvacancy."' and status='4' ";
																	$execvacancy = mysql_query($vacancy);
																	while($cet_vacancy=mysql_fetch_array($execvacancy))
																	{
																		$kandidat = "Select *, tp.namaProvinsi from userWorker uw ";
																		$kandidat .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
																		$kandidat .= "where idWorker = '".$cet_vacancy['idWorker']."' order by namaUser asc ";
																		$cet_kandidat = mysql_fetch_array(mysql_query($kandidat));
																		
																		$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
																		$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
																		$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
																		$edu .= "where idWorker = '".$cet_kandidat['idWorker']."' order by tahunLulus desc limit 1";
																		$cet_edu = mysql_fetch_array(mysql_query($edu));
																		
																		$penilaian = "select * from penilaian_summary ps ";
																		$penilaian .= "where idWorker = '".$cet_kandidat['idWorker']."' and tipe_penilaian = '2' ";
																		$cet_pen = mysql_fetch_array(mysql_query($penilaian));
																		?>
																			<tr> 
																				<td align="center"><input type="checkbox" name="psikotest[]" value="<?php echo $cet_kandidat['idWorker']?>"></td> 
																				<td align="center"><a target="_blank" href="<?=$base_url?>index.php?r=candidate-profile&id=<?=$cet_kandidat['idWorker']?>"><?=$cet_kandidat['namaUser']?></a></td>
																				<td align="center"><?=$cet_kandidat['email']?></td>
																				<td align="center"><?=$cet_kandidat['noPonsel']?></td>
																				<td align="center"><?=$cet_kandidat['usia']?> tahun</td>
																				<td align="center"><?=$cet_kandidat['namaProvinsi']?></td>
																				<td align="center">
																					<? if($cet_edu['namaPendidikan']!='')
																					{ echo $cet_edu['namaPendidikan'], $cet_edu['namaJurusan']; }
																					else
																					{ echo ''; } ?>
																				</td>
																				<td align="center">
																					<? if($cet_pen['idWorker']!='') 
																						{ 
																							?><a class="btn btn-success btn-xs" href="modal/candidate-profile.php?id=<?=$cet_kandidat['idWorker']?>" data-toggle="modal" data-target="#candidate<?=$cet_kandidat['idWorker']?>"><i class="fa fa-eye"></i></a>
																							<div id="candidate<?=$cet_kandidat['idWorker']?>" class="modal fade"><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div><?
																							?><a class="btn btn-primary btn-xs" href="modal/status-viewpsikotest.php?id=<?=$cet_kandidat['idWorker']?>" data-toggle="modal" data-target="#viewpsikotest<?=$cet_kandidat['idWorker']?>"><i class="fa fa-eye"></i></a>
																							<div id="viewpsikotest<?=$cet_kandidat['idWorker']?>" class="modal fade" ><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div><?
																						}
																						else
																						{ 
																							?><a class="btn btn-primary btn-xs" href="modal/status-psikotest.php?id=<?=$cet_kandidat['idWorker']?>" data-toggle="modal" data-target="#psikotest<?=$cet_kandidat['idWorker']?>"><i class="fa fa-pencil"></i></a>
																							<div id="psikotest<?=$cet_kandidat['idWorker']?>" class="modal fade" ><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div><?
																						}
																					?>
																				</td>
																			</tr>
																		<?
																	}
																?>
															</tbody>
														</table>
													</div>
														<input class="btn btn-success" type="submit" value="Verifikasi" name="verifikasipsikotest" class="alt_btn">
																</form>
												</div>
												
												<div id="interviewuser-iso" class="tab-pane">
													<div class="tab_container">
														<table class="table table-striped table-hover">
															<thead>
															<tr bgcolor="#dedede">
																<td align="center"></td>
																<td align="center"><b>Nama</b></td>
																<td align="center"><b>Email</b></td>
																<td align="center"><b>Telepon</b></td>
																<td align="center"><b>Usia</b></td>
																<td align="center"><b>Domisili</b></td>
																<td align="center"><b>Pendidikan</b></td>
																<td align="center"><b>Options</b></td>
															</tr>
															</thead>
															<tbody>	
																<form method="post" action="<?=$base_url?>index.php?r=status-proses">
																<?
																	$vacancy = "select * from vacancyapply va ";
																	$vacancy .= "where idvacancy = '".$idvacancy."' and status='5' ";
																	$execvacancy = mysql_query($vacancy);
																	while($cet_vacancy=mysql_fetch_array($execvacancy))
																	{
																		$kandidat = "Select *, tp.namaProvinsi from userWorker uw ";
																		$kandidat .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
																		$kandidat .= "where idWorker = '".$cet_vacancy['idWorker']."' order by namaUser asc ";
																		$cet_kandidat = mysql_fetch_array(mysql_query($kandidat));
																		
																		$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
																		$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
																		$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
																		$edu .= "where idWorker = '".$cet_kandidat['idWorker']."' order by tahunLulus desc limit 1";
																		$cet_edu = mysql_fetch_array(mysql_query($edu));
																		
																		$penilaian = "select * from penilaian_summary ps ";
																		$penilaian .= "where idWorker = '".$cet_kandidat['idWorker']."' and tipe_penilaian = '3' ";
																		$cet_pen = mysql_fetch_array(mysql_query($penilaian));
																		?>
																			<tr> 
																				<td align="center"><input type="checkbox" name="interviewuser[]" value="<?php echo $cet_kandidat['idWorker']?>"></td> 
																				<td align="center"><a target="_blank" href="<?=$base_url?>index.php?r=candidate-profile&id=<?=$cet_kandidat['idWorker']?>"><?=$cet_kandidat['namaUser']?></a></td>
																				<td align="center"><?=$cet_kandidat['email']?></td>
																				<td align="center"><?=$cet_kandidat['noPonsel']?></td>
																				<td align="center"><?=$cet_kandidat['usia']?> tahun</td>
																				<td align="center"><?=$cet_kandidat['namaProvinsi']?></td>
																				<td align="center">
																					<? if($cet_edu['namaPendidikan']!='')
																					{ echo $cet_edu['namaPendidikan'], $cet_edu['namaJurusan']; }
																					else
																					{ echo ''; } ?>
																				</td>
																				<td align="center">
																					<? if($cet_pen['idWorker']!='') 
																						{ 
																							?><a class="btn btn-success btn-xs" href="modal/candidate-profile.php?id=<?=$cet_kandidat['idWorker']?>" data-toggle="modal" data-target="#candidate<?=$cet_kandidat['idWorker']?>"><i class="fa fa-eye"></i></a>
																							<div id="candidate<?=$cet_kandidat['idWorker']?>" class="modal fade"><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div><?
																							?><a class="btn btn-primary btn-xs" href="modal/status-viewuser.php?id=<?=$cet_kandidat['idWorker']?>" data-toggle="modal" data-target="#viewuser<?=$cet_kandidat['idWorker']?>"><i class="fa fa-eye"></i></a>
																							<div id="viewuser<?=$cet_kandidat['idWorker']?>" class="modal fade" ><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div><?
																						}
																						else
																						{ 
																							?><a class="btn btn-primary btn-xs" href="modal/status-interviewuser.php?id=<?=$cet_kandidat['idWorker']?>" data-toggle="modal" data-target="#interviewuser<?=$cet_kandidat['idWorker']?>"><i class="fa fa-pencil"></i></a>
																							<div id="interviewuser<?=$cet_kandidat['idWorker']?>" class="modal fade" ><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div><?
																						}
																					?>
																				</td>
																			</tr>
																		<?
																	}
																?>
															</tbody>
														</table>
													</div>
														<input class="btn btn-success" type="submit" value="Verifikasi" name="verifikasiuser" class="alt_btn">
																</form>
												</div>
												
												<div id="negotiatingsalary-iso" class="tab-pane">
													<div class="tab_container">
														<table class="table table-striped table-hover">
															<thead>
																<tr bgcolor="#dedede">
																	<td align="center"></td>
																	<td align="center"><b>Nama</b></td>
																	<td align="center"><b>Email</b></td>
																	<td align="center"><b>Telepon</b></td>
																	<td align="center"><b>Usia</b></td>
																	<td align="center"><b>Domisili</b></td>
																	<td align="center"><b>Pendidikan</b></td>
																	<!--<td align="center"><b>Pengalaman</b></td>-->
																</tr>
															</thead>
															<tbody>
																<form method="post" action="<?=$base_url?>index.php?r=status-proses">
																<?
																	$vacancy = "select * from vacancyapply va ";
																	$vacancy .= "where idvacancy = '".$idvacancy."' and status='6' ";
																	$execvacancy = mysql_query($vacancy);
																	while($cet_vacancy=mysql_fetch_array($execvacancy))
																	{
																		$kandidat = "Select *, tp.namaProvinsi from userWorker uw ";
																		$kandidat .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
																		$kandidat .= "where idWorker = '".$cet_vacancy['idWorker']."' order by namaUser asc ";
																		$cet_kandidat = mysql_fetch_array(mysql_query($kandidat));
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut='1' order by namaUser asc";
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut in (select status from `vacancyapply` where status='1')  order by namaUser asc";*/
																	
																		$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
																		$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
																		$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
																		$edu .= "where idWorker = '".$cet_kandidat['idWorker']."' order by tahunLulus desc limit 1";
																		$cet_edu = mysql_fetch_array(mysql_query($edu));
																		?>
																			<tr> 
																				<td align="center"><input type="checkbox" name="nego[]" value="<?php echo $cet_kandidat['idWorker']?>"></td> 
																				<td align="center"><a href="<?=$base_url?>index.php?r=candidate-profile&id=<?=$cet_kandidat['idWorker']?>"><?=$cet_kandidat['namaUser']?></a></td>
																				<td align="center"><?=$cet_kandidat['email']?></td>
																				<td align="center"><?=$cet_kandidat['noPonsel']?></td>
																				<td align="center"><?=$cet_kandidat['usia']?> tahun</td>
																				<td align="center"><?=$cet_kandidat['namaProvinsi']?></td>
																				<td align="center">
																					<? if($cet_edu['namaPendidikan']!='')
																					{ echo $cet_edu['namaPendidikan'], $cet_edu['namaJurusan']; }
																					else
																					{ echo ''; } ?>
																				</td>
																			</tr>
																		<?
																	}
																?>
															</tbody>
														</table>
																	<div class="form-group">
																		<input class="btn btn-success" type="submit" value="Verifikasi" name="verifikasinego" class="alt_btn">
																	</div>
																</form>
													</div>
												</div>
												
												<div id="mcu-iso" class="tab-pane">
													<div class="tab_container">
														<table class="table table-striped table-hover">
															<thead>
																<tr bgcolor="#dedede">
																	<td align="center"></td>
																	<td align="center"><b>Nama</b></td>
																	<td align="center"><b>Email</b></td>
																	<td align="center"><b>Telepon</b></td>
																	<td align="center"><b>Usia</b></td>
																	<td align="center"><b>Domisili</b></td>
																	<td align="center"><b>Pendidikan</b></td>
																	<!--<td align="center"><b>Pengalaman</b></td>-->
																</tr>
															</thead>
															<tbody>
																<form method="post" action="<?=$base_url?>index.php?r=status-proses">
																<?
																	$vacancy = "select * from vacancyapply va ";
																	$vacancy .= "where idvacancy = '".$idvacancy."' and status='7' ";
																	$execvacancy = mysql_query($vacancy);
																	while($cet_vacancy=mysql_fetch_array($execvacancy))
																	{
																		$kandidat = "Select *, tp.namaProvinsi from userWorker uw ";
																		$kandidat .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
																		$kandidat .= "where idWorker = '".$cet_vacancy['idWorker']."' order by namaUser asc ";
																		$cet_kandidat = mysql_fetch_array(mysql_query($kandidat));
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut='1' order by namaUser asc";
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut in (select status from `vacancyapply` where status='1')  order by namaUser asc";*/
																	
																		$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
																		$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
																		$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
																		$edu .= "where idWorker = '".$cet_kandidat['idWorker']."' order by tahunLulus desc limit 1";
																		$cet_edu = mysql_fetch_array(mysql_query($edu));
																		?>
																			<tr> 
																				<td align="center"><input type="checkbox" name="mcu[]" value="<?php echo $cet_kandidat['idWorker']?>"></td> 
																				<td align="center"><a href="<?=$base_url?>index.php?r=candidate-profile&id=<?=$cet_kandidat['idWorker']?>"><?=$cet_kandidat['namaUser']?></a></td>
																				<td align="center"><?=$cet_kandidat['email']?></td>
																				<td align="center"><?=$cet_kandidat['noPonsel']?></td>
																				<td align="center"><?=$cet_kandidat['usia']?> tahun</td>
																				<td align="center"><?=$cet_kandidat['namaProvinsi']?></td>
																				<td align="center">
																					<? if($cet_edu['namaPendidikan']!='')
																					{ echo $cet_edu['namaPendidikan'], $cet_edu['namaJurusan']; }
																					else
																					{ echo ''; } ?>
																				</td>
																			</tr>
																		<?
																	}
																?>
															</tbody>
														</table>
																	<div class="form-group">
																		<input class="btn btn-success" type="submit" value="Verifikasi" name="verifikasimcu" class="alt_btn">
																	</div>
																</form>
													</div>
												</div>
												<!--<div id="mcu-iso" class="tab-pane">Medical Check-Up
												<button class="btn btn-primary" data-toggle="modal" data-target=".mcu">Add</button></div>-->
												
												<div id="join-iso" class="tab-pane">
													<div class="tab_container">
														<table class="table table-striped table-hover">
															<thead>
																<tr bgcolor="#dedede">
																	<td align="center"></td>
																	<td align="center"><b>Nama</b></td>
																	<td align="center"><b>Email</b></td>
																	<td align="center"><b>Telepon</b></td>
																	<td align="center"><b>Usia</b></td>
																	<td align="center"><b>Domisili</b></td>
																	<td align="center"><b>Pendidikan</b></td>
																	<!--<td align="center"><b>Pengalaman</b></td>-->
																</tr>
															</thead>
															<tbody>
																<form method="post" action="<?=$base_url?>index.php?r=status-proses">
																<?
																	$vacancy = "select * from vacancyapply va ";
																	$vacancy .= "where idvacancy = '".$idvacancy."' and status='8' ";
																	$execvacancy = mysql_query($vacancy);
																	while($cet_vacancy=mysql_fetch_array($execvacancy))
																	{
																		$kandidat = "Select *, tp.namaProvinsi from userWorker uw ";
																		$kandidat .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
																		$kandidat .= "where idWorker = '".$cet_vacancy['idWorker']."' order by namaUser asc ";
																		$cet_kandidat = mysql_fetch_array(mysql_query($kandidat));
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut='1' order by namaUser asc";
																		//$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut in (select status from `vacancyapply` where status='1')  order by namaUser asc";*/
																	
																		$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
																		$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
																		$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
																		$edu .= "where idWorker = '".$cet_kandidat['idWorker']."' order by tahunLulus desc limit 1";
																		$cet_edu = mysql_fetch_array(mysql_query($edu));
																		?>
																			<tr> 
																				<td align="center"><input type="checkbox" name="join[]" value="<?php echo $cet_kandidat['idWorker']?>"></td> 
																				<td align="center"><a href="<?=$base_url?>index.php?r=candidate-profile&id=<?=$cet_kandidat['idWorker']?>"><?=$cet_kandidat['namaUser']?></a></td>
																				<td align="center"><?=$cet_kandidat['email']?></td>
																				<td align="center"><?=$cet_kandidat['noPonsel']?></td>
																				<td align="center"><?=$cet_kandidat['usia']?> tahun</td>
																				<td align="center"><?=$cet_kandidat['namaProvinsi']?></td>
																				<td align="center">
																					<? if($cet_edu['namaPendidikan']!='')
																					{ echo $cet_edu['namaPendidikan'], $cet_edu['namaJurusan']; }
																					else
																					{ echo ''; } ?>
																				</td>
																			</tr>
																		<?
																	}
																?>
															</tbody>
														</table>
																	<div class="form-group">
																		<input class="btn btn-success" type="submit" value="Verifikasi" name="verifikasijoin" class="alt_btn">
																	</div>
																</form>
													</div>
												</div>
												<!--<div id="join-iso" class="tab-pane">Join/Reject</div>-->
												
											</div>
										</div>
									</section>
									<br/>
									
									<div class="pull-right">
										<a class="btn btn-primary" onclick="javascript:window.print();"><i class="fa fa-print"></i>Print</a>
									</div>
							</div>
						</div>
					<?
				}
				else
				{
					?><div class="container">
						<div class="row">
							<div class="col-md-9">
								<h3><!--<button class="btn btn-primary" href="<?//=$base_url?>index.php?r=vacancy">Back</button></div>--> <?="Link is not valid";?> </h3>
							</div>
						</div>
					</div><?php
				}
			?>
        </div>
        <!--body wrapper end-->
		
<div class="modal fade interviewhr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<? include_once('status-interviewhr.php'); ?>
		</div>
	</div>
</div>

<div class="modal fade psikotest" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel<?php echo $cet_kandidat['idWorker'];?>" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<? include_once('status-psikotest.php'); ?>
		</div>
	</div>
</div>

<div class="modal fade interviewuser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<? include_once('status-interviewuser.php'); ?>
		</div>
	</div>
</div>

<div class="modal fade negosalary" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<? include_once('status-negosalary.php'); ?>
		</div>
	</div>
</div>

<div class="modal fade mcu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<? include_once('status-mcu.php'); ?>
		</div>
	</div>
</div>

<div class="modal fade join" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<? include_once('status-join.php'); ?>
		</div>
	</div>
</div>

<div class="modal fade candidate"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<? include('modal/candidate-profile.php'); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	function openJS(){alert('loaded')}
	function closeJS(){alert('closed')}
</script>

<!--<div class="modal fade" id="candidate-profile<?php echo $cet_kandidat['idWorker'];?>" tabindex="-1" role="dialog" aria-labelledby="candidate-profile<?php echo $cet_kandidat['idWorker'];?>" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<? include_once("candidate-profile.php"); ?>
		</div>
	</div>
</div>-->