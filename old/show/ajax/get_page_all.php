<?php
session_start();
include("../../assets/dbconfig.php");

if(!isset($_POST['page']))
{
	echo "ERROR GETTING DATA";
}
else
{
	$page = $_POST['page'];
	$item_per_page = 10;
	$position = ($page * $item_per_page)-$item_per_page;
	$queryListLowongan = "SELECT uh.smallLogo, pl.idLowongan, uh.namaPerusahaan, pl.namaPosisi, pl.kodePosisi, kk.namaKategori, tp.namaPendidikan, tprov.namaProvinsi, pl.gajiDitawarkan, pl.tanggalPosting, pl.batasAkhir, pl.idHrd from postingLowongan pl ";
	$queryListLowongan .= "JOIN kategoriKerja kk ON pl.kategoriPosisi = kk.idKategori ";
	$queryListLowongan .= "JOIN tingkatPendidikan tp ON pl.pendidikanMinimal = tp.gradePendidikan ";
	$queryListLowongan .= "JOIN tableProvinsi tprov ON pl.lokasiPenempatan = tprov.idProvinsi ";
	$queryListLowongan .= "JOIN userHrd uh ON uh.idHrd = pl.idHrd ";
	$queryListLowongan .= "ORDER BY idLowongan DESC LIMIT $position, $item_per_page";
	$execListLowongan = mysql_query($queryListLowongan);
	$execListLowongan = mysql_query($queryListLowongan);
	while($list = mysql_fetch_array($execListLowongan))
	{
		?>
			<div class="media"><!--Media Start -->
				<a target="_blank" href="<?php echo $webRoot.'show/company.php?id='.$list['idHrd'];?>" class="pull-left">
					<img src="
					<?php 
						echo $list['smallLogo'];
					?>" alt="">
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
}
?>