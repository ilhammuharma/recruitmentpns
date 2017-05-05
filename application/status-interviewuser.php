<div class="popdown-content">
	<?
		$kandidat = "Select *, tp.namaProvinsi, kk.namaKategori from userWorker uw ";
		$kandidat .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
		$kandidat .= "JOIN kategoriKerja kk ON kk.idKategori = uw.posisi ";
		$kandidat .= "where nomorFptk in (select fptk from `vacancy` where createby='".$_SESSION['nama']."') and statusRekrut='4' order by namaUser asc";
		$execkandidat = mysql_query($kandidat);
		$cet_kandidat=mysql_fetch_array($execkandidat);
	
		$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
		$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
		$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
		$edu .= "where idWorker in (select idWorker from `userWorker` where namaUser='".$_SESSION['nama']."') order by tahunLulus desc limit 1";
		$execedu = mysql_query($edu);
		$cet_edu = mysql_fetch_array($execedu);
	?>
	
	<header>
		<h2><b>Interview User</b></h2>
	</header>
	<section class="body">
		<form role="form" id="forminterviewuser" action="<?=$base_url?>index.php?r=status-proses" method="post">
			<input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">
			
			<input type="hidden" name="idWorker" value="<?=$cet_kandidat['idWorker'];?>">
			
			<? soal(1);?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary" id="save" name="save">Save</button>
				<!--<button type="button" class="btn btn-default" onclick="javascript:location.href='<?=$base_url?>index.php?r=vacancy-show'">Cancel</button>-->
			</div>
	</section>
		</form>
</div>