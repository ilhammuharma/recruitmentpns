<div class="popdown-content">
	<header>
		<h2><b>Interview HR</b></h2>
	</header>
	<? //while($cet_nilai=mysql_fetch_array($penilaian)){?>
	<section class="body">
		<form role="form" id="forminterviewhr" action="<?=$base_url?>index.php?r=status-proses" method="post">	
			<input type="hidden" name="id" value="<?=$_SESSION['id'];?>">
			<? 
				//if(isset($cet_kandidat['idWorker']))
				//{
					$id = $cet_kandidat['idWorker'];
					$kandidat = "Select *, tp.namaProvinsi, kk.namaKategori from userWorker uw ";
					$kandidat .= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
					$kandidat .= "JOIN kategoriKerja kk ON kk.idKategori = uw.posisi ";
					$kandidat .= "where idWorker = '".$id."' and statusRekrut='3' order by namaUser asc";
					$execkandidat = mysql_query($kandidat);
					$cet_kandidat = mysql_fetch_array($execkandidat);
					
					$edu = "Select *, tp.namaPendidikan, tj.namaJurusan from pendidikanWorker pw ";
					$edu .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
					$edu .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
					$edu .= "where idWorker = '".$id."' order by tahunLulus desc limit 1";
					$execedu = mysql_query($edu);
					$cet_edu = mysql_fetch_array($execedu);
				//}
			?>
			<input type="hidden" name="idWorker" value="<?=$cet_kandidat['idWorker'];?>">
			<div class="row">
				<div class="col-xs-6">
					<table border="0" width="100%" class="print">
						<tr>
							<td width="150px">Nama</td>
							<td width="20px">:</td>
							<td><?=$cet_kandidat['namaUser'];?></td>
						</tr>
						<tr>
							<td>Tanggal Lahir</td>
							<td>:</td>
							<td><?=tanggal2($cet_kandidat['tanggalLahir']);?></td>
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
							<td><?=$cet_kandidat['namaKategori'];?></td>
						</tr>
						<tr>
							<td>No.Telp</td>
							<td>:</td>
							<td><?=$cet_kandidat['noPonsel'];?></td>
						</tr>
						<tr>
							<td>Domisili</td>
							<td>:</td>
							<td><?=$cet_kandidat['namaProvinsi'];?></td>
						</tr>
					</table>
				</div>
			</div>	
			<? soal(1);?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary" id="save" name="save">Save</button>
				<!--<button type="button" class="btn btn-default" onclick="javascript:location.href='<?=$base_url?>index.php?r=vacancy-show'">Cancel</button>-->
			</div>
	</section>
		</form>
	<?//}?>
</div>