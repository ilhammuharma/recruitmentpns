<?
	if(isset($_GET['i']))
	{
		$id=$_GET['i'];
		$data=mysql_fetch_array(mysql_query("select * from loginuser where idLogin='$id'"));
	}
?>

<!-- page head start-->
<div class="page-head">
	<h3 class="m-b-less">
	FPTK
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li>Home</li>
			<li>FPTK</li>
			<?if(isset($_GET['i'])){ ?>
			<li class="active">Edit FPTK</li>
			<? }else{?>
			<li class="active">Add New FPTK</li>
			<? } ?>
		</ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					<?if(isset($_GET['i']))
					{ ?>Edit FPTK<? }
					else
					{?>Add New FPTK<? } ?>
				</header>
				<div class="panel-body spinner">
					<form role="form" class="form-horizontal" id="newFptk" action="<?=$base_url?>index.php?r=fptk-proses" method="post">
						<header class="panel-heading"><b>Informasi Posisi</b></header>
						<div class="form-group">
							<label for="posisiDirektorat" class="col-sm-2 control-label">Direktorat</label>
							<div class="col-lg-10">
								<select name="posisiDirektorat" id="posisiDirektorat" class="form-control" required>
									<option value="">-- Pilih Direktorat --</option>
									<?php
										$queryDirektorat1 = "SELECT * FROM kategoriDirektorat ORDER BY namaDirektorat ASC";
										$execDirektorat1 = mysql_query($queryDirektorat1);
										while($resultDirektorat1 = mysql_fetch_array($execDirektorat1))
										{
											?><option value="<?php echo $resultDirektorat1['idDirektorat'];?>"><?php echo $resultDirektorat1['namaDirektorat'];?></option><?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiDepartemen" class="col-sm-2 control-label">Departemen</label>
							<div class="col-lg-10">
								<select name="posisiDepartemen" id="posisiDepartemen" class="form-control" required>
									<option value="">-- Pilih Departemen --</option>
									<?php
										$queryDepartemen2 = "SELECT * FROM kategoriDepartemen ORDER BY namaDepartemen ASC";
										$execDepartemen2 = mysql_query($queryDepartemen2);
										while($resultDepartemen2 = mysql_fetch_array($execDepartemen2))
										{
											?><option value="<?php echo $resultDepartemen2['idDepartemen'];?>"><?php echo $resultDepartemen2['namaDepartemen'];?></option><?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiSection" class="col-sm-2 control-label">Bagian</label>
							<div class="col-lg-10">
								<select name="posisiSection" id="posisiSection" class="form-control" required>
									<option value="">-- Pilih Bagian --</option>
									<?php
										$querySection2 = "SELECT * FROM kategoriSection ORDER BY namaSection ASC";
										$execSection2 = mysql_query($querySection2);
										while($resultSection2 = mysql_fetch_array($execSection2))
										{
											?><option value="<?php echo $resultSection2['idSection'];?>"><?php echo $resultSection2['namaSection'];?></option><?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiJabatan" class="col-sm-2 control-label">Posisi/Jabatan</label>
							<div class="col-lg-10">
								<select name="posisiJabatan" id="posisiJabatan" class="form-control" required>
									<option value="">-- Pilih Posisi --</option>
									<?php
										$queryPosisi2 = "SELECT * FROM kategoriKerja ORDER BY idKategori ASC";
										$execPosisi2 = mysql_query($queryPosisi2);
										while($resultPosisi2 = mysql_fetch_array($execPosisi2))
										{
											?><option value="<?php echo $resultPosisi2['idKategori'];?>"><?php echo $resultPosisi2['namaKategori'];?></option><?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiLevel" class="col-sm-2 control-label">Level</label>
							<div class="col-lg-10">
								<select name="posisiLevel" id="posisiLevel" class="form-control" required>
									<option value="">-- Pilih Level --</option>
									<?php
										$queryLevel = "SELECT * FROM kategoriLevel ORDER BY namaLevel ASC";
										$execLevel = mysql_query($queryLevel);
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
							<div class="col-lg-10">
								<select name="posisiLokasi" id="posisiLokasi" class="form-control" required>
									<option value="">-- Pilih Lokasi --</option>
									<?php
										$distrik = "SELECT * FROM kategoriDistrik ORDER BY namaDistrik ASC";
										$execDistrik = mysql_query($distrik);
										while($resultDistrik = mysql_fetch_array($execDistrik))
										{ 
											?><option value="<?php echo $resultDistrik['idDistrik'];?>"><?php echo $resultDistrik['namaDistrik'];?></option><?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiJumlah" class="col-sm-2 control-label">Jumlah Kebutuhan</label>
							<div class="col-lg-10">
								<input type="text" id="posisiJumlah" name="posisiJumlah" class="form-control" value="0" required>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiTujuan" class="col-sm-2 control-label">Tujuan Permintaan</label>
							<div class="col-lg-10">
								<label class="radio-inline"><input type="radio" name="posisiTujuan" id="posisiTujuanBaru" value="Rekrut Baru" default required>Rekrut Baru</label>
								<label class="radio-inline"><input type="radio" name="posisiTujuan" id="posisiTujuanGanti" value="Penggantian" required>Penggantian</label>
								<div class="input-group">
									<input type="text" id="posisiPengganti" name="posisiPengganti" placeholder="Atas Nama" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiTanggal" class="col-sm-2 control-label">Tanggal Dibutuhkan</label>
							<div class="col-lg-10">
								<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" class="input-append date dpYears" required>
									<input type="text" name="posisiTanggal" class="form-control">
									<span class="input-group-btn add-on">
										<button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
								<span class="help-block">Select date</span>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiJobdes" class="col-sm-2 control-label">Deskripsi Kerja</label>
							<div class="col-lg-10">
								<label class="radio-inline"><input type="radio" name="posisiJobdes" id="posisiJobdesAda" value="Ada" default required>Ada</label>
								<label class="radio-inline"><input type="radio" name="posisiJobdes" id="posisiJobdesTidak" value="Tidak Ada" required>Tidak Ada</label>
								<p class="help-block">*Jika tidak ada, wajib membuat dan melampirkan.</p>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiStatus" class="col-sm-2 control-label">Status Karyawan</label>
							<div class="col-lg-10">
								<label class="radio-inline"><input type="radio" name="posisiStatus" id="posisiStatusBulanan" value="Bulanan" default required>Bulanan</label>
								<label class="radio-inline"><input type="radio" name="posisiStatus" id="posisiStatusHarian" value="Harian" required>Harian</label>
							</div>
						</div>
						<header class="panel-heading"><b>Kualifikasi</b></header>
						<div class="form-group">
							<label for="kualifikasiJumlahl" class="col-sm-2 control-label">Jumlah Dibutuhkan</label>
							<div class="col-lg-10">
								<div class="input-group">
									<div class="input-group-addon">Laki-Laki</div>
									<input type="text" name="kualifikasiJumlahl" class="form-control" id="kualifikasiJumlahl" value="0" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-lg-10">
								<div class="input-group">
								<div class="input-group-addon">Perempuan</div>
									<input type="text" name="kualifikasiJumlahp" class="form-control" id="kualifikasiJumlahp" value="0" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="kualifikasiUsia" class="col-sm-2 control-label">Usia</label>
							<div class="col-lg-10">
								<input type="text" name="kualifikasiUsia" class="form-control" id="kualifikasiUsia" placeholder="Usia (Tahun)" required>
							</div>
						</div>
						<div class="form-group">
							<label for="kualifikasiPendidikan" class="col-sm-2 control-label">Pendidikan</label>
							<div class="col-lg-10">
								<select name="kualifikasiPendidikan" id="kualifikasiPendidikan" class="form-control" required>
								<option value="">-- Pilih Pendidikan --</option>
									<?php
										$queryPendidikan = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
										$execPendidikan = mysql_query($queryPendidikan);
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
							<div class="col-lg-10">
								<select name="kualifikasiJurusan" id="kualifikasiJurusan" class="form-control" required>
								<option value="">-- Pilih Jurusan --</option>
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
						<div class="form-group">
							<label for="kualifikasiPengalaman" class="col-sm-2 control-label">Pengalaman</label>
							<div class="col-lg-10">
								<input type="text" name="kualifikasiPengalaman" class="form-control" id="kualifikasiPengalaman" placeholder="Pengalaman (Tahun)" required>
							</div>
						</div>
						<div class="form-group">
							<label for="kualifikasiLainlain" class="col-sm-2 control-label">Lain-Lain</label>
							<div class="col-lg-10">
								<textarea type="text" name="kualifikasiLainlain" class="form-control" placeholder="Lain-Lain" id="kualifikasiLainlain"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-2">
								<?if(isset($_GET['i'])){ ?>
								<input type="hidden" name="id" value="<?=$id?>"> 
								<input class="btn btn-success" type="submit" name="edit" value="Edit">
								<? }else{?>
								<input class="btn btn-success" type="submit" name="save" value="Save">
								<? } ?>
								<button type="button" class="btn btn-default" onclick="javascript:location.href='<?=$base_url?>index.php?r=fptk'">Cancel</button>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->