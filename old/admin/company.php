<?php
	session_start();
	$title = "department";
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
		}else if(isset($_SESSION['hrd']))
		{
			header("Location:../hrd/");
		}
		else if(isset($_SESSION['admin']))
		{
			include("templates/head.php");
			?>
				<h3><strong>Company</strong></h3>
				<?php
					$getTotalHrd = "SELECT * FROM userHrd";
					$execTotalHrd = mysql_query($getTotalHrd);
					$totalHrd = mysql_num_rows($execTotalHrd);
					$perPage = 10;
					$pages = ceil($totalHrd/$perPage);

					$getHrd = "SELECT * FROM userHrd ORDER BY namaPerusahaan ASC LIMIT 0, $perPage";
					$execHrd = mysql_query($getHrd);
					if(mysql_num_rows($execHrd) < 1)
					{
						echo "Belum ada perusahaan yang terdaftar";
					}
					else
					{
						?>
							<input type="hidden" name="pages" value="<?php echo $pages;?>" id="pages">
							<div class="table-responsive" id="total-hrd">
								<table class="table table-hover table-condensed">
									<thead><tr><th>Action</th><th>Name</th><th>Email</th><th>Phone</th></tr></thead>
									<tbody>
										<?php
											while($result = mysql_fetch_array($execHrd))
											{
												?>
													<tr>
														<td><a href="../show/company.php?id=<?php echo $result['idHrd'];?>" target="_blank"> <button class="btn btn-success btn-primary">Show Profile</button></a></td>
														<td><?php echo $result['namaPerusahaan'];?></td>
														<td><?php echo $result['emailPerusahaan'];?></td>
														<td><?php echo $result['teleponPerusahaan'];?></td>
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