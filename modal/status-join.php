<?
	include('../module/config.php');
	include('css.php');
?>

<div class="popdown-content">
	<header>
		<h2><b>Join/Withdraw/Reject</b></h2>
	</header>
	<section class="body">
		<form role="form" id="formjoin" action="<?=$base_url?>index.php?r=status-proses" method="post">
			<input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">
			<? 
				if(isset($_GET['id']) and isset($_GET['v']))
				{
					$id = $_GET['id'];
					$v = $_GET['v'];
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
			<input type="hidden" name="id" value="<?=$id?>">
			<input type="hidden" name="v" value="<?=$v?>">
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
			</br>
			
			<div class="form-group">
				<label class="control-label" for="joinreject" required="required"><b>Status</b></label>
				<div class="col-lg-12">
					<div class="radio-custom inline radio-success">
						<input type="radio" value="Join" name="joinreject" id="success">
						<label for="success">Join</label>
					</div>
					<div class="radio-custom inline radio-info">
						<input type="radio" value="Withdraw" name="joinreject" id="infor">
						<label for="infor">Withdraw</label>
					</div>
					<div class="radio-custom inline radio-danger">
						<input type="radio" value="Reject" name="joinreject" id="danger">
						<label for="danger">Reject</label>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label for="joindate" class="control-label"><b>Tanggal Join</b></label>
				<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" class="input-append date dpYears">
					<input type="text" name="joindate" class="form-control" required>
					<span class="input-group-btn add-on">
						<button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>
				<span class="help-block">Select date</span>
			</div>
			
			<div class="form-group">
				<label class="control-label" for="ketjoin" required="required"><b>Keterangan</b></label>
				<textarea type="text" name="ketjoin" id="ketjoin" class="form-control" style="width:100%; height:100%;"></textarea>
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary" id="savejoin" name="savejoin">Save</button>
				<!--<button type="button" class="btn btn-default" onclick="javascript:location.href='<?=$base_url?>index.php?r=vacancy-show'">Cancel</button>-->
			</div>
		</form>
	</section>
</div>
<? include('js.php'); ?>