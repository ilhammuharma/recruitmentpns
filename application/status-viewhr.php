<?
	include('../module/config.php');
?>
<link rel="stylesheet" href="assets/print-invoice.css" media="print">

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

<!--body wrapper start-->
<div class="wrapper body" style="padding:10px;">
	<div class="panel invoice">
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12" >
					<h1>Hasil Interview HR</h1>
				</div>
			</div>
			<br/>
			
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
							<td><?=$cet_edu['jurusan'];?></td>
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
			
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<a class="btn btn-danger" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
<!--body wrapper end-->