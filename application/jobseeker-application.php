<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-md-12">
			<section class="panel">
				<header class="panel-heading"> </span></header>
				<div class="panel-body" style="height:auto;">
					<form id="basic-form" method="post" action="jobseeker-application.html#" >
						<div >
							<h3>Data Diri</h3>
							<section >
								<div class="form-group clearfix">
									<label class="col-lg-2 control-label" for="nama">Nama Lengkap *</label>
									<div class="col-lg-10">
										<input class="form-control" id="nama" name="nama" type="text" class="required">
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-lg-2 control-label" class="required" for="gender"> Jenis Kelamin *</label>
									<div class="col-lg-10">
										<div class="radio-inline">
											<label><input type="radio" name="gender" id="genderPa" value="Laki-Laki" checked>Laki-Laki</label>
											<label><input type="radio" name="gender" id="genderPi" value="Perempuan">Perempuan</label>
										</div>
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-lg-2 control-label" for="golonganDarah"> Golongan Darah *</label>
									<div class="col-lg-10">
										<select class="form-control m-b-10" id="golonganDarah" name="golonganDarah" required="required">
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="AB">AB</option>
											<option value="O">O</option>
										</select>
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-lg-2 control-label" for="tempatLahir">Tempat Lahir *</label>
									<div class="col-lg-10">
										<input class="form-control" id="tempatLahir" name="tempatLahir" type="text" class="required">
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-lg-2 control-label" for="agama"> Agama *</label>
									<div class="col-lg-10">
										<select class="form-control m-b-10" id="agama" name="agama" required="required">
											<option value="Islam">Islam</option>
											<option value="Kristen Protestan">Kristen Protestan</option>
											<option value="Katholik">Katholik</option>
											<option value="Hindu">Hindu</option>
											<option value="Buddha">Buddha</option>
										</select>
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-lg-2 control-label" for="noKtp">No. KTP *</label>
									<div class="col-lg-10">
										<input class="form-control" id="noKtp" name="noKtp" type="int" class="required">
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-lg-2 control-label" class="required" for="kewarganegaraan"> Kewarganegaraan *</label>
									<div class="col-lg-10">
										 <div class="radio-inline">
											<label><input type="radio" name="kewarganegaraan" id="wni" value="WNI" checked>WNI</label>
											<label><input type="radio" name="kewarganegaraan" id="wna" value="WNA">WNA</label>
										</div>
									</div>
								</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="noNpwp">No. NPWP</label>
														<div class="col-lg-10">
															<input class="form-control" id="noNpwp" name="noNpwp" type="int">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="email">Email *</label>
														<div class="col-lg-10">
															<input class="form-control" id="email" name="email" type="email" class="required">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="addressKtp">Alamat(KTP) *</label>
														<div class="col-lg-10">
															<textarea class="form-control" id="addressKtp" name="addressKtp" type="text" class="required"></textarea>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="addressSekarang">Alamat(Sekarang)</label>
														<div class="col-lg-10">
															<textarea class="form-control" id="addressSekarang" name="addressSekarang" type="text"></textarea>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="noponsel">No. Telepon *</label>
														<div class="col-lg-10">
															<div class="input-group">
																<div class="input-group-addon">+62</div>
																<input class="form-control" id="noponsel" name="noponsel" type="tel" class="required">
															</div>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="onoponsel">No. Telepon Lain</label>
														<div class="col-lg-10">
															<div class="input-group">
																<div class="input-group-addon">+62</div>
																<input class="form-control" id="onoponsel" name="onoponsel" type="tel">
															</div>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" class="required" for="statusNikah"> Status Nikah *</label>
														<div class="col-lg-10">
															<div class="radio-inline">
																<label><input type="radio" name="statusNikah" id="single" value="Lajang" checked>Lajang</label>
																<label><input type="radio" name="statusNikah" id="menikah" value="Menikah">Menikah</label>
																<label><input type="radio" name="statusNikah" id="dudajanda" value="Duda/Janda">Duda/Janda</label>
															</div>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-12 control-label ">(*) Wajib Diisi</label>
													</div>
												</section>
												
												
												<h3>Pendidikan</h3>
												<section>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="nama-universitas"> Nama Sekolah/Universitas *</label>
														<div class="col-lg-10">
															<input id="nama-universitas" name="nama-universitas" type="text" class="required form-control">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="alamat-kampus"> Lokasi Sekolah/Universitas *</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="alamat-kampus" name="alamat-kampus" required="required">
																<?php
																	$queryEduProv = "SELECT * FROM tableProvinsi";
																	$execEduProv = mysql_query($queryEduProv);
																	while($listEduProv = mysql_fetch_array($execEduProv))
																	{
																		?><option value="<?php echo $listEduProv['idProvinsi'];?>" <?php if($listEduProv['idProvinsi'] == $resultEduProv['lokasiInstansi']){echo "selected";}?>> <?php echo $listEduProv['namaProvinsi'];?> </option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="kualifikasi"> Jenjang Pendidikan *</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="kualifikasi" name="kualifikasi" required="required">
																<?php
																	$queryKualifikasi = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
																	$execKualifikasi = mysql_query($queryKualifikasi);
																	while($resultKualifikasi = mysql_fetch_array($execKualifikasi))
																	{
																		?><option value="<?php echo $resultKualifikasi['gradePendidikan'];?>"><?php echo $resultKualifikasi['namaPendidikan'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="jurusan"> Program Studi *</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="jurusan" name="jurusan" required="required">
																<?php
																	$queryJurusan = "SELECT * FROM tableJurusan ORDER BY namaJurusan ASC";
																	$execJurusan = mysql_query($queryJurusan);
																	while($resultJurusan = mysql_fetch_array($execJurusan))
																	{
																		?><option value="<?php echo $resultJurusan['idJurusan'];?>"><?php echo $resultJurusan['namaJurusan'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="ipk"> Nilai/IPK *</label>
														<div class="col-lg-10">
															<input id="ipk" name="ipk" type="text" class="required form-control">
															<p class="help-block">Gunakan tanda titik (.) sebagai pemisah desimal.</p>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="tahun-lulus"> Tahun Lulus *</label>
														<div class="col-lg-10">
															<input id="tahun-lulus" name="tahun-lulus" type="text" class="required form-control">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-12 control-label ">(*) Wajib Diisi</label>
													</div>
												</section>
												
												<h3>Pengalaman Kerja</h3>
												<section>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-perusahaan"> Nama Perusahaan</label>
														<div class="col-lg-10">
															<input class="form-control" id="pengalaman-perusahaan" name="pengalaman-perusahaan" type="text">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-bidang"> Bidang Usaha</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="pengalaman-bidang" name="pengalaman-bidang">
																<?php
																	$queryBidangUsaha = "SELECT * FROM bidangUsaha ORDER BY namaBidangUsaha ASC";
																	$execBidangUsaha = mysql_query($queryBidangUsaha);
																	while($resultBidangUsaha = mysql_fetch_array($execBidangUsaha))
																	{
																		?><option value="<?php echo $resultBidangUsaha['idUsaha'];?>"><?php echo $resultBidangUsaha['namaBidangUsaha'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-posisi"> Jabatan</label>
														<div class="col-lg-10">
															<input class="form-control" id="pengalaman-posisi" name="pengalaman-posisi" type="text">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-lokasi"> Lokasi</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="pengalaman-lokasi" name="pengalaman-lokasi">
																<?php
																	$queryExpProv = "SELECT * FROM tableProvinsi";
																	$execExpProv = mysql_query($queryExpProv);
																	while($listProv = mysql_fetch_array($execExpProv))
																	{
																		?><option value="<?php echo $listProv['idProvinsi']?>" <?php if($listProv['idProvinsi'] == $resultExpProv['lokasi']){ echo "selected";}?>><?php echo $listProv['namaProvinsi'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label"> Periode Kerja</label>
														<div class="col-lg-10">
															<div class="input-group input-large custom-date-range" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
																<input type="text" class="form-control dpd1" name="start-date-work">
																<span class="input-group-addon">Hingga</span>
																<input type="text" class="form-control dpd2" name="end-date-work">
															</div>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-gaji">Gaji Terakhir</label>
														<div class="col-lg-10">
															<div class="input-group">
																<div class="input-group-addon"><u>+</u> Rp</div>
																<input class="form-control" id="pengalaman-gaji" name="pengalaman-gaji" type="tel">
															</div>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-grossNett"> Gross/Nett</label>
														<div class="col-lg-10">
															 <div class="radio-inline">
																<label><input type="radio" name="pengalaman-grossNett" id="pengalaman-gross" value="Gross" checked>Gross</label>
																<label><input type="radio" name="pengalaman-grossNett" id="pengalaman-nett" value="Nett">Nett</label>
															</div>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-bawahan"> Jumlah Bawahan</label>
														<div class="col-lg-10">
															<input class="form-control" id="pengalaman-bawahan" name="pengalaman-bawahan" type="text">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-alasan"> Alasan Pindah</label>
														<div class="col-lg-10">
															<textarea class="form-control" id="pengalaman-alasan" name="pengalaman-alasan" type="text"></textarea>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-namaAtasan"> Nama Atasan</label>
														<div class="col-lg-10">
															<input class="form-control" id="pengalaman-namaAtasan" name="pengalaman-namaAtasan" type="text">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-telpAtasan">No. Telepon Atasan</label>
														<div class="col-lg-10">
															<div class="input-group">
																<div class="input-group-addon">+62</div>
																<input class="form-control" id="pengalaman-telpAtasan" name="pengalaman-telpAtasan" type="tel">
															</div>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="pengalaman-jabatanAtasan"> Jabatan Atasan</label>
														<div class="col-lg-10">
															<input class="form-control" id="pengalaman-jabatanAtasan" name="pengalaman-jabatanAtasan" type="text">
														</div>
													</div>
												</section>
												
												<h3>Keahlian Bahasa</h3>
												<section>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="bahasa"> Bahasa *</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="bahasa" name="bahasa" required="required">
																<?php
																	$queryBahasa = "SELECT * FROM tableBahasa ORDER BY namaBahasa ASC";
																	$execBahasa = mysql_query($queryBahasa);
																	while($resultBahasa = mysql_fetch_array($execBahasa))
																	{
																		?><option value="<?php echo $resultBahasa['idBahasa'];?>"><?php echo $resultBahasa['namaBahasa'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="bahasa-lisan"> Lisan *</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="bahasa-lisan" name="bahasa-lisan" required="required">
																<?php
																	$queryTingkatKeahlian = "SELECT * FROM tingkatKeahlian ORDER BY gradeKeahlian";
																	$execTingkatKeahlian1 = mysql_query($queryTingkatKeahlian);
																	while($resultTingkatKeahlian1 = mysql_fetch_array($execTingkatKeahlian1))
																	{
																		?><option value="<?php echo $resultTingkatKeahlian1['gradeKeahlian'];?>"><?php echo $resultTingkatKeahlian1['tingkatKeahlian'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="bahasa-menulis"> Menulis *</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="bahasa-menulis" name="bahasa-menulis" required="required">
																<?php
																	$execTingkatKeahlian2 = mysql_query($queryTingkatKeahlian);
																	while($resultTingkatKeahlian2 = mysql_fetch_array($execTingkatKeahlian2))
																	{
																		?><option value="<?php echo $resultTingkatKeahlian2['gradeKeahlian'];?>"><?php echo $resultTingkatKeahlian2['tingkatKeahlian'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="bahasa-membaca"> Membaca *</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="bahasa-membaca" name="bahasa-membaca" required="required">
																<?php
																	$execTingkatAhli3 = mysql_query($queryTingkatKeahlian);
																	while($resultTingkatAhli3 = mysql_fetch_array($execTingkatAhli3))
																	{
																		?><option value="<?php echo $resultTingkatAhli3['gradeKeahlian'];?>"><?php echo $resultTingkatAhli3['tingkatKeahlian'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="bahasa-keterangan"> Keterangan</label>
														<div class="col-lg-10">
															<input class="form-control" id="bahasa-keterangan" name="bahasa-keterangan" type="text">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-12 control-label ">(*) Wajib Diisi</label>
													</div>
												</section>
												
												<h3>Keahlian Lain</h3>
												<section>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="skill"> Nama Keahlian</label>
														<div class="col-lg-10">
															<input class="form-control" id="skill" name="skill" type="text">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="tingkat-skill"> Tingkat Keahlian</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="tingkat-skill" name="tingkat-skill">
																<?php
																	$execTingkatKeahlian3 = mysql_query($queryTingkatKeahlian);
																	while($resultTingkatKeahlian3 = mysql_fetch_array($execTingkatKeahlian3))
																	{
																		?><option value="<?php echo $resultTingkatKeahlian3['gradeKeahlian'];?>"><?php echo $resultTingkatKeahlian3['tingkatKeahlian'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
												</section>
												
												<h3>Keahlian Mengemudi</h3>
												<section>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="mengemudi"> Nama Keahlian</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="mengemudi" name="mengemudi">
																<?php
																	$queryMengemudi = "SELECT * FROM tableMengemudi ORDER BY namaMengemudi ASC";
																	$execMengemudi = mysql_query($queryMengemudi);
																	while($resultMengemudi = mysql_fetch_array($execMengemudi))
																	{
																		?><option value="<?php echo $resultMengemudi['idMengemudi'];?>"><?php echo $resultMengemudi['namaMengemudi'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="keahlian-mengemudi"> Tingkat Keahlian</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="keahlian-mengemudi" name="keahlian-mengemudi">
																<?php
																	$queryTingkatMengemudi = "SELECT * FROM tingkatKeahlian ORDER BY gradeKeahlian";
																	$execTingkatMengemudi = mysql_query($queryTingkatMengemudi);
																	while($resultTingkatMengemudi = mysql_fetch_array($execTingkatMengemudi))
																	{
																		?><option value="<?php echo $resultTingkatMengemudi['gradeKeahlian'];?>"><?php echo $resultTingkatMengemudi['tingkatKeahlian'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="noSim-mengemudi"> No. SIM</label>
														<div class="col-lg-10">
															<input class="form-control" id="noSim-mengemudi" name="noSim-mengemudi" type="text">
														</div>
													</div>
												</section>
												
												<h3>Pelatihan</h3>
												<section>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="nama_training"> Nama Pelatihan</label>
														<div class="col-lg-10">
															<input class="form-control" id="nama_training" name="nama_training" type="text">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="penyelenggara_training"> Penyelenggara</label>
														<div class="col-lg-10">
															<input class="form-control" id="penyelenggara_training" name="penyelenggara_training" type="text">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="tahun_training"> Tahun</label>
														<div class="col-lg-10">
															<input class="form-control" id="tahun_training" name="tahun_training" type="text">
														</div>
													</div>
													<div class="form-group clearfix">
														<label class="col-lg-2 control-label" for="keterangan_training"> Keterangan</label>
														<div class="col-lg-10">
															<select class="form-control m-b-10" id="keterangan_training" name="keterangan_training">
																<?php
																	$queryKetTraining = "SELECT * FROM tingkatKetTraining";
																	$execKetTraining = mysql_query($queryKetTraining);
																	while($listKetTraining = mysql_fetch_array($execKetTraining))
																	{
																		?><option value="<?php echo $listKetTraining['idKetTraining']?>" <?php if($listKetTraining['idKetTraining'] == $resultKetTraining['keteranganTraining']){ echo "selected";}?>><?php echo $listKetTraining['tingkatKetTraining'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
												</section>
												
											</div>
										</form>
									</div>
								</section>
							</div>
						</div>
						</div>
						<!--body wrapper end-->