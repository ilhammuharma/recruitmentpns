<html> 
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
	$title = "job-seeker";
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
		else if(isset($_SESSION['hrd']))
		{
			header("Location:../hrd/");
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
			$getStatusUser = "SELECT * FROM userWorker";
			$execStatusUser = mysql_query($getStatusUser);
			$statusUser = mysql_num_rows($execStatusUser);	
			?>
				<?php
					$per_page = 50;
					$getTotalWorker = "SELECT * FROM userWorker
									JOIN loginUser ON loginUser.idLogin = userWorker.idLogin WHERE loginUser.level=2
									ORDER BY namaUser ASC LIMIT 0";
					$execTotalWorker = mysql_query($getTotalWorker);
					$totalWorker = mysql_num_rows($execTotalWorker);
					$pages = ceil($totalWorker/$per_page);
					
					/*$getWorker = "SELECT uw.idLogin, lu.idLogin, uw.namaUser, uw.emailUser, uw.noPonsel, uw.statusRekrut, tsr.namaStatus, uw.nomorFptk, f.nomorFptk as noFptk  FROM userWorker uw ";
					$getWorker .= "JOIN tableStatusRekrut tsr ON tsr.namaStatus = uw.statusRekrut ";
					$getWorker .= "JOIN fptk f ON f.nomorFptk = uw.nomorFptk ";
					$getWorker .= "JOIN loginUser lu ON lu.idLogin = uw.idLogin WHERE lu.level=2 ";
					$getWorker .= "ORDER BY namaUser ASC LIMIT 0, $per_page";*/
					
					$getWorker = "SELECT * FROM userWorker
								JOIN loginUser ON loginUser.idLogin = userWorker.idLogin WHERE loginUser.level=2
								ORDER BY namaUser ASC LIMIT 0, $per_page";
					
					$execWorker = mysql_query($getWorker);
					if(mysql_num_rows($execWorker) < 1)
					{
						echo "There has been no registered applicants";
					}
					else
					{
						?>
							<h3><strong>Daftar Kandidat</strong></h3>
							<input type="hidden" value="<?php echo $pages;?>" name="pages" id="pages">
							<div class="table-responsive" id="total-worker">
								<table class="table table-hover table-condensed" style="width: 1300px; border: 1px #333;">
									<thead>
										<tr>
											<th>Action</th><th>Username</th><th>Email</th><th>Phone</th><th>Status</th><th>Nomor FPTK</th>
										</tr>
									</thead>
									<tbody>
										<?php
											while($result = mysql_fetch_array($execWorker))
											{
												$status=mysql_fetch_array(mysql_query("SELECT namaStatus FROM tableStatusRekrut where idTable='".$result['statusRekrut']."'"));
												?>
													<tr>
														<td>
															<a href="../show/worker.php?id=<?php echo $result['idWorker'];?>" target="_blank"><button class="btn btn-sm btn-success">Show Profile</button></a>
															<a href="edit-jobseeker.php?id=<?php echo $result['idWorker'];?>"><button class="btn btn-danger btn-sm">Update Status</button></a>
														</td> 
														<td><?php echo $result['namaUser'];?></td>
														<td><?php echo $result['emailUser'];?></td>
														<td><?php echo $result['noPonsel'];?></td>
														<td><?php echo $status['namaStatus'];?></td>
														<td><?php echo $result['nomorFptk'];?></td>
													</tr>
												<?php
											}
										?>
									</tbody>
								</table>
								<div class="table-responsive" id="excel">  
									<form method="post" action="exportExcel.php" >  
										<input type="submit" name="export_excel" class="btn btn-sm btn-success" value="Download" />  
									</form>  
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