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
		if(isset($_SESSION['admin']))
		{
			function populate_word($url)
			{
				$fd = @fopen($url, "r");
				$word = "";
				while(!feof($fd))
				{
					$buffer = fgets($fd,1024);
					$buffer = trim($buffer);
					$buffer = strip_tags($buffer);
					$explode = explode(" ", $buffer);
					for($i = 0 ; $i<=sizeof($explode); $i++){
						$kata = stripslashes(strtolower($explode[$i]));
						$word .= $kata." ";
					}
				}
				return $word;
			}
			include("templates/head.php");
			if(isset($_POST['submit-post']))
			{
				$idHrd = $_POST['idHrd'];
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
					$batasAkhir = $batasAkhir->format('Y-m-d');
				}
				else
				{
					$batasAkhir = $_POST['batas-akhir'];
				}
				//$deskripsiKerja = htmlentities($_POST['deskripsi-kerja']);
				$kualifikasiLain = htmlentities($_POST['oqualification']);

				$queryInput = "INSERT INTO postingLowongan(idLowongan, namaPosisi, kodePosisi, kategoriPosisi, pendidikanMinimal, ipkNilai, umurMaksimal, lokasiPenempatan, gajiDitawarkan,tanggalPosting, batasAkhir, kualifikasiLain, idHrd) VALUES(";
				$queryInput .= "'', '$namaPosisi', '$kodePosisi', $kategoriPosisi, $pendidikanMinimal, $ipkNilai, $umurMaksimal,";
				$queryInput .= "$lokasiPenempatan, $gajiDitawarkan, curdate(),STR_TO_DATE('$batasAkhir', '%Y-%m-%d'), '$kualifikasiLain', $idHrd)";
				//echo $queryInput;
				$execInput = mysql_query($queryInput);

				$queryGetIdLowongan = "SELECT max(idLowongan) as idLowongan FROM postingLowongan WHERE idHrd = $idHrd";
				$execGetIdLowongan = mysql_query($queryGetIdLowongan);
				$resultGetIdLowongan = mysql_fetch_array($execGetIdLowongan);
				$idLowongan = $resultGetIdLowongan['idLowongan'];
				//echo $idLowongan;

				$url = $webRoot."data/lowongan.php?id=".$idLowongan;
				$urlShow = $webRoot."show/post.php?id=".$idLowongan;
				
				$content = populate_word($url);
				//echo $content;
				$queryInsertSearchLowongan = "INSERT INTO tableSearchLowongan VALUES('', $idLowongan, '$urlShow', '$content')";
				$execInsertSearchLowongan = mysql_query($queryInsertSearchLowongan);
				?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						Job advertisements successfully posted!
					</div>
					<a href="posted.php"><button type="button" class="btn btn-primary">Back</button></a>
				<?php
			}
			else
			{
				?>
					<h3><strong>Pasang Lowongan</strong></h3>
					<form action="posting.php" class="form-horizontal" role="form" method="post">
						<input type="hidden" name="idHrd" value="<?php echo $_SESSION['idHrd']?>">
						<div class="form-group">
							<label for="posisi" class="col-sm-2 control-label">Posisi</label>
							<div class="col-sm-5">
								<input type="text" name="posisi" class="form-control" id="posisi" placeholder="The position required" required>
							</div>
						</div>
						<div class="form-group">
							<label for="kode-posisi" class="col-sm-2 control-label">Kode Posisi</label>
							<div class="col-sm-2">
								<input type="text" name="kode-posisi" class="form-control" id="kode-poisisi" placeholder="Code">
							</div>
						</div>
						<div class="form-group">
							<label for="kategori-posisi" class="col-sm-2 control-label">Kategori Posisi</label>
							<div class="col-sm-4">
								<?php
									$queryKategori = "SELECT * FROM kategoriKerja ORDER BY namaKategori ASC";
									$execKategori = mysql_query($queryKategori);
								?>
								<select name="kategori-posisi" id="kategori-posisi" class="form-control">
									<?php
										while($resultKategori = mysql_fetch_array($execKategori))
										{
											?>
												<option value="<?php echo $resultKategori['idKategori'];?>"><?php echo $resultKategori['namaKategori'];?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meducation" class="col-sm-2 control-label">Minimal Pendidikan</label>
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
												<option value="<?php echo $resultTingkatPendidikan['idTingkat'];?>"><?php echo $resultTingkatPendidikan['namaPendidikan'];?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="mgpa" class="col-sm-2 control-label">Minimal IPK</label>
							<div class="col-sm-4">
								<input type="text" name="mgpa" class="form-control" id="mgpa" placeholder="GPA">
								<p class="help-block">*Enter zero (0) if it does not require a minimum GPA.</p>
								<p class="help-block">**Use dot (.) as the decimal separator.</p>
							</div>
						</div>
						<div class="form-group">
							<label for="mage" class="col-sm-2 control-label">Maksimal Usia</label>
							<div class="col-sm-4">
								<input type="number" name="mage" class="form-control" id="mage" placeholder="Maximum Age">
								<p class="help-block">*Enter zero (0) if it does not require a limit age.</p>
							</div>
						</div>
						<div class="form-group">
							<label for="lokasi" class="col-sm-2 control-label">Lokasi Penempatan</label>
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
												<option value="<?php echo $resultLokasi['idProvinsi'];?>"><?php echo $resultLokasi['namaProvinsi'];?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="batas-akhir" class="col-sm-2 control-label">Batas Akhir</label>
							<div class="col-sm-4">
								<input class="form-control" name="batas-akhir" id="batas-akhir" placeholder="Deadline">
							</div>
						</div>
						<div class="form-group">
							<label for="gaji" class="col-sm-2 control-label">Gaji</label>
							<div class="col-sm-4">
								<div class="input-group">
									<div class="input-group-addon"><u>+</u> Rp</div>
									<input type="number" name="gaji" class="form-control" id="gaji" placeholder="The salary offered">
								</div>
								<p class="help-block">Enter zero (0) if not given salary offer.</p>
							</div>
						</div>
						<!--<div class="form-group">
							<label for="deskripsi-kerja" class="col-sm-2 control-label">Job Description</label>
							<div class="col-sm-8">
								<textarea name="deskripsi-kerja" id="deskripsi-kerja" rows="5" class="form-control"></textarea>
							</div>
						</div>-->
						<div class="form-group">
							<label for="oqualification" class="col-sm-2 control-label">Kualifikasi Lain</label>
							<div class="col-sm-8">
								<textarea name="oqualification" id="oqualification" rows="5" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-5">
								<button type="submit" class="btn btn-primary" name="submit-post" id="submit-post">Simpan</button>
							</div>
						</div>
					</form>
				<?php
			}
			include("templates/foot.php");
		}
		else
		{
			if(isset($_SESSION['hrd']))
			{
				header("Location:../hrd/");
			}
			else
			{
				header("Location:../worker/");
			}
		}
	}
?>