<?php
	session_start();
	$title = "posting";
	include("../assets/dbconfig.php");

	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(!isset($_SESSION['admin']))
		{
			if(isset($_SESSION['worker']))
			{
				header("Location:../worker/");
			}
			else
			{
				header("Location:index.php");
			}
		}
		else
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

			if(isset($_POST['edit-post']))
			{
				$idHrd = $_POST['idHrd'];
				$idLowongan = $_POST['idLowongan'];
				$namaPosisi = $_POST['posisi'];
				$kodePosisi = $_POST['kode-posisi'];
				$kategoriPosisi = $_POST['kategori-posisi'];
				$pendidikanMinimal = $_POST['meducation'];
				if($_POST['mgpa'] == "")
				{
					$ipkNilai = 0;
				}
				else
				{
					$ipkNilai = $_POST['mgpa'];
				}
				if($_POST['mage'] == "")
				{
					$umurMaksimal = 0;
				}
				else
				{
					$umurMaksimal = $_POST['mage'];
				}
				$lokasiPenempatan = $_POST['lokasi'];
				if($_POST['gaji'] == "")
				{
					$gajiDitawarkan = 0;
				}
				else
				{
					$gajiDitawarkan = $_POST['gaji'];
				}
				if($_POST['batas-akhir'] == "")
				{
					$tambah = new DateInterval("P15D");
					$now = new DateTime();
					$batasAkhir = $now->add($tambah);
					$batasAkhir = $batasAkhir->format('d-m-Y');
				}
				else
				{
					$batasAkhir = $_POST['batas-akhir'];
				}
				//$deskripsiKerja = htmlentities($_POST['deskripsi-kerja']);
				$kualifikasiLain = htmlentities($_POST['oqualification']);
				$queryUpdatePosting = "UPDATE postingLowongan SET namaPosisi = '$namaPosisi', kodePosisi = '$kodePosisi', pendidikanMinimal = $pendidikanMinimal, ipkNilai = $ipkNilai, umurMaksimal = $umurMaksimal, lokasiPenempatan = $lokasiPenempatan, gajiDitawarkan = $gajiDitawarkan, batasAkhir = STR_TO_DATE('$batasAkhir', '%d-%m-%Y'), kualifikasiLain = '$kualifikasiLain' WHERE idLowongan = $idLowongan AND idHrd = $idHrd";
				$execUpdatePosting = mysql_query($queryUpdatePosting) or die("SQL ERROR");
				$url = $webRoot."data/lowongan.php?id=".$idLowongan;
				$urlShow = $webRoot."show/post.php?id=".$idLowongan;
				$content = populate_word($url);
				$queryUpdateSearchLowongan = "UPDATE tableSearchLowongan SET url = '$urlShow', content = '$content' WHERE idLowongan = $idLowongan";
				$execUpdateSearchLowongan = mysql_query($queryUpdateSearchLowongan) or die("SQL Error");
				include("templates/head.php");
				?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						Edit the vacancy ad successfully.
					</div>
					<a href="posted.php"><button type="button" class="btn btn-primary">Back</button></a>
				<?php
				include("templates/foot.php");
			}
			else
			{		
				if(!isset($_GET['id']))
				{
					header("Location:posting.php");
				}
				else
				{
					$id = $_GET['id'];
					$idHrd = $_SESSION['idHrd'];
					$queryGetPosting = "SELECT * FROM postingLowongan WHERE idLowongan = $id AND idHrd = $idHrd";
					$execGetPosting = mysql_query($queryGetPosting);
					$editPosting = mysql_fetch_array($execGetPosting);
					if(mysql_num_rows($execGetPosting) > 0)
					{
						include("templates/head.php");
						?>
							<h3>Edit the vacancy ad</h3>
							<form action="edit-posting.php" class="form-horizontal" role="form" method="post">
								<input type="hidden" name="idHrd" value="<?php echo $_SESSION['idHrd']?>">
								<input type="hidden" name="idLowongan" value="<?php echo $id;?>">
								<div class="form-group">
									<label for="posisi" class="col-sm-2 control-label">Position</label>
									<div class="col-sm-5">
										<input type="text" name="posisi" class="form-control" id="posisi" placeholder="The position required" value="<?php echo $editPosting['namaPosisi'];?>" required>
									</div>
								</div>
								<div class="form-group">
									<label for="kode-posisi" class="col-sm-2 control-label">Position Code</label>
									<div class="col-sm-2">
										<input type="text" name="kode-posisi" class="form-control" id="kode-posisi" value="<?php echo $editPosting['kodePosisi'];?>" placeholder="Code">
									</div>
								</div>
								<div class="form-group">
									<label for="kategori-posisi" class="col-sm-2 control-label">Position Category</label>
									<div class="col-sm-4">
										<?php
											$queryKategori = "SELECT * FROM kategoriKerja";
											$execKategori = mysql_query($queryKategori);
										?>
										<select name="kategori-posisi" id="kategori-posisi" class="form-control">
											<?php
												while($resultKategori = mysql_fetch_array($execKategori))
												{
													?>
														<option value="<?php echo $resultKategori['idKategori'];?>" <?php if($resultKategori['idKategori'] == $editPosting['kategoriPosisi']){ echo "selected";} ?>><?php echo $resultKategori['namaKategori'];?></option>
													<?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="meducation" class="col-sm-2 control-label">Minimum Education</label>
									<div class="col-sm-4">
										<?php
											$queryTingkatPendidikan = "SELECT * FROM tingkatPendidikan";
											$execTingkatPendidikan = mysql_query($queryTingkatPendidikan);
										?>
										<select name="meducation" id="meducation" class="form-control">
											<?php
												while($resultTingkatPendidikan = mysql_fetch_array($execTingkatPendidikan))
												{
													?>
														<option value="<?php echo $resultTingkatPendidikan['gradePendidikan'];?>" <?php if($resultTingkatPendidikan['gradePendidikan'] == $editPosting['pendidikanMinimal']){ echo "selected";}?>><?php echo $resultTingkatPendidikan['namaPendidikan'];?></option>
													<?php	
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="mgpa" class="col-sm-2 control-label">Minimum GPA</label>
									<div class="col-sm-4">
										<input type="text" name="mgpa" class="form-control" id="mgpa" placeholder="GPA" value="<?php echo $editPosting['ipkNilai'];?>">
										<p class="help-block">*Enter zero (0) if it does not require a minimum GPA.</p>
										<p class="help-block">**Use dot (.) as the decimal separator.</p>
									</div>
								</div>
								<div class="form-group">
									<label for="mage" class="col-sm-2 control-label">Maximum Age</label>
									<div class="col-sm-4">
										<input type="number" name="mage" class="form-control" id="mage" placeholder="Maximum Age" value="<?php echo $editPosting['umurMaksimal'];?>">
										<p class="help-block">*Enter zero (0) if it does not require a limit age.</p>
									</div>
								</div>
								<div class="form-group">
									<label for="lokasi" class="col-sm-2 control-label">Location of Placement</label>
									<div class="col-sm-4">
										<?php
											$queryLokasi = "SELECT * FROM tableProvinsi";
											$execLokasi = mysql_query($queryLokasi);
										?>
										<select name="lokasi" id="lokasi" class="form-control">
											<?php
												while($resultLokasi = mysql_fetch_array($execLokasi))
												{
													?>
														<option value="<?php echo $resultLokasi['idProvinsi'];?>" <?php if($resultLokasi['idProvinsi'] == $editPosting['lokasiPenempatan']) { echo "selected";}?>><?php echo $resultLokasi['namaProvinsi'];?></option>
													<?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="batas-akhir" class="col-sm-2 control-label">Deadline</label>
									<div class="col-sm-4">
										<?php
											$end = new DateTime($editPosting['batasAkhir']);
											$endWork = $end->format('d-m-Y')
										?>
										<input class="form-control" name="batas-akhir" id="batas-akhir" placeholder="Deadline" value="<?php echo $endWork;?>">
									</div>
								</div>
								<div class="form-group">
									<label for="gaji" class="col-sm-2 control-label">The Salary Offered</label>
									<div class="col-sm-4">
										<div class="input-group">
											<div class="input-group-addon"><u>+</u> Rp</div>
											<input type="number" name="gaji" class="form-control" id="gaji" placeholder="The salary offered" value="<?php echo $editPosting['gajiDitawarkan'];?>">
										</div>
										<p class="help-block">*Enter zero (0) if not given salary offer.</p>
									</div>
								</div>
								<!--<div class="form-group">
									<label for="deskripsi-kerja" class="col-sm-2 control-label">Job Description</label>
									<div class="col-sm-8">
										<textarea name="deskripsi-kerja" id="deskripsi-kerja" rows="5" class="form-control"></textarea>
									</div>
								</div>-->
								<div class="form-group">
									<label for="oqualification" class="col-sm-2 control-label">Other Qualifications</label>
									<div class="col-sm-8">
										<textarea name="oqualification" id="oqualification" rows="5" class="form-control"><?php echo html_entity_decode($editPosting['kualifikasiLain']);?></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-5">
										<button type="submit" class="btn btn-primary" name="edit-post" id="edit-post">Save</button>
									</div>
								</div>
							</form>
						<?php
						include("templates/foot.php");
					}
					else
					{
						header("Location:posting.php");
					}
				}
			}
		}
	}
?>