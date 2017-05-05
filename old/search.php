<?php
	session_start();
	include("assets/dbconfig.php");
	$head = "";
	include("templates/head.php");
?>

<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="box-no-border">
				<div class="row">
					<div class="col-md-6">
						<form role="form" action="search.php" method="get">
							<div class="form-group">
								<div class="input-group">
									<input type="text" placeholder="Enter search keyword" class="form-control" name="query" required>
										<span class="input-group-btn">
											<button type="submit"class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
										</span>
							    </div>
							    <p style="text-align:right;">Or <a href="asearch.php">advanced search mode</a></p>
							</div>
						</form>
					</div>
				</div>
				<?php 
					if(isset($_GET['query']))
					{
						$queryAll = $_GET['query'];
						$query = explode(" ", $queryAll);
						?>
							<div class="row">
								<div class="col-md-10">
									<strong>Keyword: </strong>
										<?php
											error_reporting(E_ALL & ~E_NOTICE);
												for($x = 0; $query[$x]; $x++)
												{
													echo "<u><a href='search.php?query=".$query[$x]."'>".$query[$x]."</a></u>, ";
												}
												$querySearchLowongan = "SELECT tsl.idTable, tsl.url, pl.namaPosisi, pl.kodePosisi, tp.namaProvinsi, tpend.namaPendidikan, pl.batasAkhir FROM tableSearchLowongan tsl ";
												$querySearchLowongan .= "JOIN postingLowongan pl ON pl.idLowongan = tsl.idLowongan ";
												$querySearchLowongan .= "JOIN tableProvinsi tp ON tp.idProvinsi = pl.lokasiPenempatan ";
												$querySearchLowongan .= "JOIN tingkatPendidikan tpend ON tpend.gradePendidikan = pl.pendidikanMinimal ";
												$querySearchLowongan .= "WHERE match(content) against('$queryAll') > 0";
												$execSearchLowongan = mysql_query($querySearchLowongan);
												if(mysql_num_rows($execSearchLowongan) < 1)
												{
													echo "<br><br>Not found jobs by keyword <em>".$queryAll."</em>";
												}
												else
												{
													?>
														<br><br>
															<div class="table-responsive">
																<table class="table table-hover table-condensed">
																	<tbody>
																		<?php
																			while($result = mysql_fetch_array($execSearchLowongan))
																			{
																					$end = new DateTime($result['batasAkhir']);
																					$endPost = $end->format('d M Y');
																				?>					
																				<tr>
																					<td>
																						<?php 
																							echo "<p><strong>".$result['namaPosisi']."</strong>";
																							if($result['kodePosisi'] != "")
																							{
																								echo " [".$result['kodePosisi']."]";
																							}
																							echo "</p>";
																							echo "<em>The Placement: ".$result['namaProvinsi'].", Minimum Education: ".$result['namaPendidikan'].", The Deadline: ".$endPost."</em>";
																						?>
																					</td>
																					<td><a target="_blank" href="<?php echo $result['url'];?>"><button type="button" class="btn btn-sm btn-success">Detail</button></a></td>
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
								</div>
							</div>
						<?php 
					}
				?>
			</div>
		</div>
		<?php include("templates/right-menu.php");?>
	</div>
</div>
<?php
	include("templates/foot.php");
?>