<?php
	session_start();
	$title = "posted";
	include("../assets/dbconfig.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
		{
			header("Location:../worker/");
		}
		else if(isset($_SESSION['admin']))
		{
			include("templates/head.php");
			$getTotalLowongan = "SELECT * FROM postingLowongan";
			$execTotalLowongan = mysql_query($getTotalLowongan);
			$totalPosting = mysql_num_rows($execTotalLowongan);
			$per_page = 10;
			$pages = ceil($totalPosting/$per_page);

			$queryListLowongan = "SELECT uh.namaPerusahaan, pl.idHrd, pl.idLowongan, pl.namaPosisi, pl.kodePosisi, kk.namaKategori, tp.namaPendidikan, pl.ipkNilai, pl.umurMaksimal, tprov.namaProvinsi, pl.gajiDitawarkan, pl.tanggalPosting, pl.batasAkhir from postingLowongan pl ";
			$queryListLowongan .= "JOIN userHrd uh ON uh.idHrd = pl.idHrd ";
			$queryListLowongan .= "JOIN kategoriKerja kk ON pl.kategoriPosisi = kk.idKategori ";
			$queryListLowongan .= "JOIN tingkatPendidikan tp ON pl.pendidikanMinimal = tp.gradePendidikan ";
			$queryListLowongan .= "JOIN tableProvinsi tprov ON pl.lokasiPenempatan = tprov.idProvinsi ";
			$queryListLowongan .= "ORDER BY idLowongan DESC LIMIT 0, $per_page";
			$execListLowongan = mysql_query($queryListLowongan);
			?>
				<h3><strong>Daftar Lowongan Kerja</strong></h3>
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" value="<?php echo $pages;?>" id="pages">
						<div class="table-responsive" id="listLowongan">
							<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th>Action</th>
										<th>Department</th>
										<th>Time Posting</th>
										<th>Position</th>
										<th>Qualification</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$execListLowongan = mysql_query($queryListLowongan);
										while($list = mysql_fetch_array($execListLowongan))
										{
											?>
												<tr>
													<td>
														<a href="edit-posting.php?id=<?php echo $list['idLowongan'];?>"><button class="btn btn-primary">Edit</button></a>
														<button class="btn btn-danger btn-primary" data-toggle="modal" data-target="#show-lowongan<?php echo $list['idLowongan'];?>">Delete</button>
													</td>
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
												</tr>
												
												<!-- Modal Delete Lowongan -->
												<div class="modal fade" id="show-lowongan<?php echo $list['idLowongan'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-lowongan<?php echo $list['idLowongan']?>" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																<h4 class="modal-title" id="modal-label-lowongan<?php echo $list['idLowongan']?>"><?php echo $list['namaPosisi'];?></h4>
															</div>
															<div class="modal-body">Are you sure want to delete this vacancy?</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																<a href="delete-post.php?id=<?php echo $list['idLowongan'];?>"><button type="button" class="btn btn-primary" name="hapus-lowongan">Delete</button></a>
															</div>
														</div>
													</div>
												</div>
											<?php 
										} 
									?>
								</tbody>
							</table>
						</div>
						<ul id="pagination" class="pagination-sm"></ul>
					</div>
				</div>
			<?php
			include("templates/foot.php");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>