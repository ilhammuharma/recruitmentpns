<style>
	.print tr td
	{
		padding:1px 0px;
		vertical-align: top;
	}
</style>
<script type="text/javascript" src="../js/tinybox.js"></script>
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
				if(isset($_POST['idFptk']) AND isset($_POST['a']))
				{
					$idFptk = $_POST['idFptk'];
					$approve = $_POST['a'];
					$showfptk = "SELECT *, kdir2.namaDirektorat as direktorat2, kde2.namaDepartemen as departemen2, ks2.namaSection as section2, 
								kk2.namaKategori as posisi2, kl2.namaLevel as level2, kdis2.namaDistrik as distrik2, tpe.namaPendidikan, tj.namaJurusan FROM fptk f ";
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
												<td><?php echo $_SESSION['nik'];?></td>
											</tr>
										</table>
									</div>
									<div class="col-xs-6">
										<table border="0" width="100%" class="print">
											<tr>
												<td width="150px">Posisi</td>
												<td width="20px">:</td>
												<td></td>
											</tr>
											<tr>
												<td>Departemen</td>
												<td>:</td>
												<td><?php echo $_SESSION['department'];?></td>
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
													<?if($resultFptk['mppPosisi']=="Tidak Sesuai"){?>
													<td><font color="red"><? echo $resultFptk['mppPosisi'];?></font></td><?}
													else{?>
													<td><? echo $resultFptk['mppPosisi'];?></td><?}
													?>
												</tr>
												<tr>
													<td>Keterangan</td>
													<td>:</td>
													<?if($resultFptk['keteranganPosisi']!=""){?>
													<td><font color="red"><? echo $resultFptk['keteranganPosisi'];?></font></td><?}
													else{?>
													<td><? echo $resultFptk['keteranganPosisi'];?></td><?}
													?>
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
															{ ?><input type="checkbox" checked> <label><?php echo $resultFptk['jobdesPosisi'];?></label><? }
															else
															{ ?><input type="checkbox" checked> <label><?php echo $resultFptk['penggantiPosisi'];?><strong> (wajib membuat & melampirkan)</strong></label><? }
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
									
									<div class="row"><div class="col-xs-12" style="font-size:16px;"><strong>KANDIDAT</strong></div></div>
									<table class="table table-striped table-hover">
										<thead>
										<tr>
											<td align="center"><b>Nama</b></td>
											<td align="center"><b>Email</b></td>
											<td align="center"><b>Telepon</b></td>
											<td align="center"><b>Usia</b></td>
											<td align="center"><b>Domisili</b></td>
											<td align="center"><b>Pendidikan</b></td>
											<td align="center"><b>Status</b></td>
											<td align="center"><b>Options</b></td>
										</tr>
										</thead>
										<tbody>
										<?
											$sortlist = "Select *, tp.namaProvinsi, ts.namaStatus from userWorker uw ";
											$sortlist .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
											$sortlist .= "JOIN tableStatusRekrut ts ON ts.idTable = uw.statusRekrut ";
											$sortlist .= "where nomorFptk='".$resultFptk['nomorFptk']."'";
											$execsortlist = mysql_query($sortlist);
											while($cet_sortlist = mysql_fetch_array($execsortlist)){
												$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
												$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
												$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
												$edu .= "where idWorker='".$cet_sortlist['idWorker']."' order by tahunLulus desc limit 1";
												$execedu = mysql_query($edu);
												$cet_edu = mysql_fetch_array($execedu);
										?>
											<tr>
												<td align="center"><?=$cet_sortlist['namaUser']?></td>
												<td align="center"><?=$cet_sortlist['email']?></td>
												<td align="center"><?=$cet_sortlist['noPonsel']?></td>
												<td align="center"><?=$cet_sortlist['usia']?> tahun</td>
												<td align="center"><?=$cet_sortlist['namaProvinsi']?></td>
												<td align="center"><?=$cet_edu['namaPendidikan']?>&nbsp;<?=$cet_edu['namaJurusan']?></td>
												<td align="center"><? if($cet_sortlist['namaStatus']!=''){ echo $cet_sortlist['namaStatus']; } else { echo 'Undefined'; }?></td>
												<td align="center"><a class="btn btn-success btn-xs" href="modal/candidate-profile.php?id=<?=$cet_kandidat['idWorker']?>" data-toggle="modal" data-target="#candidate<?=$cet_kandidat['idWorker']?>"><i class="fa fa-eye"></i></a>
												<div id="candidate<?=$cet_kandidat['idWorker']?>" class="modal fade"><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div></td>
											</tr>
										<?}?>
										</tbody>
									</table>
									<br/>
									
									<div class="row"><div class="col-xs-12" style="font-size:16px;"><h4><strong>APPROVAL & VERIFIKASI</strong></h4></div></div>
									<div class="row">
										<div class="col-xs-6">
											<table border="0" width="100%" class="print">
												<tr>
													<td width="150px">Manager</td>
													<td width="20px">:</td>
													<td>
													<?
														if($resultFptk['namaManager']!='' and $resultFptk['tanggalManager']!='')
														{?><td><?php echo $resultFptk['namaManager']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php tanggal2($resultFptk['tanggalManager'])?></td><?}
														else{}
													?>
													</td>
												</tr>
												<tr>
													<td>HR Superintendent</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaHrdSuperintendent']!='' and $resultFptk['tanggalHrdSuperintendent']!='')
														{?><td><?php echo $resultFptk['namaHrdSuperintendent']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php tanggal2($resultFptk['tanggalHrdSuperintendent'])?></td><?}
														else{}
													?>
													</td>
												</tr>
												<tr>
													<td>General Manager</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaGeneralManager']!='' and $resultFptk['tanggalGeneralManager']!='')
														{?><td><?php echo $resultFptk['namaGeneralManager']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php tanggal2($resultFptk['tanggalGeneralManager'])?></td><?}
														else{}
													?>
													</td>
												</tr>
												<tr>
													<td>OD</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaOdManager']!='' and $resultFptk['tanggalOdManager']!='')
														{?><td><?php echo $resultFptk['namaOdManager']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php tanggal2($resultFptk['tanggalOdManager'])?></td><?}
														else{}
													?>
													</td>
												</tr>
												<tr>
													<td>HR Manager</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaHrdManager']!='' and $resultFptk['tanggalHrdManager']!='')
														{?><td><?php echo $resultFptk['namaHrdManager']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php tanggal2($resultFptk['tanggalHrdManager'])?></td><?}
														else{}
													?>
													</td>
												</tr>
												<tr>
													<td>Director</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaDirektur']!='' and $resultFptk['tanggalDirektur']!='')
														{?><td><?php echo $resultFptk['namaDirektur']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php tanggal2($resultFptk['tanggalDirektur'])?></td><?}
														else{}
													?>
													</td>
												</tr>
												<tr>
													<td>PIC</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['namaRecruitmentSuperintendent']!='' and $resultFptk['tanggalRecruitmentSuperintendent']!='')
														{?><td><?php echo $resultFptk['namaRecruitmentSuperintendent']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php tanggal2($resultFptk['tanggalRecruitmentSuperintendent'])?></td><?}
														else{}
													?>
													</td>
												</tr>
												<tr>
													<td>Closed By</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['closingBy']!='' and $resultFptk['closingDate']!='')
														{?><td><?php echo $resultFptk['closingBy']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php tanggal2($resultFptk['closingDate'])?></td><?}
														else{}
													?>
													</td>
												</tr>
												<tr>
													<td>Rejected By</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['rejectFptk']!='' and $resultFptk['tanggalReject']!='')
														{?><td><?php echo $resultFptk['rejectFptk']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php tanggal2($resultFptk['tanggalReject'])?></td><?}
														else{}
													?>
													</td>
												</tr>
												<tr>
													<td>Alasan Reject</td>
													<td>:</td>
													<td>
													<?
														if($resultFptk['rejectFptk']!='' and $resultFptk['tanggalReject']!='')
														{?><td><?php echo $resultFptk['keteranganReject']?></td><?}
														else{}
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
																<td width="200px">MPP</td>
																<td width="20px">:</td>
																<td>
																	<label for="mppPosisi" class="radio-inline" class="radio-custom radio-success"><input type="radio" name="mppPosisi" id="mppIya" value="Sesuai">Sesuai</label>
																	<label for="mppPosisi" class="radio-inline" class="radio-custom radio-danger"><input type="radio" name="mppPosisi" id="mppTidak" value="Tidak Sesuai">Tidak Sesuai</label>
																</td>
															</tr>
															<tr>
																<td width="200px">Keterangan (Jika Tidak Sesuai)</td>
																<td width="20px">:</td>
																<td>
																	<div class="form-group">
																		<label for="keteranganPosisi" required="required" class="control-label"></label>
																		<textarea name="keteranganPosisi" id="keteranganPosisi" style="width:100%; height:100%;"></textarea>
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
																		$querySelectPic = "SELECT idLogin, nama FROM loginUser where idlogin=61 or idLogin=62 or idLogin=63 order by nama asc ";
																		$execSelectPic = mysql_query($querySelectPic);
																		while($selectPic = mysql_fetch_array($execSelectPic))
																		{?><option value="<?php echo $selectPic['idLogin'];?>"><?php echo $selectPic['nama'];?></option><?php }
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
														if($_POST['a']==1 or $_POST['a']==3 or $_POST['a']==5 or $_POST['a']==6)
														{
															?><!--<label><button type="submit" href="<?//=$base_url;?>index.php?r=fptk-proses" class="btn btn-primary btn-danger" name="reject">Reject</button></label>--><?
															?><!--<button type="submit" onclick="TINY.box.show({url:'fptk-reject.php', post:'id=<?=$resultFptk['nomorFptk'];?>', width:600,height:300,opacity:20,topsplit:3})" class="btn btn-primary btn-danger" name="reject">Reject</button>--><? 
															?><label><a class="btn btn-primary btn-danger" href="application/fptk-reject.php?id=<?=$resultFptk['idFptk']?>" data-toggle="modal" data-target="#reject<?=$resultFptk['idFptk']?>">Reject</a></label>
															<div id="reject<?=$resultFptk['idFptk']?>" class="modal fade" ><div class="modal-dialog" style="width:90%;"><div class="modal-content"></div></div></div><?
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
				else
				{
					?><div class="container">
						<div class="row">
							<div class="col-md-9">
								<h3><?php echo "Link is not valid";?> </h3>
							</div>
						</div>
					</div><?php
				}
			?>
        </div>
        <!--body wrapper end-->
