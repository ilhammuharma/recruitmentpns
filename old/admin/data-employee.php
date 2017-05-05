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
	$title = "data-employee";
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
					$getTotalWorker = "SELECT * FROM loginUser WHERE level=3 ORDER BY username ASC LIMIT 0";
					$execTotalWorker = mysql_query($getTotalWorker);
					$totalWorker = mysql_num_rows($execTotalWorker);
					$pages = ceil($totalWorker/$per_page);

					$getWorker = "SELECT * FROM loginUser WHERE level=3 ORDER BY username ASC LIMIT 0, $per_page";
					$execWorker = mysql_query($getWorker);
					if(mysql_num_rows($execWorker) < 1)
					{
						echo "There has been no registered employees";
					}
					else
					{
						?>
							<h3><strong>Daftar Pegawai</strong></h3>
							<input type="hidden" value="<?php echo $pages;?>" name="pages" id="pages">
							<div class="table-responsive" id="total-worker">
								<table class="table table-hover table-condensed">
									<thead>
										<tr>
											<th>Action</th>
											<th>Username</th>
											<th>Email</th>
										</tr>
									</thead>
									<tbody>
										<?php
											while($result = mysql_fetch_array($execWorker))
											{
												?>
													<tr>
														<td>
															<a href="permission.php?id=<?php echo $result['idLogin'];?>"><button class="btn btn-danger btn-primary">Permission</button></a>
															<a href="changePassword.php?id=<?php echo $result['idLogin'];?>"><button class="btn btn-primary">Change Password</button></a>
														</td> 
														<td><?php echo $result['username'];?></td>
														<td><?php echo $result['email'];?></td>
													</tr>
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