<?php
	session_start();
	include("../assets/dbconfig.php");
	$title = "fptk";
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_SESSION['admin']))
		{
			header("Location: ../admin/");
		}
		else if(isset($_SESSION['worker']))
		{
			include("templates/head.php");
			if(isset($_POST['edit-fptk']))
			{
				$idFptk = $_POST['idFptk'];
				$pemohonNama = $_POST['pemohonNama'];
				$pemohonNik = $_POST['pemohonNik'];
				$pemohonPosisi = $_POST['pemohonPosisi'];
				$pemohonDepartemen = $_POST['pemohonDepartemen'];
				
				$posisiDivisi = $_POST['posisiDivisi'];
				$posisiDepartemen = $_POST['posisiDepartemen'];
				$posisiJabatan = $_POST['posisiJabatan'];
				$posisiLevel = $_POST['posisiLevel'];
				$posisiLokasi = $_POST['posisiLokasi'];
				$posisiJumlah = $_POST['posisiJumlah'];
				if($_POST['posisiTujuan'] == "")
				{
					$posisiTujuan = "Rekrut Baru";
				}
				else
				{
					$posisiTujuan = $_POST['posisiTujuan'];
				}
				$posisiPengganti = $_POST['posisiPengganti'];
				if($_POST['posisiMpp'] == "")
				{
					$posisiMpp = "Ya";
				}
				else
				{
					$posisiMpp = $_POST['posisiMpp'];
				}
				$posisiKeterangan = $_POST['posisiKeterangan'];
				$posisiTanggal = date('d-m-Y', strtotime($_POST['posisiTanggal']));
				if($_POST['posisiJobdes'] == "")
				{
					$posisiJobdes = "Ada";
				}
				else
				{
					$posisiJobdes = $_POST['posisiJobdes'];
				}
				if($_POST['posisiStatus'] == "")
				{
					$posisiStatus = "Bulanan";
				}
				else
				{
					$posisiStatus = $_POST['posisiStatus'];
				}
				
				$kualifikasiJumlahl = $_POST['kualifikasiJumlahl'];
				$kualifikasiJumlahp = $_POST['kualifikasiJumlahp'];
				$kualifikasiUsia = $_POST['kualifikasiUsia'];
				$kualifikasiPendidikan = $_POST['kualifikasiPendidikan'];
				$kualifikasiJurusan = $_POST['kualifikasiJurusan'];
				$kualifikasiPengalaman = $_POST['kualifikasiPengalaman'];
				$kualifikasiLainlain = $_POST['kualifikasiLainlain'];
				
				$bulananTglditerima = date('d-m-Y', strtotime($_POST['bulananTglditerima']));
				$bulananPic = $_POST['bulananPic'];
				$bulananTglclosing = date('d-m-Y', strtotime($_POST['bulananTglclosing']));
				$bulananPemenuhan = $_POST['bulananPemenuhan'];
				$bulananKaryawan = $_POST['bulananKaryawan'];
				$bulananTglmasuk = date('d-m-Y', strtotime($_POST['bulananTglmasuk']));
				$bulananSbrinternal = $_POST['bulananSbrinternal'];
				$bulananSbreksternal = $_POST['bulananSbreksternal'];
				$bulananLaineksternal = $_POST['bulananLaineksternal'];
				
				$harianTglditerima = date('d-m-Y', strtotime($_POST['harianTglditerima']));
				$harianTglclosing = date('d-m-Y', strtotime($_POST['harianTglclosing']));
				$harianPemenuhan = $_POST['harianPemenuhan'];

				$queryUpdate = "UPDATE fptk SET namaPemohon = '$pemohonNama', nikPemohon = '$pemohonNik', posisiPemohon = '$pemohonPosisi', departemenPemohon = '$pemohonDepartemen', 
								divisiPosisi = '$posisiDivisi', departemenPosisi = '$posisiDepartemen', jabatanPosisi = '$posisiJabatan', levelPosisi = '$posisiLevel', 
								lokasiPosisi = '$posisiLokasi', jumlahPosisi = '$posisiJumlah', tujuanPosisi = '$posisiTujuan', penggantiPosisi = '$posisiPengganti', mppPosisi = '$posisiMpp', 
								keteranganPosisi = '$posisiKeterangan', tanggalPosisi = STR_TO_DATE('$posisiTanggal', '%d-%m-%Y'), jobdesPosisi = '$posisiJobdes', statusPosisi = '$posisiStatus', 
								jumlahlKualifikasi = '$kualifikasiJumlahl', jumlahpKualifikasi = '$kualifikasiJumlahp', usiaKualifikasi = '$kualifikasiUsia', pendidikanKualifikasi = '$kualifikasiPendidikan', 
								jurusanKualifikasi = '$kualifikasiJurusan', pengalamanKualifikasi = '$kualifikasiPengalaman', lainlainKualifikasi = '$kualifikasiLainlain', 
								tglditerimaBulanan = '$bulananTglditerima', picBulanan = '$bulananPic', tglclosingBulanan = '$bulananTglclosing', pemenuhanBulanan = '$bulananPemenuhan', 
								karyawanBulanan = '$bulananKaryawan', tglmasukBulanan = '$bulananTglmasuk', sbrinternalBulanan = '$bulananSbrinternal', sbreksternalBulanan = '$bulananSbreksternal', laineksternalBulanan = '$bulananLaineksternal', 
								tglditerimaHarian = '$harianTglditerima', tglclosingHarian = '$harianTglclosing', pemenuhanHarian = '$harianPemenuhan' 
								WHERE idFptk = $idFptk";
				$execUpdate = mysql_query($queryUpdate);
				?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>The FPTK was successfully edited.
					</div>
					<a href="fptk.php"><button class="btn btn-success">Back</button></a>
				<?php
			}
			else
			{
				if(!isset($_GET['idFptk']))
				{
					header("Location: fptk.php");
				}
				else
				{
					$idFptk = $_GET['idFptk'];
					$queryEditFptk= "SELECT * FROM fptk WHERE idFptk = $idFptk";
					$execEditFptk = mysql_query($queryEditFptk);
					$fptk = mysql_fetch_array($execEditFptk);
					$tanggal_posisi = new DateTime($fptk['tanggalPosisi']);
					$date = $tanggal_posisi->format('d-m-Y');
					$tglditerima_bulanan = new DateTime($fptk['tglditerimaBulanan']);
					$date = $tglditerima_bulanan->format('d-m-Y');
					$tglclosing_bulanan = new DateTime($fptk['tglclosingBulanan']);
					$date = $tglclosing_bulanan->format('d-m-Y');
					$tglmasuk_bulanan = new DateTime($fptk['tglmasukBulanan']);
					$date = $tglmasuk_bulanan->format('d-m-Y');
					$tglditerima_harian = new DateTime($fptk['tglditerimaHarian']);
					$date = $tglditerima_harian->format('d-m-Y');
					$tglclosing_harian = new DateTime($fptk['tglclosingHarian']);
					$date = $tglclosing_harian->format('d-m-Y');
					?>
						<h3>Edit FPTK</h3>
						<form action="edit-fptk.php" role="form" class="form-horizontal" method="post">
							<input type="hidden" value="<?php echo $fptk['idFptk'];?>" name="id">
							<h4>I. Pemohon</h4>
							<div class="form-group">
								<label for="pemohon-nama" class="col-sm-2 control-label">Nama Pemohon</label>
								<div class="col-sm-5">
									<input type="text" name="pemohon-nama" class="form-control" id="pemohon-nama" placeholder="Nama Pemohon" required>
								</div>
							</div>
							<div class="form-group">
								<label for="pemohon-nik" class="col-sm-2 control-label">NIK</label>
								<div class="col-sm-5">
									<input type="number" name="pemohon-nik" class="form-control" id="pemohon-nik" placeholder="Nomor Induk Karywan (6 Angka)">
								</div>
							</div>
							<div class="form-group">
								<label for="pemohon-posisi" class="col-sm-2 control-label">Posisi/Jabatan</label>
								<div class="col-sm-5">
									<?php
										$queryPosisi = "SELECT * FROM kategoriKerja ORDER BY namaKategori ASC";
										$execPosisi = mysql_query($queryPosisi);
									?>
									<select name="pemohon-posisi" id="pemohon-posisi" class="form-control">
										<option value="" disabled>-- Pilih posisi --</option>
										<?php
											while($resultPosisi = mysql_fetch_array($execPosisi))
											{
												?><option value="<?php echo $resultPosisi['idKategori'];?>"><?php echo $resultPosisi['namaKategori'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="pemohon-departemen" class="col-sm-2 control-label">Departemen</label>
								<div class="col-sm-5">
									<?php
										$queryDepartemen = "SELECT * FROM kategoriDepartemen ORDER BY namaDepartemen ASC";
										$execDepartemen = mysql_query($queryDepartemen);
									?>
									<select name="pemohon-departemen" id="pemohon-departemen" class="form-control">
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
								<label for="posisi-divisi" class="col-sm-2 control-label">Divisi</label>
								<div class="col-sm-5">
									<?php
										$queryDivisi = "SELECT * FROM kategoriDivisi ORDER BY namaDivisi ASC";
										$execDivisi = mysql_query($queryDivisi);
									?>
									<select name="posisi-divisi" id="posisi-divisi" class="form-control">
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
								<label for="posisi-departemen" class="col-sm-2 control-label">Departemen</label>
								<div class="col-sm-5">
									<?php
										$queryDepartemen2 = "SELECT * FROM kategoriDepartemen ORDER BY namaDepartemen ASC";
										$execDepartemen2 = mysql_query($queryDepartemen2);
									?>
									<select name="posisi-departemen" id="posisi-departemen" class="form-control">
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
								<label for="posisi-jabatan" class="col-sm-2 control-label">Posisi/Jabatan</label>
								<div class="col-sm-5">
									<?php
										$queryPosisi2 = "SELECT * FROM kategoriKerja ORDER BY namaKategori ASC";
										$execPosisi2 = mysql_query($queryPosisi2);
									?>
									<select name="posisi-jabatan" id="posisi-jabatan" class="form-control">
										<option value="" disabled>-- Pilih posisi --</option>
										<?php
											while($resultPosisi2 = mysql_fetch_array($execPosisi2))
											{
												?><option value="<?php echo $resultPosisi2['idKategori'];?>"><?php echo $resultPosisi2['namaKategori'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="posisi-level" class="col-sm-2 control-label">Level</label>
								<div class="col-sm-5">
									<?php
										$queryLevel = "SELECT * FROM kategoriLevel ORDER BY namaLevel ASC";
										$execLevel = mysql_query($queryLevel);
									?>
									<select name="posisi-level" id="posisi-level" class="form-control">
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
								<label for="posisi-lokasi" class="col-sm-2 control-label">Lokasi Penempatan</label>
								<div class="col-sm-5">
									<?php
										$queryProvinsi = "SELECT * FROM tableProvinsi ORDER BY namaProvinsi ASC";
										$execProvinsi = mysql_query($queryProvinsi);
									?>
									<select name="posisi-lokasi" id="posisi-lokasi" class="form-control">
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
								<label for="posisi-jumlah" class="col-sm-2 control-label">Jumlah Kebutuhan</label>
								<div class="col-sm-5">
									<input type="number" name="posisi-jumlah" class="form-control" id="posisi-jumlah" placeholder="Jumlah Kebutuhan (Hanya Angka)">
								</div>
							</div>
							<div class="form-group">
								<label for="posisi-tujuan" class="col-sm-2 control-label">Tujuan Permintaan</label>
								<div class="col-sm-5">
									<label class="radio-inline"><input type="radio" name="posisi-tujuan" id="posisi-tujuanBaru" value="Rekrut Baru" default>Rekrut Baru</label>
									<label class="radio-inline"><input type="radio" name="posisi-tujuan" id="posisi-tujuanGanti" value="Penggantian">Penggantian</label>
									<div class="input-group">
										<input type="text" id="penggantiPosisi" name="penggantiPosisi" placeholder="Penggantian, Atas Nama" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="posisi-mpp" class="col-sm-2 control-label">Sesuai MPP? (Diisi Oleh HRD)</label>
								<div class="col-sm-5">
									<label class="radio-inline"><input type="radio" name="posisi-mpp" id="posisi-mppIya" value="Iya" default>Iya</label>
									<label class="radio-inline"><input type="radio" name="posisi-mpp" id="posisi-mppTidak" value="Tidak">Tidak</label>
								</div>
							</div>
							<div class="form-group">
								<label for="posisi-keterangan" class="col-sm-2 control-label">Keterangan</label>
								<div class="col-sm-5">
									<textarea type="number" name="posisi-keterangan" class="form-control" id="posisi-keterangan" placeholder="Keterangan (Jika Tidak Sesuai Dengan MPP)"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="posisi-tanggal" class="col-sm-2 control-label">Tanggal Dibutuhkan</label>
								<div class="col-sm-5">
									<?php $lahir = new DateTime;?>
									<input type="date" class="form-control" name="posisi-tanggal" id="posisi-tanggal" value="<?php echo $lahir->format('d-m-Y'); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="posisi-jobdes" class="col-sm-2 control-label">Deskripsi Kerja</label>
								<div class="col-sm-5">
									<label class="radio-inline"><input type="radio" name="posisi-jobdes" id="posisi-jobdesAda" value="Ada" default>Ada</label>
									<label class="radio-inline"><input type="radio" name="posisi-jobdes" id="posisi-jobdesTidak" value="Tidak Ada">Tidak Ada</label>
									<p class="help-block">*Jika tidak ada, wajib membuat dan melampirkan.</p>
								</div>
							</div>
							<div class="form-group">
								<label for="posisi-status" class="col-sm-2 control-label">Status Karyawan</label>
								<div class="col-sm-5">
									<label class="radio-inline"><input type="radio" name="posisi-status" id="posisi-statusBulanan" value="Bulanan" default>Bulanan</label>
									<label class="radio-inline"><input type="radio" name="posisi-status" id="posisi-statusHarian" value="Harian">Harian</label>
								</div>
							</div>
							
							<h4>III. Kualifikasi</h4>
							<div class="form-group">
								<label for="kualifikasi-jumlahl" class="col-sm-2 control-label">Jumlah Dibutuhkan</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">Laki-Laki</div>
										<input type="number" name="kualifikasi-jumlahl" class="form-control" id="kualifikasi-jumlahl">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">Perempuan</div>
										<input type="number" name="kualifikasi-jumlahp" class="form-control" id="kualifikasi-jumlahp">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="kualifikasi-usia" class="col-sm-2 control-label">Usia</label>
								<div class="col-sm-5">
									<input type="number" name="kualifikasi-usia" class="form-control" id="kualifikasi-usia" placeholder="Usia (Hanya Angka)">
								</div>
							</div>
							<div class="form-group">
								<label for="kualifikasi-pendidikan" class="col-sm-2 control-label">Pendidikan</label>
								<div class="col-sm-5">
									<?php
										$queryPendidikan = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
										$execPendidikan = mysql_query($queryPendidikan);
									?>
									<select name="kualifikasi-pendidikan" id="kualifikasi-pendidikan" class="form-control">
										<?php
											while($resultPendidikan = mysql_fetch_array($execPendidikan))
											{
												?><option value="<?php echo $resultPendidikan['idTingkat'];?>"><?php echo $resultPendidikan['namaPendidikan'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kualifikasi-jurusan" class="col-sm-2 control-label">Jurusan</label>
								<div class="col-sm-5">
									<?php
										$queryJurusan = "SELECT * FROM tableJurusan ORDER BY namaJurusan ASC";
										$execJurusan = mysql_query($queryJurusan);
									?>
									<select name="kualifikasi-jurusan" id="kualifikasi-jurusan" class="form-control">
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
								<label for="kualifikasi-pengalaman" class="col-sm-2 control-label">Pengalaman</label>
								<div class="col-sm-5">
									<input type="number" name="kualifikasi-pengalaman" class="form-control" id="kualifikasi-pengalaman" placeholder="Pengalaman (Hanya Angka)">
								</div>
							</div>
							<div class="form-group">
								<label for="kualifikasi-lainlain" class="col-sm-2 control-label">Lain-Lain</label>
								<div class="col-sm-5">
									<textarea type="number" name="kualifikasi-lainlain" class="form-control" id="kualifikasi-lainlain"></textarea>
								</div>
							</div>
							
							<h4>IV. Untuk Karyawan Bulanan</h4>
							<div class="form-group">
								<label for="bulanan-tglditerima" class="col-sm-2 control-label">Tanggal FPTK Diterima</label>
								<div class="col-sm-5">
									<?php $lahir = new DateTime;?>
									<input type="date" class="form-control" name="bulanan-tglditerima" id="bulanan-tglditerima" value="<?php echo $lahir->format('d-m-Y'); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="bulanan-pic" class="col-sm-2 control-label">PIC</label>
								<div class="col-sm-5">
									<input type="text" name="bulanan-pic" id="bulanan-pic" class="form-control"  placeholder="PIC">
								</div>
							</div>
							<div class="form-group">
								<label for="bulanan-tglclosing" class="col-sm-2 control-label">Tanggal Closing</label>
								<div class="col-sm-5">
									<?php $lahir = new DateTime;?>
									<input type="date" class="form-control" name="bulanan-tglclosing" id="bulanan-tglclosing" value="<?php echo $lahir->format('d-m-Y'); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="bulanan-pemenuhan" class="col-sm-2 control-label">Lama Pemenuhan</label>
								<div class="col-sm-5">
									<input type="text" name="bulanan-pemenuhan" id="bulanan-pemenuhan" class="form-control"  placeholder="Lama Pemenuhan">
								</div>
							</div>
							<div class="form-group">
								<label for="bulanan-karyawan" class="col-sm-2 control-label">Karyawan a.n.</label>
								<div class="col-sm-5">
									<input type="text" name="bulanan-karyawan" id="bulanan-karyawan" class="form-control"  placeholder="Nama Karyawan">
								</div>
							</div>
							<div class="form-group">
								<label for="bulanan-tglmasuk" class="col-sm-2 control-label">Tanggal Masuk</label>
								<div class="col-sm-5">
									<?php $lahir = new DateTime;?>
									<input type="date" class="form-control" name="bulanan-tglmasuk" id="bulanan-tglmasuk" value="<?php echo $lahir->format('d-m-Y'); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="bulanan-sbrinternal" class="col-sm-2 control-label">Sumber Rekrutmen</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">Internal</div>
										<input type="text" class="form-control"  name="bulanan-sbrinternal" id="bulanan-sbrinternal">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">Eksternal</div>
										<?php
											$queryReferensi = "SELECT * FROM referensiEksternal ORDER BY idRefeksternal ASC";
											$execReferensi = mysql_query($queryReferensi);
										?>
										<select name="bulanan-sbreksternal" id="bulanan-sbreksternal" class="form-control">
											<?php
												while($resultReferensi = mysql_fetch_array($execReferensi))
												{
													?><option value="<?php echo $resultReferensi['idRefeksternal'];?>"><?php echo $resultReferensi['namaRefeksternal'];?></option><?php
												}
											?>
										</select>
									</div>
									<div class="input-group">
										<input type="text" id="laineksternalBulanan" name="laineksternalBulanan" placeholder="Sebutkan Jika Tidak Ada Di-list" class="form-control">
									</div>
								</div>
							</div>
							
							<h4>IV. Untuk Karyawan Harian</h4>
							<div class="form-group">
								<label for="harian-tglditerima" class="col-sm-2 control-label">Tanggal FPTK Diterima</label>
								<div class="col-sm-5">
									<?php $lahir = new DateTime;?>
									<input type="date" class="form-control" name="harian-tglditerima" id="harian-tglditerima" value="<?php echo $lahir->format('d-m-Y'); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="harian-tglclosing" class="col-sm-2 control-label">Tanggal Closing</label>
								<div class="col-sm-5">
									<?php $lahir = new DateTime;?>
									<input type="date" class="form-control" name="harian-tglclosing" id="harian-tglclosing" value="<?php echo $lahir->format('d-m-Y'); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="harian-pemenuhan" class="col-sm-2 control-label">Lama Pemenuhan</label>
								<div class="col-sm-5">
									<input type="text" name="harian-pemenuhan" id="harian-pemenuhan" class="form-control"  placeholder="Lama Pemenuhan">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-2 col-md-6">
									<button type="submit" name="edit-fptk" class="btn btn-primary btn-sm">Save</button>
								</div>
							</div>
						</form>
					<?php
				}
			}
			include("templates/foot.php");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>