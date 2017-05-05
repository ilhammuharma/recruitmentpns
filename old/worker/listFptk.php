<html> 
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	</head> 
	<script type="text/javascript" src="../tableExport/jquery.js"></script>
	
	<!-- Harus ada untuk konversi apa pun-->
	<script type="text/javascript" src="../tableExport/tableExport.js"></script>
	<script type="text/javascript" src="../tableExport/jquery.based64.js"></script>
		
	<!-- Export sebagai png -->
	<script type="text/javascript" src="../tableExport/html2canvas.js"></script>
		
	<!-- Export sebagai PDF -->
	<script type="text/javascript" src="../tableExport/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="../tableExport/jspdf/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="../tableExport/jspdf/jspdf/libs/based64.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(e)
		{
			$("#pdf").click(function(e)
			{
				$("#mytable").tableExport({
					type: 'pdf',
					escape: 'false'
				});
			});
		
			$("#excel").click(function(e)
			{
				$("#mytable").tableExport({
					type: 'excel',
					escape: 'false'
				});
			});
			
			$("#word").click(function(e)
			{
				$("#mytable").tableExport({
					type: 'word',
					escape: 'false'
				});
			});
		});
	</script>
	
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
		if(isset($_SESSION['admin']))
		{
			header("Location:../admin/");
		}
		else if(isset($_SESSION['hrd']))
		{
			header("Location:../hrd/");
		}
		else if(isset($_SESSION['worker']))
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
			
			$getStatusFptk = "SELECT * FROM fptk WHERE idWorker = '$idWorker'";
			$execStatusFptk = mysql_query($getStatusFptk);
			$statusFptk = mysql_num_rows($execStatusFptk);	
			?>
				<?php
					$per_page = 50;
					$totalFptk = "SELECT * FROM fptk";
					$getTotalFptk = mysql_query($totalFptk);
					$resultTotalFptk = mysql_num_rows($getTotalFptk);
					$pages = ceil($resultTotalFptk/$per_page);
					
					$queryShowFptk = "SELECT f.idFptk, f.nomorFptk, f.namaPemohon, f.nikPemohon, f.posisiPemohon, kk1.namaKategori as posisi1, f.departemenPosisi, kde1.namaDepartemen as departemen1,
									f.mppPosisi, f.keteranganPosisi, f.namaManager, f.tanggalManager, f.namaHrdSuperintendent, f.tanggalHrdSuperintendent, f.namaGeneralManager, f.tanggalGeneralManager, 
									f.namaOdManager, f.tanggalOdManager, f.namaHRDManager, f.tanggalHRDManager, f.namaDirektur, f.tanggalDirektur, f.rejectFptk, f.keteranganReject, f.tanggalReject, f.namaRecruitmentSuperintendent FROM fptk f ";
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
							<h3><strong>Perkembangan FPTK</strong></h3>
							<input type="hidden" value="<?php echo $pages;?>" id="pages">
							<div class="table-responsive" id="total-fptk">
								<table class="table table-hover table-condensed" style="width: 3500px; border: 1px #333;">
									<tr>
										<th>Nomor FPTK</th><th>PIC</th><th>Nama Pemohon</th><th>NIK Pemohon</th><th>Posisi Pemohon</th><th>Departemen Pemohon</th>
										<th>Sesuai MPP?</th><th>Keterangan</th><th>Disetujui Oleh, Manager</th><th>Tanggal</th><th>Diperiksa Oleh, HRD Superintendent</th><th>Tanggal</th><th>Diketahui Oleh, General Manager</th><th>Tanggal</th>
										<th>Diketahui Oleh, HRD Manager</th><th>Tanggal</th><th>Tidak Sesuai MPP, Direktur</th><th>Tanggal</th><th>FPTK Ditolak Oleh</th><th>Alasan Ditolak</th><th>Tanggal</th>
									</tr>
									<tbody>
										<?php
											while($result = mysql_fetch_array($execShowFptk))
											{
												?>
													<tr>
														<td><?php echo $result['nomorFptk']?></td>
														<td><?php echo $result['namaRecruitmentSuperintendent']?></td>
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
														<td><?php echo $result['namaHRDManager']?></td>
														<td><?php echo $result['tanggalHRDManager']?></td>
														<td><?php echo $result['namaDirektur']?></td>
														<td><?php echo $result['tanggalDirektur']?></td>
														<td><?php echo $result['rejectFptk']?></td>
														<td><?php echo $result['keteranganReject']?></td>
														<td><?php echo $result['tanggalReject']?></td>
													</tr>
												<?php
											}
										?>
									</tbody>
								</table>
							</div>
						<?php
					}
				?>
					<?php if($pages > 1){ ?><ul id="pagination" class="pagination-sm"></ul><?php }?>
				<?php
			include("templates/foot.php");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>
</html>