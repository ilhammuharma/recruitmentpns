<?php
	session_start();
	$title = "resume";
	include("../assets/dbconfig.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
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
			$idLogin = $_SESSION['idLogin'];
			$tab = "";
			$queryGetUser = "SELECT * FROM userWorker WHERE idLogin = '$idLogin'";
			$execGetUser = mysql_query($queryGetUser);
			$resultGetUser = mysql_fetch_array($execGetUser);
			$idWorker = $resultGetUser['idWorker'];
			
			if(isset($_POST['saveIdentity']))
			{
				$tab = "identity";
				//echo "update identity";
				$idWorker = $_POST['id-worker'];
				$namaLengkap = $_POST['nama'];
				if($_POST['gender'] == "")
				{
					$gender = "L";
				}
				else
				{
					$gender = $_POST['gender'];
				}
				if($_POST['golonganDarah'] == "")
				{
					$golonganDarah = "A";
				}
				else
				{
					$golonganDarah = $_POST['golonganDarah'];
				}
				$tempatLahir = $_POST['tempatLahir'];
				$birthday = $_POST['birthday'];
				if($_POST['agama'] == "")
				{
					$agama = "Islam";
				}
				else
				{
					$agama = $_POST['agama'];
				}
				if($_POST['statusNikah'] == "")
				{
					$statusNikah = "Belum Menikah";
				}
				else
				{
					$statusNikah = $_POST['statusNikah'];
				}
				$noKtp = $_POST['noKtp'];
				if($_POST['kewarganegaraan'] == "")
				{
					$kewarganegaraan = "WNI";
				}
				else
				{
					$kewarganegaraan = $_POST['kewarganegaraan'];
				}
				$noNpwp = $_POST['noNpwp'];
				$email = $_POST['email'];
				$alamatKtp = addslashes($_POST['addressKtp']);
				$alamatSekarang = addslashes($_POST['addressSekarang']);
				$noPonsel = "+62".$_POST['noponsel'];
				$oNoPonsel = "+62".$_POST['onoponsel'];
				
				$queryUpdateIdentity = "UPDATE userWorker SET namaUser = '$namaLengkap', gender = '$gender', golonganDarah = '$golonganDarah', 
				tempatLahir = '$tempatLahir', birthday=STR_TO_DATE('$birthday','%d-%m-%Y'), agama = '$agama', statusNikah = '$statusNikah', noKtp = '$noKtp', 
				kewarganegaraan = '$kewarganegaraan', noNpwp = '$noNpwp', emailUser = '$email', alamatKtp = '$alamatKtp',
				alamatSekarang = '$alamatSekarang', noPonsel='$noPonsel', otherPonsel='$oNoPonsel' WHERE idWorker = $idWorker";
				//echo $queryUpdateIdentity;
				
				$execQuery = mysql_query($queryUpdateIdentity);
				$queryIdLogin = "SELECT idLogin FROM userWorker WHERE idWorker = '$idWorker'";
				$execIdLogin = mysql_query($queryIdLogin);
				$getIdLogin = mysql_fetch_array($execIdLogin);
				$idLogin = $getIdLogin['idLogin'];
				$queryUpdateLogin = "UPDATE loginWorker SET email = '$email' WHERE idLogin = '$idLogin'";
				$execUpdateLogin = mysql_query($queryUpdateLogin);
				//$_SESSION['suksesUpdateIdentitas'] = "Data berhasil disimpan.";
				//echo "berhasil";
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			if(isset($_POST['saveEdu']))
			{
				$tab = "education";
				$idWorker = $_POST['idWorker'];
				$namaUniversitas = $_POST['nama-universitas'];
				$alamatUniversitas = $_POST['alamat-kampus'];
				$kualifikasi = $_POST['kualifikasi'];
				$jurusan = $_POST['jurusan'];
				if($_POST['ipk'] == "")
				{
					$ipk = 0;
				}
				else
				{
					$ipk = $_POST['ipk'];
				}
				if($_POST['tahun-lulus'] == "")
				{
					$lulus = 0;
				}
				else
				{
					$lulus = $_POST['tahun-lulus'];
				}
				$queryInputEducation = "INSERT INTO pendidikanWorker VALUES(null, '$idWorker', '$namaUniversitas', '$alamatUniversitas', '$kualifikasi', '$jurusan', '$ipk', '$lulus')";
				$execInputEducation = mysql_query($queryInputEducation);
				//$_SESSION['suksesUpdateEducation'] = "Data berhasil disimpan.";
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			if(isset($_POST['edu-update']))
			{
				$tab = "education";
				$idPendidikan = $_POST['id-pendidikan'];
				$namaUniversitas = $_POST['nama-universitas'];
				$alamatUniversitas = $_POST['alamat-kampus'];
				$kualifikasi = $_POST['kualifikasi'];
				$jurusan = $_POST['jurusan'];
				if($_POST['nilai'] == "")
				{
					$ipk = 0;
				}
				else
				{
					$ipk = $_POST['nilai'];
				}
				if($_POST['lulus'] == "")
				{
					$lulus = 0;
				}
				else
				{
					$lulus = $_POST['lulus'];
				}
				//echo $alamatUniversitas."<br>";
				$queryUpdateEducation = "UPDATE pendidikanWorker SET namaInstansi = '$namaUniversitas', lokasiInstansi = '$alamatUniversitas', kualifikasiPendidikan = '$kualifikasi', 
										jurusanPendidikan = '$jurusan', nilai = '$ipk', tahunLulus = '$lulus' WHERE idPendidikan = '$idPendidikan'";
				//echo $queryUpdateEducation;
				$execUpdateEducation = mysql_query($queryUpdateEducation);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-education']))
			{
				$tab = "education";
				$idPendidikan = $_POST['id-pendidikan'];
				$queryDeleteEducation = "DELETE FROM pendidikanWorker WHERE idPendidikan = '$idPendidikan'";
				$execDeleteEducation = mysql_query($queryDeleteEducation);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['saveExp']))
			{
				$tab = "experience";
				$idWorker = $_POST['idWorker'];
				$pengalaman_perusahaan = $_POST['pengalaman-perusahaan'];
				$pengalaman_bidang = $_POST['pengalaman-bidang'];
				$pengalaman_posisi = $_POST['pengalaman-posisi'];
				$pengalaman_lokasi = $_POST['pengalaman-lokasi'];
				$start = $_POST['start-date-work'];
				if(isset($_POST['endNow']))
				{
					$end = "00-00-000";
				}
				else
				{
					$end = $_POST['end-date-work'];
				}
				$pengalaman_gaji = $_POST['pengalaman-gaji'];
				if(isset($_POST['pengalaman-grossNett']))
				{
					$pengalaman_grossNett = $_POST['pengalaman-grossNett'];
				}
				else
				{
					$pengalaman_grossNett = 0;
				}
				$pengalaman_bawahan = $_POST['pengalaman-bawahan'];
				$pengalaman_alasan = addslashes($_POST['pengalaman-alasan']);
				$pengalaman_namaAtasan = $_POST['pengalaman-namaAtasan'];
				$pengalaman_telpAtasan = $_POST['pengalaman-telpAtasan'];
				$pengalaman_jabatanAtasan = $_POST['pengalaman-jabatanAtasan'];
				
				$queryInputExp = "INSERT INTO pengalamanWorker VALUES(null, '$idWorker', '$pengalaman_perusahaan', '$pengalaman_bidang', '$pengalaman_posisi', 
								'$pengalaman_lokasi', STR_TO_DATE('$start','%d-%m-%Y'), STR_TO_DATE('$end','%d-%m-%Y'), '$pengalaman_gaji',
								'$pengalaman_grossNett', '$pengalaman_bawahan', '$pengalaman_alasan',
								'$pengalaman_namaAtasan', '$pengalaman_telpAtasan', '$pengalaman_jabatanAtasan')";
				$execInputExp = mysql_query($queryInputExp);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-exp']))
			{
				$tab = "experience";
				$idPengalaman = $_POST['id-exp'];
				//echo $idPengalaman;
				$queryDeleteExp = "DELETE FROM pengalamanWorker WHERE idPengalaman = '$idPengalaman'";
				$execDeleteExp = mysql_query($queryDeleteExp);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-exp']))
			{
				$tab = "experience";
				$idPengalaman = $_POST['id-exp'];
				$perusahaan_pengalaman = $_POST['perusahaan-pengalaman'];
				$bidang_pengalaman = $_POST['bidang-pengalaman'];
				$posisi_pengalaman = $_POST['posisi-pengalaman'];
				$lokasi_pengalaman = $_POST['lokasi-pengalaman'];
				$start = $_POST['start-date-work'];
				if(isset($_POST['endNow']))
				{
					$end = "00-00-000";
				}
				else
				{
					$end = $_POST['end-date-work'];
				}
				$gaji_pengalaman = $_POST['gaji-pengalaman'];
				if(isset($_POST['grossNett-pengalaman']))
				{
					$grossNett_pengalaman = $_POST['grossNett-pengalaman'];
				}
				else
				{
					$grossNett_pengalaman = 0;
				}
				$bawahan_pengalaman = $_POST['bawahan-pengalaman'];
				$alasan_pengalaman = addslashes($_POST['alasan-pengalaman']);
				$namaAtasan_pengalaman = $_POST['namaAtasan-pengalaman'];
				$telpAtasan_pengalaman = $_POST['telpAtasan-pengalaman'];
				$jabatanAtasan_pengalaman = $_POST['jabatanAtasan-pengalaman'];
				
				$queryUpdateExp = "UPDATE pengalamanWorker SET namaPerusahaan = '$perusahaan_pengalaman', bidangUsaha = '$bidang_pengalaman', posisi = '$posisi_pengalaman', lokasi = '$lokasi_pengalaman', 
								awalKerja = STR_TO_DATE('$start', '%d-%m-%Y'), akhirKerja = STR_TO_DATE('$end', '%d-%m-%Y'), gaji = '$gaji_pengalaman', 
								grossNett = '$grossNett_pengalaman', jumlahBawahan = '$bawahan_pengalaman', deskripsi = '$alasan_pengalaman',
								namaAtasan = '$namaAtasan_pengalaman', telpAtasan = '$telpAtasan_pengalaman', jabatanAtasan = '$jabatanAtasan_pengalaman' WHERE idPengalaman = '$idPengalaman'";
				$execUpdateExp = mysql_query($queryUpdateExp);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['saveBhs']))
			{
				$tab = "skill";
				$idWorker = $_POST['idWorker'];
				$bahasa = $_POST['bahasa'];
				$bahasaLisan = $_POST['bahasa-lisan'];
				$bahasaMenulis = $_POST['bahasa-menulis'];
				$bahasaMembaca = $_POST['bahasa-membaca'];
				$bahasaKeterangan = $_POST['bahasa-keterangan'];
				$queryInputBahasa = "INSERT INTO skillBahasaWorker VALUES(null, '$idWorker', '$bahasa', '$bahasaLisan', '$bahasaMenulis', '$bahasaMembaca', '$bahasaKeterangan')";
				$execInputBahasa = mysql_query($queryInputBahasa);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-bahasa']))
			{
				$tab = "skill";
				$idtable = $_POST['id-table'];
				$queryDeleteBahasa = "DELETE FROM skillBahasaWorker WHERE idTable = '$idtable'";
				$execDeleteBahasa = mysql_query($queryDeleteBahasa);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-bahasa']))
			{
				$tab = "skill";
				$idtable = $_POST['id-table'];
				$bahasa = $_POST['nama-bahasa'];
				$lisan = $_POST['tkl'];
				$menulis = $_POST['tkt'];
				$membaca = $_POST['tkb'];
				$keterangan = $_POST['ket'];
				$queryUpdateBahasa = "UPDATE skillBahasaWorker SET idBahasa = '$bahasa', tingkatLisan = '$lisan', tingkatMenulis = '$menulis', tingkatMembaca = '$membaca', keteranganBahasa = '$keterangan' WHERE idTable = '$idtable'";
				$execUpdateBahasa = mysql_query($queryUpdateBahasa);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['saveSkill']))
			{
				$tab = "skill";
				$idWorker = $_POST['idWorker'];
				$namaSkill = $_POST['skill'];
				$tingkatSkill = $_POST['tingkat-skill'];
				$queryInputSkill = "INSERT INTO skillWorker VALUES(null, '$idWorker', '$namaSkill', '$tingkatSkill')";
				$execInputSkill = mysql_query($queryInputSkill);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-skill']))
			{
				$tab = "skill";
				$idSkill = $_POST['id-skill'];
				$queryDeleteSkill = "DELETE FROM skillWorker WHERE idSkill = '$idSkill'";
				$execDeleteSkill = mysql_query($queryDeleteSkill);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			if(isset($_POST['saveMengemudi']))
			{
				$tab = "skill";
				$idWorker = $_POST['idWorker'];
				$mengemudi = $_POST['mengemudi'];
				$keahlianMengemudi = $_POST['keahlian-mengemudi'];
				$noSim = $_POST['noSim-mengemudi'];
				$queryInputMengemudi = "INSERT INTO skillMengemudiWorker VALUES(null, '$idWorker', '$mengemudi', '$keahlianMengemudi', '$noSim')";
				$execInputMengemudi = mysql_query($queryInputMengemudi);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-mengemudi']))
			{
				$tab = "skill";
				$idtablem = $_POST['id-tablem'];
				$queryDeleteMengemudi = "DELETE FROM skillMengemudiWorker WHERE idTableM = '$idtablem'";
				$execDeleteMengemudi = mysql_query($queryDeleteMengemudi);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-mengemudi']))
			{
				$tab = "skill";
				$idtablem = $_POST['id-tablem'];
				$mengemudi = $_POST['nama-mengemudi'];
				$ahliMengemudi = $_POST['tkm'];
				$noSim = $_POST['noSim'];
				$queryUpdateMengemudi = "UPDATE skillMengemudiWorker SET idMengemudi = '$mengemudi', keahlianMengemudi = '$ahliMengemudi', noSim = '$noSim' WHERE idTableM = '$idtablem'";
				$execUpdateMengemudi = mysql_query($queryUpdateMengemudi);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-skill']))
			{
				$tab = "skill";
				$idSkill = $_POST['id-skill'];
				$namaSkill = $_POST['nama-skill'];
				$tingkat = $_POST['tingkat'];
				$queryUpdateSkill = "UPDATE skillWorker SET namaSkill = '$namaSkill', tingkatSkill = '$tingkat' WHERE idSkill = '$idSkill'";
				$execUpdateSkill = mysql_query($queryUpdateSkill);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			if(isset($_POST['saveTraining']))
			{
				$tab = "skill";
				$idWorker = $_POST['idWorker'];
				$namaTraining = $_POST['nama_training'];
				$penyelenggaraTraining = $_POST['penyelenggara_training'];
				$tahunTraining = $_POST['tahun_training'];
				$keteranganTraining = $_POST['keterangan_training'];
				$queryInputTraining = "INSERT INTO skillTrainingWorker VALUES(null, '$idWorker', '$namaTraining', '$penyelenggaraTraining', '$tahunTraining', '$keteranganTraining')";
				$execInputTraining = mysql_query($queryInputTraining);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-training']))
			{
				$tab = "skill";
				$idTraining = $_POST['id-training'];
				$queryDeleteTraining = "DELETE FROM skillTrainingWorker WHERE idTraining = '$idTraining'";
				$execDeleteTraining = mysql_query($queryDeleteTraining);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-training']))
			{
				$tab = "skill";
				$idTraining = $_POST['id-training'];
				$namaTraining = $_POST['nama-training'];
				$penyelenggaraTraining = $_POST['penyelenggara-training'];
				$tahunTraining = $_POST['tahun-training'];
				$keteranganTraining = $_POST['keterangan-training'];
				//$tingkat = $_POST['tingkat'];
				$queryUpdateTraining = "UPDATE skillTrainingWorker SET namaTraining = '$namaTraining', penyelenggaraTraining = '$penyelenggaraTraining', 
										tahunTraining = '$tahunTraining', keteranganTraining = '$keteranganTraining' WHERE idTraining = '$idTraining'";
				$execUpdateTraining = mysql_query($queryUpdateTraining);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			if(isset($_POST['saveInti']))
			{
				$tab = "lingkunganKeluarga";
				$idWorker = $_POST['idWorker'];
				$hubunganInti = $_POST['hubungan_inti'];
				$namaInti = $_POST['nama_inti'];
				if($_POST['gender_inti'] == "")
				{
					$genderInti = "L";
				}
				else
				{
					$genderInti = $_POST['gender_inti'];
				}
				$tempatLahirInti = $_POST['tempatLahir_inti'];
				$birthdayInti = date('d-m-Y', strtotime($_POST['birthdayInti']));
				$pendidikanInti = $_POST['pendidikan_inti'];
				$pekerjaanInti = $_POST['pekerjaan_inti'];
				$perusahaanInti = $_POST['perusahaan_inti'];
				$queryInputInti = "INSERT INTO keluargaInti VALUES(null, '$idWorker', '$hubunganInti', '$namaInti', '$genderInti', '$tempatLahirInti',
									'$birthdayInti', '$pendidikanInti', '$pekerjaanInti', '$perusahaanInti')";
				$execInputInti = mysql_query($queryInputInti);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-inti']))
			{
				$tab = "lingkunganKeluarga";
				$idInti = $_POST['id-inti'];
				$queryDeleteInti = "DELETE FROM keluargaInti WHERE idInti = '$idInti'";
				$execDeleteInti = mysql_query($queryDeleteInti);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-inti']))
			{
				$tab = "lingkunganKeluarga";
				$idInti = $_POST['id-inti'];
				$hubunganInti = $_POST['hubungan-inti'];
				$namaInti = $_POST['nama-inti'];
				$genderInti = $_POST['gender-inti'];
				$tempatLahirInti = $_POST['tempatLahir-inti'];
				$birthdayInti = $_POST['birthday-inti'];
				$pendidikanInti = $_POST['pendidikan-inti'];
				$pekerjaanInti = $_POST['pekerjaan-inti'];
				$perusahaanInti = $_POST['perusahaan-inti'];
				//$tingkat = $_POST['tingkat'];
				$queryUpdateInti = "UPDATE keluargaInti SET hubunganInti = '$hubunganInti', namaInti = '$namaInti', 
									genderInti = '$genderInti', tempatLahirInti = '$tempatLahirInti', birthdayInti=STR_TO_DATE('$birthdayInti','%d-%m-%Y'),
									pendidikanInti = '$pendidikanInti', pekerjaanInti = '$pekerjaanInti', perusahaanInti = '$perusahaanInti' WHERE idInti = '$idInti'";
				$execUpdateInti = mysql_query($queryUpdateInti);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			if(isset($_POST['saveBesar']))
			{
				$tab = "lingkunganKeluarga";
				$idWorker = $_POST['idWorker'];
				$hubunganBesar = $_POST['hubungan_besar'];
				$namaBesar = $_POST['nama_besar'];
				if($_POST['gender_besar'] == "")
				{
					$genderBesar = "L";
				}
				else
				{
					$genderBesar = $_POST['gender_besar'];
				}
				$tempatLahirBesar = $_POST['tempatLahir_besar'];
				$birthdayBesar = date('d-m-Y', strtotime($_POST['birthday_besar']));
				$pendidikanBesar = $_POST['pendidikan_besar'];
				$pekerjaanBesar = $_POST['pekerjaan_besar'];
				$perusahaanBesar = $_POST['perusahaan_besar'];
				$queryInputBesar = "INSERT INTO keluargaBesar VALUES(null, $idWorker, '$hubunganBesar', '$namaBesar', '$genderBesar', '$tempatLahirBesar',
									'$birthdayBesar', '$pendidikanBesar', '$pekerjaanBesar', '$perusahaanBesar')";
				$execInputBesar = mysql_query($queryInputBesar);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = $idWorker"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-besar']))
			{
				$tab = "lingkunganKeluarga";
				$idBesar = $_POST['id-besar'];
				$queryDeleteBesar = "DELETE FROM keluargaBesar WHERE idBesar = $idBesar";
				$execDeleteBesar = mysql_query($queryDeleteBesar);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = $idWorker"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-besar']))
			{
				$tab = "lingkunganKeluarga";
				$idBesar = $_POST['id-besar'];
				$hubunganBesar = $_POST['hubungan-besar'];
				$namaBesar = $_POST['nama-besar'];
				$genderBesar = $_POST['gender-besar'];
				$tempatLahirBesar = $_POST['tempatLahir-besar'];
				$birthdayBesar = $_POST['birthday-besar'];
				$pendidikanBesar = $_POST['pendidikan-besar'];
				$pekerjaanBesar = $_POST['pekerjaan-besar'];
				$perusahaanBesar = $_POST['perusahaan-besar'];
				//$tingkat = $_POST['tingkat'];
				$queryUpdateBesar = "UPDATE keluargaBesar SET hubunganBesar = '$hubungannBesar', namaBesar = '$namaBesar', 
									genderBesar = '$genderBesar', tempatLahirBesar = '$tempatLahirBesar', birthdayBesar=STR_TO_DATE('$birthdayBesar','%d-%m-%Y'),
									pendidikanBesar = '$pendidikanBesar', pekerjaanBesar = '$pekerjaanBesar', perusahaanBesar = '$perusahaanBesar' WHERE idBesar = $idBesar";
				$execUpdateBesar = mysql_query($queryUpdateBesar);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = $idWorker"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			if(isset($_POST['saveDarurat']))
			{
				$tab = "lingkunganKeluarga";
				$idWorker = $_POST['idWorker'];
				$hubunganDarurat = $_POST['hubungan_darurat'];
				$namaDarurat = $_POST['nama_darurat'];
				if($_POST['gender_darurat'] == "")
				{
					$genderDarurat = "L";
				}
				else
				{
					$genderDarurat = $_POST['gender_darurat'];
				}
				$alamatDarurat = $_POST['alamat_darurat'];
				$noTelpDarurat = $_POST['noTelp_darurat'];
				$pekerjaanDarurat = $_POST['pekerjaan_darurat'];
				$perusahaanDarurat = $_POST['perusahaan_darurat'];
				$queryInputDarurat = "INSERT INTO keluargaDarurat VALUES(null, $idWorker, '$hubunganDarurat', '$namaDarurat', '$genderDarurat', '$alamatDarurat',
									'$noTelpDarurat', '$pekerjaanDarurat', '$perusahaanDarurat')";
				$execInputDarurat = mysql_query($queryInputDarurat);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = $idWorker"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-darurat']))
			{
				$tab = "lingkunganKeluarga";
				$idDarurat = $_POST['id-darurat'];
				$queryDeleteDarurat = "DELETE FROM keluargaDarurat WHERE idDarurat = $idDarurat";
				$execDeleteDarurat = mysql_query($queryDeleteDarurat);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = $idWorker"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-darurat']))
			{
				$tab = "lingkunganKeluarga";
				$idDarurat = $_POST['id-darurat'];
				$hubunganDarurat = $_POST['hubungan-darurat'];
				$namaDarurat = $_POST['nama-darurat'];
				$genderDarurat = $_POST['gender-darurat'];
				$alamatDarurat = $_POST['alamat-darurat'];
				$noTelpDarurat = $_POST['noTelp-darurat'];
				$pekerjaanDarurat = $_POST['pekerjaan-darurat'];
				$perusahaanDarurat = $_POST['perusahaan-darurat'];
				//$tingkat = $_POST['tingkat'];
				$queryUpdateDarurat = "UPDATE keluargaDarurat SET hubunganDarurat = '$hubungannDarurat', namaDarurat = '$namaDarurat', 
									genderDarurat = '$genderDarurat', alamatDarurat = '$alamatDarurat', noTelpDarurat = '$noTelpDarurat',
									pekerjaanDarurat = '$pekerjaanDarurat', perusahaanDarurat = '$perusahaanDarurat' WHERE idDarurat = $idDarurat";
				$execUpdateDarurat = mysql_query($queryUpdateDarurat);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = $idWorker"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['saveMinat']))
			{
				$tab = "minat";
				$idWorker = $_POST['id-worker'];
				$minat_cita = $_POST['minat_cita'];
				$minat_motivasi = $_POST['minat_motivasi'];
				$minat_alasan = $_POST['minat_alasan'];
				$mgaji = $_POST['mgaji'];
				if(isset($_POST['minat_nego']))
				{
					$minat_nego = $_POST['minat_nego'];
				}
				else
				{
					$minat_nego = 0;
				}
				$minat_fasilitas = $_POST['minat_fasilitas'];
				$minat_waktu = $_POST['minat_waktu'];
				$jenisKerja = $_POST['jenis-pekerjaan'];
				$minat_jenisKerja1 = $_POST['jenis-pekerjaan-1'];
				$minat_jenisKerja2 = $_POST['jenis-pekerjaan-2'];
				$minat_jenisKerja3 = $_POST['jenis-pekerjaan-3'];
				$minat_jenisKerja4 = $_POST['jenis-pekerjaan-4'];
				$minat_jenisKerja5 = $_POST['jenis-pekerjaan-5'];
				$minat_lingKerja1 = $_POST['lingkungan-kerja-1'];
				$minat_lingKerja2 = $_POST['lingkungan-kerja-2'];
				$minat_lingKerja3 = $_POST['lingkungan-kerja-3'];
				$minat_lingKerja4 = $_POST['lingkungan-kerja-4'];
				$minat_lingKerja5 = $_POST['lingkungan-kerja-5'];
				$minat_lingKerja6 = $_POST['lingkungan-kerja-6'];
				$minat_lokasiKerja1 = $_POST['lokasi-kerja-1'];
				$minat_lokasiKerja2 = $_POST['lokasi-kerja-2'];
				$minat_lokasiKerja3 = $_POST['lokasi-kerja-3'];
				if(isset($_POST['bersedia']))
				{
					$bersedia = $_POST['bersedia'];
				}
				else
				{
					$bersedia = 0;
				}
				if(isset($_POST['minat_dinas']))
				{
					$minat_dinas = $_POST['minat_dinas'];
				}
				else
				{
					$minat_dinas = 0;
				}
				if(isset($_POST['minat_oki']))
				{
					$minat_oki = $_POST['minat_oki'];
				}
				else
				{
					$minat_oki = 0;
				}
				$minat_tipe = $_POST['minat_tipe'];
				$minat_masalah = $_POST['minat_masalah'];
				$minat_sulit = $_POST['minat_sulit'];
				$minat_sbrInternal = $_POST['minat_sbrInternal'];
				$minat_sbrEksternal = $_POST['minat_sbrEksternal'];
				//$minat_sbrLain = $_POST['minat_sbrLain'];
				
				$queryUpdateMinat = "UPDATE userWorker SET citaCita = '$minat_cita', motivasiBekerja = '$minat_motivasi', alasanBekerja = '$minat_alasan', minimalGaji = $mgaji, 
									negosiasiGaji = '$minat_nego', tunjanganFasilitas = '$minat_fasilitas', waktuBekerja = STR_TO_DATE('$minat_waktu','%d-%m-%Y'),
									cariKerja = $jenisKerja, jenisPekerjaanDisukai1 = '$minat_jenisKerja1', jenisPekerjaanDisukai2 = '$minat_jenisKerja2', jenisPekerjaanDisukai3 = '$minat_jenisKerja3',
									jenisPekerjaanDisukai4 = '$minat_jenisKerja4', jenisPekerjaanDisukai5 = '$minat_jenisKerja5',
									lingKerDisukai1 = '$minat_lingKerja1', lingKerDisukai2 = '$minat_lingKerja2', lingKerDisukai3 = '$minat_lingKerja3',
									lingKerDisukai4 = '$minat_lingKerja4', lingKerDisukai5 = '$minat_lingKerja5', lingKerDisukai6 = '$minat_lingKerja6',
									lokasiKerja1 = '$minat_lokasiKerja1', lokasiKerja2 = '$minat_lokasiKerja2', lokasiKerja3 = '$minat_lokasiKerja1', 
									bersedia = '$bersedia', dinasLuarKota = '$minat_dinas', penempatanOki = '$minat_oki', 
									tipeOrang = '$minat_tipe', menghadapiMasalah = '$minat_masalah', kondisiSulit = '$minat_sulit', 
									sumberData_internal = '$minat_sbrInternal', sumberData_eksternal = '$minat_sbrEksternal'
									WHERE idWorker = $idWorker";
				$execUpdateMinat = mysql_query($queryUpdateMinat);
				$_SESSION['suksesUpdateMinat'] = "Data berhasil disimpan.";

				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = $idWorker"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/	
			}
			
			if(isset($_POST['saveKenalan']))
			{
				$tab = "sosial";
				$idWorker = $_POST['idWorker'];
				$namaKenalan = $_POST['nama_kenalan'];
				$perusahaanKenalan = $_POST['perusahaan_kenalan'];
				$jabatanKenalan = $_POST['jabatan_kenalan'];
				$noTelpKenalan = $_POST['noTelp_kenalan'];
				$hubunganKenalan = $_POST['hubungan_kenalan'];
				
				$queryKenalan = "INSERT INTO sosialKenalan VALUES(null, '$idWorker', '$namaKenalan', '$perusahaanKenalan', '$jabatanKenalan', '$noTelpKenalan', '$hubunganKenalan')";
				$execKenalan = mysql_query($queryKenalan);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-kenalan']))
			{
				$tab = "sosial";
				$idKenalan = $_POST['id-kenalan'];
				$queryDeleteKenalan = "DELETE FROM sosialKenalan WHERE idKenalan = '$idKenalan'";
				$execDeleteKenalan = mysql_query($queryDeleteKenalan);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-kenalan']))
			{
				$tab = "sosial";
				$idKenalan = $_POST['id-kenalan'];
				$namaKenalan = $_POST['nama-kenalan'];
				$perusahaanKenalan = $_POST['perusahaan-kenalan'];
				$jabatanKenalan = $_POST['jabatan-kenalan'];
				$noTelpKenalan = $_POST['noTelp-kenalan'];
				$hubunganKenalan = $_POST['hubungan-kenalan'];
				
				$queryUpdateKenalan = "UPDATE sosialKenalan SET namaKenalan = '$namaKenalan', perusahaanKenalan = '$perusahaanKenalan', jabatanKenalan = '$jabatanKenalan',
									noTelpKenalan = '$noTelpKenalan', hubunganKenalan = '$hubunganKenalan' WHERE idKenalan = '$idKenalan'";
				$execUpdateKenalan = mysql_query($queryUpdateKenalan);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			if(isset($_POST['saveReferensi']))
			{
				$tab = "sosial";
				$idWorker = $_POST['idWorker'];
				$namaReferensi = $_POST['nama_referensi'];
				$perusahaanReferensi = $_POST['perusahaan_referensi'];
				$jabatanReferensi = $_POST['jabatan_referensi'];
				$noTelpReferensi = $_POST['noTelp_referensi'];
				$hubunganReferensi = $_POST['hubungan_referensi'];
				
				$queryReferensi = "INSERT INTO sosialReferensi VALUES(null, '$idWorker', '$namaReferensi', '$perusahaanReferensi', '$jabatanReferensi', '$noTelpReferensi', '$hubunganReferensi')";
				$execReferensi = mysql_query($queryReferensi);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-referensi']))
			{
				$tab = "sosial";
				$idReferensi = $_POST['id-referensi'];
				$queryDeleteReferensi = "DELETE FROM sosialReferensi WHERE idReferensi = '$idReferensi'";
				$execDeleteReferensi = mysql_query($queryDeleteReferensi);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-referensi']))
			{
				$tab = "sosial";
				$idReferensi = $_POST['id-referensi'];
				$namaReferensi = $_POST['nama-referensi'];
				$perusahaanReferensi = $_POST['perusahaan-referensi'];
				$jabatanReferensi = $_POST['jabatan-referensi'];
				$noTelpReferensi = $_POST['noTelp-referensi'];
				$hubunganReferensi = $_POST['hubungan-referensi'];
				
				$queryUpdateReferensi = "UPDATE sosialReferensi SET namaReferensi = '$namaReferensi', perusahaanReferensi = '$perusahaanReferensi', jabatanReferensi = '$jabatanReferensi',
									noTelpReferensi = '$noTelpReferensi', hubunganReferensi = '$hubunganReferensi' WHERE idReferensi = '$idReferensi'";
				$execUpdateReferensi = mysql_query($queryUpdateReferensi);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			if(isset($_POST['saveOrganisasi']))
			{
				$tab = "sosial";
				$idWorker = $_POST['idWorker'];
				$namaOrganisasi = $_POST['nama_organisasi'];
				$bidangOrganisasi = $_POST['bidang_organisasi'];
				$lokasiOrganisasi = $_POST['lokasi_organisasi'];
				$jabatanOrganisasi = $_POST['jabatan_organisasi'];
				$tahunOrganisasi = $_POST['tahun_organisasi'];
				
				$queryOrganisasi = "INSERT INTO sosialOrganisasi VALUES(null, '$idWorker', '$namaOrganisasi', '$bidangOrganisasi', '$lokasiOrganisasi', '$jabatanOrganisasi', '$tahunOrganisasi')";
				$execOrganisasi = mysql_query($queryOrganisasi);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = $idWorker"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-organisasi']))
			{
				$tab = "sosial";
				$idOrganisasi = $_POST['id-organisasi'];
				$queryDeleteOrganisasi = "DELETE FROM sosialOrganisasi WHERE idOrganisasi = '$idOrganisasi'";
				$execDeleteOrganisasi= mysql_query($queryDeleteOrganisasi);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-organisasi']))
			{
				$tab = "sosial";
				$idOrganisasi = $_POST['id-organisasi'];
				$namaOrganisasi = $_POST['nama-organisasi'];
				$bidangOrganisasi = $_POST['bidang-organisasi'];
				$lokasiOrganisasi = $_POST['lokasi-organisasi'];
				$jabatanOrganisasi = $_POST['jabatan-organisasi'];
				$tahunOrganisasi = $_POST['tahun-organisasi'];
				
				$queryUpdateOrganisasi = "UPDATE sosialOrganisasi SET namaOrganisasi = '$namaOrganisasi', bidangOrganisasi = '$bidangOrganisasi', lokasiOrganisasi = '$lokasiOrganisasi',
									jabatanOrganisasi = '$jabatanOrganisasi', tahunOrganisasi = '$tahunOrganisasi' WHERE idOrganisasi = '$idOrganisasi'";
				$execUpdateOrganisasi = mysql_query($queryUpdateOrganisasi);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			if(isset($_POST['savePsikotest']))
			{
				$tab = "sosial";
				$idWorker = $_POST['idWorker'];
				$waktuPsikotest = $_POST['waktu_psikotest'];
				$penyelenggaraPsikotest = $_POST['penyelenggara_psikotest'];
				$tempatPsikotest = $_POST['tempat_psikotest'];
				$tujuanPsikotest = $_POST['tujuan_psikotest'];
				
				$queryPsikotest = "INSERT INTO sosialPsikotest VALUES(null, '$idWorker', '$waktuPsikotest', '$penyelenggaraPsikotest', '$tempatPsikotest', '$tujuanPsikotest')";
				$execPsikotest = mysql_query($queryPsikotest);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = $idWorker"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['delete-psikotest']))
			{
				$tab = "sosial";
				$idPsikotest = $_POST['id-psikotest'];
				$queryDeletePsikotest = "DELETE FROM sosialPsikotest WHERE idPsikotest = '$idPsikotest'";
				$execDeletePsikotest = mysql_query($queryDeletePsikotest);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}

			if(isset($_POST['update-psikotest']))
			{
				$tab = "sosial";
				$idPsikotest = $_POST['id-psikotest'];
				$waktuPsikotest = $_POST['waktu-psikotest'];
				$penyelenggaraPsikotest = $_POST['penyelenggara-psikotest'];
				$tempatPsikotest = $_POST['tempat-psikotest'];
				$tujuanPsikotest = $_POST['tujuan-psikotest'];
				
				$queryUpdatePsikotest = "UPDATE sosialPsikotest SET waktuPsikotest = '$waktuPsikotest', penyelenggaraPsikotest = '$penyelenggaraPsikotest', 
										tempatPsikotest = '$tempatPsikotest', tujuanPsikotest = '$tujuanPsikotest' WHERE idPsikotest = '$idPsikotest'";
				$execUpdatePsikotest = mysql_query($queryUpdatePsikotest);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
			}
			
			$execGetUser = mysql_query($queryGetUser);
			$resultGetUser = mysql_fetch_array($execGetUser);
			
			$getStatusEducation = "SELECT * FROM pendidikanWorker WHERE idWorker = '$idWorker'";
			$execStatusEducation = mysql_query($getStatusEducation);
			$statusEducation = mysql_num_rows($execStatusEducation);

			$getStatusExp = "SELECT * FROM pengalamanWorker WHERE idWorker = '$idWorker'";
			$execStatusExp = mysql_query($getStatusExp);
			$statusExp = mysql_num_rows($execStatusExp);

			$getStatusTraining = "SELECT * FROM skillTrainingWorker WHERE idWorker = '$idWorker'";
			$execStatusTraining = mysql_query($getStatusTraining);
			$statusTraining = mysql_num_rows($execStatusTraining);
			
			$getStatusMengemudi = "SELECT * FROM skillMengemudiWorker WHERE idWorker = '$idWorker'";
			$execStatusMengemudi = mysql_query($getStatusMengemudi);
			$statusMengemudi = mysql_num_rows($execStatusMengemudi);
			
			$getStatusSkill = "SELECT * FROM skillWorker WHERE idWorker = '$idWorker'";
			$execStatusSkill = mysql_query($getStatusSkill);
			$statusSkill = mysql_num_rows($execStatusSkill);

			$getStatusBahasa = "SELECT * FROM skillBahasaWorker WHERE idWorker = '$idWorker'";
			$execStatusBahasa = mysql_query($getStatusBahasa);
			$statusBahasa = mysql_num_rows($execStatusBahasa);
			
			$getStatusDarurat = "SELECT * FROM keluargaDarurat WHERE idWorker = '$idWorker'";
			$execStatusDarurat = mysql_query($getStatusDarurat);
			$statusDarurat = mysql_num_rows($execStatusDarurat);
			
			$getStatusBesar = "SELECT * FROM keluargaBesar WHERE idWorker = '$idWorker'";
			$execStatusBesar = mysql_query($getStatusBesar);
			$statusBesar = mysql_num_rows($execStatusBesar);
			
			$getStatusInti = "SELECT * FROM keluargaInti WHERE idWorker = '$idWorker'";
			$execStatusInti = mysql_query($getStatusInti);
			$statusInti = mysql_num_rows($execStatusInti);
			
			$getStatusPsikotest = "SELECT * FROM sosialPsikotest WHERE idWorker = '$idWorker'";
			$execStatusPsikotest = mysql_query($getStatusPsikotest);
			$statusPsikotest = mysql_num_rows($execStatusPsikotest);
			
			$getStatusOrganisasi = "SELECT * FROM sosialOrganisasi WHERE idWorker = '$idWorker'";
			$execStatusOrganisasi = mysql_query($getStatusOrganisasi);
			$statusOrganisasi = mysql_num_rows($execStatusOrganisasi);
			
			$getStatusReferensi = "SELECT * FROM sosialReferensi WHERE idWorker = '$idWorker'";
			$execStatusReferensi = mysql_query($getStatusReferensi);
			$statusReferensi = mysql_num_rows($execStatusReferensi);
			
			$getStatusKenalan = "SELECT * FROM sosialKenalan WHERE idWorker = '$idWorker'";
			$execStatusKenalan = mysql_query($getStatusKenalan);
			$statusKenalan = mysql_num_rows($execStatusKenalan);
	?>
			<h3>Data Diri <a href="../show/worker.php?id=<?php echo $idWorker;?>" target="_blank"><button class="btn btn-sm btn-primary">Lihat Profil</button> </a></h3>
			<!-- Nav tabs -->
			<div class="background-tab">
				<ul class="nav nav-tabs nav-justified nav-pills" role="tablist">
					<li id="border-tab" role="presentation"<?php if($tab == "" || $tab == "identity"){echo " class='active'";}?>><a href="#personal" role="tab" data-toggle="tab">Data Diri</a></li>
					<li id="border-tab" role="presentation"<?php if($tab == "education"){echo " class='active'";}?>><a href="#pendidikan" role="tab" data-toggle="tab">Pendidikan <?php if($statusEducation < 1) { echo "<i class='fa fa-exclamation-triangle'></i>";}?></a></li>
					<li id="border-tab" role="presentation"<?php if($tab == "experience"){echo " class='active'";}?>><a href="#pengalaman" role="tab" data-toggle="tab">Pengalaman <?php if($statusExp < 1) { echo "<i class='fa fa-exclamation-triangle'></i>";}?></a></li>
					<li id="border-tab" role="presentation"<?php if($tab == "skill"){echo " class='active'";}?>><a href="#skills" role="tab" data-toggle="tab">Skills <?php if($statusTraining <1 || $statusMengemudi < 1 || $statusSkill < 1 || $statusBahasa < 1) { echo "<i class='fa fa-exclamation-triangle'></i>";}?></a></li>
					<li id="border-tab" role="presentation"<?php if($tab == "lingkunganKeluarga"){echo " class='active'";}?>><a href="#lingkunganKeluarga" role="tab" data-toggle="tab">Lingkungan Keluarga <?php if($statusDarurat <1 ||$statusBesar <1 || $statusInti < 1) { echo "<i class='fa fa-exclamation-triangle'></i>";}?></a></li>
					<li id="border-tab" role="presentation"<?php if($tab == "minat"){echo " class='active'";}?>><a href="#minat" role="tab" data-toggle="tab">Minat Kerja</a></li>
					<li id="border-tab" role="presentation"<?php if($tab == "sosial"){echo " class='active'";}?>><a href="#sosial" role="tab" data-toggle="tab">Aktifitas Sosial <?php if($statusPsikotest <1 || $statusOrganisasi <1 || $statusReferensi <1 || $statusKenalan < 1) { echo "<i class='fa fa-exclamation-triangle'></i>";}?></a></li>
				</ul>
			</div>

			<!-- Tab panes -->
			<div class="tab-content padding-top-tab">
				<?php 
					$queryProvinsi = "SELECT * FROM tableProvinsi";
					//print_r($result);
				?>

				<!--Personal detail start -->
				<div role="tabpanel" class="tab-pane <?php if($tab == '' || $tab == 'identity'){ echo 'active'; }?>" id="personal">
					<div class="row">
						<div class="col-sm-8">
							<form class="form-horizontal" role="form" action="resume.php" method="post">
								<div class="form-group">
									<input type="hidden" name="id-worker" value="<?php echo $idWorker;?>">
									<label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
									<div class="col-sm-8">
										<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" value="<?php echo $resultGetUser['namaUser'];?>"required>
									</div>
								</div>
								<div class="form-group">
									<label for="gender" class="col-sm-2 control-label">Jenis Kelamin</label>
									<div class="col-sm-8">
										<label class="radio-inline"><input type="radio" name="gender" id="genderPa" <?php if($resultGetUser['gender'] == "L"){ echo "checked";}?> value="Laki-Laki" default>Laki-Laki</label>
										<label class="radio-inline"><input type="radio" name="gender" id="genderPi" <?php if($resultGetUser['gender'] == "P"){ echo "checked";}?> value="Perempuan">Perempuan</label>
									</div>
								</div>
								<div class="form-group">
									<label for="golonganDarah" class="col-sm-2 control-label">Golongan Darah</label>
									<div class="col-sm-8">
										<select id="golonganDarah" name="golonganDarah" required="required" class="form-control"/>
											<option value="A" <?php if($resultGetUser['golonganDarah'] == "A"){ echo "selected";}?> default>A</option>
											<option value="B" <?php if($resultGetUser['golonganDarah'] == "B"){ echo "selected";}?>>B</option>
											<option value="AB" <?php if($resultGetUser['golonganDarah'] == "AB"){ echo "selected";}?>>AB</option>
											<option value="O" <?php if($resultGetUser['golonganDarah'] == "O"){ echo "selected";}?>>O</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="tempatLahir" class="col-sm-2 control-label">Tempat Lahir</label>
									<div class="col-sm-8">
										<input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="<?php echo $resultGetUser['tempatLahir'];?>"required>
									</div>
								</div>
								<div class="form-group">
									<label for="birthday" class="col-sm-2 control-label">Tanggal Lahir</label>
									<div class="col-sm-4">
										<?php $lahir = new DateTime($resultGetUser['birthday']);?>
										<input class="form-control" name="birthday" id="birthday" placeholder="Tanggal Lahir" value="<?php echo $lahir->format('d-m-Y'); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="agama" class="col-sm-2 control-label">Agama</label>
									<div class="col-sm-8">
										<select id="agama" name="agama" required="required" class="form-control"/>
											<option value="Islam" <?php if($resultGetUser['agama'] == "Islam"){ echo "selected";}?> default>Islam</option>
											<option value="Kristen Protestan" <?php if($resultGetUser['agama'] == "Kristen Protestan"){ echo "selected";}?>>Kristen Protestan</option>
											<option value="Katholik" <?php if($resultGetUser['agama'] == "Katholik"){ echo "selected";}?>>Katholik</option>
											<option value="Hindu" <?php if($resultGetUser['agama'] == "Hindu"){ echo "selected";}?>>Hindu</option>
											<option value="Buddha" <?php if($resultGetUser['agama'] == "Buddha"){ echo "selected";}?>>Buddha</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="statusNikah" class="col-sm-2 control-label">Status Pernikahan</label>
									<div class="col-sm-8">
										<label class="radio-inline"><input type="radio" name="statusNikah" id="single" <?php if($resultGetUser['statusNikah'] == "Belum Menikah"){ echo "checked";}?> value="Belum Menikah" default>Belum Menikah</label>
										<label class="radio-inline"><input type="radio" name="statusNikah" id="menikah" <?php if($resultGetUser['statusNikah'] == "Menikah"){ echo "checked";}?> value="Menikah">Menikah</label>
										<label class="radio-inline"><input type="radio" name="statusNikah" id="jandaduda" <?php if($resultGetUser['statusNikah'] == "Janda/Duda"){ echo "checked";}?> value="Janda/Duda">Janda/Duda</label>
									</div>
								</div>
								<div class="form-group">
									<label for="noKtp" class="col-sm-2 control-label">No. KTP</label>
									<div class="col-sm-8">
										<input type="int" name="noKtp" class="form-control" id="noKtp" placeholder="No. KTP/Identitas Lain" value="<?php echo $resultGetUser['noKtp'];?>"required>
									</div>
								</div>
								<div class="form-group">
									<label for="kewarganegaraan" class="col-sm-2 control-label">Kewarganegaraan</label>
									<div class="col-sm-8">
										<label class="radio-inline"><input type="radio" name="kewarganegaraan" id="wni" <?php if($resultGetUser['kewarganegaraan'] == "WNI"){ echo "checked";}?> value="WNI" default>WNI</label>
										<label class="radio-inline"><input type="radio" name="kewarganegaraan" id="wna" <?php if($resultGetUser['kewarganegaraan'] == "WNA"){ echo "checked";}?> value="WNA">WNA</label>
									</div>
								</div>
								<div class="form-group">
									<label for="noNpwp" class="col-sm-2 control-label">No. NPWP</label>
									<div class="col-sm-8">
										<input type="int" name="noNpwp" class="form-control" id="noNpwp" placeholder="No. NPWP (Jika Ada)" value="<?php echo $resultGetUser['noNpwp'];?>">
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">Email</label>
									<div class="col-sm-8">
										<input type="email" class="form-control" name="email" id="email" placeholder="Email valid anda" value="<?php echo $resultGetUser['emailUser'];?>">
									</div>
								</div>
								<div class="form-group">
									<label for="addressKtp" class="col-sm-2 control-label">Alamat (KTP)</label>
									<div class="col-sm-8">
										<textarea name="addressKtp" id="addressKtp" class="form-control" rows="3"><?php echo $resultGetUser['alamatKtp'];?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="addressSekarang" class="col-sm-2 control-label">Alamat (Sekarang)</label>
									<div class="col-sm-8">
										<textarea name="addressSekarang" id="addressSekarang" class="form-control" rows="3"><?php echo $resultGetUser['alamatSekarang'];?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="noponsel" class="col-sm-2 control-label">Nomor Ponsel</label>
									<div class="col-sm-8">
										<div class="input-group">
											<div class="input-group-addon">+62</div>
											<input type="tel" class="form-control" name="noponsel" id="noponsel" placeholder="Nomor Ponsel Anda" value="<?php echo substr($resultGetUser['noPonsel'], 3, 15);?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="onoponsel" class="col-sm-2 control-label">Nomor Ponsel Lain</label>
									<div class="col-sm-8">
										<div class="input-group">
											<div class="input-group-addon">+62</div>
											<input type="tel" class="form-control" name="onoponsel" id="onoponsel" placeholder="Nomor Ponsel Anda yang lain" value="<?php echo substr($resultGetUser['otherPonsel'], 3, 15);?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-8">
									  <button type="submit" class="btn btn-primary" id="saveIdentity" name="saveIdentity">Simpan</button>
									</div>
								</div>
								<?php
									if(isset($_SESSION['emailValidMessage']))
									{
										?>
											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-6">
													<div class="alert alert-error alert-dismissible" role="alert">
														<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><?php echo $_SESSION['emailValidMessage']; unset($_SESSION['emailValidMessage']);?>
													</div>
												</div>
											</div>
										<?php
									}
									if(isset($_SESSION['suksesUpdateIdentitas']))
									{
										?>
											<div class="form-group">
												<div class="col-sm-offset-2 col-sm-6">
													<div class="alert alert-success alert-dismissible" role="alert">
														<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><?php echo $_SESSION['suksesUpdateIdentitas']; unset($_SESSION['suksesUpdateIdentitas']);?>
													</div>
												</div>
											</div>
										<?php
									}
								?>
							</form>
						</div><!--END COL-SM-8 -->
						
						<div class="col-sm-4"><!--Untuk FOTO -->
							<div id="imageChange">
								<img src="<?php
									if($resultGetUser['pathFoto'] != $webRoot.'upload/default.gif')
									{
										echo $resultGetUser['pathFoto'];
									}
									else
									{
										echo $webRoot.'upload/default.gif';
									}
								?>" alt="<?php echo $resultGetUser['namaUser'];?>" class="img-thumbnail img-responsive" id="user-photo">
							</div>
							<div class="status"></div>
							<p class="help-block">Klik pada gambar untuk mengganti foto terbaru.</p>
							<p class="help-block">*Maksimal file adalah 1MB.</p>
							<p class="help-block">**File yang bisa diupload adalah jpg, jpeg, png, gif.</p>
						</div><!--END FOTO-->
					</div><!--End Row -->
				</div><!--Personal detail end -->

				<!-- Pendidikan start -->
				<div role="tabpanel" class="tab-pane <?php if($tab == 'education'){ echo 'active'; }?>" id="pendidikan">
					<h4>Pendidikan<button type="button" class="btn btn-primary btn-sm" id="addEdu">Tambah</button></h4>
					<div class="row">
						<div class="col-sm-4">
							<?php
								if(isset($_SESSION['suksesUpdateEducation']))
								{
									?>
										<div class="alert alert-success alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><?php echo $_SESSION['suksesUpdateEducation']; unset($_SESSION['suksesUpdateEducation']);?>
										</div>
									<?php
								}
							?>
						</div>
					</div>
					<div id="addEducation" style="display:none!important;">
						<div class="padding-top-under-button row">
							<form class="form-horizontal" role="form" id="formEdu" action="resume.php" method="post">
								<input type="hidden" name="idWorker" value="<?php echo $idWorker;?>">
									<div class="form-group">
										<label for="nama-universitas" class="col-sm-2 control-label">Universitas/Instansi Pendidikan</label>
										<div class="col-sm-5">
											<input type="text" name="nama-universitas" class="form-control" id="nuniversitas" placeholder="Nama Universitas" required>
										</div>
									</div>
									<div class="form-group">
										<label for="alamat-kampus<?php echo $resultEduProv['idPendidikan'];?>" class="col-sm-2 control-label">Lokasi Universitas/Instansi Pendidikan</label>
										<div class="col-sm-3">
											<select name="alamat-kampus" id="alamat-kampus<?php echo $resultEduProv['idPendidikan'];?>" class="form-control">
												<?php
													$queryEduProv = "SELECT * FROM tableProvinsi";
													$execEduProv = mysql_query($queryEduProv);
													while($listEduProv = mysql_fetch_array($execEduProv))
													{
														?>
															<option value="<?php echo $listEduProv['idProvinsi'];?>" <?php if($listEduProv['idProvinsi'] == $resultEduProv['lokasiInstansi']){echo "selected";}?>> <?php echo $listEduProv['namaProvinsi'];?> </option>
														<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="kualifikasi" class="col-sm-2 control-label">Kualifikasi</label>
										<div class="col-sm-3">
											<?php
												$queryKualifikasi = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
												$execKualifikasi = mysql_query($queryKualifikasi);
											?>
											<select class="form-control" name="kualifikasi" id="kualifikasi">
												<?php
													while($resultKualifikasi = mysql_fetch_array($execKualifikasi))
													{
														?><option value="<?php echo $resultKualifikasi['gradePendidikan'];?>"><?php echo $resultKualifikasi['namaPendidikan'];?></option><?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="jurusan" class="col-sm-2 control-label">Jurusan</label>
										<div class="col-sm-3">
											<?php
												$queryJurusan = "SELECT * FROM tableJurusan ORDER BY namaJurusan ASC";
												$execJurusan = mysql_query($queryJurusan);
											?>
											<select name="jurusan" id="jurusan" class="form-control">
												<?php
													while($resultJurusan = mysql_fetch_array($execJurusan))
													{
														?><option value="<?php echo $resultJurusan['idJurusan'];?>"><?php echo $resultJurusan['namaJurusan'];?></option><?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="ipk" class="col-sm-2 control-label">Nilai/IPK</label>
										<div class="col-sm-3">
											<input name="ipk" class="form-control" id="ipk" placeholder="Nilai/IPK">
											<p class="help-block">Gunakan tanda titik (.) sebagai pemisah desimal.</p>
										</div>
									</div>
									<div class="form-group">
										<label for="tahun-lulus" class="col-sm-2 control-label">Tahun Lulus</label>
										<div class="col-sm-3">
											<input name="tahun-lulus" class="form-control" id="tahun-lulus" placeholder="Tahun Lulus">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
										  <button type="submit" class="btn btn-primary" id="saveEdu" name="saveEdu">Simpan</button>
										  <button type="button" class="btn btn-default" id="batalEdu">Batal</button>
										</div>
									</div>
							</form>
						</div>
					</div>
					<div id="showEducation" class="show-list row">
						<div class="col-sm-8">
							<div class="table-responsive">
								<?php
									$queryShowEducation = "SELECT pw.idPendidikan, pw.idWorker, pw.namaInstansi, pw.lokasiInstansi, tprov.namaProvinsi, pw.kualifikasiPendidikan, tp.namaPendidikan as tingkat, pw.jurusanPendidikan, tj.namaJurusan as jurusan, pw.nilai, pw.tahunLulus FROM pendidikanWorker pw ";
									$queryShowEducation .= "JOIN tableJurusan tj ON pw.jurusanPendidikan = tj.idJurusan ";
									$queryShowEducation .= "JOIN tingkatPendidikan tp ON pw.kualifikasiPendidikan = tp.gradePendidikan ";
									$queryShowEducation .= "JOIN tableProvinsi tprov ON pw.lokasiInstansi = tprov.idProvinsi ";
									$queryShowEducation .= "WHERE pw.idWorker = $idWorker ORDER BY tahunLulus DESC";
									$execShowEducation = mysql_query($queryShowEducation);
								?>
								<table class="table table-hover table-condensed">
									<tbody>
										<?php
											while($resultShowEducation = mysql_fetch_array($execShowEducation))
											{
												?>
													<tr>
														<td><?php echo $resultShowEducation['tahunLulus'];?></td>
														<td><?php echo $resultShowEducation['tingkat'];?></td>
														<td>
															<?php 
																echo "<strong>".$resultShowEducation['namaInstansi']."</strong><br>";
																echo "<em>".$resultShowEducation['jurusan']."</em>";
															?>
														</td>
														<td><button class="btn btn-xs btn-default" data-toggle="modal" data-target="#education<?php echo $resultShowEducation['idPendidikan'];?>">Edit</button> 
														<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-edu<?php echo $resultShowEducation['idPendidikan'];?>">Delete</button></td>
													</tr>
													<!-- Modal  EDIT -->
													<div class="modal fade" id="education<?php echo $resultShowEducation['idPendidikan'];?>" tabindex="-1" role="dialog" aria-labelledby="education<?php echo $resultShowEducation['idPendidikan'];?>" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																	<h4 class="modal-title" id="education-title<?php echo $resultShowEducation['idPendidikan'];?>"><?php echo $resultShowEducation['namaInstansi'];?></h4>
																</div>
																<div class="modal-body">
																	<form action="resume.php" role="form" id="editEducation<?php echo $resultShowEducation['idPendidikan'];?>" method="post">
																		<input type="hidden" name="id-pendidikan" value="<?php echo $resultShowEducation['idPendidikan'];?>">
																		<div class="form-group">
																			<label for="nama-universitas<?php echo $resultShowEducation['idPendidikan'];?>">Nama Universitas</label>
																			<input type="text" class="form-control" id="nama-universitas<?php echo $resultShowEducation['idPendidikan'];?>" name="nama-universitas" value="<?php echo $resultShowEducation['namaInstansi'];?>">
																		</div>
																		<div class="form-group">
																			<label for="alamat-kampus<?php echo $resultShowEducation['idPendidikan'];?>">Lokasi Universitas/Instansi Pendidikan</label>
																			<select name="alamat-kampus" id="alamat-kampus<?php echo $resultShowEducation['idPendidikan'];?>" class="form-control">
																				<?php
																					$queryProvinsi = "SELECT * FROM tableProvinsi";
																					$execEduModalProv = mysql_query($queryProvinsi);
																					while($listEduModalProv = mysql_fetch_array($execEduModalProv))
																					{
																						?>
																							<option value="<?php echo $listEduModalProv['idProvinsi'];?>" <?php if($listEduModalProv['idProvinsi'] == $resultShowEducation['lokasiInstansi']){echo "selected";}?>> <?php echo $listEduModalProv['namaProvinsi'];?> </option>
																						<?php
																					}
																				?>
																			</select>
																		</div>
																		<div class="form-group">
																			<label for="kualifikasi<?php echo $resultShowEducation['idPendidikan'];?>">Kualifikasi</label>
																			<select name="kualifikasi" id="kualifikasi<?php echo $resultShowEducation['idPendidikan'];?>" class="form-control">
																				<?php 
																					$execEduModalKualifikasi = mysql_query($queryKualifikasi);
																					while($listEduModalKualifikasi = mysql_fetch_array($execEduModalKualifikasi))
																					{
																						?>
																							<option value="<?php echo $listEduModalKualifikasi['gradePendidikan'];?>" <?php if($listEduModalKualifikasi['gradePendidikan'] == $resultShowEducation['kualifikasiPendidikan']){ echo "selected";}?>><?php echo $listEduModalKualifikasi['namaPendidikan'];?></option>
																						<?php
																					}
																				?>
																			</select>
																		</div>
																		<div class="form-group">
																			<label for="jurusan<?php echo $resultShowEducation['idPendidikan'];?>">Jurusan</label>
																			<select name="jurusan" id="jurusan<?php echo $resultShowEducation['idPendidikan'];?>" class="form-control">
																				<?php 
																					$execEduModalJurusan = mysql_query($queryJurusan);
																					while($listEduModalJurusan = mysql_fetch_array($execEduModalJurusan))
																					{
																						?>
																							<option value="<?php echo $listEduModalJurusan['idJurusan'];?>" <?php if($listEduModalJurusan['idJurusan'] == $resultShowEducation['jurusanPendidikan']){ echo "selected";}?>><?php echo $listEduModalJurusan['namaJurusan'];?></option>
																						<?php
																					}
																				?>
																			</select>
																		</div>
																		<div class="form-group">
																			<label for="nilai<?php echo $resultShowEducation['idPendidikan'];?>">Nilai/IPK</label>
																			<input class="form-control" id="nilai<?php echo $resultShowEducation['idPendidikan'];?>" name="nilai" value="<?php echo $resultShowEducation['nilai'];?>">  <p class="help-block">Gunakan tanda titik (.) sebagai pemisah desimal.</p>
																		</div>
																		<div class="form-group">
																			<label for="lulus<?php echo $resultShowEducation['idPendidikan'];?>">Tahun Lulus</label>
																			<input type="number" class="form-control" id="lulus<?php echo $resultShowEducation['idPendidikan'];?>" name="lulus" value="<?php echo $resultShowEducation['tahunLulus'];?>">
																		</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
																	<button type="submit" class="btn btn-primary" name="edu-update">Simpan</button>
																	</form>
																</div>
															</div>
														</div>
													</div>
													<!-- Modal Delete-->
													<div class="modal fade" id="delete-edu<?php echo $resultShowEducation['idPendidikan'];?>" tabindex="-1" role="dialog" aria-labelledby="delete-edu<?php echo $resultShowEducation['idPendidikan'];?>" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																	<h4 class="modal-title" id="delete-edu-title<?php echo $resultShowEducation['idPendidikan'];?>"><?php echo $resultShowEducation['namaInstansi'];?></h4>
																</div>
																<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																<div class="modal-footer">
																	<form action="resume.php" method="post">
																		<input type="hidden" name="id-pendidikan" value="<?php echo $resultShowEducation['idPendidikan'];?>">
																		<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																		<button type="submit" class="btn btn-danger" name="delete-education">Hapus</button>
																	</form>
																</div>
															</div>
														</div>
													</div>
												<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div><!-- Pendidikan end -->
				
				<!-- Pengalaman start -->
				<div role="tabpanel" class="tab-pane <?php if($tab == 'experience'){ echo 'active'; }?>" id="pengalaman">
					<h4>Pengalaman Kerja (Mulai Dari Perusahaan Yang Pertama Saudara Bekerja) <button type="button" class="btn btn-primary btn-sm" id="addExp" alt="Tambah Pengalaman Kerja">Tambah</button></h4>
					<div id="addExperience" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="formExp" action="resume.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
							<div class="form-group">
								<label for="pengalaman-perusahaan" class="col-sm-2 control-label">Nama Perusahaan</label>
								<div class="col-sm-5">
									<input type="text" name="pengalaman-perusahaan" class="form-control" id="pengalaman-perusahaan" placeholder="Nama perusahaan" required>
								</div>
							</div>
							<div class="form-group">
								<label for="pengalaman-bidang" class="col-sm-2 control-label">Bidang Usaha</label>
								<div class="col-sm-5">
									<select name="pengalaman-bidang" id="pengalaman-bidang" class="form-control">
										<?php
											$queryBidangUsaha = "SELECT * FROM bidangUsaha ORDER BY namaBidangUsaha ASC";
											$execBidangUsaha = mysql_query($queryBidangUsaha);
											while($resultBidangUsaha = mysql_fetch_array($execBidangUsaha))
											{
												?><option value="<?php echo $resultBidangUsaha['idUsaha'];?>"><?php echo $resultBidangUsaha['namaBidangUsaha'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="pengalaman-posisi" class="col-sm-2 control-label">Jabatan</label>
								<div class="col-sm-5">
									<input type="text" name="pengalaman-posisi" class="form-control" id="pengalaman-posisi" placeholder="Jabatan" required>
								</div>
							</div>
							<div class="form-group">
								<label for="pengalaman-lokasi" class="col-sm-2 control-label">Lokasi</label>
								<div class="col-sm-5">
									<select name="pengalaman-lokasi" id="pengalaman-lokasi" class="form-control">
										<?php
											$queryExpProv = "SELECT * FROM tableProvinsi";
											$execExpProv = mysql_query($queryExpProv);
											while($listProv = mysql_fetch_array($execExpProv))
											{
												?><option value="<?php echo $listProv['idProvinsi']?>" <?php if($listProv['idProvinsi'] == $resultExpProv['lokasi']){ echo "selected";}?>><?php echo $listProv['namaProvinsi'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Periode Kerja</label>
								<div class="col-sm-2">
									<input class="form-control" name="start-date-work" id="start-date-work" placeholder="Awal masa kerja">
								</div>
								<label class="col-sm-1 control-label">Hingga</label>
								<div id="hideEndKerja">
									<div class="col-sm-2">
										<input class="form-control" name="end-date-work" id="end-date-work" placeholder="Akhir masa kerja">
									</div>
								</div>
								<div class="col-sm-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="endNow" id="endNow" value="1">Sekarang
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="pengalaman-gaji" class="col-sm-2 control-label">Gaji Terakhir</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon"><u>+</u> Rp</div>
										<input type="text" class="form-control" name="pengalaman-gaji" id="pengalaman-gaji" placeholder="Gaji terakhir (hanya angka)">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="pengalaman-grossNett" class="col-sm-2 control-label">Gross/Nett</label>
								<div class="col-sm-5">
									<label class="radio-inline"><input type="radio" name="pengalaman-grossNett" id="pengalaman-gross" value="Gross" default>Gross</label>
									<label class="radio-inline"><input type="radio" name="pengalaman-grossNett" id="pengalaman-nett" value="Nett">Nett</label>
								</div>
							</div>
							<div class="form-group">
								<label for="pengalaman-bawahan" class="col-sm-2 control-label">Jumlah Bawahan</label>
								<div class="col-sm-5">
									<input type="number" name="pengalaman-bawahan" class="form-control" id="pengalaman-bawahan" placeholder="Jumlah bawahan (hanya angka)">
								</div>
							</div>
							<div class="form-group">
								<label for="pengalaman-alasan" class="col-sm-2 control-label">Alasan Pindah</label>
								<div class="col-sm-5">
									<textarea name="pengalaman-alasan" id="pengalaman-alasan" rows="3" class="form-control" placeholder="Alasan pindah tempat kerja"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="pengalaman-namaAtasan" class="col-sm-2 control-label">Nama Atasan</label>
								<div class="col-sm-5">
									<input name="pengalaman-namaAtasan" id="pengalaman-namaAtasan" rows="3" class="form-control" placeholder="Nama atasan yang bisa dijadikan referensi mengenai data diri Anda">
								</div>
							</div>
							<div class="form-group">
								<label for="pengalaman-telpAtasan" class="col-sm-2 control-label">Nomor Telepon/HP Atasan</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">+62</div>
										<input type="tel" class="form-control" name="pengalaman-telpAtasan" id="pengalaman-telpAtasan" placeholder="Nomor telepon atasan">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="pengalaman-jabatanAtasan" class="col-sm-2 control-label">Jabatan Atasan</label>
								<div class="col-sm-5">
									<input name="pengalaman-jabatanAtasan" id="pengalaman-jabatanAtasan" rows="3" class="form-control" placeholder="Jabatan atasan">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-2">
									<button type="submit" class="btn btn-primary" id="saveExp" name="saveExp">Simpan</button>
									<button type="button" class="btn btn-default" id="batalExp">Batal</button>
								</div>
							</div>
						</form>
					</div>
					
					<div id="listExperience" class="show-list row">
						<div class="col-sm-8">
							<?php
								$queryShowExperience = "SELECT pw.idPengalaman, pw.idWorker, pw.posisi, pw.namaPerusahaan, bu.namaBidangUsaha, tp.namaProvinsi, pw.awalKerja, pw.akhirKerja, pw.deskripsi FROM pengalamanWorker pw ";
								$queryShowExperience .= "JOIN bidangUsaha bu on bu.idUsaha = pw.bidangUsaha ";
								$queryShowExperience .= "JOIN tableProvinsi tp on tp.idProvinsi = pw.lokasi ";
								$queryShowExperience .= "WHERE idWorker = $idWorker ORDER BY awalKerja DESC";
								$execShowExperience = mysql_query($queryShowExperience) or die("Mysql Error");
								//echo $execShowExperience;
								//echo $queryShowExperience;
							?>
							<div class="table-responsive">
								<?php
									if(mysql_num_rows($execShowExperience) > 0 )
									{ 
										?>
											<table class="table table-condensed table-hover">
												<tbody>
													<?php 
														while($resultShowExperience = mysql_fetch_array($execShowExperience))
														{
															$startWork = new DateTime($resultShowExperience['awalKerja']);
															if($resultShowExperience['akhirKerja'] == "0000-00-00")
															{
																$endWork = "sekarang";
															}
															else
															{
																$endWorking = new DateTime($resultShowExperience['akhirKerja']);
																$endWork = $endWorking->format('M Y');
															}
															?>
																<tr>
																	<td><?php echo $startWork->format('M Y')." - ".$endWork;?></td>
																	<td>
																		<?php 
																			echo "<strong>".$resultShowExperience['posisi']."</strong><br>";
																			echo $resultShowExperience['namaPerusahaan']." | ".$resultShowExperience['namaProvinsi']."<br>";
																			echo "Alasan pindah: <em>".$resultShowExperience['deskripsi']."</em>";
																		?>
																	</td>
																	<td>
																		<form action="edit_experience.php" method="post">
																			<input type="hidden" name="id-exp" value="<?php echo $resultShowExperience['idPengalaman'];?>">
																			<button type="submit" class="btn btn-xs btn-default" name="throw_edit">Edit</button>
																			<button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-exp<?php echo $resultShowExperience['idPengalaman'];?>">Delete</button>
																		</form>
																	</td>
																</tr>

																<!-- Modal Delete Experience -->
																<div class="modal fade" id="delete-exp<?php echo $resultShowExperience['idPengalaman'];?>" tabindex="-1" role="dialog" aria-labelledby="delete-exp-label<?php echo $resultShowExperience['idPengalaman'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="delete-exp-label<?php echo $resultShowExperience['idPengalaman'];?>"><?php echo $resultShowExperience['posisi'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin untuk menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" method="post">
																					<input type="hidden" name="id-exp" value="<?php echo $resultShowExperience['idPengalaman'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-danger" name="delete-exp">Hapus</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
				</div><!-- Pengalaman end -->

				<!-- Skills start -->
				<div role="tabpanel" class="tab-pane <?php if($tab == 'skill'){ echo 'active'; }?>" id="skills">
					<h4>Keahlian Bahasa <button type="button" class="btn btn-primary btn-sm" id="addLang" alt="Tambah Keahlian Bahasa">Tambah</button></h4>
					<div id="addBahasa" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-bahasa" action="resume.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
							<div class="form-group">
								<label for="bahasa" class="col-sm-2 control-label">Bahasa</label>
								<div class="col-sm-4">
									<?php
										$queryBahasa = "SELECT * FROM tableBahasa ORDER BY namaBahasa ASC";
										$execBahasa = mysql_query($queryBahasa);
									?>
									<select name="bahasa" id="bahasa" class="form-control">
										<?php
											while($resultBahasa = mysql_fetch_array($execBahasa))
											{
												?><option value="<?php echo $resultBahasa['idBahasa'];?>"><?php echo $resultBahasa['namaBahasa'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="bahasa-lisan" class="col-sm-2 control-label">Lisan</label>
								<div class="col-sm-4">
									<?php
										$queryTingkatKeahlian = "SELECT * FROM tingkatKeahlian ORDER BY gradeKeahlian";
										$execTingkatKeahlian1 = mysql_query($queryTingkatKeahlian);
									?>
									<select name="bahasa-lisan" id="bahasa-lisan" class="form-control">
										<?php
											while($resultTingkatKeahlian1 = mysql_fetch_array($execTingkatKeahlian1))
											{
												?><option value="<?php echo $resultTingkatKeahlian1['gradeKeahlian'];?>"><?php echo $resultTingkatKeahlian1['tingkatKeahlian'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="bahasa-menulis" class="col-sm-2 control-label">Menulis</label>
								<div class="col-sm-4">
									<?php
										$execTingkatKeahlian2 = mysql_query($queryTingkatKeahlian);
									?>
									<select name="bahasa-menulis" id="bahasa-menulis" class="form-control">
										<?php
											while($resultTingkatKeahlian2 = mysql_fetch_array($execTingkatKeahlian2))
											{
												?><option value="<?php echo $resultTingkatKeahlian2['gradeKeahlian'];?>"><?php echo $resultTingkatKeahlian2['tingkatKeahlian'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="bahasa-membaca" class="col-sm-2 control-label">Membaca</label>
								<div class="col-sm-4">
									<?php
										$execTingkatAhli3 = mysql_query($queryTingkatKeahlian);
									?>
									<select name="bahasa-membaca" id="bahasa-membaca" class="form-control">
										<?php
											while($resultTingkatAhli3 = mysql_fetch_array($execTingkatAhli3))
											{
												?><option value="<?php echo $resultTingkatAhli3['gradeKeahlian'];?>"><?php echo $resultTingkatAhli3['tingkatKeahlian'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="bahasa-keterangan" class="col-sm-2 control-label">Keterangan</label>
								<div class="col-sm-5">
									<input type="text" name="bahasa-keterangan" class="form-control" id="bahasa-keterangan" placeholder="(Hasil Tes IELTS/TOEFL/TOEIC/DLL)">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="saveBhs" name="saveBhs">Simpan</button>
									<button type="button" class="btn btn-default" id="batalBhs">Batal</button>
								</div>
							</div>
						</form>	
					</div>
					<div id="listBahasa" class="show-list row">
						<div class="table-responsive">
							<div class="col-sm-9">
								<?php
									$queryShowBahasa = "SELECT sbw.idTable, sbw.idBahasa, tb.namaBahasa, sbw.tingkatLisan, tkl.tingkatKeahlian as lisan, sbw.tingkatMenulis, tkt.tingkatKeahlian as menulis, 
														sbw.tingkatMembaca, tkb.tingkatKeahlian as membaca, sbw.keteranganBahasa FROM skillBahasaWorker sbw ";
									$queryShowBahasa .= "JOIN tableBahasa tb ON tb.idBahasa = sbw.idBahasa ";
									$queryShowBahasa .= "JOIN tingkatKeahlian tkl ON tkl.gradeKeahlian = sbw.tingkatLisan ";
									$queryShowBahasa .= "JOIN tingkatKeahlian tkt ON tkt.gradeKeahlian = sbw.tingkatMenulis ";
									$queryShowBahasa .= "JOIN tingkatKeahlian tkb ON tkb.gradeKeahlian = sbw.tingkatMembaca ";
									$queryShowBahasa .= "WHERE idWorker = $idWorker";

									$execShowBahasa = mysql_query($queryShowBahasa);
									if(mysql_num_rows($execShowBahasa) > 0)
									{
										?>
											<table class="table table-condensed table-hover">
												<thead><th>Kemampuan Bahasa</th><th>Lisan</th><th>Menulis</th><th>Membaca</th><th>Keterangan</th><th></th></thead>
												<tbody>
													<?php
														while($resultShowBahasa = mysql_fetch_array($execShowBahasa))
														{
															?>
																<tr>
																	<td>
																		<?php echo $resultShowBahasa['namaBahasa'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBahasa['lisan'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBahasa['menulis'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBahasa['membaca'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBahasa['keteranganBahasa'];?>
																	</td>
																	<td>
																		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#update-bahasa<?php echo $resultShowBahasa['idTable'];?>">Edit</button> 
																		<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-bahasa<?php echo $resultShowBahasa['idTable'];?>">Delete</button>
																	</td>
																</tr>
																<!-- Modal Delete Bahasa-->
																<div class="modal fade" id="delete-bahasa<?php echo $resultShowBahasa['idTable'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-bahasa<?php echo $resultShowBahasa['idTable'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-label-bahasa<?php echo $resultShowBahasa['idTable'];?>"><?php echo $resultShowBahasa['namaBahasa'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" role="form" id="delete-bahasa<?php echo $resultShowBahasa['idTable'];?>" method="post">
																					<input type="hidden" name="id-table" value="<?php echo $resultShowBahasa['idTable'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary" name="delete-bahasa">Delete</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>

																<!-- Modal Update Bahasa-->
																<div class="modal fade" id="update-bahasa<?php echo $resultShowBahasa['idTable'];?>" tabindex="-1" role="dialog" aria-labelledby="update-modal-label-bahasa<?php echo $resultShowBahasa['idTable'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="update-modal-label-bahasa<?php echo $resultShowBahasa['idTable'];?>"><?php echo $resultShowBahasa['namaBahasa'];?></h4>
																			</div>
																			<div class="modal-body">
																				<form action="resume.php" role="form" id="update-bahasa<?php echo $resultShowBahasa['idTable'];?>" method="post">
																					<input type="hidden" name="id-table" value="<?php echo $resultShowBahasa['idTable'];?>">
																					<div class="form-group">
																						<label for="nama-bahasa<?php echo $resultShowBahasa['idTable'];?>">Nama Bahasa</label>
																						<select name="nama-bahasa" id="nama-bahasa<?php echo $resultShowBahasa['idTable'];?>" class="form-control">
																							<?php 
																								$execEditNamaBahasa = mysql_query($queryBahasa);
																								while($listEditNamaBahasa = mysql_fetch_array($execEditNamaBahasa))
																								{   				
																									?>
																										<option value="<?php echo $listEditNamaBahasa['idBahasa'];?>" <?php if($listEditNamaBahasa['idBahasa'] == $resultShowBahasa['idBahasa']){ echo "selected";}?>> <?php echo $listEditNamaBahasa['namaBahasa'];?> </option>
																									<?php
																								}
																							?>	
																						</select>
																					</div>
																					<div class="form-group">
																						<label for="tkl<?php echo $resultShowBahasa['idTable'];?>">Lisan</label>
																						<select name="tkl" id="tkl<?php echo $resultShowBahasa['idTable'];?>" class="form-control">
																							<?php
																								$execEditBahasaLisan = mysql_query($queryTingkatKeahlian);
																								while($listEditBahasaLisan = mysql_fetch_array($execEditBahasaLisan))
																								{
																									?>
																										<option value="<?php echo $listEditBahasaLisan['gradeKeahlian'];?>" <?php if($listEditBahasaLisan['gradeKeahlian'] == $resultShowBahasa['tingkatLisan']){ echo "selected";}?>><?php echo $listEditBahasaLisan['tingkatKeahlian'];?></option>
																									<?php
																								}
																							?>
																						</select>
																					</div>
																					<div class="form-group">
																						<label for="tkt<?php echo $resultShowBahasa['idTable'];?>">Menulis</label>
																						<select name="tkt" id="tkt<?php echo $resultShowBahasa['idTable'];?>" class="form-control">
																							<?php
																								$execEditBahasaMenulis = mysql_query($queryTingkatKeahlian);
																								while($listEditBahasaMenulis = mysql_fetch_array($execEditBahasaMenulis))
																								{
																									?>
																										<option value="<?php echo $listEditBahasaMenulis['gradeKeahlian'];?>" <?php if($listEditBahasaMenulis['gradeKeahlian'] == $resultShowBahasa['tingkatMenulis']){ echo "selected";}?>> <?php echo $listEditBahasaMenulis['tingkatKeahlian'];?></option>
																									<?php
																								}
																							?>
																						</select>
																					</div>
																					<div class="form-group">
																						<label for="tkb<?php echo $resultShowBahasa['idTable'];?>">Membaca</label>
																						<select name="tkb" id="tkb<?php echo $resultShowBahasa['idTable'];?>" class="form-control">
																							<?php
																								$execEditBahasaMembaca = mysql_query($queryTingkatKeahlian);
																								while($listEditBahasaMembaca = mysql_fetch_array($execEditBahasaMembaca))
																								{
																									?>
																										<option value="<?php echo $listEditBahasaMembaca['gradeKeahlian'];?>" <?php if($listEditBahasaMembaca['gradeKeahlian'] == $resultShowBahasa['tingkatMembaca']){ echo "selected";}?>> <?php echo $listEditBahasaMembaca['tingkatKeahlian'];?></option>
																									<?php
																								}
																							?>
																						</select>
																					</div>
																					<div class="form-group">
																						<label for="ket<?php echo $resultShowBahasa['idTable'];?>">Keterangan</label>
																						<input type="text" name="ket" id="ket<?php echo $resultShowBahasa['idTable'];?>" class="form-control" value="<?php echo $resultShowBahasa['keteranganBahasa'];?>">
																					</div>
																			</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																						<button type="submit" class="btn btn-primary" name="update-bahasa">Update</button>
																				</form>
																					</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
					
					<h4>Keahlian Lain<button type="button" class="btn btn-primary btn-sm" id="addOtherSkill" alt="Tambah Keahlian Lain">Tambah</button></h4>
					<div id="addOSkill" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-skill" action="resume.php" method="post">
							<input type="hidden" name="idWorker" value="<?php echo $idWorker;?>">
							<div class="form-group">
								<label for="skill" class="col-sm-2 control-label">Nama Keahlian</label>
								<div class="col-sm-5">
									<input type="text" name="skill" class="form-control" id="skill" placeholder="Jenis kemampuan yang dimiliki" required>
								</div>
							</div>
							<div class="form-group">
								<label for="tingkat-skill" class="col-sm-2 control-label">Tingkat Kemampuan</label>
								<div class="col-sm-5">
									<?php
										$execTingkatKeahlian3 = mysql_query($queryTingkatKeahlian);
									?>
									<select name="tingkat-skill" id="tingkat-skill" class="form-control">
										<?php
											while($resultTingkatKeahlian3 = mysql_fetch_array($execTingkatKeahlian3))
											{
												?><option value="<?php echo $resultTingkatKeahlian3['gradeKeahlian'];?>"><?php echo $resultTingkatKeahlian3['tingkatKeahlian'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="saveSkill" name="saveSkill">Simpan</button> 
									<button type="button" class="btn btn-default" id="batalSkill">Batal</button>
								</div>
							</div>
						</form>
					</div>
					
					
					<div id="listSkill" class="show-list row">
						<div class="col-sm-8">
							<?php
								$queryShowSkill = "SELECT sw.idSkill, sw.namaSkill, sw.tingkatSkill, tk.tingkatKeahlian as grade FROM skillWorker sw ";
								$queryShowSkill .= "JOIN tingkatKeahlian tk ON tk.gradeKeahlian = sw.tingkatSkill ";
								$queryShowSkill .= "WHERE idWorker = $idWorker";
								$execShowSkill = mysql_query($queryShowSkill) or die();
							?>
							<div class="table-responsive">
								<?php
									if(mysql_num_rows($execShowSkill) > 0 )
									{ 
										?>
											<table class="table table-condensed table-hover">
												<thead><th>Nama Keahlian</th><th>Tingkat Keahlian</th><th></th></thead>
												<tbody>
													<?php 
														while($resultShowSKill = mysql_fetch_array($execShowSkill))
														{
															?>	
																<tr>
																	<td>
																		<?php echo $resultShowSKill['namaSkill'];?>
																	</td>
																	<td>
																		<?php echo $resultShowSKill['grade'];?>
																	</td>
																	<td>
																		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#update-skill<?php echo $resultShowSKill['idSkill'];?>">Edit</button> 
																		<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-skill<?php echo $resultShowSKill['idSkill'];?>">Delete</button>
																	</td>
																</tr>
																
																<!-- Modal DELETE Skill -->
																<div class="modal fade" id="delete-skill<?php echo $resultShowSKill['idSkill'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-skill<?php echo $resultShowSKill['idSkill'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-delete-skill<?php echo $resultShowSKill['idSkill'];?>"><?php echo $resultShowSKill['namaSkill'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" method="post">
																					<input type="hidden" name="id-skill" value="<?php echo $resultShowSKill['idSkill'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary" name="delete-skill">Hapus</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>

																<!-- Modal Update Skill -->
																<div class="modal fade" id="update-skill<?php echo $resultShowSKill['idSkill'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-update-skill<?php echo $resultShowSKill['idSkill'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-update-skill<?php echo $resultShowSKill['idSkill'];?>"><?php echo $resultShowSKill['namaSkill'];?></h4>
																			</div>
																			<div class="modal-body">
																				<form action="resume.php" method="post" id="form-update-skill<?php echo $resultShowSKill['idSkill'];?>" role="form">
																					<input type="hidden" name="id-skill" value="<?php echo $resultShowSKill['idSkill'];?>">
																					<div class="form-group">
																						<label for="nama-skill<?php echo $resultShowSKill['idSkill'];?>">Nama Skill</label>
																						<input type="text" name="nama-skill" id="nama-skill<?php echo $resultShowSKill['idSkill'];?>" class="form-control" value="<?php echo $resultShowSKill['namaSkill'];?>">
																					</div>
																					<div class="form-group">
																						<label for="tingkat<?php echo $resultShowSKill['idSkill'];?>">Tingkat Keahlian</label>
																						<select name="tingkat" id="tingkat<?php echo $resultShowSKill['idSkill'];?>" class="form-control">
																							<?php 
																								$execTingkatAhli = mysql_query($queryTingkatKeahlian);
																								while($tingkatAhli = mysql_fetch_array($execTingkatAhli))
																								{
																									?><option value="<?php echo $tingkatAhli['gradeKeahlian'];?>" <?php if($tingkatAhli['gradeKeahlian'] == $resultShowSKill['tingkatSkill']){ echo "selected";}?>><?php echo $tingkatAhli['tingkatKeahlian'];?></option><?php 
																								}
																							?>
																						</select>
																					</div>
																			</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																						<button type="submit" class="btn btn-primary" name="update-skill">Simpan</button>
																				</form>
																					</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
					
					<h4>Keahlian Mengemudi <button type="button" class="btn btn-primary btn-sm" id="addKemudi" alt="Tambah Keahlian Mengemudi">Tambah</button></h4>
					<div id="addMengemudi" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-mengemudi" action="resume.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
							<div class="form-group">
								<label for="mengemudi" class="col-sm-2 control-label">Nama Keahlian</label>
								<div class="col-sm-4">
									<?php
										$queryMengemudi = "SELECT * FROM tableMengemudi ORDER BY namaMengemudi ASC";
										$execMengemudi = mysql_query($queryMengemudi);
									?>
									<select name="mengemudi" id="mengemudi" class="form-control">
										<?php
											while($resultMengemudi = mysql_fetch_array($execMengemudi))
											{
												?><option value="<?php echo $resultMengemudi['idMengemudi'];?>"><?php echo $resultMengemudi['namaMengemudi'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="keahlian-mengemudi" class="col-sm-2 control-label">Tingkat Keahlian</label>
								<div class="col-sm-4">
									<?php
										$queryTingkatMengemudi = "SELECT * FROM tingkatKeahlian ORDER BY gradeKeahlian";
										$execTingkatMengemudi = mysql_query($queryTingkatMengemudi);
									?>
									<select name="keahlian-mengemudi" id="keahlian-mengemudi" class="form-control">
										<?php
											while($resultTingkatMengemudi = mysql_fetch_array($execTingkatMengemudi))
											{
												?><option value="<?php echo $resultTingkatMengemudi['gradeKeahlian'];?>"><?php echo $resultTingkatMengemudi['tingkatKeahlian'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="noSim-mengemudi" class="col-sm-2 control-label">Nomor SIM</label>
								<div class="col-sm-5">
									<input type="int" name="noSim-mengemudi" class="form-control" id="noSim-mengemudi" placeholder="Nomor SIM (Hanya Angka)">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="saveMengemudi" name="saveMengemudi">Simpan</button>
									<button type="button" class="btn btn-default" id="batalMengemudi">Batal</button>
								</div>
							</div>
						</form>	
					</div>
					
					<div id="listMengemudi" class="show-list row">
						<div class="table-responsive">
							<div class="col-sm-9">
								<?php
									$queryShowMengemudi = "SELECT smw.idTableM, smw.idMengemudi, tm.namaMengemudi, smw.keahlianMengemudi, tkm.tingkatKeahlian as ahliMengemudi, smw.noSim FROM skillMengemudiWorker smw ";
									$queryShowMengemudi .= "JOIN tableMengemudi tm ON tm.idMengemudi = smw.idMengemudi ";
									$queryShowMengemudi .= "JOIN tingkatKeahlian tkm ON tkm.gradeKeahlian = smw.keahlianMengemudi ";
									$queryShowMengemudi .= "WHERE idWorker = $idWorker";

									$execShowMengemudi = mysql_query($queryShowMengemudi);
									if(mysql_num_rows($execShowMengemudi) > 0)
									{
										?>
											<table class="table table-condensed table-hover">
												<thead><th>Nama Keahlian</th><th>Tingkat Keahlian</th><th>Nomor SIM</th></thead>
												<tbody>
													<?php
														while($resultShowMengemudi = mysql_fetch_array($execShowMengemudi))
														{
															?>
																<tr>
																	<td>
																		<?php echo $resultShowMengemudi['namaMengemudi'];?>
																	</td>
																	<td>
																		<?php echo $resultShowMengemudi['ahliMengemudi'];?>
																	</td>
																	<td>
																		<?php echo $resultShowMengemudi['noSim'];?>
																	</td>
																	<td>
																		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#update-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>">Edit</button> 
																		<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>">Delete</button>
																	</td>
																</tr>
																
																<!-- Modal Delete Mengemudi-->
																<div class="modal fade" id="delete-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-label-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>"><?php echo $resultShowMengemudi['namaMengemudi'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" role="form" id="delete-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>" method="post">
																					<input type="hidden" name="id-tablem" value="<?php echo $resultShowMengemudi['idTableM'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary" name="delete-mengemudi">Delete</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>

																<!-- Modal Update Mengemudi-->
																<div class="modal fade" id="update-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>" tabindex="-1" role="dialog" aria-labelledby="update-modal-label-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="update-modal-label-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>"><?php echo $resultShowMengemudi['namaMengemudi'];?></h4>
																			</div>
																			<div class="modal-body">
																				<form action="resume.php" role="form" id="update-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>" method="post">
																					<input type="hidden" name="id-tablem" value="<?php echo $resultShowMengemudi['idTableM'];?>">
																					<div class="form-group">
																						<label for="nama-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>">Nama Keahlian</label>
																						<select name="nama-mengemudi" id="nama-mengemudi<?php echo $resultShowMengemudi['idTableM'];?>" class="form-control">
																							<?php 
																								$execEditNamaMengemudi = mysql_query($queryMengemudi);
																								while($listEditNamaMengemudi = mysql_fetch_array($execEditNamaMengemudi))
																								{   				
																									?>
																										<option value="<?php echo $listEditNamaMengemudi['idMengemudi'];?>" <?php if($listEditNamaMengemudi['idMengemudi'] == $resultShowMengemudi['idMengemudi']){ echo "selected";}?>> <?php echo $listEditNamaMengemudi['namaMengemudi'];?> </option>
																									<?php
																								}
																							?>	
																						</select>
																					</div>
																					<div class="form-group">
																						<label for="tkm<?php echo $resultShowMengemudi['idTableM'];?>">Tingkat Keahlian</label>
																						<select name="tkm" id="tkm<?php echo $resultShowMengemudi['idTableM'];?>" class="form-control">
																							<?php
																								$execEditKeahlianMengemudi = mysql_query($queryTingkatKeahlian);
																								while($listEditKeahlianMengemudi = mysql_fetch_array($execEditKeahlianMengemudi))
																								{
																									?>
																										<option value="<?php echo $listEditKeahlianMengemudi['gradeKeahlian'];?>" <?php if($listEditKeahlianMengemudi['gradeKeahlian'] == $resultShowMengemudi['keahlianMengemudi']){ echo "selected";}?>><?php echo $listEditKeahlianMengemudi['tingkatKeahlian'];?></option>
																									<?php
																								}
																							?>
																						</select>
																					<div class="form-group">
																						<label for="noSim<?php echo $resultShowMengemudi['idTableM'];?>">Nomor SIM</label>
																						<input type="int" name="noSim" id="noSim<?php echo $resultShowMengemudi['idTableM'];?>" class="form-control" value="<?php echo $resultShowMengemudi['noSim'];?>">
																					</div>
																			</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																						<button type="submit" class="btn btn-primary" name="update-mengemudi">Update</button>
																				</form>
																					</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
					
					<h4>Training/Pelatihan <button type="button" class="btn btn-primary btn-sm" id="addTrainingPelatihan" alt="Tambah Training/Pelatihan">Tambah</button></h4>
					<div id="addTraining" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-training" action="resume.php" method="post">
							<input type="hidden" name="idWorker" value="<?php echo $idWorker;?>">
							<div class="form-group">
								<label for="nama_training" class="col-sm-2 control-label">Nama Training/Seminar/Workshop</label>
								<div class="col-sm-5">
									<input type="text" name="nama_training" class="form-control" id="nama_training" placeholder="Nama Training/Seminar/Workshop yang Pernah diikuti" required>
								</div>
							</div>
							<div class="form-group">
								<label for="penyelenggara_training" class="col-sm-2 control-label">Lembaga Penyelenggara</label>
								<div class="col-sm-5">
									<input type="text" name="penyelenggara_training" class="form-control" id="penyelenggara_training" placeholder="Nama Lembaga Penyelenggara" required>
								</div>
							</div>
							<div class="form-group">
								<label for="tahun_training" class="col-sm-2 control-label">Tahun</label>
								<div class="col-sm-3">
									<input name="tahun_training" class="form-control" id="tahun_training" placeholder="Tahun Diselenggarakan">
								</div>
							</div>
							<div class="form-group">
								<label for="keterangan_training<?php echo $resultKetTraining['idTraining'];?>" class="col-sm-2 control-label">Keterangan</label>
								<div class="col-sm-5">
									<select name="keterangan_training" id="keterangan_training<?php echo $resultKetTraining['idTraining'];?>" class="form-control">
										<?php
											$queryKetTraining = "SELECT * FROM tingkatKetTraining";
											$execKetTraining = mysql_query($queryKetTraining);
											while($listKetTraining = mysql_fetch_array($execKetTraining))
											{
												?><option value="<?php echo $listKetTraining['idKetTraining']?>" <?php if($listKetTraining['idKetTraining'] == $resultKetTraining['keteranganTraining']){ echo "selected";}?>><?php echo $listKetTraining['tingkatKetTraining'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="saveTraining" name="saveTraining">Simpan</button> 
									<button type="button" class="btn btn-default" id="batalTraining">Batal</button>
								</div>
							</div>
						</form>
					</div>
					
					<div id="listTraining" class="show-list row">
						<div class="col-sm-8">
							<?php
								$queryShowTraining = "SELECT stw.idTraining, stw.namaTraining, stw.penyelenggaraTraining, stw.tahunTraining, stw.keteranganTraining, tkt.tingkatKetTraining as gradeTraining FROM skillTrainingWorker stw ";
								$queryShowTraining .= "JOIN tingkatKetTraining tkt ON tkt.gradeKetTraining = stw.keteranganTraining ";
								$queryShowTraining .= "WHERE idWorker = $idWorker";
								$execShowTraining = mysql_query($queryShowTraining) or die();
							?>
							<div class="table-responsive">
								<?php
									if(mysql_num_rows($execShowTraining) > 0 )
									{ 
										?>
											<table class="table table-condensed table-hover">
												<thead><th>Nama Training/Seminar/Workshop</th><th>Lembaga Penyelenggara</th><th>Tahun</th><th>Keterangan</th><th></th></thead>
												<tbody>
													<?php 
														while($resultShowTraining = mysql_fetch_array($execShowTraining))
														{
															?>	
																<tr>
																	<td>
																		<?php echo $resultShowTraining['namaTraining'];?>
																	</td>
																	<td>
																		<?php echo $resultShowTraining['penyelenggaraTraining'];?>
																	</td>
																	<td>
																		<?php echo $resultShowTraining['tahunTraining'];?>
																	</td>
																	<td>
																		<?php echo $resultShowTraining['gradeTraining'];?>
																	</td>
																	<td>
																		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#update-training<?php echo $resultShowTraining['idTraining'];?>">Edit</button> 
																		<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-training<?php echo $resultShowTraining['idTraining'];?>">Delete</button>
																	</td>
																</tr>
																
																<!-- Modal DELETE Training -->
																<div class="modal fade" id="delete-training<?php echo $resultShowTraining['idTraining'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-training<?php echo $resultShowTraining['idTraining'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-delete-training<?php echo $resultShowTraining['idTraining'];?>"><?php echo $resultShowTraining['namaTraining'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" method="post">
																					<input type="hidden" name="id-training" value="<?php echo $resultShowTraining['idTraining'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary" name="delete-training">Hapus</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>

																<!-- Modal Update Training -->
																<div class="modal fade" id="update-training<?php echo $resultShowTraining['idTraining'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-update-training<?php echo $resultShowTraining['idTraining'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-update-training<?php echo $resultShowTraining['idTraining'];?>"><?php echo $resultShowTraining['namaTraining'];?></h4>
																			</div>
																			<div class="modal-body">
																				<form action="resume.php" method="post" id="form-update-training<?php echo $resultShowTraining['idTraining'];?>" role="form">
																					<input type="hidden" name="id-training" value="<?php echo $resultShowTraining['idTraining'];?>">
																					<div class="form-group">
																						<label for="nama-training<?php echo $resultShowTraining['idTraining'];?>">Nama Training</label>
																						<input type="text" name="nama-training" id="nama-training<?php echo $resultShowTraining['idTraining'];?>" class="form-control" value="<?php echo $resultShowTraining['namaTraining'];?>">
																					</div>
																					<div class="form-group">
																						<label for="penyelenggara-training<?php echo $resultShowTraining['idTraining'];?>">Lembaga Penyelenggara</label>
																						<input type="text" name="penyelenggara-training" id="penyelenggara-training<?php echo $resultShowTraining['idTraining'];?>" class="form-control" value="<?php echo $resultShowTraining['penyelenggaraTraining'];?>">
																					</div>
																					<div class="form-group">
																						<label for="tahun-training<?php echo $resultShowTraining['idTraining'];?>">Tahun</label>
																						<input type="number" name="tahun-training" id="tahun-training<?php echo $resultShowTraining['idTraining'];?>" class="form-control" value="<?php echo $resultShowTraining['tahunTraining'];?>">
																					</div>
																					<div class="form-group">
																						<label for="keterangan-training<?php echo $resultShowTraining['idTraining'];?>">Keterangan</label>
																						<select name="keterangan-training" id="keterangan-training<?php echo $resultShowTraining['idTraining'];?>" class="form-control">
																							<?php 
																								$queryKeteranganTraining = "SELECT * FROM tingkatKetTraining";
																								$execKeteranganTraining = mysql_query($queryKeteranganTraining);
																								while($listKeteranganTraining = mysql_fetch_array($execKeteranganTraining))
																								{
																									?>
																										<option value="<?php echo $listKeteranganTraining['idKetTraining']?>" <?php if($listKeteranganTraining['idKetTraining'] == $resultShowTraining['keteranganTraining']){ echo "selected";}?>><?php echo $listKeteranganTraining['tingkatKetTraining'];?></option>
																									<?php
																								}
																							?>
																						</select>
																					</div>
																			</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																						<button type="submit" class="btn btn-primary" name="update-training">Simpan</button>
																				</form>
																					</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
				</div><!-- Skills end -->
				
				<!-- Families start -->
				<div role="tabpanel" class="tab-pane <?php if($tab == 'lingkunganKeluarga'){ echo 'active'; }?>" id="lingkunganKeluarga">
					<h4>Keluarga Inti (Suami/Istri dan Anak-Anak Sesuai Urutan) <button type="button" class="btn btn-primary btn-sm" id="addKeluargaInti" alt="Tambah Keluarga Inti">Tambah</button></h4>
					<div id="addKelInti" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-inti" action="resume.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
							<div class="form-group">
								<label for="hubungan_inti" class="col-sm-2 control-label">Hubungan Keluarga</label>
								<div class="col-sm-5">
									<?php
										$queryHubunganKeluarga = "SELECT * FROM hubunganKeluarga";
										$execHubunganKeluarga = mysql_query($queryHubunganKeluarga);
									?>
									<select name="hubungan_inti" id="hubungan_inti" class="form-control">
										<?php
											while($resultHubunganKeluarga = mysql_fetch_array($execHubunganKeluarga))
											{
												?>
													<option value="<?php echo $resultHubunganKeluarga['gradeHubungan'];?>"><?php echo $resultHubunganKeluarga['namaHubungan'];?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_inti" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-5">
									<input type="text" name="nama_inti" class="form-control" id="nama_inti" placeholder="Nama Anggota Keluarga" required>
								</div>
							</div>
							<div class="form-group">
								<label for="gender_inti" class="col-sm-2 control-label">Jenis Kelamin</label>
								<div class="col-sm-5">
									<label class="radio-inline"><input type="radio" name="gender_inti" id="genderPa" value="Laki-Laki" default>Laki-Laki</label>
									<label class="radio-inline"><input type="radio" name="gender_inti" id="genderPi" value="Perempuan">Perempuan</label>
								</div>
							</div>
							<div class="form-group">
								<label for="tempatLahir_inti" class="col-sm-2 control-label">Tempat Lahir</label>
								<div class="col-sm-5">
									<input type="text" name="tempatLahir_inti" class="form-control" id="tempatLahir_inti" placeholder="Tempat Lahir" required>
								</div>
							</div>
							<div class="form-group">
								<label for="birthday_inti" class="col-sm-2 control-label">Tanggal Lahir</label>
								<div class="col-sm-5">
									<?php $lahir = new DateTime($resultBirthdayInti['birthdayInti']);?>
									<input type="date" class="form-control" name="birthday_inti" id="birthday_inti" placeholder="Tanggal Lahir" value="<?php echo $lahir->format('d-m-Y'); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="pendidikan_inti" class="col-sm-2 control-label">Pendidikan</label>
								<div class="col-sm-5">
									<?php
										$queryPendidikan = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
										$execPendidikan = mysql_query($queryPendidikan);
									?>
									<select class="form-control" name="pendidikan_inti" id="pendidikan_inti">
										<?php
											while($resultPendidikan = mysql_fetch_array($execPendidikan))
											{
												?><option value="<?php echo $resultPendidikan['gradePendidikan'];?>"><?php echo $resultPendidikan['namaPendidikan'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="pekerjaan_inti" class="col-sm-2 control-label">Bidang Pekerjaan</label>
								<div class="col-sm-5">
									<input type="text" name="pekerjaan_inti" class="form-control" id="pekerjaan_inti" placeholder="Bidang Pekerjaan" required>
								</div>
							</div>
							<div class="form-group">
								<label for="perusahaan_inti" class="col-sm-2 control-label">Nama Perusahaan</label>
								<div class="col-sm-5">
									<input type="text" name="perusahaan_inti" class="form-control" id="perusahaan_inti" placeholder="Nama Perusahaan">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="saveInti" name="saveInti">Simpan</button> 
									<button type="button" class="btn btn-default" id="batalInti">Batal</button>
								</div>
							</div>
						</form>
					</div>
					
					<div id="listInti" class="show-list row">
						<div class="table-responsive">
							<div class="col-sm-9">
								<?php
									$queryShowInti = "SELECT ki.idInti, ki.hubunganInti, hk.namaHubungan, ki.namaInti, ki.genderInti, ki.tempatLahirInti, ki.birthdayInti, ki.pendidikanInti, tp.namaPendidikan, 
													ki.pekerjaanInti, ki.perusahaanInti FROM keluargaInti ki ";
									$queryShowInti .= "JOIN hubunganKeluarga hk ON hk.gradeHubungan = ki.hubunganInti ";
									$queryShowInti .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = ki.pendidikanInti ";
									$queryShowInti .= "WHERE idWorker = $idWorker";
									
									$execShowInti = mysql_query($queryShowInti) or die();
									if(mysql_num_rows($execShowInti) > 0 )
									{ 
										?>
											<table class="table table-condensed table-hover">
												<thead><th>Status Hubungan</th><th>Nama</th><th>Jenis Kelamin</th><th>Tempat Lahir</th><th>Tanggal Lahir</th><th>Pendidikan</th><th>Pekerjaan</th><th>Perusahaan</th><th></th></thead>
												<tbody>
													<?php 
														while($resultShowInti = mysql_fetch_array($execShowInti))
														{
															?>	
																<tr>
																	<td>
																		<?php echo $resultShowInti['namaHubungan'];?>
																	</td>
																	<td>
																		<?php echo $resultShowInti['namaInti'];?>
																	</td>
																	<td>
																		<?php echo $resultShowInti['genderInti'];?>
																	</td>
																	<td>
																		<?php echo $resultShowInti['tempatLahirInti'];?>
																	</td>
																	<td>
																		<?php echo $resultShowInti['birthdayInti'];?>
																	</td>
																	<td>
																		<?php echo $resultShowInti['namaPendidikan'];?>
																	</td>
																	<td>
																		<?php echo $resultShowInti['pekerjaanInti'];?>
																	</td>
																	<td>
																		<?php echo $resultShowInti['perusahaanInti'];?>
																	</td>
																	<td>
																		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#update-inti<?php echo $resultShowInti['idInti'];?>">Edit</button> 
																		<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-inti<?php echo $resultShowInti['idInti'];?>">Delete</button>
																	</td>
																</tr>
																
																<!-- Modal DELETE Keluarga Inti -->
																<div class="modal fade" id="delete-inti<?php echo $resultShowInti['idInti'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-inti<?php echo $resultShowInti['idInti'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-delete-inti<?php echo $resultShowInti['idInti'];?>"><?php echo $resultShowInti['namaHubungan'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" method="post">
																					<input type="hidden" name="id-inti" value="<?php echo $resultShowInti['idInti'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary" name="delete-inti">Hapus</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>

																<!-- Modal Update Keluarga Inti -->
																<div class="modal fade" id="update-inti<?php echo $resultShowInti['idInti'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-update-inti<?php echo $resultShowInti['idInti'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-update-inti<?php echo $resultShowInti['idInti'];?>"><?php echo $resultShowInti['namaHubungan'];?></h4>
																			</div>
																			<div class="modal-body">
																				<form action="resume.php" method="post" id="form-update-inti<?php echo $resultShowInti['idInti'];?>" role="form">
																					<input type="hidden" name="id-inti" value="<?php echo $resultShowInti['idInti'];?>">
																					<div class="form-group">
																						<label for="hubungan-inti<?php echo $resultShowInti['idInti'];?>">Status Hubungan</label>
																						<select name="hubungan-inti" id="hubungan-inti<?php echo $resultShowInti['idInti'];?>" class="form-control">
																							<?php 
																								$queryStatusHubungan = "SELECT * FROM hubunganKeluarga";
																								$execStatusHubungan = mysql_query($queryStatusHubungan);
																								while($StatusHubungan = mysql_fetch_array($execStatusHubungan))
																								{
																									?><option value="<?php echo $StatusHubungan['gradeHubungan'];?>" <?php if($StatusHubungan['gradeHubungan'] == $resultShowInti['hubunganInti']){ echo "selected";}?>><?php echo $StatusHubungan['namaHubungan'];?></option><?php 
																								}
																							?>
																						</select>
																					</div>
																					<div class="form-group">
																						<label for="nama-inti<?php echo $resultShowInti['idInti'];?>">Nama</label>
																						<input type="text" name="nama-inti" id="nama-inti<?php echo $resultShowInti['idInti'];?>" class="form-control" value="<?php echo $resultShowInti['namaInti'];?>">
																					</div>
																					<div class="form-group">
																						<label for="gender-inti<?php echo $resultShowInti['idInti'];?>">Jenis Kelamin</label>
																						<input type="text" name="gender-inti" id="gender-inti<?php echo $resultShowInti['idInti'];?>" class="form-control" value="<?php echo $resultShowInti['genderInti'];?>">
																					</div>
																					<div class="form-group">
																						<label for="tempatLahir-inti<?php echo $resultShowInti['idInti'];?>">Tempat Lahir</label>
																						<input type="text" name="tempatLahir-inti" id="tempatLahir-inti<?php echo $resultShowInti['idInti'];?>" class="form-control" value="<?php echo $resultShowInti['tempatLahirInti'];?>">
																					</div>
																					<div class="form-group">
																						<label for="birthday-inti<?php echo $resultShowInti['idInti'];?>">Tanggal Lahir</label>
																						<input type="text" name="birthday-inti" id="birthday-inti<?php echo $resultShowInti['idInti'];?>" class="form-control" value="<?php echo $resultShowInti['birthdayInti'];?>">
																					</div>
																					<div class="form-group">
																						<label for="pendidikan-inti<?php echo $resultShowInti['idInti'];?>">Pendidikan</label>
																						<select name="pendidikan-inti" id="pendidikan-inti<?php echo $resultShowInti['idInti'];?>" class="form-control">
																							<?php 
																								$execPendInti = mysql_query($queryPendidikan);
																								while($listPendInti = mysql_fetch_array($execPendInti))
																								{
																									?><option value="<?php echo $listPendInti['gradePendidikan'];?>" <?php if($listPendInti['gradePendidikan'] == $resultShowInti['pendidikanInti']){ echo "selected";}?>><?php echo $listPendInti['namaPendidikan'];?></option><?php
																								}
																							?>
																						</select>
																					</div>
																					<div class="form-group">
																						<label for="pekerjaan-inti<?php echo $resultShowInti['idInti'];?>">Bidang Pekerjaan</label>
																						<input type="text" name="pekerjaan-inti" id="pekerjaan-inti<?php echo $resultShowInti['idInti'];?>" class="form-control" value="<?php echo $resultShowInti['pekerjaanInti'];?>">
																					</div>
																					<div class="form-group">
																						<label for="perusahaan-inti<?php echo $resultShowInti['idInti'];?>">Nama Perusahaan</label>
																						<input type="text" name="perusahaan-inti" id="perusahaan-inti<?php echo $resultShowInti['idInti'];?>" class="form-control" value="<?php echo $resultShowInti['perusahaanInti'];?>">
																					</div>
																			</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																						<button type="submit" class="btn btn-primary" name="update-inti">Simpan</button>
																				</form>
																					</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
					
					<h4>Keluarga Besar (Ayah/Ibu dan Saudara Sekandung/Angkat Sesuai Urutan) <button type="button" class="btn btn-primary btn-sm" id="addKeluargaBesar" alt="Tambah Keluarga Besar">Tambah</button></h4>
					<div id="addKelBesar" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-besar" action="resume.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
							<div class="form-group">
								<label for="hubungan_besar" class="col-sm-2 control-label">Hubungan Keluarga</label>
								<div class="col-sm-5">
									<?php
										$queryHubunganKeluarga2 = "SELECT * FROM hubunganKeluarga";
										$execHubunganKeluarga2 = mysql_query($queryHubunganKeluarga2);
									?>
									<select name="hubungan_besar" id="hubungan_besar" class="form-control">
										<?php
											while($resultHubunganKeluarga2 = mysql_fetch_array($execHubunganKeluarga2))
											{
												?>
													<option value="<?php echo $resultHubunganKeluarga2['gradeHubungan'];?>"><?php echo $resultHubunganKeluarga2['namaHubungan'];?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_besar" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-5">
									<input type="text" name="nama_besar" class="form-control" id="nama_besar" placeholder="Nama Anggota Keluarga" required>
								</div>
							</div>
							<div class="form-group">
								<label for="gender_besar" class="col-sm-2 control-label">Jenis Kelamin</label>
								<div class="col-sm-5">
									<label class="radio-inline"><input type="radio" name="gender_besar" id="genderPa" value="Laki-Laki" default>Laki-Laki</label>
									<label class="radio-inline"><input type="radio" name="gender_besar" id="genderPi" value="Perempuan">Perempuan</label>
								</div>
							</div>
							<div class="form-group">
								<label for="tempatLahir_besar" class="col-sm-2 control-label">Tempat Lahir</label>
								<div class="col-sm-5">
									<input type="text" name="tempatLahir_besar" class="form-control" id="tempatLahir_besar" placeholder="Tempat Lahir" required>
								</div>
							</div>
							<div class="form-group">
								<label for="birthday_besar" class="col-sm-2 control-label">Tanggal Lahir</label>
								<div class="col-sm-5">
									<?php $lahir2 = new DateTime($resultBirthdayBesar['birthdayBesar']);?>
									<input type="date" class="form-control" name="birthday_besar" id="birthday_besar" placeholder="Tanggal Lahir" value="<?php echo $lahir2->format('d-m-Y'); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="pendidikan_besar" class="col-sm-2 control-label">Pendidikan</label>
								<div class="col-sm-5">
									<?php
										$queryPendidikan2 = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
										$execPendidikan2 = mysql_query($queryPendidikan2);
									?>
									<select class="form-control" name="pendidikan_besar" id="pendidikan_besar">
										<?php
											while($resultPendidikan2 = mysql_fetch_array($execPendidikan2))
											{
												?><option value="<?php echo $resultPendidikan2['gradePendidikan'];?>"><?php echo $resultPendidikan2['namaPendidikan'];?></option><?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="pekerjaan_besar" class="col-sm-2 control-label">Bidang Pekerjaan</label>
								<div class="col-sm-5">
									<input type="text" name="pekerjaan_besar" class="form-control" id="pekerjaan_besar" placeholder="Bidang Pekerjaan" required>
								</div>
							</div>
							<div class="form-group">
								<label for="perusahaan_besar" class="col-sm-2 control-label">Nama Perusahaan</label>
								<div class="col-sm-5">
									<input type="text" name="perusahaan_besar" class="form-control" id="perusahaan_besar" placeholder="Nama Perusahaan">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="saveBesar" name="saveBesar">Simpan</button> 
									<button type="button" class="btn btn-default" id="batalBesar">Batal</button>
								</div>
							</div>
						</form>
					</div>
					
					<div id="listBesar" class="show-list row">
						<div class="table-responsive">
							<div class="col-sm-9">
								<?php
									$queryShowBesar = "SELECT kb.idBesar, kb.hubunganBesar, hk.namaHubungan, kb.namaBesar, kb.genderBesar, kb.tempatLahirBesar, kb.birthdayBesar, kb.pendidikanBesar, tp.namaPendidikan, 
													kb.pekerjaanBesar, kb.perusahaanBesar FROM keluargaBesar kb ";
									$queryShowBesar .= "JOIN hubunganKeluarga hk ON hk.gradeHubungan = kb.hubunganBesar ";
									$queryShowBesar .= "JOIN tingkatPendidikan tp ON tp.gradePendidikan = kb.pendidikanBesar ";
									$queryShowBesar .= "WHERE idWorker = $idWorker";
									
									$execShowBesar = mysql_query($queryShowBesar) or die();
									if(mysql_num_rows($execShowBesar) > 0 )
									{ 
										?>
											<table class="table table-condensed table-hover">
												<thead><th>Status Hubungan</th><th>Nama</th><th>Jenis Kelamin</th><th>Tempat Lahir</th><th>Tanggal Lahir</th><th>Pendidikan</th><th>Pekerjaan</th><th>Perusahaan</th><th></th></thead>
												<tbody>
													<?php 
														while($resultShowBesar = mysql_fetch_array($execShowBesar))
														{
															?>	
																<tr>
																	<td>
																		<?php echo $resultShowBesar['namaHubungan'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBesar['namaBesar'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBesar['genderBesar'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBesar['tempatLahirBesar'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBesar['birthdayBesar'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBesar['namaPendidikan'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBesar['pekerjaanBesar'];?>
																	</td>
																	<td>
																		<?php echo $resultShowBesar['perusahaanBesar'];?>
																	</td>
																	<td>
																		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#update-besar<?php echo $resultShowBesar['idBesar'];?>">Edit</button> 
																		<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-besar<?php echo $resultShowBesar['idBesar'];?>">Delete</button>
																	</td>
																</tr>
																
																<!-- Modal DELETE Keluarga Besar -->
																<div class="modal fade" id="delete-besar<?php echo $resultShowBesar['idBesar'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-besar<?php echo $resultShowBesar['idBesar'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-delete-besar<?php echo $resultShowBesar['idBesar'];?>"><?php echo $resultShowBesar['namaHubungan'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" method="post">
																					<input type="hidden" name="id-besar" value="<?php echo $resultShowBesar['idBesar'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary" name="delete-besar">Hapus</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>

																<!-- Modal Update Keluarga Besar -->
																<div class="modal fade" id="update-besar<?php echo $resultShowBesar['idBesar'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-update-besar<?php echo $resultShowBesar['idBesar'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-update-besar<?php echo $resultShowBesar['idBesar'];?>"><?php echo $resultShowBesar['namaHubungan'];?></h4>
																			</div>
																			<div class="modal-body">
																				<form action="resume.php" method="post" id="form-update-besar<?php echo $resultShowBesar['idBesar'];?>" role="form">
																					<input type="hidden" name="id-besar" value="<?php echo $resultShowBesar['idBesar'];?>">
																					<div class="form-group">
																						<label for="hubungan-besar<?php echo $resultShowBesar['idBesar'];?>">Status Hubungan</label>
																						<select name="hubungan-besar" id="hubungan-besar<?php echo $resultShowBesar['idBesar'];?>" class="form-control">
																							<?php 
																								$queryStatusHubungan2 = "SELECT * FROM hubunganKeluarga";
																								$execStatusHubungan2 = mysql_query($queryStatusHubungan2);
																								while($StatusHubungan2 = mysql_fetch_array($execStatusHubungan2))
																								{
																									?><option value="<?php echo $StatusHubungan2['gradeHubungan'];?>" <?php if($StatusHubungan2['gradeHubungan'] == $resultShowBesar['hubunganBesar']){ echo "selected";}?>><?php echo $StatusHubungan2['namaHubungan'];?></option><?php 
																								}
																							?>
																						</select>
																					</div>
																					<div class="form-group">
																						<label for="nama-besar<?php echo $resultShowBesar['idBesar'];?>">Nama</label>
																						<input type="text" name="nama-besar" id="nama-besar<?php echo $resultShowBesar['idBesar'];?>" class="form-control" value="<?php echo $resultShowBesar['namaBesar'];?>">
																					</div>
																					<div class="form-group">
																						<label for="gender-besar<?php echo $resultShowBesar['idBesar'];?>">Jenis Kelamin</label>
																						<input type="text" name="gender-besar" id="gender-besar<?php echo $resultShowBesar['idBesar'];?>" class="form-control" value="<?php echo $resultShowBesar['genderBesar'];?>">
																					</div>
																					<div class="form-group">
																						<label for="tempatLahir-besar<?php echo $resultShowBesar['idBesar'];?>">Tempat Lahir</label>
																						<input type="text" name="tempatLahir-besar" id="tempatLahir-besar<?php echo $resultShowBesar['idBesar'];?>" class="form-control" value="<?php echo $resultShowBesar['tempatLahirBesar'];?>">
																					</div>
																					<div class="form-group">
																						<label for="birthday-besar<?php echo $resultShowBesar['idBesar'];?>">Tanggal Lahir</label>
																						<input type="text" name="birthday-besar" id="birthday-besar<?php echo $resultShowBesar['idBesar'];?>" class="form-control" value="<?php echo $resultShowBesar['birthdayBesar'];?>">
																					</div>
																					<div class="form-group">
																						<label for="pendidikan-besar<?php echo $resultShowBesar['idBesar'];?>">Pendidikan</label>
																						<select name="pendidikan-besar" id="pendidikan-besar<?php echo $resultShowBesar['idBesar'];?>" class="form-control">
																							<?php 
																								$execPendBesar = mysql_query($queryPendidikan2);
																								while($listPendBesar = mysql_fetch_array($execPendBesar))
																								{
																									?><option value="<?php echo $listPendBesar['gradePendidikan'];?>" <?php if($listPendBesar['gradePendidikan'] == $resultShowBesar['pendidikanBesar']){ echo "selected";}?>><?php echo $listPendBesar['namaPendidikan'];?></option><?php
																								}
																							?>
																						</select>
																					</div>
																					<div class="form-group">
																						<label for="pekerjaan-besar<?php echo $resultShowBesar['idBesar'];?>">Bidang Pekerjaan</label>
																						<input type="text" name="pekerjaan-besar" id="pekerjaan-besar<?php echo $resultShowBesar['idBesar'];?>" class="form-control" value="<?php echo $resultShowBesar['pekerjaanBesar'];?>">
																					</div>
																					<div class="form-group">
																						<label for="perusahaan-besar<?php echo $resultShowBesar['idBesar'];?>">Nama Perusahaan</label>
																						<input type="text" name="perusahaan-besar" id="perusahaan-besar<?php echo $resultShowBesar['idBesar'];?>" class="form-control" value="<?php echo $resultShowBesar['perusahaanBesar'];?>">
																					</div>
																			</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																						<button type="submit" class="btn btn-primary" name="update-besar">Simpan</button>
																				</form>
																					</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
					
					<h4>Pihak Yang Bisa Dihubungi Dalam Kondisi Darurat(Keluarga/Sahabat/Teman/Lain-Lain) <button type="button" class="btn btn-primary btn-sm" id="addKeluargaDarurat" alt="Tambah Pihak Darurat">Tambah</button></h4>
					<div id="addKelDarurat" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-darurat" action="resume.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
							<div class="form-group">
								<label for="hubungan_darurat" class="col-sm-2 control-label">Status Hubungan</label>
								<div class="col-sm-5">
									<?php
										$queryHubunganDarurat = "SELECT * FROM hubunganDarurat";
										$execHubunganDarurat = mysql_query($queryHubungaDarurat);
									?>
									<select name="hubungan_darurat" id="hubungan_darurat" class="form-control">
										<?php
											while($resultHubunganDarurat = mysql_fetch_array($execHubunganDarurat))
											{
												?>
													<option value="<?php echo $resultHubunganDarurat['gradeHubunganDarurat'];?>"><?php echo $resultHubunganDarurat['namaHubunganDarurat'];?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_darurat" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-5">
									<input type="text" name="nama_darurat" class="form-control" id="nama_darurat" placeholder="Nama Pihak Ybs" required>
								</div>
							</div>
							<div class="form-group">
								<label for="gender_darurat" class="col-sm-2 control-label">Jenis Kelamin</label>
								<div class="col-sm-5">
									<label class="radio-inline"><input type="radio" name="gender_darurat" id="genderPa" value="Laki-Laki" default>Laki-Laki</label>
									<label class="radio-inline"><input type="radio" name="gender_darurat" id="genderPi" value="Perempuan">Perempuan</label>
								</div>
							</div>
							<div class="form-group">
								<label for="alamat_darurat" class="col-sm-2 control-label">Alamat</label>
								<div class="col-sm-5">
									<textarea name="alamat_darurat" id="alamat_darurat" rows="3" class="form-control" placeholder="Alamat" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="noTelp_darurat" class="col-sm-2 control-label">Nomor Ponsel</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">+62</div>
										<input type="tel" class="form-control" name="noTelp_darurat" id="noTelp_darurat" placeholder="Nomor Telepon">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="pekerjaan_darurat" class="col-sm-2 control-label">Bidang Pekerjaan</label>
								<div class="col-sm-5">
									<input type="text" name="pekerjaan_darurat" class="form-control" id="pekerjaan_darurat" placeholder="Bidang Pekerjaan" required>
								</div>
							</div>
							<div class="form-group">
								<label for="perusahaan_darurat" class="col-sm-2 control-label">Nama Perusahaan</label>
								<div class="col-sm-5">
									<input type="text" name="perusahaan_darurat" class="form-control" id="perusahaan_darurat" placeholder="Nama Perusahaan">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="saveDarurat" name="saveDarurat">Simpan</button> 
									<button type="button" class="btn btn-default" id="batalDarurat">Batal</button>
								</div>
							</div>
						</form>
					</div>
					
					
				</div><!-- Families end -->

				<!-- Minat kerja start -->
				<div role="tabpanel" class="tab-pane <?php if($tab == 'minat'){ echo 'active'; }?>" id="minat">
						<form class="form-horizontal" role="form" action="resume.php" method="post">
							<input type="hidden" name="id-worker" value="<?php echo $idWorker;?>">
							<div class="form-group">
								<label for="minat_cita" class="col-sm-2 control-label">Cita-Cita</label>
								<div class="col-sm-4">
									<textarea name="minat_cita" id="minat_cita" rows="3" class="form-control" placeholder="Uraikan dengan singkat!"><?php echo $resultGetUser['citaCita'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_motivasi" class="col-sm-2 control-label">Motivasi Utama Bekerja</label>
								<div class="col-sm-4">
									<textarea name="minat_motivasi" id="minat_motivasi" rows="3" class="form-control" placeholder="Uraikan dengan singkat!"><?php echo $resultGetUser['motivasiBekerja'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_alasan" class="col-sm-2 control-label">Alasan Bekerja</label>
								<div class="col-sm-4">
									<textarea name="minat_alasan" id="minat_alasan" rows="3" class="form-control" placeholder="Uraikan dengan singkat!"><?php echo $resultGetUser['alasanBekerja'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="mgaji" class="col-sm-2 control-label">Minimal Gaji Yang Diharapkan</label>
								<div class="col-sm-4">
									<div class="input-group">
										<div class="input-group-addon"><u>+</u> Rp</div>
										<input type="text" class="form-control" name="mgaji" id="mgaji" placeholder="Minimal gaji yang diharapkan" value="<?php echo $resultGetUser['minimalGaji'];?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_nego" class="col-sm-2 control-label">Negotiable/Tidak</label>
								<div class="col-sm-4">
									<label class="radio-inline"><input type="radio" name="minat_nego" id="minat_negoIya" <?php if($resultGetUser['negosiasiGaji'] == "Negotiable"){ echo "checked";}?> value="Negotiable" default>Negotiable</label>
									<label class="radio-inline"><input type="radio" name="minat_nego" id="minat_negoTidak" <?php if($resultGetUser['negosiasiGaji'] == "Tidak"){ echo "checked";}?> value="Tidak">Tidak</label>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_fasilitas" class="col-sm-2 control-label">Fasilitas/Tunjangan Yang Diharapkan</label>
								<div class="col-sm-4">
									<textarea name="minat_fasilitas" id="minat_fasilitas" rows="3" class="form-control" placeholder="Sebutkan dengan poin-poin!"><?php echo $resultGetUser['tunjanganFasilitas'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_waktu" class="col-sm-2 control-label">Waktu Mulai Bekerja Jika Diterima</label>
								<div class="col-sm-4">
									<?php $waktuMulai = new DateTime($resultGetUser['waktuBekerja']);?>
									<input type="date" class="form-control" name="minat_waktu" id="minat_waktu" placeholder="Waktu mulai bekerja jika diterima" value="<?php echo $waktuMulai->format('d-m-Y'); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="jenis-pekerjaan" class="col-sm-2 control-label">Jenis Pekerjaan Yang Dicari</label>
								<div class="col-sm-4">
									<?php
										$queryKategoriKerja = "SELECT * FROM kategoriKerja ORDER BY namaKategori ASC";
										$execKategoriKerja = mysql_query($queryKategoriKerja);
									?>
									<select name="jenis-pekerjaan" id="jenis-pekerjaan" class="form-control">
										<?php
											while($resultKategoriKerja = mysql_fetch_array($execKategoriKerja))
											{
												?>
													<option value="<?php echo $resultKategoriKerja['idKategori'];?>"<?php if($resultGetUser['cariKerja'] == $resultKategoriKerja['idKategori']){ echo " selected";}?>><?php echo $resultKategoriKerja['namaKategori'];?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="jenis-pekerjaan-1" class="col-sm-2 control-label">Prioritas Jenis Pekerjaan Yang Disukai</label>
								<div class="col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">1.</div>
										<select name="jenis-pekerjaan-1" id="jenis-pekerjaan-1" class="form-control">
											<option value="" disabled>-- Pilih jenis pekerjaan yang disukai --</option>
											<?php
												$queryJenisPekerjaan = "SELECT * FROM jenisPekerjaan ORDER BY namaJenisPekerjaan ASC";
												$execJenisPekerjaan = mysql_query($queryJenisPekerjaan);
												while($resultJenisPekerjaan = mysql_fetch_array($execJenisPekerjaan))
												{
													?><option value="<?php echo $resultJenisPekerjaan['idJenisPekerjaan'];?>"<?php if($resultGetUser['jenisPekerjaanDisukai1'] == $resultJenisPekerjaan['idJenisPekerjaan']){ echo " selected";}?>><?php echo $resultJenisPekerjaan['namaJenisPekerjaan'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">2.</div>
										<select name="jenis-pekerjaan-2" id="jenis-pekerjaan-2" class="form-control">
											<option value="" disabled>-- Pilih jenis pekerjaan yang disukai --</option>
											<?php
												$execJenisPekerjaan2 = mysql_query($queryJenisPekerjaan);
												while($resultJenisPekerjaan2 = mysql_fetch_array($execJenisPekerjaan2))
												{
													?><option value="<?php echo $resultJenisPekerjaan2['idJenisPekerjaan'];?>"<?php if($resultGetUser['jenisPekerjaanDisukai2'] == $resultJenisPekerjaan2['idJenisPekerjaan']){ echo " selected";}?>><?php echo $resultJenisPekerjaan2['namaJenisPekerjaan'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">3.</div>
										<select name="jenis-pekerjaan-3" id="jenis-pekerjaan-3" class="form-control">
											<option value="" disabled>-- Pilih jenis pekerjaan yang disukai --</option>
											<?php
												$execJenisPekerjaan3 = mysql_query($queryJenisPekerjaan);
												while($resultJenisPekerjaan3 = mysql_fetch_array($execJenisPekerjaan3))
												{
													?><option value="<?php echo $resultJenisPekerjaan3['idJenisPekerjaan'];?>"<?php if($resultGetUser['jenisPekerjaanDisukai3'] == $resultJenisPekerjaan3['idJenisPekerjaan']){ echo " selected";}?>><?php echo $resultJenisPekerjaan3['namaJenisPekerjaan'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">4.</div>
										<select name="jenis-pekerjaan-4" id="jenis-pekerjaan-4" class="form-control">
											<option value="" disabled>-- Pilih jenis pekerjaan yang disukai --</option>
											<?php
												$execJenisPekerjaan4 = mysql_query($queryJenisPekerjaan);
												while($resultJenisPekerjaan4 = mysql_fetch_array($execJenisPekerjaan4))
												{
													?><option value="<?php echo $resultJenisPekerjaan4['idJenisPekerjaan'];?>"<?php if($resultGetUser['jenisPekerjaanDisukai4'] == $resultJenisPekerjaan4['idJenisPekerjaan']){ echo " selected";}?>><?php echo $resultJenisPekerjaan4['namaJenisPekerjaan'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">5.</div>
										<select name="jenis-pekerjaan-5" id="jenis-pekerjaan-5" class="form-control">
											<option value="" disabled>-- Pilih jenis pekerjaan yang disukai --</option>
											<?php
												$execJenisPekerjaan5 = mysql_query($queryJenisPekerjaan);
												while($resultJenisPekerjaan5 = mysql_fetch_array($execJenisPekerjaan5))
												{
													?><option value="<?php echo $resultJenisPekerjaan5['idJenisPekerjaan'];?>"<?php if($resultGetUser['jenisPekerjaanDisukai5'] == $resultJenisPekerjaan5['idJenisPekerjaan']){ echo " selected";}?>><?php echo $resultJenisPekerjaan5['namaJenisPekerjaan'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="lingkungan-kerja-1" class="col-sm-2 control-label">Prioritas Lingkungan Kerja Yang Disukai</label>
								<div class="col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">1.</div>
										<select name="lingkungan-kerja-1" id="lingkungan-kerja-1" class="form-control">
											<option value="" disabled>-- Pilih lingkungan kerja yang disukai --</option>
											<?php
												$queryLingkunganKerja = "SELECT * FROM lingkunganKerja ORDER BY namaLingkunganKerja ASC";
												$execLingkunganKerja1 = mysql_query($queryLingkunganKerja);
												while($resultLingkunganKerja1 = mysql_fetch_array($execLingkunganKerja1))
												{
													?><option value="<?php echo $resultLingkunganKerja1['idLingkunganKerja'];?>"<?php if($resultGetUser['lingKerDisukai1'] == $resultLingkunganKerja1['idLingkunganKerja']){ echo " selected";}?>><?php echo $resultLingkunganKerja1['namaLingkunganKerja'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">2.</div>
										<select name="lingkungan-kerja-2" id="lingkungan-kerja-2" class="form-control">
											<option value="" disabled>-- Pilih lingkungan kerja yang disukai --</option>
											<?php
												$execLingkunganKerja2 = mysql_query($queryLingkunganKerja);
												while($resultLingkunganKerja2 = mysql_fetch_array($execLingkunganKerja2))
												{
													?><option value="<?php echo $resultLingkunganKerja2['idLingkunganKerja'];?>"<?php if($resultGetUser['lingKerDisukai2'] == $resultLingkunganKerja2['idLingkunganKerja']){ echo " selected";}?>><?php echo $resultLingkunganKerja2['namaLingkunganKerja'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">3.</div>
										<select name="lingkungan-kerja-3" id="lingkungan-kerja-3" class="form-control">
											<option value="" disabled>-- Pilih lingkungan kerja yang disukai --</option>
											<?php
												$execLingkunganKerja3 = mysql_query($queryLingkunganKerja);
												while($resultLingkunganKerja3 = mysql_fetch_array($execLingkunganKerja3))
												{
													?><option value="<?php echo $resultLingkunganKerja3['idLingkunganKerja'];?>"<?php if($resultGetUser['lingKerDisukai3'] == $resultLingkunganKerja3['idLingkunganKerja']){ echo " selected";}?>><?php echo $resultLingkunganKerja3['namaLingkunganKerja'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">4.</div>
										<select name="lingkungan-kerja-4" id="lingkungan-kerja-4" class="form-control">
											<option value="" disabled>-- Pilih lingkungan kerja yang disukai --</option>
											<?php
												$execLingkunganKerja4 = mysql_query($queryLingkunganKerja);
												while($resultLingkunganKerja4 = mysql_fetch_array($execLingkunganKerja4))
												{
													?><option value="<?php echo $resultLingkunganKerja4['idLingkunganKerja'];?>"<?php if($resultGetUser['lingKerDisukai4'] == $resultLingkunganKerja4['idLingkunganKerja']){ echo " selected";}?>><?php echo $resultLingkunganKerja4['namaLingkunganKerja'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">5.</div>
										<select name="lingkungan-kerja-5" id="lingkungan-kerja-5" class="form-control">
											<option value="" disabled>-- Pilih lingkungan kerja yang disukai --</option>
											<?php
												$execLingkunganKerja5 = mysql_query($queryLingkunganKerja);
												while($resultLingkunganKerja5 = mysql_fetch_array($execLingkunganKerja5))
												{
													?><option value="<?php echo $resultLingkunganKerja5['idLingkunganKerja'];?>"<?php if($resultGetUser['lingKerDisukai5'] == $resultLingkunganKerja5['idLingkunganKerja']){ echo " selected";}?>><?php echo $resultLingkunganKerja5['namaLingkunganKerja'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">6.</div>
										<select name="lingkungan-kerja-6" id="lingkungan-kerja-6" class="form-control">
											<option value="" disabled>-- Pilih lingkungan kerja yang disukai --</option>
											<?php
												$execLingkunganKerja6 = mysql_query($queryLingkunganKerja);
												while($resultLingkunganKerja6 = mysql_fetch_array($execLingkunganKerja6))
												{
													?><option value="<?php echo $resultLingkunganKerja6['idLingkunganKerja'];?>"<?php if($resultGetUser['lingKerDisukai6'] == $resultLingkunganKerja6['idLingkunganKerja']){ echo " selected";}?>><?php echo $resultLingkunganKerja6['namaLingkunganKerja'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="lokasi-kerja-1" class="col-sm-2 control-label">Prioritas Lokasi Tempat Kerja Yang Diharapkan</label>
								<div class="col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">1.</div>
										<select name="lokasi-kerja-1" id="lokasi-kerja-1" class="form-control">
											<option value="" disabled>-- Pilih daerah yang diinginkan --</option>
											<?php
												$queryProvinsi = "SELECT * FROM tableProvinsi";
												$execProvinsi1 = mysql_query($queryProvinsi);
												while($resultProvinsi1 = mysql_fetch_array($execProvinsi1))
												{ 
													?><option value="<?php echo $resultProvinsi1['idProvinsi'];?>"<?php if($resultGetUser['lokasiKerja1'] == $resultProvinsi1['idProvinsi']){ echo " selected";}?>><?php echo $resultProvinsi1['namaProvinsi'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">2.</div>
										<select name="lokasi-kerja-2" id="lokasi-kerja-2" class="form-control">
												<option value="" disabled>-- Pilih daerah yang diinginkan --</option>
											<?php
												$execProvinsi2 = mysql_query($queryProvinsi);
												while($resultProvinsi2 = mysql_fetch_array($execProvinsi2))
												{ 
													?><option value="<?php echo $resultProvinsi2['idProvinsi'];?>"<?php if($resultGetUser['lokasiKerja2'] == $resultProvinsi2['idProvinsi']){ echo " selected";}?>><?php echo $resultProvinsi2['namaProvinsi'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">3.</div>
										<select name="lokasi-kerja-3" id="lokasi-kerja-3" class="form-control">
											<option value="" disabled>-- Pilih daerah yang diinginkan --</option>
											<?php
												$execProvinsi3 = mysql_query($queryProvinsi);
												while($resultProvinsi3 = mysql_fetch_array($execProvinsi3))
												{ 
													?><option value="<?php echo $resultProvinsi3['idProvinsi'];?>"<?php if($resultGetUser['lokasiKerja3'] == $resultProvinsi3['idProvinsi']){ echo " selected";}?>><?php echo $resultProvinsi3['namaProvinsi'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="bersedia" value = "1" id="bersedia"<?php if($resultGetUser['bersedia'] == 1){ echo " checked";}?>>Bersedia untuk ditempatkan selain di ketiga tempat di atas/di luar negeri.
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_dinas" class="col-sm-2 control-label">Dinas Luar Kota Ke Kantor Cabang/Kebun</label>
								<div class="col-sm-4">
									<label class="radio-inline"><input type="radio" name="minat_dinas" id="minat_dinasIya" <?php if($resultGetUser['dinasLuarKota'] == "Bersedia"){ echo "checked";}?> value="Bersedia" default>Bersedia</label>
									<label class="radio-inline"><input type="radio" name="minat_dinas" id="minat_dinasTidak" <?php if($resultGetUser['dinasLuarKota'] == "Tidak"){ echo "checked";}?> value="Tidak">Tidak</label>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_oki" class="col-sm-2 control-label">Penempatan Di Lokasi Kebun Di OKI</label>
								<div class="col-sm-4">
									<label class="radio-inline"><input type="radio" name="minat_oki" id="minat_okiIya" <?php if($resultGetUser['penempatanOki'] == "Bersedia"){ echo "checked";}?> value="Bersedia" default>Bersedia</label>
									<label class="radio-inline"><input type="radio" name="minat_oki" id="minat_okiTidak" <?php if($resultGetUser['penempatanOki'] == "Tidak"){ echo "checked";}?> value="Tidak">Tidak</label>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_tipe" class="col-sm-2 control-label">Tipe Orang Yang Disenangi</label>
								<div class="col-sm-4">
									<textarea name="minat_tipe" id="minat_tipe" rows="3" class="form-control" placeholder="Sebutkan dengan poin-poin!"><?php echo $resultGetUser['tipeOrang'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_masalah" class="col-sm-2 control-label">Cara Menghadapi Masalah Dalam Pekerjaan</label>
								<div class="col-sm-4">
									<textarea name="minat_masalah" id="minat_masalah" rows="3" class="form-control" placeholder="Uraikan dengan singkat!"><?php echo $resultGetUser['menghadapiMasalah'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_sulit" class="col-sm-2 control-label">Hal/Kondisi Sulit Dalam Mengambil Keputusan</label>
								<div class="col-sm-4">
									<textarea name="minat_sulit" id="minat_sulit" rows="3" class="form-control" placeholder="Uraikan dengan singkat!"><?php echo $resultGetUser['kondisiSulit'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="minat_sbrInternal" class="col-sm-2 control-label">Sumber Informasi</label>
								<div class="col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">Internal</div>
										<input type="text" class="form-control"  name="minat_sbrInternal" id="minat_sbrInternal" value="<?php echo $resultGetUser['sumberData_internal'];?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-4">
									<div class="input-group">
										<div class="input-group-addon">Eksternal</div>
										<?php
											$queryReferensi = "SELECT * FROM referensiEksternal ORDER BY idRefeksternal ASC";
											$execReferensi = mysql_query($queryReferensi);
										?>
										<select name="minat_sbrEksternal" id="minat_sbrEksternal" class="form-control">
											<?php
												while($resultReferensi = mysql_fetch_array($execReferensi))
												{
													?><option value="<?php echo $resultReferensi['idRefeksternal'];?>"<?php if($resultGetUser['sumberData_eksternal'] == $resultReferensi['idRefeksternal']){ echo " selected";}?>><?php echo $resultReferensi['namaRefeksternal'];?></option><?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-8">
									<button type="submit" class="btn btn-primary" id="saveMinat" name="saveMinat">Simpan</button>
								</div>
							</div>
							<?php
								if(isset($_SESSION['suksesUpdateMinat']))
								{
									?>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-6">
												<div class="alert alert-success alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><?php echo $_SESSION['suksesUpdateMinat']; unset($_SESSION['suksesUpdateMinat']);?>
												</div>
											</div>
										</div>
									<?php
								}
							?>
						</form>
				</div><!-- Minat kerja end -->
				
				<!-- Aktifitas sosial start -->
				<div role="tabpanel" class="tab-pane <?php if($tab == 'sosial'){ echo 'active'; }?>" id="sosial">
					<h4>Apakah Saudara Memiliki Kenalan Di PT Pratama Nusantara Sakti? <button type="button" class="btn btn-primary btn-sm" id="addKen" alt="Tambah Kenalan Di Grup Perusahaan">Tambah</button></h4>
					<div id="addKenalan" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-kenalan" action="resume.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
							<div class="form-group">
								<label for="nama_kenalan" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-5">
									<input type="text" name="nama_kenalan" class="form-control" id="nama_kenalan" placeholder="Nama Kenalan">
								</div>
							</div>
							<div class="form-group">
								<label for="perusahaan_kenalan" class="col-sm-2 control-label">Perusahaan</label>
								<div class="col-sm-5">
									<input type="text" name="perusahaan_kenalan" class="form-control" id="perusahaan_kenalan" placeholder="Perusahaan Kenalan">
								</div>
							</div>
							<div class="form-group">
								<label for="jabatan_kenalan" class="col-sm-2 control-label">Jabatan</label>
								<div class="col-sm-5">
									<input type="text" name="jabatan_kenalan" class="form-control" id="jabatan_kenalan" placeholder="Jabatan Kenalan">
								</div>
							</div>
							<div class="form-group">
								<label for="noTelp_kenalan" class="col-sm-2 control-label">Nomor Telepon</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">+62</div>
										<input type="tel" class="form-control" name="noTelp_kenalan" id="noTelp_kenalan" placeholder="Nomor Telepon Kenalan" value="<?php echo substr($resultNoTelpKenalan['noTelpKenalan'], 3, 15);?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="hubungan_kenalan" class="col-sm-2 control-label">Hubungan</label>
								<div class="col-sm-5">
									<input type="text" name="hubungan_kenalan" class="form-control" id="hubungan_kenalan" placeholder="Hubungan Kenalan">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="saveKenalan" name="saveKenalan">Simpan</button> 
									<button type="button" class="btn btn-default" id="batalKenalan">Batal</button>
								</div>
							</div>
						</form>
					</div>
					
					<div id="listKenalan" class="show-list row">
						<div class="col-sm-8">
							<?php
								$queryShowKenalan = "SELECT sk.idKenalan, sk.namaKenalan, sk.perusahaanKenalan, sk.jabatanKenalan, sk.noTelpKenalan, sk.hubunganKenalan FROM sosialKenalan sk ";
								$queryShowKenalan .= "WHERE idWorker = $idWorker";
								$execShowKenalan = mysql_query($queryShowKenalan) or die();
							?>
							<div class="table-responsive">
								<?php
									if(mysql_num_rows($execShowKenalan) > 0 )
									{ 
										?>
											<table class="table table-condensed table-hover">
												<thead><th>Nama</th><th>Perusahaan</th><th>Jabatan</th><th>Nomor Telepon</th><th>Hubungan</th><th></th></thead>
												<tbody>
													<?php 
														while($resultShowKenalan = mysql_fetch_array($execShowKenalan))
														{
															?>	
																<tr>
																	<td>
																		<?php echo $resultShowKenalan['namaKenalan'];?>
																	</td>
																	<td>
																		<?php echo $resultShowKenalan['perusahaanKenalan'];?>
																	</td>
																	<td>
																		<?php echo $resultShowKenalan['jabatanKenalan'];?>
																	</td>
																	<td>
																		<?php echo $resultShowKenalan['noTelpKenalan'];?>
																	</td>
																	<td>
																		<?php echo $resultShowKenalan['hubunganKenalan'];?>
																	</td>
																	<td>
																		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#update-kenalan<?php echo $resultShowKenalan['idKenalan'];?>">Edit</button> 
																		<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-kenalan<?php echo $resultShowKenalan['idKenalan'];?>">Delete</button>
																	</td>
																</tr>
																
																<!-- Modal DELETE Kenalan -->
																<div class="modal fade" id="delete-kenalan<?php echo $resultShowKenalan['idKenalan'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-kenalan<?php echo $resultShowKenalan['idKenalan'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-delete-kenalan<?php echo $resultShowKenalan['idKenalan'];?>"><?php echo $resultShowKenalan['namaKenalan'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" method="post">
																					<input type="hidden" name="id-kenalan" value="<?php echo $resultShowKenalan['idKenalan'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary" name="delete-kenalan">Hapus</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>

																<!-- Modal Update Kenalan -->
																<div class="modal fade" id="update-kenalan<?php echo $resultShowKenalan['idKenalan'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-update-kenalan<?php echo $resultShowKenalan['idKenalan'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-update-kenalan<?php echo $resultShowKenalan['idKenalan'];?>"><?php echo $resultShowKenalan['namaKenalan'];?></h4>
																			</div>
																			<div class="modal-body">
																				<form action="resume.php" method="post" id="form-update-kenalan<?php echo $resultShowKenalan['idKenalan'];?>" role="form">
																					<input type="hidden" name="id-kenalan" value="<?php echo $resultShowKenalan['idKenalan'];?>">
																					<div class="form-group">
																						<label for="nama-kenalan<?php echo $resultShowKenalan['idKenalan'];?>">Nama Kenalan</label>
																						<input type="text" name="nama-kenalan" id="nama-kenalan<?php echo $resultShowKenalan['idKenalan'];?>" class="form-control" value="<?php echo $resultShowKenalan['namaKenalan'];?>">
																					</div>
																					<div class="form-group">
																						<label for="perusahaan-kenalan<?php echo $resultShowKenalan['idKenalan'];?>">Perusahaan Kenalan</label>
																						<input type="text" name="perusahaan-kenalan" id="perusahaan-kenalan<?php echo $resultShowKenalan['idKenalan'];?>" class="form-control" value="<?php echo $resultShowKenalan['perusahaanKenalan'];?>">
																					</div>
																					<div class="form-group">
																						<label for="jabatan-kenalan<?php echo $resultShowKenalan['idKenalan'];?>">Jabatan Kenalan</label>
																						<input type="text" name="jabatan-kenalan" id="jabatan-kenalan<?php echo $resultShowKenalan['idKenalan'];?>" class="form-control" value="<?php echo $resultShowKenalan['jabatanKenalan'];?>">
																					</div>
																					<div class="form-group">
																						<label for="noTelp-kenalan<?php echo $resultShowKenalan['idKenalan'];?>">Nomor Telepon Kenalan</label>
																						<div class="input-group">
																							<div class="input-group-addon">+62</div>
																							<input type="tel" name="noTelp-kenalan" id="noTelp-kenalan<?php echo $resultShowKenalan['idKenalan'];?>" class="form-control" value="<?php substr($resultShowKenalan['noTelpKenalan'], 3, 15);?>">
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="hubungan-kenalan<?php echo $resultShowKenalan['idKenalan'];?>">Hubungan Kenalan</label>
																						<input type="text" name="hubungan-kenalan" id="hubungan-kenalan<?php echo $resultShowKenalan['idKenalan'];?>" class="form-control" value="<?php echo $resultShowKenalan['hubunganKenalan'];?>">
																					</div>
																			</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																						<button type="submit" class="btn btn-primary" name="update-kenalan">Simpan</button>
																				</form>
																					</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
					
					<h4>Pihak Yang Dapat Memberikan Referensi Tentang Saudara <button type="button" class="btn btn-primary btn-sm" id="addRef" alt="Tambah Pemberi Referensi">Tambah</button></h4>
					<div id="addReferensi" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-referensi" action="resume.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
							<div class="form-group">
								<label for="nama_referensi" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-5">
									<input type="text" name="nama_referensi" class="form-control" id="nama_referensi" placeholder="Nama Pemberi Referensi">
								</div>
							</div>
							<div class="form-group">
								<label for="perusahaan_referensi" class="col-sm-2 control-label">Perusahaan</label>
								<div class="col-sm-5">
									<input type="text" name="perusahaan_referensi" class="form-control" id="perusahaan_referensi" placeholder="Perusahaan Pemberi Referensi">
								</div>
							</div>
							<div class="form-group">
								<label for="jabatan_referensi" class="col-sm-2 control-label">Jabatan</label>
								<div class="col-sm-5">
									<input type="text" name="jabatan_referensi" class="form-control" id="jabatan_referensi" placeholder="Jabatan Pemberi Referensi">
								</div>
							</div>
							<div class="form-group">
								<label for="noTelp_referensi" class="col-sm-2 control-label">Nomor Telepon</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">+62</div>
										<input type="tel" class="form-control" name="noTelp_referensi" id="noTelp_referensi" placeholder="Nomor Telepon Pemberi Referensi" value="<?php echo substr($resultNoTelpReferensi['noTelpReferensi'], 3, 15);?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="hubungan_referensi" class="col-sm-2 control-label">Hubungan</label>
								<div class="col-sm-5">
									<input type="text" name="hubungan_referensi" class="form-control" id="hubungan_referensi" placeholder="Hubungan Pemberi Referensi">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="saveReferensi" name="saveReferensi">Simpan</button> 
									<button type="button" class="btn btn-default" id="batalReferensi">Batal</button>
								</div>
							</div>
						</form>
					</div>
					
					<div id="listReferensi" class="show-list row">
						<div class="col-sm-8">
							<?php
								$queryShowReferensi = "SELECT sr.idReferensi, sr.namaReferensi, sr.perusahaanReferensi, sr.jabatanReferensi, sr.noTelpReferensi, sr.hubunganReferensi FROM sosialReferensi sr ";
								$queryShowReferensi .= "WHERE idWorker = $idWorker";
								$execShowReferensi = mysql_query($queryShowReferensi) or die();
							?>
							<div class="table-responsive">
								<?php
									if(mysql_num_rows($execShowReferensi) > 0 )
									{ 
										?>
											<table class="table table-condensed table-hover">
												<thead><th>Nama</th><th>Perusahaan</th><th>Jabatan</th><th>Nomor Telepon</th><th>Hubungan</th><th></th></thead>
												<tbody>
													<?php 
														while($resultShowReferensi = mysql_fetch_array($execShowReferensi))
														{
															?>	
																<tr>
																	<td>
																		<?php echo $resultShowReferensi['namaReferensi'];?>
																	</td>
																	<td>
																		<?php echo $resultShowReferensi['perusahaanReferensi'];?>
																	</td>
																	<td>
																		<?php echo $resultShowReferensi['jabatanReferensi'];?>
																	</td>
																	<td>
																		<?php echo $resultShowReferensi['noTelpReferensi'];?>
																	</td>
																	<td>
																		<?php echo $resultShowReferensi['hubunganReferensi'];?>
																	</td>
																	<td>
																		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#update-referensi<?php echo $resultShowReferensi['idReferensi'];?>">Edit</button> 
																		<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-referensi<?php echo $resultShowReferensi['idReferensi'];?>">Delete</button>
																	</td>
																</tr>
																
																<!-- Modal DELETE Referensi -->
																<div class="modal fade" id="delete-referensi<?php echo $resultShowReferensi['idReferensi'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-referensi<?php echo $resultShowReferensi['idReferensi'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-delete-referensi<?php echo $resultShowReferensi['idReferensi'];?>"><?php echo $resultShowReferensi['namaReferensi'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" method="post">
																					<input type="hidden" name="id-referensi" value="<?php echo $resultShowReferensi['idReferensi'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary" name="delete-referensi">Hapus</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>

																<!-- Modal Update Referensi -->
																<div class="modal fade" id="update-referensi<?php echo $resultShowReferensi['idReferensi'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-update-referensi<?php echo $resultShowReferensi['idReferensi'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-update-referensi<?php echo $resultShowReferensi['idReferensi'];?>"><?php echo $resultShowReferensi['namaReferensi'];?></h4>
																			</div>
																			<div class="modal-body">
																				<form action="resume.php" method="post" id="form-update-referensi<?php echo $resultShowReferensi['idReferensi'];?>" role="form">
																					<input type="hidden" name="id-referensi" value="<?php echo $resultShowReferensi['idReferensi'];?>">
																					<div class="form-group">
																						<label for="nama-referensi<?php echo $resultShowReferensi['idReferensi'];?>">Nama Pemberi Referensi</label>
																						<input type="text" name="nama-referensi" id="nama-referensi<?php echo $resultShowReferensi['idReferensi'];?>" class="form-control" value="<?php echo $resultShowReferensi['namaReferensi'];?>">
																					</div>
																					<div class="form-group">
																						<label for="perusahaan-referensi<?php echo $resultShowReferensi['idReferensi'];?>">Perusahaan Pemberi Referensi</label>
																						<input type="text" name="perusahaan-referensi" id="perusahaan-referensi<?php echo $resultShowReferensi['idReferensi'];?>" class="form-control" value="<?php echo $resultShowReferensi['perusahaanReferensi'];?>">
																					</div>
																					<div class="form-group">
																						<label for="jabatan-referensi<?php echo $resultShowReferensi['idReferensi'];?>">Jabatan Pemberi Referensi</label>
																						<input type="text" name="jabatan-referensi" id="jabatan-referensi<?php echo $resultShowReferensi['idReferensi'];?>" class="form-control" value="<?php echo $resultShowReferensi['jabatanReferensi'];?>">
																					</div>
																					<div class="form-group">
																						<label for="noTelp-referensi<?php echo $resultShowReferensi['idReferensi'];?>">Nomor Telepon Pemberi Referensi</label>
																						<div class="input-group">
																							<div class="input-group-addon">+62</div>
																							<input type="tel" name="noTelp-referensi" id="noTelp-referensi<?php echo $resultShowReferensi['idReferensi'];?>" class="form-control" value="<?php substr($resultShowReferensi['noTelpReferensi'], 3, 15);?>">
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="hubungan-referensi<?php echo $resultShowReferensi['idReferensi'];?>">Hubungan Pemberi Referensi</label>
																						<input type="text" name="hubungan-referensi" id="hubungan-referensi<?php echo $resultShowReferensi['idReferensi'];?>" class="form-control" value="<?php echo $resultShowReferensi['hubunganReferensi'];?>">
																					</div>
																			</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																						<button type="submit" class="btn btn-primary" name="update-referensi">Simpan</button>
																				</form>
																					</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
					
					<h4>Pengalaman Organisasi <button type="button" class="btn btn-primary btn-sm" id="addOrg" alt="Tambah Pengalaman Organisasi">Tambah</button></h4>
					<div id="addOrganisasi" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-organisasi" action="resume.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
							<div class="form-group">
								<label for="nama_organisasi" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-5">
									<input type="text" name="nama_organisasi" class="form-control" id="nama_organisasi" placeholder="Nama Organisasi">
								</div>
							</div>
							<div class="form-group">
								<label for="bidang_organisasi" class="col-sm-2 control-label">Bergerak Di Bidang</label>
								<div class="col-sm-5">
									<input type="text" name="bidang_organisasi" class="form-control" id="bidang_organisasi" placeholder="Bidang Organisasi">
								</div>
							</div>
							<div class="form-group">
								<label for="lokasi_organisasi" class="col-sm-2 control-label">Lokasi</label>
								<div class="col-sm-5">
									<input type="text" name="lokasi_organisasi" class="form-control" id="lokasi_organisasi" placeholder="Lokasi Organisasi">
								</div>
							</div>
							<div class="form-group">
								<label for="jabatan_organisasi" class="col-sm-2 control-label">Jabatan</label>
								<div class="col-sm-5">
									<input type="text" name="jabatan_organisasi" class="form-control" id="jabatan_organisasi" placeholder="Jabatan Organisasi">
								</div>
							</div>
							<div class="form-group">
								<label for="tahun_organisasi" class="col-sm-2 control-label">Tahun</label>
								<div class="col-sm-5">
									<input type="number" name="tahun_organisasi" class="form-control" id="tahun_organisasi" placeholder="Tahun Organisasi">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="saveOrganisasi" name="saveOrganisasi">Simpan</button> 
									<button type="button" class="btn btn-default" id="batalOrganisasi">Batal</button>
								</div>
							</div>
						</form>
					</div>
					
					<div id="listOrganisasi" class="show-list row">
						<div class="col-sm-8">
							<?php
								$queryShowOrganisasi = "SELECT so.idOrganisasi, so.namaOrganisasi, so.bidangOrganisasi, so.lokasiOrganisasi, so.jabatanOrganisasi, so.tahunOrganisasi FROM sosialOrganisasi so ";
								$queryShowOrganisasi .= "WHERE idWorker = $idWorker";
								$execShowOrganisasi = mysql_query($queryShowOrganisasi) or die();
							?>
							<div class="table-responsive">
								<?php
									if(mysql_num_rows($execShowOrganisasi) > 0 )
									{ 
										?>
											<table class="table table-condensed table-hover">
												<thead><th>Nama</th><th>Bergerak Di Bidang</th><th>Lokasi</th><th>Jabatan</th><th>Tahun</th><th></th></thead>
												<tbody>
													<?php 
														while($resultShowOrganisasi = mysql_fetch_array($execShowOrganisasi))
														{
															?>	
																<tr>
																	<td>
																		<?php echo $resultShowOrganisasi['namaOrganisasi'];?>
																	</td>
																	<td>
																		<?php echo $resultShowOrganisasi['bidangOrganisasi'];?>
																	</td>
																	<td>
																		<?php echo $resultShowOrganisasi['lokasiOrganisasi'];?>
																	</td>
																	<td>
																		<?php echo $resultShowOrganisasi['jabatanOrganisasi'];?>
																	</td>
																	<td>
																		<?php echo $resultShowOrganisasi['tahunOrganisasi'];?>
																	</td>
																	<td>
																		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#update-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>">Edit</button> 
																		<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>">Delete</button>
																	</td>
																</tr>
																
																<!-- Modal DELETE Organisasi -->
																<div class="modal fade" id="delete-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-delete-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>"><?php echo $resultShowOrganisasi['namaOrganisasi'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" method="post">
																					<input type="hidden" name="id-organisasi" value="<?php echo $resultShowOrganisasi['idOrganisasi'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary" name="delete-organisasi">Hapus</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>

																<!-- Modal Update Organisasi -->
																<div class="modal fade" id="update-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-update-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-update-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>"><?php echo $resultShowOrganisasi['namaOrganisasi'];?></h4>
																			</div>
																			<div class="modal-body">
																				<form action="resume.php" method="post" id="form-update-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>" role="form">
																					<input type="hidden" name="id-organisasi" value="<?php echo $resultShowOrganisasi['idOrganisasi'];?>">
																					<div class="form-group">
																						<label for="nama-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>">Nama</label>
																						<input type="text" name="nama-organisasi" id="nama-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>" class="form-control" value="<?php echo $resultShowOrganisasi['namaOrganisasi'];?>">
																					</div>
																					<div class="form-group">
																						<label for="bidang-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>">Bergerak Di Bidang</label>
																						<input type="text" name="bidang-organisasi" id="bidang-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>" class="form-control" value="<?php echo $resultShowOrganisasi['bidangOrganisasi'];?>">
																					</div>
																					<div class="form-group">
																						<label for="lokasi-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>">Lokasi</label>
																						<input type="text" name="lokasi-organisasi" id="lokasi-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>" class="form-control" value="<?php echo $resultShowOrganisasi['lokasiOrganisasi'];?>">
																					</div>
																					<div class="form-group">
																						<label for="jabatan-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>">Jabatan</label>
																						<input type="text" name="jabatan-organisasi" id="jabatan-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>" class="form-control" value="<?php echo $resultShowOrganisasi['jabatanOrganisasi'];?>">
																					</div>
																					<div class="form-group">
																						<label for="tahun-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>">Tahun</label>
																						<input type="number" name="tahun-organisasi" id="tahun-organisasi<?php echo $resultShowOrganisasi['idOrganisasi'];?>" class="form-control" value="<?php echo $resultShowOrganisasi['tahunOrganisasi'];?>">
																					</div>
																			</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																						<button type="submit" class="btn btn-primary" name="update-organisasi">Simpan</button>
																				</form>
																					</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
					
					<h4>Psikotest Yang Pernah Diikuti <button type="button" class="btn btn-primary btn-sm" id="addPsi" alt="Tambah Psikotest">Tambah</button></h4>
					<div id="addPsikotest" style="display:none!important;" class="row">
						<form class="form-horizontal" role="form" id="form-psikotest" action="resume.php" method="post">
							<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
							<div class="form-group">
								<label for="waktu_psikotest" class="col-sm-2 control-label">Tahun</label>
								<div class="col-sm-5">
									<input type="number" name="waktu_psikotest" class="form-control" id="waktu_psikotest" placeholder="Waktu Psikotest">
								</div>
							</div>
							<div class="form-group">
								<label for="penyelenggara_psikotest" class="col-sm-2 control-label">Penyelenggara</label>
								<div class="col-sm-5">
									<input type="text" name="penyelenggara_psikotest" class="form-control" id="penyelenggara_psikotest" placeholder="Penyelenggara Psikotest">
								</div>
							</div>
							<div class="form-group">
								<label for="tempat_psikotest" class="col-sm-2 control-label">Tempat</label>
								<div class="col-sm-5">
									<input type="text" name="tempat_psikotest" class="form-control" id="tempat_psikotest" placeholder="Tempat Psikotest">
								</div>
							</div>
							<div class="form-group">
								<label for="tujuan_psikotest" class="col-sm-2 control-label">Tujuan</label>
								<div class="col-sm-5">
									<input type="text" name="tujuan_psikotest" class="form-control" id="tujuan_psikotest" placeholder="Tujuan Psikotest">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="savePsikotest" name="savePsikotest">Simpan</button> 
									<button type="button" class="btn btn-default" id="batalPsikotest">Batal</button>
								</div>
							</div>
						</form>
					</div>
					
					<div id="listPsikotest" class="show-list row">
						<div class="col-sm-8">
							<?php
								$queryShowPsikotest = "SELECT sp.idPsikotest, sp.waktuPsikotest, sp.penyelenggaraPsikotest, sp.tempatPsikotest, sp.tujuanPsikotest FROM sosialPsikotest sp ";
								$queryShowPsikotest .= "WHERE idWorker = $idWorker";
								$execShowPsikotest = mysql_query($queryShowPsikotest) or die();
							?>
							<div class="table-responsive">
								<?php
									if(mysql_num_rows($execShowPsikotest) > 0 )
									{ 
										?>
											<table class="table table-condensed table-hover">
												<thead><th>Waktu</th><th>Penyelenggara</th><th>Tempat</th><th>Tujuan</th><th></th></thead>
												<tbody>
													<?php 
														while($resultShowPsikotest = mysql_fetch_array($execShowPsikotest))
														{
															?>	
																<tr>
																	<td>
																		<?php echo $resultShowPsikotest['waktuPsikotest'];?>
																	</td>
																	<td>
																		<?php echo $resultShowPsikotest['penyelenggaraPsikotest'];?>
																	</td>
																	<td>
																		<?php echo $resultShowPsikotest['tempatPsikotest'];?>
																	</td>
																	<td>
																		<?php echo $resultShowPsikotest['tujuanPsikotest'];?>
																	</td>
																	<td>
																		<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#update-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>">Edit</button> 
																		<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>">Delete</button>
																	</td>
																</tr>
																
																<!-- Modal DELETE Psikotest -->
																<div class="modal fade" id="delete-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-delete-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>"><?php echo $resultShowPsikotest['waktuPsikotest'];?></h4>
																			</div>
																			<div class="modal-body">Apakah Anda yakin akan menghapus data ini?</div>
																			<div class="modal-footer">
																				<form action="resume.php" method="post">
																					<input type="hidden" name="id-psikotest" value="<?php echo $resultShowPsikotest['idPsikotest'];?>">
																					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																					<button type="submit" class="btn btn-primary" name="delete-psikotest">Hapus</button>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>

																<!-- Modal Update Psikotest -->
																<div class="modal fade" id="update-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-update-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content">
																			<div class="modal-header">
																				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																				<h4 class="modal-title" id="modal-update-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>"><?php echo $resultShowPsikotest['waktuPsikotest'];?></h4>
																			</div>
																			<div class="modal-body">
																				<form action="resume.php" method="post" id="form-update-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>" role="form">
																					<input type="hidden" name="id-psikotest" value="<?php echo $resultShowPsikotest['idPsikotest'];?>">
																					<div class="form-group">
																						<label for="waktu-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>">Tahun</label>
																						<input type="number" name="waktu-psikotest" id="waktu-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>" class="form-control" value="<?php echo $resultShowPsikotest['waktuPsikotest'];?>">
																					</div>
																					<div class="form-group">
																						<label for="penyelenggara-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>">Penyelenggara</label>
																						<input type="text" name="penyelenggara-psikotest" id="penyelenggara-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>" class="form-control" value="<?php echo $resultShowPsikotest['penyelenggaraPsikotest'];?>">
																					</div>
																					<div class="form-group">
																						<label for="tempat-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>">Tempat</label>
																						<input type="text" name="tempat-psikotest" id="tempat-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>" class="form-control" value="<?php echo $resultShowPsikotest['tempatPsikotest'];?>">
																					</div>
																					<div class="form-group">
																						<label for="tujuan-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>">Tujuan</label>
																						<input type="text" name="tujuan-psikotest" id="tujuan-psikotest<?php echo $resultShowPsikotest['idPsikotest'];?>" class="form-control" value="<?php echo $resultShowPsikotest['tujuanPsikotest'];?>">
																					</div>
																			</div>
																					<div class="modal-footer">
																						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																						<button type="submit" class="btn btn-primary" name="update-psikotest">Simpan</button>
																				</form>
																					</div>
																		</div>
																	</div>
																</div>
															<?php
														}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
							</div>
						</div>
					</div>
				</div> <!-- Aktifitas sosial end -->
			</div>	<!-- Tab panes end -->	
			<?php
				include("templates/foot.php");
		}
		else if(isset($_SESSION['admin']))
		{
			header("Location:../admin/");
		}
	}
?>