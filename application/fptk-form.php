<?
	if(isset($_GET['idFptk']))
	{
		$idFptk=$_GET['idFptk'];
		$data=mysql_fetch_array(mysql_query("select * from fptk where idFptk='$idFptk'"));
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
			<?if(isset($_GET['idFptk'])){ ?>
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
					<?if(isset($_GET['idFptk']))
					{ ?>Edit FPTK<? }
					else
					{?>Add New FPTK<? } ?>
				</header>
				<div class="panel-body spinner">
					<form role="form" class="form-horizontal" id="newFptk" action="<?=$base_url?>index.php?r=fptk-proses" method="post">
						<h4>Informasi Posisi</h4>
						<div class="form-group">
							<label for="posisiDirektorat" class="col-sm-2 control-label">Direktorat</label>
							<div class="col-lg-10">
								<select name="posisiDirektorat" id="posisiDirektorat" class="form-control select2" required>
									<option value=""></option>
									<optgroup label="-- Pilih Direktorat --">
									<?php
										$dir=mysql_query("select * from kategoriDirektorat order by namaDirektorat"); 
										while($cet_dir=mysql_fetch_array($dir))
										{ ?> <option <?=($cet_dir['idDirektorat']==$data['direktoratPosisi'])?'selected':'';?> value="<?=$cet_dir['idDirektorat'] ?>"><? echo $cet_dir['namaDirektorat'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="posisiDepartemen" class="col-sm-2 control-label">Departemen</label>
							<div class="col-lg-10">
								<select name="posisiDepartemen" id="posisiDepartemen" class="form-control select2" required>
									<option value=""></option>
									<optgroup label="-- Pilih Departemen --">
									<? 
										$dep=mysql_query("select * from kategoriDepartemen order by namaDepartemen"); 
										while($cet_dep=mysql_fetch_array($dep))
										{ ?> <option <?=($cet_dep['idDepartemen']==$data['departemenPosisi'])?'selected':'';?> value="<?=$cet_dep['idDepartemen'] ?>"><? echo $cet_dep['namaDepartemen'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiSection" class="col-sm-2 control-label">Section</label>
							<div class="col-lg-10">
								<select name="posisiSection" id="posisiSection" class="form-control select2" required>
									<option value=""></option>
									<optgroup label="-- Pilih Section --">
									<? 
										$sec=mysql_query("select * from kategoriSection order by namaSection"); 
										while($cet_sec=mysql_fetch_array($sec))
										{ ?> <option <?=($cet_sec['idSection']==$data['sectionPosisi'])?'selected':'';?> value="<?=$cet_sec['idSection'] ?>"><? echo $cet_sec['namaSection'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiJabatan" class="col-sm-2 control-label">Posisi/Jabatan</label>
							<div class="col-lg-10">
								<select name="posisiJabatan" id="posisiJabatan" class="form-control select2" required>
									<option value=""></option>
									<optgroup label="-- Pilih Posisi --">
									<? 
										$jab=mysql_query("select * from kategoriKerja order by namaKategori"); 
										while($cet_jab=mysql_fetch_array($jab))
										{ ?> <option <?=($cet_jab['idKategori']==$data['jabatanPosisi'])?'selected':'';?> value="<?=$cet_jab['idKategori'] ?>"><? echo $cet_jab['namaKategori'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiLevel" class="col-sm-2 control-label">Level</label>
							<div class="col-lg-10">
								<select name="posisiLevel" id="posisiLevel" class="form-control select2" required>
									<option value=""></option>
									<optgroup label="-- Pilih Level --">
									<? 
										$lev=mysql_query("select * from kategoriLevel order by namaLevel"); 
										while($cet_lev=mysql_fetch_array($lev))
										{ ?> <option <?=($cet_lev['idLevel']==$data['levelPosisi'])?'selected':'';?> value="<?=$cet_lev['idLevel'] ?>"><? echo $cet_lev['namaLevel'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiLokasi" class="col-sm-2 control-label">Lokasi Penempatan</label>
							<div class="col-lg-10">
								<select name="posisiLokasi" id="posisiLokasi" class="form-control select2" required>
									<option value=""></option>
									<optgroup label="-- Pilih Lokasi --">
									<? 
										$dis=mysql_query("select * from kategoriDistrik order by namaDistrik"); 
										while($cet_dis=mysql_fetch_array($dis))
										{ ?> <option <?=($cet_dis['idDistrik']==$data['lokasiPosisi'])?'selected':'';?> value="<?=$cet_dis['idDistrik'] ?>"><? echo $cet_dis['namaDistrik'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiJumlah" class="col-sm-2 control-label">Jumlah Kebutuhan</label>
							<div class="col-lg-10">
								<div class="input-group">
									<input class="form-control" id="posisiJumlah" name="posisiJumlah" type="text" placeholder="Hanya angka (contoh, 2)" value="<?=$data['jumlahPosisi']?>" required/>
									<div class="input-group-addon">Orang</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiTujuan" class="col-sm-2 control-label">Tujuan Permintaan</label>
							<div class="col-lg-10">
								<label class="radio-inline"><input type="radio" name="posisiTujuan" id="posisiTujuanBaru" <?php if($data['tujuanPosisi'] == "Rekrut Baru"){ echo "checked";}?> value="Rekrut Baru" >Rekrut Baru</label>
								<label class="radio-inline"><input type="radio" name="posisiTujuan" id="posisiTujuanGanti" <?php if($data['tujuanPosisi'] == "Penggantian"){ echo "checked";}?> value="Penggantian" >Penggantian</label>
								<div class="input-group">
									<input type="text" id="posisiPengganti" name="posisiPengganti" class="form-control" value="<?=$data['penggantiPosisi']?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiTanggal" class="col-sm-2 control-label">Tanggal Dibutuhkan</label>
							<div class="col-lg-10">
								<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" class="input-append date dpYears">
									<input type="text" name="posisiTanggal" class="form-control" value="<?=$data['tanggalPosisi']?>" required>
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
								<label class="radio-inline"><input type="radio" name="posisiJobdes" id="posisiJobdesAda" <?php if($data['jobdesPosisi'] == "Ada"){ echo "checked";}?> value="Ada" >Ada</label>
								<label class="radio-inline"><input type="radio" name="posisiJobdes" id="posisiJobdesTidak" <?php if($data['jobdesPosisi'] == "Tidak Ada"){ echo "checked";}?> value="Tidak Ada" >Tidak Ada</label>
								<p class="help-block">*Jika tidak ada, wajib membuat dan melampirkan.</p>
							</div>
						</div>
						<div class="form-group">
							<label for="posisiStatus" class="col-sm-2 control-label">Status Karyawan</label>
							<div class="col-lg-10">
								<label class="radio-inline"><input type="radio" name="posisiStatus" id="posisiStatusBulanan" <?php if($data['statusPosisi'] == "Bulanan"){ echo "checked";}?> value="Bulanan"  >Bulanan</label>
								<label class="radio-inline"><input type="radio" name="posisiStatus" id="posisiStatusHarian" <?php if($data['statusPosisi'] == "Harian"){ echo "checked";}?> value="Harian" >Harian</label>
							</div>
						</div>
						<h4>Kualifikasi</h4>
						<div class="form-group">
							<label for="kualifikasiJumlahl" class="col-sm-2 control-label">Jumlah Dibutuhkan</label>
							<div class="col-lg-10">
								<div class="input-group">
									<div class="input-group-addon">Laki-Laki</div>
									<input type="text" name="kualifikasiJumlahl" class="form-control" id="kualifikasiJumlahl" placeholder="Hanya angka (contoh, 1)" value="<?=$data['jumlahlKualifikasi']?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-lg-10">
								<div class="input-group">
								<div class="input-group-addon">Perempuan</div>
									<input type="text" name="kualifikasiJumlahp" class="form-control" id="kualifikasiJumlahp" placeholder="Hanya angka (contoh, 1)" value="<?=$data['jumlahpKualifikasi']?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="kualifikasiUsia" class="col-sm-2 control-label">Usia</label>
							<div class="col-lg-10">
								<div class="input-group">
									<input type="text" name="kualifikasiUsia" class="form-control" id="kualifikasiUsia" value="<?=$data['usiaKualifikasi']?>" placeholder="Hanya angka (contoh, 30)" required>
									<div class="input-group-addon">Tahun</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="kualifikasiPendidikan" class="col-sm-2 control-label">Pendidikan</label>
							<div class="col-lg-10">
								<select name="kualifikasiPendidikan" id="kualifikasiPendidikan" class="form-control select2" required>
									<option value=""></option>
									<optgroup label="-- Pilih Pendidikan --">
									<? 
										$edu=mysql_query("select * from tingkatPendidikan order by gradePendidikan"); 
										while($cet_edu=mysql_fetch_array($edu))
										{ ?> <option <?=($cet_edu['gradePendidikan']==$data['pendidikanKualifikasi'])?'selected':'';?> value="<?=$cet_edu['gradePendidikan'] ?>"><? echo $cet_edu['namaPendidikan'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="kualifikasiJurusan" class="col-sm-2 control-label">Jurusan</label>
							<div class="col-lg-10">
								<select name="kualifikasiJurusan" id="kualifikasiJurusan" class="form-control select2" required>
									<option value=""></option>
									<optgroup label="-- Pilih Jurusan --">
									<? 
										$jur=mysql_query("select * from tableJurusan order by namaJurusan"); 
										while($cet_jur=mysql_fetch_array($jur))
										{ ?> <option <?=($cet_jur['idJurusan']==$data['jurusanKualifikasi'])?'selected':'';?> value="<?=$cet_jur['idJurusan'] ?>"><? echo $cet_jur['namaJurusan'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="kualifikasiPengalaman" class="col-sm-2 control-label">Pengalaman</label>
							<div class="col-lg-10">
								<div class="input-group">
									<input type="text" name="kualifikasiPengalaman" class="form-control" id="kualifikasiPengalaman" value="<?=$data['pengalamanKualifikasi']?>" placeholder="Hanya angka (contoh, 2)" required>
									<div class="input-group-addon">Tahun</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="kualifikasiLainlain" class="col-sm-2 control-label">Lain-Lain</label>
							<div class="col-lg-10">
								<textarea type="text" name="kualifikasiLainlain" class="form-control"id="kualifikasiLainlain" value="<?=$data['lainlainKualifikasi']?>"><?=$data['lainlainKualifikasi']?></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-2">
								<?if(isset($_GET['idFptk'])){ ?>
								<input type="hidden" name="idFptk" value="<?=$idFptk?>"> 
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