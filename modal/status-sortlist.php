<?
	include('../module/config.php');
	include('css.php');
?>

<div class="popdown-content" style="overflow:hidden; height:auto;">
	<header>
		<h2><b>Sortlist</b></h2>
	</header>
	<section class="body">
		<form role="form" id="formsortlist" action="<?=$base_url?>index.php?r=status-proses" method="post">	
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
					
					/*$vacancy = "select * from vacancyapply va ";
					$vacancy .= "where idWorker = '".$id."' ";
					$execvacancy = mysql_query($vacancy);
					$cet_vacancy = mysql_fetch_array($execvacancy)*/
				}
			?>
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
			
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label for="ketsort" required="required" class="control-label"><b>Keterangan</b></label>
						<textarea name="ketsort" id="ketsort" style="width:100%; height:100%;"></textarea><?//=$cet_sum['ketsort']?>
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="idWorker" value="<?=$id?>">
					<!--<input type="hidden" name="idvacancy" value="<?=$idvacancy?>">-->
					<button type="submit" class="btn btn-primary" id="savesort" name="savesort">Save</button>
					<!--<button type="button" class="btn btn-default" onclick="javascript:location.href='<?=$base_url?>index.php?r=vacancy-show'">Cancel</button>-->
				</div>
			</div>
		</form>
	</section>
</div>
<? include('js.php'); ?>