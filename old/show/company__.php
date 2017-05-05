<?php
session_start();
$head = "showCompany";
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
	$queryShowPerusahaan = "SELECT namaPerusahaan, deskripsiPerusahaan, alamatPerusahaan, emailPerusahaan, teleponPerusahaan, faxPerusahaan, urlWebsite, pathLogo FROM userHrd WHERE idHrd = $id";
	$execShowPerusahaan = mysql_query($queryShowPerusahaan);
	$perusahaan = mysql_fetch_array($execShowPerusahaan);
	if(mysql_num_rows($execShowPerusahaan) < 1){
?>
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<h3><?php echo "Not a valid Company";?> </h3>
				</div>
				<?php include("templates/right-menu.php");?>
			</div>
		</div>
<?php
	}else{
		$getTotalLowongan = "SELECT * FROM postingLowongan WHERE idHrd = $id";
		$execTotalLowongan = mysql_query($getTotalLowongan);
		$totalPosting = mysql_num_rows($execTotalLowongan);
		$per_page = 3;
		$pages = ceil($totalPosting/$per_page);
?>
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<h3><?php echo $perusahaan['namaPerusahaan'];?></h3>
					<div class="media">
						<img src="<?php
								if($perusahaan['pathLogo'] != $webRoot.'upload/company_logo.png'){
									echo $perusahaan['pathLogo'];
								}else{
									echo $webRoot.'upload/company_logo.png';
								}
							?>" alt="" class="pull-left">
						<div class="media-body">
							<p><i class="fa fa-building"></i> <?php echo $perusahaan['alamatPerusahaan'];?></p>
							<p><i class="fa fa-phone"></i> <?php echo $perusahaan['teleponPerusahaan'];?></p>
							<p><i class="fa fa-fax"></i> <?php echo $perusahaan['faxPerusahaan'];?></p>
							<p><i class="fa fa-at"></i> <?php echo $perusahaan['emailPerusahaan'];?></p>
							<a href="<?php echo "http://".$perusahaan['urlWebsite'];?>" target="_blank"><p><i class="fa fa-external-link"></i> <?php echo $perusahaan['urlWebsite'];?></p></a> 
						</div>
					</div>
					<br>
					<blockquote>
					  <p><?php echo $perusahaan['deskripsiPerusahaan'];?></p>
					</blockquote>
					<h5>Lowongan yang dimiliki:</h4>
					<input type="hidden" value="<?php echo $pages;?>" id="pages">
					<input type="hidden" value="<?php echo $id;?>" id="id">
					<div id="listLowongan">
<?php
						$queryListLowongan = "SELECT pl.idLowongan, pl.namaPosisi, pl.kodePosisi, tp.namaPendidikan, pl.umurMaksimal, tprov.namaProvinsi, pl.tanggalPosting, pl.batasAkhir from postingLowongan pl ";
						$queryListLowongan .= "JOIN tingkatPendidikan tp ON pl.pendidikanMinimal = tp.gradePendidikan ";
						$queryListLowongan .= "JOIN tableProvinsi tprov ON pl.lokasiPenempatan = tprov.idProvinsi ";
						$queryListLowongan .= "WHERE pl.idHrd = $id ";
						$queryListLowongan .= "ORDER BY idLowongan DESC LIMIT 0, $per_page";

						$execListLowongan = mysql_query($queryListLowongan);
						while($list = mysql_fetch_array($execListLowongan)){
?>
							<hr>

							<h4>
								<a href="<?php echo $webRoot.'show/post.php?id='.$list['idLowongan'];?>">
								<?php
									echo $list['namaPosisi'];
									if($list['kodePosisi'] != ""){ echo "[".$list['kodePosisi']."]";}
								?>
								</a>
							</h4>
							<div class="form-group">
								<label class="control-label col-md-2">Kualifikasi</label>
								<div class="col-md-10">
									<p>Minimal pendidikan: <?php echo $list['namaPendidikan'];?></p>
									<p>Penempatan: <?php echo $list['namaProvinsi'];?></p>
									<?php $hingga = new DateTime($list['batasAkhir']); ?>
									<p>Batas akhir: <?php echo $hingga->format('d M Y');?></p>
								</div>
							</div>
<?php
						}
?>
					</div>
					<?php if($pages > 1){ ?>
					<ul id="pagination"class="pagination-sm"></ul>	<?php } ?>		
				</div>
				<?php include("templates/right-menu.php");?>
			</div>
		</div>
<?php
	}
}
include("templates/foot.php");
?>