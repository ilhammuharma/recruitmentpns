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
				<h3>Advanced Search</h3>
				<p class="help-block">All field are not required, please ignore if not want these parameters.</p>
				<form action="asearch.php" role="form" method="get" class="form-horizontal">
					<div class="form-group">
						<label for="posisi" class="col-md-2 control-label">Position</label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="posisi" id="posisi" placeholder="The desired position">
						</div>
					</div>
					<div class="form-group">
						<label for="kategori" class="col-md-2 control-label">Category Position</label>
						<div class="col-md-5">
							<select name="kategori" id="kategori" class="form-control">
								<option value="">--Select One--</option>
								<?php
									$queryKategori = "SELECT * FROM kategoriKerja ORDER BY namaKategori ASC";
									$execKategori = mysql_query($queryKategori);
									while($listKategori = mysql_fetch_array($execKategori))
									{
										?><option value="<?php echo $listKategori['idKategori'];?>"><?php echo $listKategori['namaKategori'];?></option><?php 
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="pendidikan" class="col-md-2 control-label">Minimum Education</label>
						<div class="col-md-5">
							<select name="pendidikan" id="pendidikan" class="form-control">
								<option value="">--Select One--</option>
								<?php
									$queryPendidikan = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
									$execPendidikan = mysql_query($queryPendidikan);
									while($listPendidikan = mysql_fetch_array($execPendidikan))
									{
										?><option value="<?php echo $listPendidikan['gradePendidikan'];?>"><?php echo $listPendidikan['namaPendidikan'];?></option><?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="nilai" class="col-md-2 control-label">Minimum GPA</label>
						<div class="col-md-5">
							<input type="text" class="form-control" id="nilai" name="nilai" placeholder="Minimal IPK">
						</div>
					</div>
					<div class="form-group">
						<label for="penempatan" class="col-md-2 control-label">Work Placements</label>
						<div class="col-md-5">
							<select name="penempatan" id="penempatan" class="form-control">
								<option value="">--Select One--</option>
								<?php
									$queryProvinsi = "SELECT * FROM tableProvinsi";
									$execProvinsi = mysql_query($queryProvinsi);
									while($listProvinsi = mysql_fetch_array($execProvinsi))
									{
										?><option value="<?php echo $listProvinsi['idProvinsi'];?>"><?php echo $listProvinsi['namaProvinsi'];?></option><?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="fungsi" class="col-md-2 control-label">Work Category</label>
						<div class="col-md-5">
							<select name="fungsi" id="fungsi" class="form-control">
								<option value="">--Select One--</option>
								<?php
									$queryFungsi = "SELECT * FROM kategoriKerja";
									$execFungsi = mysql_query($queryFungsi);
									while($listFungsi = mysql_fetch_array($execFungsi))
									{
										?><option value="<?php echo $listFungsi['idKategori'];?>"><?php echo $listFungsi['namaKategori'];?></option><?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="gaji" class="col-md-2 control-label">Minimum Salary</label>
						<div class="col-md-5">
							<div class="input-group">
								<span class="input-group-addon"><u>+</u>Rp</span>
								<input type="number" class="form-control" id="gaji" name="gaji" placeholder="Minimum Salary">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-5">
							<button type="submit" class="btn btn-primary" name="advance-search">Search</button>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-md-12">
						<?php
							if(isset($_GET['advance-search']))
							{
								$queryCariLanjut = "SELECT pl.idLowongan, pl.namaPosisi, pl.kodePosisi, kk.namaKategori, tp.namaPendidikan, tprov.namaProvinsi, pl.ipkNilai, pl.gajiDitawarkan, pl.batasAkhir FROM postingLowongan pl ";
								$queryCariLanjut .= "JOIN kategoriKerja kk ON kk.idKategori = pl.kategoriPosisi ";
								$queryCariLanjut .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pl.pendidikanMinimal ";
								$queryCariLanjut .= "JOIN tableProvinsi tprov ON tprov.idProvinsi = pl.lokasiPenempatan ";
								$queryCariLanjut .= "WHERE ";
								$pencarian = "";
								if(isset($_GET['posisi']))
								{
									$posisi = $_GET['posisi'];
									$queryCariLanjut .= "lower(pl.namaPosisi) like lower('%$posisi%') ";
									if($_GET['posisi'] == "")
									{
										$posisi = "All";
									}
									$pencarian .= " The expected position: ".$posisi.",";
								}
								if(isset($_GET['kategori']))
								{
									if($_GET['kategori'] != "")
									{
										$kategori = $_GET['kategori'];
										$queryCariLanjut .= "AND pl.kategoriPosisi = $kategori ";
										$execKategori = mysql_query("SELECT * from kategoriKerja WHERE idKategori = $kategori");
										$resultKategori = mysql_fetch_array($execKategori);
										$kategori = $resultKategori['namaKategori'];
										$pencarian .= " Work Category: ".$kategori.",";
									}
								}
								if(isset($_GET['pendidikan']))
								{
									if($_GET['pendidikan'] != "")
									{
										$pendidikan = $_GET['pendidikan'];
										$queryCariLanjut .= "AND pl.pendidikanMinimal >= $pendidikan ";
										$execPendidikan = mysql_query("SELECT * FROM tingkatPendidikan WHERE gradePendidikan = $pendidikan");
										$resultPendidikan = mysql_fetch_array($execPendidikan);
										$pendidikan = $resultPendidikan['namaPendidikan'];
										$pencarian .= " Minimum Education: ".$pendidikan.",";
									}	
								}
								if(isset($_GET['nilai']))
								{
									if($_GET['nilai'] != "")
									{
										$nilai = $_GET['nilai'];
										$queryCariLanjut .= "AND pl.ipkNilai >= $nilai ";
										$pencarian .= " Minimum GPA: ".$nilai.",";
									}
								}
								if(isset($_GET['penempatan']))
								{
									if($_GET['penempatan'] != "")
									{
										$penempatan = $_GET['penempatan'];
										$queryCariLanjut .= "AND pl.lokasiPenempatan = $penempatan ";
										$getProvinsi = mysql_query("SELECT * FROM tableProvinsi WHERE idProvinsi = $penempatan");
										$resultProvinsi = mysql_fetch_array($getProvinsi);
										$provinsi = $resultProvinsi['namaProvinsi'];
										$pencarian .= " Work Placements: ".$provinsi.",";
									}
								}
								if(isset($_GET['fungsi']))
								{
									if($_GET['fungsi'] != "")
									{
										$fungsi = $_GET['fungsi'];
										$queryCariLanjut .= "AND pl.kategoriPosisi = $fungsi ";
										$getFungsi = mysql_query("SELECT * FROM kategoriKerja WHERE idKategori = $fungsi");
										$resultFungsi = mysql_fetch_array($getFungsi);
										$hasilFungsi = $resultFungsi['namaKategori'];
										$pencarian .= " Work Category: ".$hasilFungsi.",";
									}
								}
								if(isset($_GET['gaji']))
								{
									if($_GET['gaji'] != "")
									{
										$gaji = $_GET['gaji'];
										$queryCariLanjut .= "AND pl.gajiDitawarkan >= $gaji ";
										$pencarian .= " Minimum salary offered: Rp ".$gaji;
									}
								}
								$batas = new DateTime();
								$batasAkhir = $batas->format('d-m-Y');	
								$queryCariLanjut .= "AND batasAkhir >= STR_TO_DATE('$batasAkhir', '%d-%m-%Y') ORDER BY batasAkhir DESC";

								//echo $queryCariLanjut;
								$execCariLanjut = mysql_query($queryCariLanjut);
								if(mysql_num_rows($execCariLanjut) < 1)
								{
									echo "<p><em>".$pencarian."</em></p>";
									echo "No vacancies were found...";
								}
								else
								{
									?>
										<p><em><?php echo $pencarian;?></em></p>
										<div class="table-responsive">
											<table class="table table-condense table-hover">
												<tbody>
													<?php
														while($listLowongan = mysql_fetch_array($execCariLanjut))
														{
															?>
																<tr>
																	<td>
																		<?php
																			echo "<p><strong>".$listLowongan['namaPosisi']."</strong>";
																			if($listLowongan['kodePosisi'] != "")
																			{
																				echo " [".$listLowongan['kodePosisi']."]";
																			} 
																			echo "</p>";
																			echo "<em>Placement: ".$listLowongan['namaProvinsi'].", ";
																			echo "Category: ".$listLowongan['namaKategori'].", ";
																			echo "Minimum Education: ".$listLowongan['namaPendidikan'].", ";
																			echo "Minimum GPA: ".$listLowongan['ipkNilai'].", ";
																			echo "Salary: ".$listLowongan['gajiDitawarkan']."</em>";
																			$batasAkhir = new DateTime($listLowongan['batasAkhir']);
																			echo "<p>Deadline: <strong>".$batasAkhir->format('d M Y')."</strong></p>";
																		?>
																	</td>
																	<td>
																		<a target="_blank"href="<?php echo $webRoot.'show/post.php?id='.$listLowongan['idLowongan'];?>"><button type="button" class="btn btn-success btn-sm">Detail</button></a>
																	</td>
																</tr>
															<?php
														}
													?>
												</tbody>
											</table>
										</div>
									<?php
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php include("templates/right-menu.php"); ?>
	</div>
</div>
<?php
	include("templates/foot.php");
?>