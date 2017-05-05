<?php
session_start();
include("../../assets/dbconfig.php");
$username = $_SESSION['username'];
if(!isset($_SESSION['username'])){
	echo "ERROR LOGIN";
}else{
	if(isset($_POST['page'])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$item_per_page = 5;
		if(!is_numeric($page_number)){
			die('Invalid!');
		}
		$position = ($page_number * $item_per_page)-$item_per_page;

		$queryListLowongan = "SELECT uh.namaPerusahaan, pl.idHrd, pl.idLowongan, pl.namaPosisi, pl.kodePosisi, kk.namaKategori, tp.namaPendidikan, pl.ipkNilai, pl.umurMaksimal, tprov.namaProvinsi, pl.gajiDitawarkan, pl.tanggalPosting, pl.batasAkhir from postingLowongan pl ";
		$queryListLowongan .= "JOIN userHrd uh ON uh.idHrd = pl.idHrd ";
		$queryListLowongan .= "JOIN kategoriKerja kk ON pl.kategoriPosisi = kk.idKategori ";
		$queryListLowongan .= "JOIN tingkatPendidikan tp ON pl.pendidikanMinimal = tp.gradePendidikan ";
		$queryListLowongan .= "JOIN tableProvinsi tprov ON pl.lokasiPenempatan = tprov.idProvinsi ";
		$queryListLowongan .= "ORDER BY idLowongan DESC LIMIT $position, $item_per_page";
		//echo $queryListLowongan;
		?>
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<th>Pemilik Lowongan</th>
					<th>Masa Posting</th>
					<th>Nama Posisi</th>
					<th>Kualifikasi</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
		<?php
		$execListLowongan = mysql_query($queryListLowongan);
		while($list = mysql_fetch_array($execListLowongan)){
		?>
			
			<tr>
				<td>
					<?php echo "<a target='_blank' href='".$webRoot."show/company.php?id=".$list['idHrd']."'>".$list['namaPerusahaan']."</a>";?>
				</td>
				<td>
					<?php 
						$posting = new DateTime($list['tanggalPosting']);
						$akhir = new DateTime($list['batasAkhir']);
						echo $posting->format('d M Y')."<br>";
						echo $akhir->format('d M Y');
					?>
				</td>
				<td>
					<?php 
						echo "<a target='_blank' href='".$webRoot."show/post.php?id=".$list['idLowongan']."'><strong>".$list['namaPosisi']."</strong> ";
						if($list['kodePosisi'] != ""){ echo "[".$list['kodePosisi']."]</a>";}	
					?>
				</td>
				<td>
					<?php
						echo "Min. pendidikan: ".$list['namaPendidikan']."<br>";
						echo "Min. IPK/Nilai: ".$list['ipkNilai']."<br>";
						if($list['gajiDitawarkan'] == 0){
							$gaji = "Unspecified.";
						}else{
							$gaji = $list['gajiDitawarkan'];
						}
						echo "Salary: ".$gaji."<br>";
						echo "Penempatan: ".$list['namaProvinsi']."<br>";
					?>
				</td>
				<td>
					<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#show-lowongan<?php echo $list['idLowongan'];?>">Delete</button>
				</td>
			</tr>
			<!-- Modal Delete Lowongan -->
			<div class="modal fade" id="show-lowongan<?php echo $list['idLowongan'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-lowongan<?php echo $list['idLowongan']?>" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h4 class="modal-title" id="modal-label-lowongan<?php echo $list['idLowongan']?>"><?php echo $list['namaPosisi'];?></h4>
			      </div>
			      <div class="modal-body">
			        Apakah Anda yakin untuk menghapus lowongan ini?
			      </div>
			      <div class="modal-footer">   	      		
	      		        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	      		        <a href="delete-post.php?id=<?php echo $list['idLowongan'];?>"><button type="button" class="btn btn-primary" name="hapus-lowongan">Hapus</button></a>
			      </div>
			    </div>
			  </div>
			</div>
			
		<?php
		}
		?>
			</tbody>
		</table>
<?php
	}
}
?>