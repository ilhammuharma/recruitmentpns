<?php
	session_start();
	$head = "";
	include("../assets/dbconfig.php");
	include("templates/head.php");
?>

<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="box-no-border">
				<h3>List of Jobs</h3>
				<?php
					$per_page = 10;
					$queryTotal = "SELECT * FROM postingLowongan";
					$execTotal = mysql_query($queryTotal);
					$queryListLowongan = "SELECT uh.smallLogo, pl.idLowongan, uh.namaPerusahaan, pl.namaPosisi, pl.kodePosisi, kk.namaKategori, tp.namaPendidikan, tprov.namaProvinsi, pl.gajiDitawarkan, pl.tanggalPosting, pl.batasAkhir, pl.idHrd from postingLowongan pl ";
					$queryListLowongan .= "JOIN kategoriKerja kk ON pl.kategoriPosisi = kk.idKategori ";
					$queryListLowongan .= "JOIN tingkatPendidikan tp ON pl.pendidikanMinimal = tp.gradePendidikan ";
					$queryListLowongan .= "JOIN tableProvinsi tprov ON pl.lokasiPenempatan = tprov.idProvinsi ";
					$queryListLowongan .= "JOIN userHrd uh ON uh.idHrd = pl.idHrd ";
					$queryListLowongan .= "ORDER BY idLowongan DESC LIMIT 0, $per_page";
					$execListLowongan = mysql_query($queryListLowongan);
					$totalPosting = mysql_num_rows($execTotal);
					$pages = ceil($totalPosting/$per_page);
				?>
				<input type="hidden" value="<?php echo $pages;?>" id="pages">
				<div id="showAllLowongan">
					<?php
						while($list = mysql_fetch_array($execListLowongan))
						{
							?>
								<div class="media"><!--Media Start -->
									<a target="_blank" href="<?php echo $webRoot.'show/company.php?id='.$list['idHrd'];?>" class="pull-left">
										<img src="
										<?php echo $list['smallLogo'];?>" alt="">
									</a>
									<div class="media-body">
										<h4 class="media-heading">
											<a target="_blank" href="<?php echo $webRoot.'show/post.php?id='.$list['idLowongan'];?>">
												<?php 
													echo $list['namaPosisi'];
													if($list['kodePosisi'] != "")
													{
														echo " [".$list['kodePosisi']."]";
													}
												?>
											</a>
										</h4>
										<?php
											echo "<a target='_blank' href='".$webRoot."show/company.php?id=".$list['idHrd']."''>".$list['namaPerusahaan']."<br></a>";
											echo "Penempatan: ".$list['namaProvinsi']."<br>";
											$hingga = new DateTime($list['batasAkhir']);
											echo "Hingga : ".$hingga->format('d M Y');
										?>
									</div>
								</div><!--Media End -->
							<?php
					    } 
					?>                
				</div>
				<?php 
					if($pages > 1)
					{
						?><ul id="all-lowongan"class="pagination-sm"></ul>	<?php 
					} 
				?>
			</div>
		</div>
		<?php include("templates/right-menu.php");?>
	</div>
</div>
<?phpinclude("templates/foot.php");?>