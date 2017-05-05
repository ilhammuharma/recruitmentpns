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
			include("templates/head.php");
			?>
				<h3><strong>PIC FPTK</strong></h3>
				<?php
					if($_GET['id']==1)
					{
						$getTotalFptk = "SELECT * FROM fptk WHERE namaManager='' AND rejectFptk=''";
					}
					else if($_GET['id']==2)
					{
						$getTotalFptk = "SELECT * FROM fptk WHERE namaManager!='' AND namaHrdSuperintendent='' AND rejectFptk=''";
					}
					else if($_GET['id']==3)
					{
						$getTotalFptk = "SELECT * FROM fptk WHERE namaHrdSuperintendent!='' AND namaGeneralManager='' AND rejectFptk=''";
					}
					else if($_GET['id']==4)
					{
						$getTotalFptk = "SELECT * FROM fptk WHERE namaGeneralManager!='' AND namaOdManager='' AND rejectFptk=''";
					}
					else if($_GET['id']==5)
					{
						$getTotalFptk = "SELECT * FROM fptk WHERE namaOdManager!='' AND namaHrdManager='' AND rejectFptk=''";
					}
					else if($_GET['id']==6)
					{
						$getTotalFptk = "SELECT * FROM fptk WHERE namaHrdManager!='' AND namaDirektur='' AND rejectFptk=''";
					}
					else
					{
						$getTotalFptk = "SELECT * FROM fptk WHERE namaDirektur!='' AND namaRecruitmentSuperintendent='' AND rejectFPTK=''";
					}
					
					$execTotalFptk = mysql_query($getTotalFptk);
					$totalFptk = mysql_num_rows($execTotalFptk);
					$per_page = 10;
					$pages = ceil($totalFptk/$per_page);
					
					$output = '';
					
					if($_GET['id']==1)
					{
						$getFptk = "SELECT * FROM fptk WHERE namaManager='' AND rejectFptk='' ORDER BY namaPemohon ASC LIMIT 0, $per_page";
					}
					else if($_GET['id']==2)
					{
						$getFptk = "SELECT * FROM fptk WHERE namaManager!='' AND namaHrdSuperintendent='' AND rejectFptk='' ORDER BY namaPemohon ASC LIMIT 0, $per_page";
					}
					else if($_GET['id']==3)
					{
						$getFptk = "SELECT * FROM fptk WHERE namaHrdSuperintendent!='' AND namaGeneralManager='' AND rejectFptk='' ORDER BY namaPemohon ASC LIMIT 0, $per_page";
					}
					else if($_GET['id']==4)
					{
						$getFptk = "SELECT * FROM fptk WHERE namaGeneralManager!='' AND namaOdManager='' AND rejectFptk='' ORDER BY namaPemohon ASC LIMIT 0, $per_page";
					}
					else if($_GET['id']==5)
					{
						$getFptk = "SELECT * FROM fptk WHERE namaOdManager!='' AND namaHrdManager='' AND rejectFptk='' ORDER BY namaPemohon ASC LIMIT 0, $per_page";
					}
					else if($_GET['id']==6)
					{
						$getFptk = "SELECT * FROM fptk WHERE namaHrdManager!='' AND namaDirektur='' AND rejectFptk='' ORDER BY namaPemohon ASC LIMIT 0, $per_page";
					}
					else
					{
						$getFptk = "SELECT * FROM fptk WHERE namaDirektur!='' AND namaRecruitmentSuperintendent='' AND rejectFptk='' ORDER BY namaPemohon ASC LIMIT 0, $per_page";
					}
					
					//INNER JOIN loginUser ON loginUser.idLogin = fptk.idFptk WHERE loginUser.level=3
					$execFptk = mysql_query($getFptk);
					
					/*$queryShowFptk = mysql_query($getFptk);
					$queryShowFptk = "SELECT f.idFptk, f.nomorFptk, f.namaPemohon, f.nikPemohon, f.posisiPemohon, kk1.namaKategori as posisi1, f.departemenPosisi, kde1.namaDepartemen as departemen1, mppPosisi FROM fptk f ";
					$queryShowFptk .= "JOIN kategoriKerja kk1 ON kk1.idKategori = f.posisiPemohon ";
					$queryShowFptk .= "JOIN kategoriDepartemen kde1 ON kde1.idDepartemen = f.departemenPemohon ";
					$queryShowFptk .= "ORDER BY nomorFptk ASC LIMIT 0, $per_page";
					$execFptk = mysql_query($queryShowFptk);*/
					
					if(mysql_num_rows($execFptk) < 1)
					{
						echo "There has been no FPTK";
					}
					else
					{
						?>
							<input type="hidden" value="<?php echo $pages;?>" name="pages" id="pages">
							<div id="listFptk" class="show-list row">
								<div class="table-responsive" id="total-worker">
									<table class="table table-hover table-condensed">
										<thead>
											<tr>
												<th>Nomor FPTK</th>
												<th>Nama Pemohon</th>
												<th>NIK Pemohon</th>
												<th>Posisi Pemohon</th>
												<th>Departemen Pemohon</th>
											</tr>
										</thead>
										<tbody>
											<?php
												while($result = mysql_fetch_array($execFptk))
												{
													?>
														<tr>
															<td><?php echo $result['nomorFptk']?></td>
															<td><?php echo $result['namaPemohon']?></td>
															<td><?php echo $result['nikPemohon']?></td>
															<td><?php echo $result['posisiPemohon']?></td>
															<td><?php echo $result['departemenPemohon']?></td>
															<td><a href="selectingPic.php?idFptk=<?php echo $result['idFptk'];?>&approve=<?php echo $_GET['id']?>"><button class="btn btn-primary btn-danger">Select</button></a></td> 
														</tr>
													<?php
												}
											?>
										</tbody>
									</table>
								</div>
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