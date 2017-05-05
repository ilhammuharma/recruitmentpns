<?php
	session_start();
	include("../assets/dbconfig.php");
	$title = "Search";
	
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
			header("Location:../admin/");
		}
		else if(isset($_SESSION['hrd']))
		{
			include("templates/head.php");
			?>	
				<div class="row">
					<div class="col-md-5">
						<h3>Quick Search Job Seekers</h3>
						<form action="search.php" role="form" method="get">
							<div class="form-group">
								<div class="input-group">
									<input type="text" name="query" class="form-control" placeholder="Enter search keyword" id="query" required>
									<span class="input-group-btn"><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button></span>
								</div>
								<p style="text-align:right;">Or <a href="asearch.php">Advanced Search</a></p>
							</div>
						</form>
					</div>
				</div>
				<?php
					if(isset($_GET['query']))
					{
						?>
							<div class="row">
								<div class="col-md-7">
									<?php
										$queryAll = $_GET['query'];
										$query = explode(" ", $queryAll);
									?>
									<strong>Keyword: </strong>
									<?php
										error_reporting(E_ALL & ~E_NOTICE);
										for($x = 0; $query[$x]; $x++)
										{
											echo "<u><a href='search.php?query=".$query[$x]."'>".$query[$x]."</a></u>, ";
										}
										$querySearchWorker = "SELECT tsw.idTable, tsw.idWorker, tsw.url, uw.namaUser, pw.namaInstansi, max(pw.kualifikasiPendidikan), tj.namaJurusan, pw.nilai, kk.namaKategori, uw.minimalGaji FROM tableSearchWorker tsw ";
										$querySearchWorker .= "JOIN userWorker uw ON uw.idWorker = tsw.idWorker ";
										$querySearchWorker .= "JOIN pendidikanWorker pw ON pw.idWorker = tsw.idWorker ";
										$querySearchWorker .= "JOIN kategoriKerja kk ON kk.idKategori = uw.cariKerja ";
										$querySearchWorker .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
										$querySearchWorker .= "WHERE match(content) against('$queryAll') > 0 GROUP BY pw.idWorker ";
										//echo $querySearchWorker;
										$execSearchWorker = mysql_query($querySearchWorker);
										if(mysql_num_rows($execSearchWorker) < 1)
										{
											echo "<p>No data found.</p>";
										}
										else
										{
											?>
											<div class="table-responsive">
												<table class="table table-condensed table-hover">
													<tbody>
														<?php
															while($searchList = mysql_fetch_array($execSearchWorker))
															{
																?>
																	<tr>
																		<td>
																			<p><strong><?php echo $searchList['namaUser'];?></strong></p>
																			<em><?php echo $searchList['namaInstansi'].", ".$searchList['namaJurusan'].", GPA/Score: ".$searchList['nilai']."<br>";?></em>
																			<em><?php echo "Expected Vacancy: ".$searchList['namaKategori'].", Expected Salary: Rp ".$searchList['minimalGaji'];?></em>
																		</td>
																		<td>
																			<a target="_blank" href="<?php echo $searchList['url'];?>"><button class="btn btn-sm btn-success">Details</button></a>
																		</td>
																	</tr>
																<?php
															}
										}
														?>
													</tbody>
												</table>
											</div>
								</div>
							</div>
						<?php
					}
				?>
			<?php
			include("templates/foot.php");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>