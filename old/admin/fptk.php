<html> 
<?php
	session_start();
	$title = "fptk";
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
			function populate_word($url)
			{
				error_reporting(E_ALL & ~E_NOTICE);
				$fd = @fopen($url, "r");
				$word = "";
				while(!feof($fd))
				{
					$buffer = fgets($fd,1024);
					$buffer = trim($buffer);
					$buffer = strip_tags($buffer);
					$explode = explode(" ", $buffer);
					for($i = 0 ; $i<=sizeof($explode); $i++)
					{
						$kata = stripslashes(strtolower($explode[$i]));
						$word .= $kata." ";
					}
				}
				return $word;
			}
		
			include("templates/head.php");
			$idLogin = $_SESSION['idLogin'];
			//$tab = "";
			$queryGetUser = "SELECT * FROM userWorker WHERE idLogin = '$idLogin'";
			$execGetUser = mysql_query($queryGetUser);
			$resultGetUser = mysql_fetch_array($execGetUser);
			$idWorker = $resultGetUser['idWorker'];
				
			if(isset($_POST['delete-fptk']))
			{
				$idFptk = $_POST['id-fptk'];
				$queryDeleteFptk = "DELETE FROM fptk WHERE idFptk = '$idFptk'";
				$execDeleteFptk = mysql_query($queryDeleteFptk) or die("SQL ERROR");
				$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");
			}
			
			$getStatusFptk = "SELECT * FROM fptk WHERE idWorker = '$idWorker'";
			$execStatusFptk = mysql_query($getStatusFptk);
			$statusFptk = mysql_num_rows($execStatusFptk);	
			?>
				<?php
					$per_page = 10;
					$totalFptk = "SELECT * FROM fptk";
					$getTotalFptk = mysql_query($totalFptk);
					$resultTotalFptk = mysql_num_rows($getTotalFptk);
					$pages = ceil($resultTotalFptk/$per_page);
					
					$queryShowFptk = "SELECT f.idFptk, f.nomorFptk, f.namaPemohon, f.nikPemohon, f.posisiPemohon, kk1.namaKategori as posisi1, f.departemenPosisi, kde1.namaDepartemen as departemen1,
									f.mppPosisi, f.keteranganPosisi, f.namaManager, f.tanggalManager, f.namaHrdSuperintendent, f.tanggalHrdSuperintendent, f.namaGeneralManager, f.tanggalGeneralManager, 
									f.namaOdManager, f.tanggalOdManager, f.namaHRDManager, f.tanggalHRDManager, f.namaDirektur, f.tanggalDirektur, f.rejectFptk, f.keteranganReject, f.tanggalReject, f.namaRecruitmentSuperintendent, f.tanggalRecruitmentSuperintendent FROM fptk f ";
					$queryShowFptk .= "JOIN kategoriKerja kk1 ON kk1.idKategori = f.posisiPemohon ";
					$queryShowFptk .= "JOIN kategoriDepartemen kde1 ON kde1.idDepartemen = f.departemenPemohon ";
					$queryShowFptk .= "ORDER BY nomorFptk ASC LIMIT 0, $per_page";
									
					//$queryShowFptk = "SELECT f.idFptk, f.namaPemohon, f.nikPemohon, f.posisiPemohon, kk.namaKategori, f.departemenPemohon, kd.namaDepartemen FROM fptk f ";
					//$queryShowFptk .= "JOIN kategoriKerja kk ON kk.idKategori = f.posisiPemohon ";
					//$queryShowFptk .= "JOIN kategoriDepartemen kd ON kd.idDepartemen = f.departemenPemohon ";
					//$queryShowFptk .= "WHERE idWorker = $idWorker";
									
					$execShowFptk = mysql_query($queryShowFptk);
					if(mysql_num_rows($execShowFptk) < 1)
					{
						echo "<em>Tidak ada FPTK</em>";
					}
					else
					{
						?>
							<h3><strong>Daftar FPTK</strong></h3>
							<input type="hidden" value="<?php echo $pages;?>" name="pages" id="pages">
							<div class="table-responsive" id="total-fptk">
								<table class="table table-hover table-condensed" style="width: 4000px; border: 1px #333;">
									<tr>
										<th>Action</th><th>Nomor FPTK</th><th>PIC</th><th>Tanggal Ditetapkan</th><th>Nama Pemohon</th><th>NIK Pemohon</th><th>Posisi Pemohon</th><th>Departemen Pemohon</th>
										<th>Sesuai MPP?</th><th>Keterangan (Tidak Sesuai MPP)</th>
										<th>Disetujui Oleh, Manager</th><th>Tanggal</th><th>Diperiksa Oleh, HRD Superintendent</th><th>Tanggal</th><th>Diketahui Oleh, General Manager</th><th>Tanggal</th>
										<th>Diperiksa Oleh, OD Manager</th><th>Tanggal</th><th>Diketahui Oleh, HRD Manager</th><th>Tanggal</th><th>Tidak Sesuai MPP, Direktur</th><th>Tanggal</th><th>FPTK Ditolak Oleh</th><th>Alasan FPTK Ditolak</th><th>Tanggal</th>
									</tr>
									<tbody>
										<?php
											while($result = mysql_fetch_array($execShowFptk))
											{
												?>
													<tr>
														<td><a href="../show/viewFptk.php?id=<?php echo $result['idFptk'];?>"><button class="btn btn-sm btn-success">Show FPTK</button></a>
															<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-fptk<?php echo $result['idFptk'];?>">Delete</button></td>
														<td><?php echo $result['nomorFptk']?></td>
														<td><?php echo $result['namaRecruitmentSuperintendent']?></td>
														<td><?php echo $result['tanggalRecruitmentSuperintendent']?></td>
														<td><?php echo $result['namaPemohon']?></td>
														<td><?php echo $result['nikPemohon']?></td>
														<td><?php echo $result['posisi1']?></td>
														<td><?php echo $result['departemen1']?></td>
														<td><?php echo $result['mppPosisi']?></td>
														<td><?php echo $result['keteranganPosisi']?></td>
														<td><?php echo $result['namaManager']?></td>
														<td><?php echo $result['tanggalManager']?></td>
														<td><?php echo $result['namaHrdSuperintendent']?></td>
														<td><?php echo $result['tanggalHrdSuperintendent']?></td>
														<td><?php echo $result['namaGeneralManager']?></td>
														<td><?php echo $result['tanggalGeneralManager']?></td>
														<td><?php echo $result['namaOdManager']?></td>
														<td><?php echo $result['tanggalOdManager']?></td>
														<td><?php echo $result['namaHRDManager']?></td>
														<td><?php echo $result['tanggalHRDManager']?></td>
														<td><?php echo $result['namaDirektur']?></td>
														<td><?php echo $result['tanggalDirektur']?></td>
														<td><?php echo $result['rejectFptk']?></td>
														<td><?php echo $result['keteranganReject']?></td>
														<td><?php echo $result['tanggalReject']?></td>
													</tr>
																	
													<!-- Modal DELETE FPTK-->
													<div class="modal fade" id="delete-fptk<?php echo $result['idFptk'];?>" tabindex="-1" role="dialog" aria-labelledby="label-delete-fptk<?php echo $result['idFptk'];?>" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																	<h4 class="modal-title" id="label-delete-fptk<?php echo $result['idFptk'];?>"><?php echo $result['nomorFptk'];?></h4>
																</div>
																<div class="modal-body">Are you sure want to delete this FPTK?</div>
																<div class="modal-footer">
																	<form action="fptk.php" role="form" id="delete-fptk<?php echo $result['idFptk'];?>" method="post">
																		<input type="hidden" name="id-fptk" value="<?php echo $result['idFptk'];?>">
																		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																		<button type="submit" class="btn btn-primary" name="delete-fptk">Delete</button>
																	</form>
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
						<?php
						if($pages > 1)
						{
							echo "<ul id='pagination' class='pagination-sm'></ul>";
						}
					}
				include("templates/foot.php");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>
</html>