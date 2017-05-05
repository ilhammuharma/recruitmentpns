<?php
session_start();
include("../../assets/dbconfig.php");

if(!isset($_POST['page']))
{
	echo "ERROR GETTING DATA";
}
else
{
	$id = $_POST['id'];
	$page = $_POST['page'];
	$item_per_page = 10;
	$position = ($page * $item_per_page)-$item_per_page;
	$queryListLowongan = "SELECT pl.idLowongan, pl.namaPosisi, pl.kodePosisi, tp.namaPendidikan, pl.umurMaksimal, tprov.namaProvinsi, pl.tanggalPosting, pl.batasAkhir from postingLowongan pl ";
	$queryListLowongan .= "JOIN tingkatPendidikan tp ON pl.pendidikanMinimal = tp.gradePendidikan ";
	$queryListLowongan .= "JOIN tableProvinsi tprov ON pl.lokasiPenempatan = tprov.idProvinsi ";
	$queryListLowongan .= "WHERE pl.idHrd = $id ";
	$queryListLowongan .= "ORDER BY idLowongan DESC LIMIT $position, $item_per_page";
	$execListLowongan = mysql_query($queryListLowongan);
	while($resultListLowongan = mysql_fetch_array($execListLowongan))
	{
		?>
			<hr>
			<h4>
				<a href="<?php echo $webRoot.'show/post.php?id='.$resultListLowongan['idLowongan'];?>">
					<?php
						echo $resultListLowongan['namaPosisi'];
						if($resultListLowongan['kodePosisi'] != ""){ echo "[".$resultListLowongan['kodePosisi']."]";}
					?>
				</a>
			</h4>
			<div class="form-group">
				// <label class="control-label col-md-2">Qualification</label>
				<div class="col-md-10">
					<p>Minimum Education: <?php echo $resultListLowongan['namaPendidikan'];?></p>
					<p>Placement: <?php echo $resultListLowongan['namaProvinsi'];?></p>
					<?php 
						$now = new DateTime();
						$hingga = new DateTime($resultListLowongan['batasAkhir']); 
						$banyakHari = date_diff($now, $hingga);
					?>
					<p>Deadline: 
						<?php echo $hingga->format('d M Y');
							if($hingga == $now)
							{
								echo " (Hari Ini)";
							}
							elseif($hingga > $now)
							{
								echo " (".$banyakHari->format('%d')." hari lagi)";
							}
							else
							{
								echo " (Telah Berakhir)";
							}
						?>
					</p>
				</div>
			</div>
		<?php
	}
}
?>