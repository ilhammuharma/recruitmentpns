<?php
	session_start();
	$title = "reportFptk";
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
			?>
				<h3><strong>Laporan FPTK</strong></h3>
				<a href="showReportFptk.php"><button class="btn btn-sm btn-success">Show All Reports</button></a>
				<p class="help-block">All fields are not required, please ignore if not want these parameters.</p>
				<form action="reportFptk.php" role="form" method="get" class="form-horizontal">
					<div class="form-group">
						<label for="nomorFptk" class="col-md-2 control-label">Nomor FPTK</label>
						<div class="col-md-4">
							<select name="nomorFptk" id="nomorFptk" class="form-control">
								<option value="">--Select One--</option>
								<?php 
									$queryNomorFptk = "SELECT * FROM fptk";
									$execNomorFptk = mysql_query($queryNomorFptk);
									while($NomorFptk = mysql_fetch_array($execNomorFptk))
									{
										?><option value="<?php echo $NomorFptk['idFptk'];?>"><?php echo $NomorFptk['nomorFptk'];?></option><?php 
									}
								?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="namaPemohon" class="col-md-2 control-label">Nama Pemohon</label>
						<div class="col-md-4">
							<select name="namaPemohon" id="namaPemohon" class="form-control">
								<option value="">--Select One--</option>
								<?php 
									$queryNamaPemohon = "SELECT * FROM fptk";
									$execNamaPemohon = mysql_query($queryNamaPemohon);
									while($NamaPemohon = mysql_fetch_array($execNamaPemohon))
									{
										?><option value="<?php echo $NamaPemohon['idFptk'];?>"><?php echo $NamaPemohon['namaPemohon'];?></option><?php 
									}
								?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="jabatanPosisi" class="col-md-2 control-label">Posisi/Jabatan</label>
						<div class="col-md-4">
							<select name="jabatanPosisi" id="jabatanPosisi" class="form-control">
								<option value="">--Select One--</option>
								<?php 
									$queryJabatanPosisi = "SELECT * FROM kategoriKerja";
									$execJabatanPosisi = mysql_query($queryJabatanPosisi);
									while($JabatanPosisi = mysql_fetch_array($execJabatanPosisi))
									{
										?><option value="<?php echo $JabatanPosisi['idKategori'];?>"><?php echo $JabatanPosisi['namaKategori'];?></option><?php 
									}
								?>
							</select>
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
							$querySearch = "SELECT f.idFptk, f.nomorFptk, f.namaPemohon, max(f.jabatanPosisi), kk1.namaKategori FROM fptk f ";
							$querySearch .= "JOIN kategoriKerja kk1 ON kk1.idKategori = f.jabatanPosisi ";
							//$querySearch = "SELECT uw.idWorker, uw.namaUser, pw.namaInstansi, max(pw.kualifikasiPendidikan), tp.namaPendidikan, tj.namaJurusan, pw.nilai, sw.namaSkill, uw.cariKerja FROM userWorker uw ";
							//$querySearch .= "JOIN pendidikanWorker pw ON pw.idWorker = uw.idWorker ";
							//$querySearch .= "JOIN skillWorker sw ON sw.idWorker = uw.idWorker ";
							//$querySearch .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
							//$querySearch .= "JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
							$querySearch .= "WHERE ";

							$pencarian = "Search keyword: ";
						
							if($_GET['nomorFptk'] != "")
							{
								$nomorFptk = $_GET['nomorFptk'];
								$getNomorFptk = "SELECT * FROM fptk WHERE idFptk = $nomorFptk";
								$execNomorFptk = mysql_query($getNomorFptk);
								$resultNomorFptk = mysql_fetch_array($execNomorFptk);
								$namaNomorFptk = $resultNomorFptk['nomorFptk'];
								$querySearch .= "f.nomorFptk = $nomorFptk AND ";
								$pencarian .= "Look for field of FPTK: ".$namaNomorFptk.", ";
							}
							
							if($_GET['namaPemohon'] != "")
							{
								$namaPemohon = $_GET['namaPemohon'];
								$getNamaPemohon = "SELECT * FROM fptk WHERE idFptk = $namaPemohon";
								$execNamaPemohon = mysql_query($getNamaPemohon);
								$resultNamaPemohon = mysql_fetch_array($execNamaPemohon);
								$namaNamaPemohon = $resultNamaPemohon['namaPemohon'];
								$querySearch .= "f.namaPemohon = $namaPemohon AND ";
								$pencarian .= "Look for field of FPTK: ".$namaNamaPemohon.", ";
							}
							
							if($_GET['jabatanPosisi'] != "")
							{
								$jabatanPosisi = $_GET['jabatanPosisi'];
								$queryJabatanPosisi = "SELECT * FROM kategoriKerja WHERE idKategori = $jabatanPosisi";
								$execJabatanPosisi = mysql_query($queryJabatanPosisi);
								$resultJabatanPosisi = mysql_fetch_array($execJabatanPosisi);
								$querySearch .= "f.jabatanPosisi = ".$jabatanPosisi." AND ";
								$pencarian .= "Look for field of FPTK: ".$resultJabatanPosisi['namaKategori'].", ";
								//$namaJabatanPosisi = $resultJabatanPosisi['namaKategori'];
								//$pencarian .= "Look for field of work: ".$namaJabatanPosisi.", ";
							}
							
							$querySearch .= "1 GROUP BY f.idFptk ASC";	
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
																		echo "<p><strong>".$searchResult['nomorFptk']."</strong></p>";
																		echo "<em>".$searchResult['namaPemohon']." | ".$searchResult['namaKategori']."";
																	?>
																</td>
																<td><a target="_blank" href="<?php echo $webRoot."show/viewFptk.php?id=".$searchResult['idFptk'];?>"><button class="btn btn-sm btn-success">Details</button></a></td>
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
		}
		else
		{
			header("Location:index.php");
		}
	}
?>