<style>
	.print tr td
	{
		padding:1px 0px;
		vertical-align: top;
	}
</style>
<link rel="stylesheet" href="assets/print-invoice.css" media="print">
<div class="page-head">
	<h3 class="m-b-less">
	FPTK
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li>Home</li>
			<li>FPTK</li>
			<?if(isset($_POST['i'])){ ?>
			<li class="active">Approval FPTK</li>
			<? }else{?>
			<li class="active">View FPTK</li>
			<? } ?>
		</ol>
    </div>
</div>           
	<!--body wrapper start-->
        <div class="wrapper">
			<?
				if(!isset($_POST['idFptk']) AND !isset($_POST['a']))
				{
					?><div class="container">
						<div class="row">
							<div class="col-md-9">
								<h3><?php echo "Link is not valid";?> </h3>
							</div>
						</div>
					</div><?php
				}
				else
				{
					$idFptk = $_POST['idFptk'];
					$approve = $_POST['a'];
					$showfptk = "SELECT f.idFptk, f.namaPemohon, f.nikPemohon, f.direktoratPosisi, kdir2.namaDirektorat as direktorat2, f.departemenPosisi, kde2.namaDepartemen as departemen2, f.sectionPosisi, ks2.namaSection as section2, 
								f.jabatanPosisi, kk2.namaKategori as posisi2, f.levelPosisi, kl2.namaLevel as level2, f.lokasiPosisi, kdis2.namaDistrik as distrik2, f.jumlahPosisi, 
								f.tujuanPosisi, f.penggantiPosisi, f.mppPosisi, f.keteranganPosisi, f.tanggalPosisi, f.jobdesPosisi, f.statusPosisi, 
								f.jumlahlKualifikasi, f.jumlahpKualifikasi, f.usiaKualifikasi, f.pendidikanKualifikasi, tpe.namaPendidikan, f.jurusanKualifikasi, tj.namaJurusan, f.pengalamanKualifikasi, f.lainlainKualifikasi, f.nomorFptk,
								f.namaManager, f.tanggalManager, f.namaHrdSuperintendent, f.tanggalHrdSuperintendent, f.namaGeneralManager, f.tanggalGeneralManager, f.namaHrdManager, f.tanggalHrdManager, 
								f.namaDirektur, f.tanggalDirektur, f.rejectFptk, f.tanggalReject, f.keteranganReject, f.namaRecruitmentSuperintendent, f.tanggalRecruitmentSuperintendent, f.closingBy, f.closingDate FROM fptk f ";
					$showfptk .= "INNER JOIN kategoriDirektorat kdir2 ON kdir2.idDirektorat = f.direktoratPosisi ";
					$showfptk .= "INNER JOIN kategoriDepartemen kde2 ON kde2.idDepartemen = f.departemenPosisi ";
					$showfptk .= "INNER JOIN kategoriSection ks2 ON ks2.idSection = f.sectionPosisi ";
					$showfptk .= "INNER JOIN kategoriKerja kk2 ON kk2.idKategori = f.jabatanPosisi ";
					$showfptk .= "INNER JOIN kategoriLevel kl2 ON kl2.idLevel = f.levelPosisi ";
					$showfptk .= "INNER JOIN kategoriDistrik kdis2 ON kdis2.idDistrik = f.lokasiPosisi ";
					$showfptk .= "INNER JOIN tingkatPendidikan tpe ON tpe.gradePendidikan = f.pendidikanKualifikasi ";
					$showfptk .= "INNER JOIN tableJurusan tj ON tj.idJurusan = f.jurusanKualifikasi ";
					$showfptk .= "WHERE idFptk = $idFptk";
					$execShowFptk = mysql_query($showfptk);
					//echo $showfptk;
					$resultFptk = mysql_fetch_array($execShowFptk);
					/*if(mysql_num_rows($execShowFptk) < 1)
					{
						?><div class="container">
							<div class="row">
								<div class="col-md-9">
									<h3><?php echo "Not valid";?> </h3>
								</div>
							</div>
						</div><?php
					}
					else
					{*/
						?>
						<div class="panel invoice">
							<div class="panel-body">
								<div class="row">
									<img src="assets/img/invoice-logo.png" alt="" style="position:absolute; top: 10px; left:10px;"/>
									<div class="col-xs-12">
										<div class="total-purchase text-center">
											<h3><strong>FORM PERMINTAAN TENAGA KERJA</strong></h3>
											<h4><strong>NO: <?php echo $resultFptk['nomorFptk'];?></strong></h4>
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
												<td><?php echo $resultFptk['namaPemohon'];?></td>
											</tr>
											<tr>
												<td>NIK</td>
												<td>:</td>
												<td><?php echo $resultFptk['nikPemohon'];?></td>
											</tr>
										</table>
									</div>
									<div class="col-xs-6">
										<table border="0" width="100%" class="print">
											<tr>
												<td width="150px">Posisi</td>
												<td width="20px">:</td>
												<td>IT Supervisor</td>
											</tr>
											<tr>
												<td>Departemen</td>
												<td>:</td>
												<td>Bussiness Support</td>
											</tr>
										</table>
									</div>
								</div>
								<br/>
								
								<div class="row"><div class="col-xs-12"><strong>INFORMASI POSISI</strong></div></div>
									<div class="row">
										<div class="col-xs-6">
											<table border="0" width="100%" class="print">
												<tr>
													<td width="150px">Direktorat</td>
													<td width="20px">:</td>
													<td><?php echo $resultFptk['direktorat2'];?></td>
												</tr>
												<tr>
													<td>Departemen</td>
													<td>:</td>
													<td><?php echo $resultFptk['departemen2'];?></td>
												</tr>
												<tr>
													<td>Section</td>
													<td>:</td>
													<td><?php echo $resultFptk['section2'];?></td>
												</tr>
											</table>
										</div>
										<div class="col-xs-6">
											<table border="0" width="100%" class="print">
												<tr>
													<td width="150px">Posisi / Jabatan</td>
													<td width="20px">:</td>
													<td><?php echo $resultFptk['posisi2'];?></td>
												</tr>
												<tr>
													<td>Level</td>
													<td>:</td>
													<td><?php echo $resultFptk['level2'];?></td>
												</tr>
												<tr>
													<td>Lokasi Penempatan</td>
													<td>:</td>
													<td><?php echo $resultFptk['distrik2'];?></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<table border="0" width="100%" class="print">
												<tr>
													<td>Jumlah Kebutuhan</td>
													<td>:</td>
													<td><?php echo $resultFptk['jumlahPosisi'];?> Orang</td>
												</tr>
												<tr>
													<td width="150px">Tujuan Permintaan</td>
													<td width="20px">:</td>
													<td class="checkbox-custom check-success">
														<?
															if ($resultFptk['tujuanPosisi']=='Rekrut Baru')
															{?><input type="checkbox" checked> <label><?php echo $resultFptk['tujuanPosisi'];?></label><?}
															else
															{?><input type="checkbox" checked> <label>Penggantian, atas nama : <strong><?php echo $resultFptk['penggantiPosisi'];?></strong></label><?}
														?>
													</td>
												</tr>
												<tr>
													<td>MPP</td>
													<td>:</td>
													<td>
														<? echo $resultFptk['mppPosisi'];
															/*if($resultFptk['mppPosisi']!='')
															{?><td><?php echo $resultFptk['mppPosisi'];?></td><?}
															else
															{?><td><?php echo '-';?></td><?}*/
														?>
													</td>
												</tr>
												<tr>
													<td>Keterangan</td>
													<td>:</td>
													<td>
														<? echo $resultFptk['keteranganPosisi'];
															/*if($resultFptk['keteranganPosisi']!='')
															{?><td><?php echo $resultFptk['keteranganPosisi'];?></td><?}
															else
															{?><td><?php echo '-';?></td><?}*/
														?>
													</td>
												</tr>
												<tr>
													<td>Tanggal Dibutuhkan</td>
													<td>:</td>
													<td><?php tanggal2($resultFptk['tanggalPosisi'])?></td>
												</tr>
												<tr>
													<td>Deskripsi Pekerjaan</td>
													<td>:</td>
													<td class="checkbox-custom check-success">
														<?
															if ($resultFptk['jobdesPosisi']=='Ada')
															{?><input type="checkbox" checked> <label><?php echo $resultFptk['jobdesPosisi'];?></label><?}
															else
															{?><input type="checkbox" checked> <label><?php echo $resultFptk['penggantiPosisi'];?><strong> (wajib membuat & melampirkan)</strong></label><?}
														?>
													</td>
												</tr>
												<tr>
													<td>Status Karyawan</td>
													<td>:</td>
													<td><?php echo $resultFptk['statusPosisi'];?></td>
												</tr>
											</table>
										</div>
									</div>
									<br>
									
									<div class="row"><div class="col-xs-12" style="font-size:16px;"><strong>KUALIFIKASI</strong></div></div>
									<div class="row">
										<div class="col-xs-12">
											<table border="0" width="100%" class="print">
												<tr>
													<td width="150px">Jumlah Dibutuhkan</td>
													<td width="20px">:</td>
													<td>Laki-laki : <?php echo $resultFptk['jumlahlKualifikasi'];?> Orang <span style="margin-right:30px;"></span> Perempuan : <?php echo $resultFptk['jumlahpKualifikasi'];?> Orang</td>
												</tr>
												<tr>
													<td>Usia</td>
													<td>:</td>
													<td><?php echo $resultFptk['usiaKualifikasi'];?> Tahun</td>
												</tr>
												<tr>
													<td width="150px">Pendidikan</td>
													<td width="20px">:</td>
													<td>Universitas/Instansi : <?php echo $resultFptk['namaPendidikan'];?> <span style="margin-right:30px;"></span> Jurusan : <?php echo $resultFptk['namaJurusan'];?></td>
												</tr>
												<tr>
													<td>Pengalaman</td>
													<td>:</td>
													<td><?php echo $resultFptk['pengalamanKualifikasi'];?> Tahun</td>
												</tr>
												<tr>
													<td>Lain -lain</td>
													<td>:</td>
													<td>
														<? echo $resultFptk['lainlainKualifikasi'];
															/*if($resultFptk['lainlainKualifikasi']!='')
															{?><td><?php echo $resultFptk['lainlainKualifikasi'];?></td><?}
															else
															{?><td><?php echo '-';?></td><?}*/
														?>
													</td>
												</tr>
											</table>
										</div>
									</div>
									<br/>
									
									<div class="row"><div class="col-xs-12" style="font-size:16px;"><strong>SHORT LIST</strong></div></div>
									<table class="table table-striped table-hover">
										<thead>
										<tr>
											<th width="3%" align="center">NO</th>
											<th width="20%">PENDIDIKAN</th>
											<th >NAMA</th>
											<th width="8%" align="center">PENGALAMAN</th>
											<th width="5%" align="center">USIA</th>
											<th width="15%">JENIS KELAMIN</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td align="center">1</td>
											<td>S1 - Teknik Informatika</td>
											<td>Jason Statom</td>
											<td align="center">2</td>
											<td align="center">28</td>
											<td>Laki - laki</td>
										</tr>
										<tr>
											<td align="center">2</td>
											<td>S1 - Teknik Komputer</td>
											<td>Gwen Stefani</td>
											<td align="center">0</td>
											<td align="center">25</td>
											<td>Perempuan</td>
										</tr>
										<tr>
											<td>3</td>
											<td>S1 - Sistem Informasi</td>
											<td>Brad Pit</td>
											<td align="center">1</td>
											<td align="center">35</td>
											<td>Laki-laki</td>
										</tr>
										
										</tbody>
									</table>
									<br/>
									
									<div class="row"><div class="col-xs-12" style="font-size:16px;"><h4><strong>APPROVE & VERIFIKASI</strong></h4></div></div>
									<div class="row">
										<div class="col-xs-6">
											<table border="0" width="100%" class="print">
												<tr>
													<td width="150px">Manager</td>
													<td width="20px">:</td>
													<td>
													<?
														if($resultFptk['namaManager']!='' and $resultFptk['tanggalManager']!='')
														{?><td><?php echo $resultFptk['namaManager'];?></td>
														<td><?php tanggal2($resultFptk['tanggalManager'])?></td><?}
														else
														{?><td>Pending</td><?}
													?>
													</td>
												</tr>
												<tr>
													<td>HRD Superintendent</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaHrdSuperintendent']!='' and $resultFptk['tanggalHrdSuperintendent']!='')
														{?><td><?php echo $resultFptk['namaHrdSuperintendent'];?></td>
														<td><?php tanggal2($resultFptk['tanggalHrdSuperintendent'])?></td><?}
														else
														{?><td>Pending</td><?}
													?>
													</td>
												</tr>
												<tr>
													<td>General Manager</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaGeneralManager']!='' and $resultFptk['tanggalGeneralManager']!='')
														{?><td><?php echo $resultFptk['namaGeneralManager'];?></td>
														<td><?php tanggal2($resultFptk['tanggalGeneralManager'])?></td><?}
														else
														{?><td>Pending</td><?}
													?>
													</td>
												</tr>
												<tr>
													<td>HRD Manager</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaHrdManager']!='' and $resultFptk['tanggalHrdManager']!='')
														{?><td><?php echo $resultFptk['namaHrdManager'];?></td>
														<td><?php tanggal2($resultFptk['tanggalHrdManager'])?></td><?}
														else
														{?><td>Pending</td><?}
													?>
													</td>
												</tr>
												<tr>
													<td>Director</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaDirektur']!='' and $resultFptk['tanggalDirektur']!='')
														{?><td><?php echo $resultFptk['namaDirektur'];?></td>
														<td><?php tanggal2($resultFptk['tanggalDirektur'])?></td><?}
														else
														{?><td>Pending</td><?}
													?>
													</td>
												</tr>
												<tr>
													<td>PIC</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaRecruitmentSuperintendent']!='' and $resultFptk['tanggalRecruitmentSuperintendent']!='')
														{?><td><?php echo $resultFptk['namaRecruitmentSuperintendent'];?></td>
														<td><?php tanggal2($resultFptk['tanggalRecruitmentSuperintendent'])?></td><?}
														else
														{?><td>Pending</td><?}
													?>
													</td>
												</tr>
												<tr>
													<td>Closed By</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['closingBy']!='' and $resultFptk['closingDate']!='')
														{?><td><?php echo $resultFptk['closingBy'];?></td>
														<td><?php tanggal2($resultFptk['closingDate'])?></td><?}
														else
														{?><td>Pending</td><?}
													?>
													</td>
												</tr>
												<tr>
													<td>Rejected By</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['rejectFptk']!='' and $resultFptk['tanggalReject']!='')
														{?><td><?php echo $resultFptk['rejectFptk'];?></td>
														<td><?php tanggal2($resultFptk['tanggalReject'])?></td><?}
														else
														{?><td>-</td><?}
													?>
													</td>
												</tr>
											</table>
										</div>
									</div>
									<br/>
									
									<div class="row" class="form-group"><div class="col-xs-12" style="font-size:16px;"><h4><strong>STATUS</strong></h4></div></div>
										<div class="row">
										<?php
											if($_POST['a']==4)
											{
												?>
												<form action="<?=$base_url;?>index.php?r=fptk-proses" method="post">
													<input type="hidden" name="idFptk" value="<?php echo $resultFptk['idFptk']?>">
													<input type="hidden" name="a" value="<?php echo $approve;?>">
													<div class="col-xs-6">
														<table border="0" width="100%" class="print">
															<tr>
																<td width="150px">MPP</td>
																<td width="20px">:</td>
																<td>
																	<label for="mppPosisi" class="radio-inline" class="radio-custom radio-success"><input type="radio" name="mppPosisi" id="mppIya" value="Sesuai">Sesuai</label>
																	<label for="mppPosisi" class="radio-inline" class="radio-custom radio-danger"><input type="radio" name="mppPosisi" id="mppTidak" value="Tidak Sesuai">Tidak Sesuai</label>
																</td>
															</tr>
														</table>
													</div>
													<div class="pull-right">
														<label><input class="btn btn-success" type="submit" name="approval" value="Submit"></label>
														<label><a class="btn btn-primary" onclick="javascript:window.print();"><i class="fa fa-print"></i>Print</a></label>
													</div>
												</form>
												<?php	
											}
											else if($_POST['a']==7)
											{
												?>
												<form action="<?=$base_url;?>index.php?r=fptk-proses" method="post">
													<input type="hidden" name="idFptk" value="<?php echo $resultFptk['idFptk']?>">
													<input type="hidden" name="a" value="<?php echo $approve;?>">
													<div class="col-xs-6">
														<table border="0" width="100%" class="print">
															<tr>
																<td width="150px">PIC FPTK</td>
																<td width="20px">:</td>
																<td>
																	<select class="col-md-7" name="pic" id="pic" class="form-control">
																		<option value="">-- Select PIC --</option>
																		<?php 
																		$querySelectPic = "SELECT nama FROM loginUser where idlogin=61 or idLogin=62 or idLogin=63 order by nama asc ";
																		$execSelectPic = mysql_query($querySelectPic);
																		while($selectPic = mysql_fetch_array($execSelectPic))
																		{?><option value="<?php echo $selectPic['nama'];?>"><?php echo $selectPic['nama'];?></option><?php }
																		?>
																	</select>
																</td>
															</tr>
														</table>
													</div>
													<div class="pull-right">
														<label><input class="btn btn-success" type="submit" name="approval" value="Submit"></label>
														<label><a class="btn btn-primary" onclick="javascript:window.print();"><i class="fa fa-print"></i>Print</a></label>
													</div>
												</form>
												<?php	
											}	
											else if($_POST['a']==8)
											{
												?>
												<form action="<?=$base_url;?>index.php?r=fptk-proses" method="post">
													<input type="hidden" name="idFptk" value="<?php echo $resultFptk['idFptk']?>">
													<input type="hidden" name="a" value="<?php echo $approve;?>">
													<div class="col-xs-6">
														<table border="0" width="100%" class="print">
															<tr>
																<td width="150px">Closing Date</td>
																<td width="20px">:</td>
																<td>
																	<div class="col-md-10">
																		<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" class="input-append date dpYears">
																			<input type="text" name="closingDate" class="form-control" required>
																				<span class="input-group-btn add-on">
																					<button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
																				</span>
																		</div>
																		<span class="help-block">Select date</span>
																	</div>
																</td>
															</tr>
														</table>
													</div>
													<div class="pull-right">
														<label><input class="btn btn-success" type="submit" name="approval" value="Submit"></label>
														<label><a class="btn btn-primary" onclick="javascript:window.print();"><i class="fa fa-print"></i>Print</a></label>
													</div>
												</form>
												<?php	
											}	
											else
											{
												?>
												<form action="<?=$base_url;?>index.php?r=fptk-proses" method="post">
													<input type="hidden" name="idFptk" value="<?=$resultFptk['idFptk'];?>">
													<input type="hidden" name="a" value="<?=$approve;?>">
													<div class="pull-right">
														<label><input class="btn btn-success" type="submit" name="approval" value="Approve"></label>
														<?
														if($_POST['a']==1 or $_POST['a']==5 or $_POST['a']==6)
														{
															?><label><button type="submit" onclick="TINY.box.show({url:'alasanRejectFptk.php', post:'id=<?php echo $resultFptk['nomorFptk'];?>', width:600,height:300,opacity:20,topsplit:3})" class="btn btn-primary btn-danger" name="reject">Reject</button></label><?php 
														} 
														else{}
														?>
														<label><a class="btn btn-primary" onclick="javascript:window.print();"><i class="fa fa-print"></i>Print</a></label>
													</div>
												</form>
												<?
											}
										?>
										</div>
							</div>
						</div>
						<?
					
				}
			?>
        </div>
        <!--body wrapper end-->
