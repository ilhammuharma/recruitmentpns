<?
	include('../module/config.php');
	//include('css.php');
?>
<? 
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$data = "SELECT *, kdir2.namaDirektorat as direktorat2, kde2.namaDepartemen as departemen2, ks2.namaSection as section2, 
					kk2.namaKategori as posisi2, kl2.namaLevel as level2, kdis2.namaDistrik as distrik2, tpe.namaPendidikan, tj.namaJurusan FROM fptk f ";
		$data .= "INNER JOIN kategoriDirektorat kdir2 ON kdir2.idDirektorat = f.direktoratPosisi ";
		$data .= "INNER JOIN kategoriDepartemen kde2 ON kde2.idDepartemen = f.departemenPosisi ";
		$data .= "INNER JOIN kategoriSection ks2 ON ks2.idSection = f.sectionPosisi ";
		$data .= "INNER JOIN kategoriKerja kk2 ON kk2.idKategori = f.jabatanPosisi ";
		$data .= "INNER JOIN kategoriLevel kl2 ON kl2.idLevel = f.levelPosisi ";
		$data .= "INNER JOIN kategoriDistrik kdis2 ON kdis2.idDistrik = f.lokasiPosisi ";
		$data .= "INNER JOIN tingkatPendidikan tpe ON tpe.gradePendidikan = f.pendidikanKualifikasi ";
		$data .= "INNER JOIN tableJurusan tj ON tj.idJurusan = f.jurusanKualifikasi ";
		$data .= "WHERE idFptk = $id";
		$execdata = mysql_query($data);
		$cet_data = mysql_fetch_array($execdata);
	}
?>
<div class="popdown-content" style="overflow:hidden; height:auto;">
	<header>
		<h2><b>Alasan Reject FPTK No. <?=$cet_data['nomorFptk']?></b></h2>
	</header>
	<section class="body">
		<form role="form" id="formreject" action="<?=$base_url?>index.php?r=fptk-proses" method="post">	
			<!--<input type="hidden" name="id" value="<?=$_SESSION['id'];?>">-->
			<input type="hidden" name="id" value="<?=$id;?>">
			<input type="hidden" name="nomorFptk" value="<?=$cet_data['nomorFptk']?>">
			<div class="form-group">
				<label for="keteranganReject" required="required" class="control-label"><b>Alasan</b></label>
				<textarea name="keteranganReject" id="keteranganReject" style="width:100%; height:100%;"><?=$cet_data['alasanReject']?></textarea>
			</div>
			<div class="form-group">
					<button type="submit" name="reject" id="reject" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</section>
</div>
<? //include('js.php'); ?>