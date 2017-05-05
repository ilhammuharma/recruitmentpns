<?php
session_start();
$head = "";
include("../assets/dbconfig.php");
include("templates/head.php");
if(!isset($_GET['id'])){
?>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<h3><?php echo "Link is not valid";?> </h3>
			</div>
			<?php include("templates/right-menu.php");?>
		</div>
	</div>
<?php
}else{
	$id = $_GET['id'];
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}else{
		$username = "";
	}
	$getIdWorker = "SELECT idWorker FROM userWorker WHERE idLogin = (SELECT idLogin FROM loginWorker WHERE username = '$username')";
	$execIdWorker = mysql_query($getIdWorker);
	$result = mysql_fetch_array($execIdWorker);
	$idWorker = $result['idWorker'];

	$queryShowLowongan = "SELECT pl.idLowongan, uh.namaPerusahaan, pl.namaPosisi, pl.kodePosisi, kk.namaKategori, tp.namaPendidikan, pl.umurMaksimal, tprov.namaProvinsi, pl.gajiDitawarkan, pl.tanggalPosting, pl.batasAkhir, pl.kualifikasiLain, pl.idHrd, pl.ipkNilai FROM postingLowongan pl ";
	$queryShowLowongan .= "JOIN userHrd uh ON pl.idHrd = uh.idHrd ";
	$queryShowLowongan .= "JOIN kategoriKerja kk ON pl.kategoriPosisi = kk.idKategori ";
	$queryShowLowongan .= "JOIN tingkatPendidikan tp ON pl.pendidikanMinimal = tp.gradePendidikan ";
	$queryShowLowongan .= "JOIN tableProvinsi tprov ON pl.lokasiPenempatan = tprov.idProvinsi ";
	$queryShowLowongan .="WHERE idLowongan = $id";
	
	$execShowLowongan = mysql_query($queryShowLowongan);
	$resultShowLowongan = mysql_fetch_array($execShowLowongan);
	if(mysql_num_rows($execShowLowongan) < 1){
?>
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<h3><?php echo "Not a valid post";?> </h3>
				</div>
				<?php include("templates/right-menu.php");?>
			</div>
		</div>
<?php
	}else{
		$idLowongan = $resultShowLowongan['idLowongan'];
?>
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<h3>
						<?php 
							echo $resultShowLowongan['namaPosisi'];
							if($resultShowLowongan['kodePosisi'] != ""){
								echo " [".$resultShowLowongan['kodePosisi']."]";
							}
						?>
					</h3>
					<p><em><a href="<?php echo $webRoot.'show/company.php?id='.$resultShowLowongan['idHrd'];?>"><?php echo $resultShowLowongan['namaPerusahaan'];?></a></em></p>
					<p><strong>Kategori: </strong><?php echo $resultShowLowongan['namaKategori'];?></p>
					<div class="row">
						<div class="col-md-6">
							<?php
								$start = new DateTime($resultShowLowongan['tanggalPosting']);
								$posting = $start->format('d M Y');
								echo "<p><strong>Tanggal Posting: ".$posting."</strong></p>";
							?>

						</div>
						<div class="col-md-6">
							<?php
								$ending = new DateTime($resultShowLowongan['batasAkhir']);
								$hingga = $ending->format("d M Y");
							?>
							<p><strong>Batas Akhir: <?php echo $hingga;?></strong></p>						
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							Deskripsi Umum:
						</div>
						<div class="col-md-9">
							<p> Minimal Pendidikan: <?php echo $resultShowLowongan['namaPendidikan']." ";?></p>
							<p> Usia Maksimal: <?php echo $resultShowLowongan['umurMaksimal']." tahun ";?></p>
							<p> Penempatan Kerja: <?php echo $resultShowLowongan['namaProvinsi']." ";?></p>
						<?php if($resultShowLowongan['ipkNilai'] > 0 ){?>
							<p>Minimal IPK/Nilai: <?php echo $resultShowLowongan['ipkNilai'];?></p>
						<?php }?>
						<?php if($resultShowLowongan['gajiDitawarkan'] > 0){ ?>
							<p> Gaji yang ditawarkan: <?php echo $resultShowLowongan['gajiDitawarkan']." ";?></p>
						<?php }?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							Kualifikasi Lain:
						</div>
						<div class="col-md-9">
							<?php echo html_entity_decode($resultShowLowongan['kualifikasiLain']);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-offset-9 col-md-3">
					<?php
							if(!isset($_SESSION['username'])){
								echo "Silakan login/register untuk dapat <em>apply</em>";
							}else{
					?>
							<button class="btn btn-success" data-toggle="modal" data-target="#confirm-apply"
					<?php
							$getStatus = "SELECT * FROM applyLowongan WHERE idLowongan = $id AND idWorker = $idWorker";
							if(!isset($_SESSION['worker'])){
								echo " disabled";
							}else{
								$getStatus = "SELECT * FROM applyLowongan WHERE idLowongan = $id AND idWorker = $idWorker";
								$execStatus = mysql_query($getStatus);
								if(mysql_num_rows($execStatus) > 0){
									echo " disabled";
								}
							}
					?>
							>Apply</button>
					<?php
								if(isset($_SESSION['worker'])){
									$execLabelStatus = mysql_query($getStatus);
									if(mysql_num_rows($execLabelStatus) > 0){
										echo "<p>Anda telah meng-<em>apply</em> lamaran ini</p>";
									}
								}
							}
					?>
						</div>

						<!-- Modal Delete-->
						<div class="modal fade" id="confirm-apply" tabindex="-1" role="dialog" aria-labelledby="label-confirm" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						        <h4 class="modal-title" id="label-confirm"><em>Apply</em> lowongan kerja?</h4>
						      </div>
						      <div class="modal-body">
						        Apakah Anda yakin untuk <em>apply</em> lowongan ini?
						      </div>
						      <div class="modal-footer">
						        
						        <form action="apply.php" method="post">
						        	<input type="hidden" name="id-worker" value="<?php echo $idWorker;?>">
						        	<input type="hidden" name="id-lowongan" value="<?php echo $idLowongan;?>">
						        	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						        	<button type="submit" class="btn btn-success" name="apply">Apply</button>
						        </form>
						      </div>
						    </div>
						  </div>
						</div>
						

					</div>
				</div>
				<?php include("templates/right-menu.php");?>
			</div>
		</div>
<?php
	}
}
include("templates/foot.php");
?>