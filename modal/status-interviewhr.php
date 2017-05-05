<?
	include('../module/config.php');
	include('css.php');
?>

<div class="popdown-content" style="overflow:hidden; height:auto;">
	<header>
		<h2><b>Interview HR</b></h2>
	</header>
	<section class="body">
		<form role="form" id="forminterviewhr" action="<?=$base_url?>index.php?r=status-proses" method="post">	
			<input type="hidden" name="id" value="<?=$_SESSION['id'];?>">
			<? 
				if(isset($_GET['id']))
				{
					$id = $_GET['id'];
					$data= "Select *, tp.namaProvinsi, kk.namaKategori from userWorker uw ";
					$data.= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
					$data.= "JOIN kategoriKerja kk ON kk.idKategori = uw.posisi ";
					$data.= "where idWorker='".$id."' ";
					$execdata = mysql_query($data);
					$cet_data = mysql_fetch_array($execdata);
									
					$edu= "SELECT *, tprov.namaProvinsi as lokasi, tp.namaPendidikan as jenjang, tj.namaJurusan as jurusan from pendidikanWorker pw ";
					$edu.= "INNER JOIN tableProvinsi tprov ON tprov.idProvinsi = pw.lokasiInstansi ";
					$edu.= "INNER JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
					$edu.= "INNER JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
					$edu.= "WHERE idWorker='".$id."' ORDER BY tahunLulus DESC limit 1 ";
					$execedu = mysql_query($edu);
					$cet_edu = mysql_fetch_array($execedu);
				}
			?>
			<input type="hidden" name="idWorker" value="<?=$id;?>">
			<div class="row">
				<div class="col-xs-6">
					<table border="0" width="100%" class="print">
						<tr>
							<td width="150px">Nama</td>
							<td width="20px">:</td>
							<td><?=$cet_data['namaUser'];?></td>
						</tr>
						<tr>
							<td>Tanggal Lahir</td>
							<td>:</td>
							<td><?=tanggal2($cet_data['tanggalLahir']);?></td>
						</tr>
						<tr>
							<td>Pendidikan</td>
							<td>:</td>
							<td><?=$cet_edu['namaJurusan'];?></td>
						</tr>
					</table>
				</div>
				<div class="col-xs-6">
					<table border="0" width="100%" class="print">
						<tr>
							<td width="150px">Posisi</td>
							<td width="20px">:</td>
							<td><?=$cet_data['namaKategori'];?></td>
						</tr>
						<tr>
							<td>No.Telp</td>
							<td>:</td>
							<td><?=$cet_data['noPonsel'];?></td>
						</tr>
						<tr>
							<td>Domisili</td>
							<td>:</td>
							<td><?=$cet_data['namaProvinsi'];?></td>
						</tr>
					</table>
				</div>
			</div>	
			
			<? soal(1);?>
			
			<div class="col-xs-12 col-sm-4 col-lg-4">
				<h3><b>Total Gross Component</b></h3>
				<div class="form-group">
					<label for="gajipokok" class="control-label"><b>Gaji Pokok</b></label>
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" name="gajipokok" class="form-control pokok" id="gajipokok" value="<?=$cet_sum['gajipokok']?>" placeholder="Hanya angka" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="tunjangan" class="control-label"><b>Tunjangan</b></label>
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" name="tunjangan" class="form-control pokok" id="tunjangan" value="<?=$cet_sum['tunjangan']?>" placeholder="Hanya angka" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="tunjanganlain" class="control-label"><b>Tunjangan Lain</b></label>
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" name="tunjanganlain" class="form-control pokok" id="tunjanganlain" value="<?=$cet_sum['tunjanganlain']?>" placeholder="Hanya angka" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="premi" class="control-label"><b>Premi</b></label>
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" name="premi" class="form-control pokok" id="premi" value="<?=$cet_sum['premi']?>" placeholder="Hanya angka" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="total" class="control-label"><b>Total</b></label>
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" name="total" class="form-control total" id="total" value="<?=$cet_sum['total']?>" placeholder="Hanya angka" required>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-4 col-lg-4">
				<h3><b>Total Variable Pay</b></h3>
				<div class="form-group">
					<label for="makan" class="control-label"><b>Makan</b></label>
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" name="makan" class="form-control" id="makan" value="<?=$cet_sum['makan']?>" placeholder="Hanya angka" required>
					</div>
				</div>
								
				<div class="form-group">
					<label for="lembur" class="control-label"><b>Lembur</b></label>
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" name="lembur" class="form-control" id="lembur" value="<?=$cet_sum['lembur']?>" placeholder="Hanya angka" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="bonus" class="control-label"><b>Bonus</b></label>
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" name="bonus" class="form-control" id="bonus" value="<?=$cet_sum['bonus']?>" placeholder="Hanya angka" required>
					</div>
				</div>
			</div>
				
			<div class="col-xs-12 col-sm-4 col-lg-4">
				<h3><b>Benefit</b></h3>
				<div class="form-group">
					<label for="transport" class="control-label"><b>Transportasi</b></label>
					<input type="text" name="transport" class="form-control" id="transport" value="<?=$cet_sum['transport']?>" required>
				</div>
				
				<div class="form-group">
					<label for="kesehatan" required="required" class="control-label"><b>Kesehatan</b></label>
					<textarea name="kesehatan" id="kesehatan" style="width:100%; height:100%;"><?=$cet_sum['kesehatan']?></textarea>
				</div>
				
				<div class="form-group">
					<label for="cuti" class="control-label"><b>Cuti</b></label>
					<input type="text" name="cuti" class="form-control" id="cuti" value="<?=$cet_sum['cuti']?>" required>
				</div>
				
				<div class="form-group">
					<label for="dll" required="required" class="control-label"><b>Lain-Lain</b></label>
					<textarea name="dll" id="dll" style="width:100%; height:100%;"><?=$cet_sum['dll']?></textarea>
				</div>
			</div>
		
			<div class="col-xs-12 col-sm-12 col-lg-12">
				<h3><b>Total Cash</b></h3>
				<div class="form-group">
					<label for="expectation" class="control-label"><b>Expectation</b></label>
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input type="text" name="expectation" class="form-control" id="expectation" value="<?=$cet_sum['expectation']?>" required>
					</div>
				</div>
				
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary" id="savehr" name="savehr">Save</button>
					<!--<button type="button" class="btn btn-default" onclick="javascript:location.href='<?=$base_url?>index.php?r=vacancy-show'">Cancel</button>-->
				</div>
			</div>
			
		</form>
	</section>
</div>
<? include('js.php'); ?>