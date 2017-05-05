<?php
	session_start();
	include("../assets/dbconfig.php");
	$title = "Advanced Search";
	
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
			include("templates/head.php");
			?>
				<h3><strong>Advanced Search</strong></h3>
				<p class="help-block">All fields are not required, please ignore if not want these parameters.</p>
				<form action="asearch.php" role="form" method="get" class="form-horizontal">
					<div class="form-group">
						<label for="fungsi" class="col-md-2 control-label">Type of Work</label>
						<div class="col-md-4">
							<select name="fungsi" id="fungsi" class="form-control">
								<option value="">--Select One--</option>
								<?php 
									$queryKategori = "SELECT * FROM kategoriKerja";
									$execKategori = mysql_query($queryKategori);
									while($kategori = mysql_fetch_array($execKategori))
									{
										?><option value="<?php echo $kategori['idKategori'];?>"><?php echo $kategori['namaKategori'];?></option><?php 
									}
								?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="lulusan" class="col-md-2 control-label">A Graduate of: </label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="lulusan" id="lulusan" placeholder="Alumni from?">
							<p class="help-block">Please enter the full name of the institute</p>
						</div>
					</div>
					
					<div class="form-group">
						<label for="kualifikasi" class="col-md-2 control-label">Qualification: </label>
						<div class="col-md-4">
							<select name="kualifikasi" id="kualifikasi" class="form-control">
								<option value="">--Select One--</option>
								<?php
									$queryKualifikasi = "SELECT * FROM tingkatPendidikan";
									$execKualifikasi = mysql_query($queryKualifikasi);
									while($resultKualifikasi = mysql_fetch_array($execKualifikasi))
									{
										?><option value="<?php echo $resultKualifikasi['gradePendidikan'];?>"><?php echo $resultKualifikasi['namaPendidikan'];?></option><?php
									}
								?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="usia" class="col-md-2 control-label">Maximum Age</label>
						<div class="col-md-3">
							<input type="number" class="form-control" name="usia" id="lulusan" placeholder="Maximum Age">
						</div>
					</div>
					
					<div class="form-group">
						<label for="penempatan" class="col-md-2 control-label">Expected Placement</label>
						<div class="col-md-4">
							<select name="penempatan" id="penempatan" class="form-control">
								<option value="">--Select One--</option>
								<?php
									$queryProvinsi = "SELECT * FROM tableProvinsi";
									$execProvinsi = mysql_query($queryProvinsi);
									while($provinsi = mysql_fetch_array($execProvinsi))
									{
										?><option value="<?php echo $provinsi['idProvinsi'];?>"><?php echo $provinsi['namaProvinsi'];?></option><?php
									}
								?>				
							</select>
							<div class="checkbox">
								<label for="seluruh-indonesia">
									<input type="checkbox" name="all" id="all" value="1"> Willing placed throughout Indonesia
								</label>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="skill" class="col-md-2 control-label">Skills</label>
						<div class="col-md-5">
							<input type="text" name="skill" id="skill" class="form-control" placeholder="Skill that is owned">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-offset-2 col-md-3">
							<button type="submit" name="squery" id="query" class="btn btn-primary">Seacrh</button>
						</div>
					</div>
				</form>
			<div class="row">
				<div class="col-md-9">
					<?php
						if(isset($_GET['squery']))
						{
							$querySearch = "SELECT uw.idWorker, uw.namaUser, pw.namaInstansi, max(pw.kualifikasiPendidikan), tp.namaPendidikan, tj.namaJurusan, pw.nilai, sw.namaSkill, uw.cariKerja FROM userWorker uw ";
							$querySearch .= "JOIN pendidikanWorker pw ON pw.idWorker = uw.idWorker ";
							$querySearch .= "JOIN skillWorker sw ON sw.idWorker = uw.idWorker ";
							$querySearch .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
							$querySearch .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
							$querySearch .= "WHERE ";

							$pencarian = "Search keyword: ";
						
							if($_GET['lulusan'] != "")
							{
								$lulusan = $_GET['lulusan'];
								$querySearch .= "lower(pw.namaInstansi) like lower('%$lulusan%') AND ";
								$pencarian .= "A Graduate of ".$lulusan.", ";
							}
								
							if($_GET['usia'] != "")
							{
								$usia = $_GET['usia'];
								$querySearch .= "(year(now())-year(uw.birthday)) < ".$usia." AND ";
								$pencarian .= "Maximum Age: ".$usia." tahun, ";
							}
						
							if($_GET['kualifikasi'] != "")
							{
								$kualifikasi = $_GET['kualifikasi'];
								$querySearch .= "pw.kualifikasiPendidikan >= ".$kualifikasi." AND ";
								$queryPendidikan = "SELECT * FROM tingkatPendidikan WHERE gradePendidikan = $kualifikasi";
								$execPendidikan = mysql_query($queryPendidikan);
								$resultPendidikan = mysql_fetch_array($execPendidikan);
								$pencarian .= "Minimum Education: ".$resultPendidikan['namaPendidikan'].", ";
							}
								
							if($_GET['fungsi'] != "")
							{
								$fungsi = $_GET['fungsi'];
								$getFungsi = "SELECT * FROM kategoriKerja WHERE idKategori = $fungsi";
								$execFungsi = mysql_query($getFungsi);
								$resultFungsi = mysql_fetch_array($execFungsi);
								$namaFungsi = $resultFungsi['namaKategori'];
								$querySearch .= "uw.cariKerja = $fungsi AND ";
								$pencarian .= "Look for field of work: ".$namaFungsi.", ";
							}
								
							if($_GET['penempatan'] != "")
							{
								$penempatan = $_GET['penempatan'];
								$getProvinsi = "SELECT * FROM tableProvinsi WHERE idProvinsi = $penempatan";
								$execGetProvinsi = mysql_query($getProvinsi);
								$result = mysql_fetch_array($execGetProvinsi);
								$querySearch .= "uw.lokasiKerja1 = $penempatan OR uw.lokasiKerja2 = $penempatan OR uw.lokasiKerja3 = $penempatan AND ";
								$pencarian .= "Expected Location ".$result['namaProvinsi'].", ";
							}
								
							if(isset($_GET['all']))
							{
								$all = $_GET['all'];
								$querySearch .= "uw.bersedia = $all AND ";
								$pencarian .= "Willing placed throughout Indonesia, ";
							}
								
							if($_GET['skill'] != "")
							{
								$skill = $_GET['skill'];
								$querySearch .= "lower(sw.namaSkill) like lower('$skill') AND ";
								$pencarian .= "Skills: ".$skill;
							}
							$querySearch .= "1 GROUP BY uw.idWorker ASC";	
							echo $pencarian;
							$execSearch = mysql_query($querySearch);

							if(mysql_num_rows($execSearch) < 1)
							{
								echo "<p> No data found</p>";
							}
							else
							{
								?>
									<div class="table-responsive">
										<table class="table table-condensed table-hover">
											<tbody>
												<?php
													while($searchResult = mysql_fetch_array($execSearch))
													{
														?>
															<tr>
																<td>
																	<?php 
																		echo "<p><strong>".$searchResult['namaUser']."</strong></p>";
																		echo "<em>".$searchResult['namaInstansi']." | ".$searchResult['namaJurusan']." (".$searchResult['namaPendidikan'].")";
																	?>
																</td>
																<td><a target="_blank" href="<?php echo $webRoot."show/worker.php?id=".$searchResult['idWorker'];?>"><button class="btn btn-sm btn-success">Details</button></a></td>
															</tr>
														<?php
													}
												?>
											</tbody>
										</table>
									</div>
				</div>
			</div>
								<?php
							}	
						}
			include("templates/foot.php");
		}else
		{
			header("Location:index.php");
		}
	}
?>