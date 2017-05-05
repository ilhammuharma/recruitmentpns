<?php
	session_start();
	$title = "fptk";
	include("../assets/dbconfig.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
		{
			include("templates/head.php");
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
			
			$idLogin = $_SESSION['idLogin'];
			//$tab = "";
			$queryGetUser = "SELECT * FROM userWorker WHERE idLogin = '$idLogin'";
			$execGetUser = mysql_query($queryGetUser);
			$resultGetUser = mysql_fetch_array($execGetUser);
			$idWorker = $resultGetUser['idWorker'];
				
			//include("templates/head.php");
			if(isset($_POST['saveFptk']))
			{
				$idWorker = $_POST['idWorker'];
				$pemohonNama = $_POST['pemohonNama'];
				$pemohonNik = $_POST['pemohonNik'];
				$pemohonPosisi = $_POST['pemohonPosisi'];
				$pemohonPosisiBaru = $_POST['pemohonPosisiBaru'];
				$pemohonDepartemen = $_POST['pemohonDepartemen'];
					
				$posisiDivisi = $_POST['posisiDivisi'];
				$posisiDepartemen = $_POST['posisiDepartemen'];
				$posisiJabatan = $_POST['posisiJabatan'];
				$posisiJabatanBaru = $_POST['posisiJabatanBaru'];
				$posisiLevel = $_POST['posisiLevel'];
				$posisiLokasi = $_POST['posisiLokasi'];
				$posisiJumlah = $_POST['posisiJumlah'];
				if($_POST['posisiTujuan'] == "")
				{
					$posisiTujuan = "Rekrut Baru";
				}
				else
				{
					$posisiTujuan = $_POST['posisiTujuan'];
				}
				$posisiPengganti = $_POST['posisiPengganti'];
				/*if($_POST['posisiMpp'] == "")
				{
					$posisiMpp = "Ya";
				}
				else
				{
					$posisiMpp = $_POST['posisiMpp'];
				}*/
				$posisiKeterangan = $_POST['posisiKeterangan'];
				$posisiTanggal = date('Y-m-d', strtotime($_POST['posisiTanggal']));
				if($_POST['posisiJobdes'] == "")
				{
					$posisiJobdes = "Ada";
				}
				else
				{
					$posisiJobdes = $_POST['posisiJobdes'];
				}
				if($_POST['posisiStatus'] == "")
				{
					$posisiStatus = "Bulanan";
				}
				else
				{
					$posisiStatus = $_POST['posisiStatus'];
				}
					
				$kualifikasiJumlahl = $_POST['kualifikasiJumlahl'];
				$kualifikasiJumlahp = $_POST['kualifikasiJumlahp'];
				$kualifikasiUsia = $_POST['kualifikasiUsia'];
				$kualifikasiPendidikan = $_POST['kualifikasiPendidikan'];
				$kualifikasiJurusan = $_POST['kualifikasiJurusan'];
				$kualifikasiPengalaman = $_POST['kualifikasiPengalaman'];
				$kualifikasiLainlain = $_POST['kualifikasiLainlain'];
					
				$bulananTglditerima = date('Y-m-d', strtotime($_POST['bulananTglditerima']));
				$bulananPic = $_POST['bulananPic'];
				$bulananTglclosing = date('Y-m-d', strtotime($_POST['bulananTglclosing']));
				$bulananPemenuhan = $_POST['bulananPemenuhan'];
				$bulananKaryawan = $_POST['bulananKaryawan'];
				$bulananTglmasuk = date('Y-m-d', strtotime($_POST['bulananTglmasuk']));
				$bulananSbrinternal = $_POST['bulananSbrinternal'];
				$bulananSbreksternal = $_POST['bulananSbreksternal'];
				$bulananLaineksternal = $_POST['bulananLaineksternal'];
					
				$harianTglditerima = date('Y-m-d', strtotime($_POST['harianTglditerima']));
				$harianTglclosing = date('Y-m-d', strtotime($_POST['harianTglclosing']));
				$harianPemenuhan = $_POST['harianPemenuhan'];
				
				$waktuTahun = date('Y');
				$nomor = mysql_query("SELECT * FROM fptk WHERE nomorFptk LIKE '%$waktuTahun' ORDER BY nomorFptk DESC LIMIT 1");
				$cek_nomor = mysql_num_rows($nomor);
				if($cek_nomor=='0')
				{
					$running_num = "0001";
				}
				else
				{
					$cetak_nomor = mysql_fetch_array($nomor);
					$get_nomor = $cetak_nomor['nomorFptk'];
					$pisah_num = explode('/',$get_nomor);
					$next_num = $pisah_num['0'] +1;
					$leng_num = strlen($next_num);
					if($leng_num=='1')
					{
						$running_num = "000".$next_num;
					}
					else if($leng_num=='2')
					{
						$running_num = "00".$next_num;
					}
					else if($leng_num=='3')
					{
						$running_num = "0".$next_num;
					}
					else
					{
						$running_num = $next_num;
					}
				}
				
				$waktuBulan = date('m');
				if($waktuBulan=='01')
				{
					$running_bulan = "I";
				}
				else if($waktuBulan=='02')
				{
					$running_bulan = "II";
				}
				else if($waktuBulan=='03')
				{
					$running_bulan = "III";
				}
				else if($waktuBulan=='04')
				{
					$running_bulan = "IV";
				}
				else if($waktuBulan=='05')
				{
					$running_bulan = "V";
				}
				else if($waktuBulan=='06')
				{
					$running_bulan = "VI";
				}
				else if($waktuBulan=='07')
				{
					$running_bulan = "VII";
				}
				else if($waktuBulan=='08')
				{
					$running_bulan = "VIII";
				}
				else if($waktuBulan=='09')
				{
					$running_bulan = "IX";
				}
				else if($waktuBulan=='10')
				{
					$running_bulan = "X";
				}
				else if($waktuBulan=='11')
				{
					$running_bulan = "XI";
				}
				else if($waktuBulan=='12')
				{
					$running_bulan = "XII";
				}
				$fptkNomor = $running_num."/HRD-HO"."/".$running_bulan."/".$waktuTahun;
				
				$tanggalDibuat = date('Y-m-d');
				$pembuat=$_SESSION['username'];
				
				//$fptkBulan = $_POST['$running_bulan'];
				//$fptkBulan = $running_bulan;
				
				
				//echo $fptkNomor;
				
				$queryInputFptk = "INSERT INTO fptk (idFptk, idWorker, namaPemohon, nikPemohon, posisiPemohon, posisiBaruPemohon, departemenPemohon, 
								divisiPosisi, departemenPosisi, jabatanPosisi, jabatanBaruPosisi, levelPosisi, lokasiPosisi, jumlahPosisi, 
								tujuanPosisi, penggantiPosisi, mppPosisi, keteranganPosisi, tanggalPosisi, jobdesPosisi, statusPosisi, 
								jumlahlKualifikasi, jumlahpKualifikasi, usiaKualifikasi, pendidikanKualifikasi, jurusanKualifikasi, pengalamanKualifikasi, lainlainKualifikasi, 
								tglditerimaBulanan, picBulanan, tglclosingBulanan, pemenuhanBulanan, karyawanBulanan, tglmasukBulanan, sbrinternalBulanan, sbreksternalBulanan, laineksternalBulanan, 
								tglditerimaHarian, tglclosingHarian, pemenuhanHarian, nomorFptk, namaManager, tanggalManager, namaHrdSuperintendent, tanggalHrdSuperintendent, namaGeneralManager, tanggalGeneralManager, namaOdManager, tanggalOdManager, namaHrdManager, tanggalHrdManager, 
								namaDirektur, tanggalDirektur, rejectFPTK, tanggalReject, keteranganReject, namaRecruitmentSuperintendent, tanggalRecruitmentSuperintendent, akunPemohon, tanggalDibuat) 
								VALUES ('', '$idWorker', '$pemohonNama', '$pemohonNik', '$pemohonPosisi', '$pemohonPosisiBaru', '$pemohonDepartemen', 
								'$posisiDivisi', '$posisiDepartemen', '$posisiJabatan', '$posisiJabatanBaru', '$posisiLevel', '$posisiLokasi', '$posisiJumlah', 
								'$posisiTujuan', '$posisiPengganti', '', '$posisiKeterangan', '$posisiTanggal', '$posisiJobdes', '$posisiStatus', 
								'$kualifikasiJumlahl', '$kualifikasiJumlahp', '$kualifikasiUsia', '$kualifikasiPendidikan', '$kualifikasiJurusan', '$kualifikasiPengalaman', '$kualifikasiLainlain', 
								'$bulananTglditerima', '$bulananPic', '$bulananTglclosing', '$bulananPemenuhan', '$bulananKaryawan', '$bulananTglmasuk', '$bulananSbrinternal', '$bulananSbreksternal', '$bulananLaineksternal', 
								'$harianTglditerima', '$harianTglclosing', '$harianPemenuhan', '$fptkNomor', '', '', '', '', '', '', '', '', '', '', 
								'', '', '', '', '', '', '', '$pembuat', '$tanggalDibuat')";
				//echo $queryInputFptk;
				$execInputFptk = mysql_query($queryInputFptk);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
				?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Anda telah berhasil membuat FPTK.
					</div>
					<a href="fptk.php"><button class="btn btn-success">Back</button></a>
				<?php
			}
				
			if(isset($_POST['delete-fptk']))
			{
				$idFptk = $_POST['id-fptk'];
				$queryDeleteFptk = "DELETE FROM fptk WHERE idFptk = '$idFptk'";
				$execDeleteFptk = mysql_query($queryDeleteFptk);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
				?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Anda telah berhasil menghapus FPTK.
					</div>
					<a href="fptk.php"><button class="btn btn-success">Back</button></a>
				<?php
			}
				
			if(isset($_POST['update-fptk']))
			{
				$idFptk = $_POST['id-fptk'];
				$pemohonNama = $_POST['pemohon-nama'];
				$pemohonNik = $_POST['pemohon-nik'];
				$pemohonPosisi = $_POST['pemohon-posisi'];
				$pemohonPosisiBaru = $_POST['pemohon-posisiBaru'];
				$pemohonDepartemen = $_POST['pemohon-departemen'];
					
				$posisiDivisi = $_POST['posisi-divisi'];
				$posisiDepartemen = $_POST['posisi-departemen'];
				$posisiJabatan = $_POST['posisi-jabatan'];
				$posisiJabatanBaru = $_POST['posisi-jabatanBaru'];
				$posisiLevel = $_POST['posisi-level'];
				$posisiLokasi = $_POST['posisi-lokasi'];
				$posisiJumlah = $_POST['posisi-jumlah'];
				if($_POST['posisi-tujuan'] == "")
				{
					$posisiTujuan = "Rekrut Baru";
				}
				else
				{
					$posisiTujuan = $_POST['posisi-tujuan'];
				}
				$posisiPengganti = $_POST['posisi-pengganti'];
				/*if($_POST['posisi-mpp'] == "")
				{
					$posisiMpp = "Ya";
				}
				else
				{
					$posisiMpp = $_POST['posisi-mpp'];
				}*/
				$posisiKeterangan = $_POST['posisi-keterangan'];
				$posisiTanggal = date('Y-m-d', strtotime($_POST['posisi-tanggal']));
				if($_POST['posisi-jobdes'] == "")
				{
					$posisiJobdes = "Ada";
				}
				else
				{
					$posisiJobdes = $_POST['posisi-jobdes'];
				}
				if($_POST['posisi-status'] == "")
				{
					$posisiStatus = "Bulanan";
				}
				else
				{
					$posisiStatus = $_POST['posisi-status'];
				}
					
				$kualifikasiJumlahl = $_POST['kualifikasi-jumlahl'];
				$kualifikasiJumlahp = $_POST['kualifikasi-jumlahp'];
				$kualifikasiUsia = $_POST['kualifikasi-usia'];
				$kualifikasiPendidikan = $_POST['kualifikasi-pendidikan'];
				$kualifikasiJurusan = $_POST['kualifikasi-jurusan'];
				$kualifikasiPengalaman = $_POST['kualifikasi-pengalaman'];
				$kualifikasiLainlain = $_POST['kualifikasi-lainlain'];
					
				$bulananTglditerima = date('Y-m-d', strtotime($_POST['bulanan-tglditerima']));
				$bulananPic = $_POST['bulanan-pic'];
				$bulananTglclosing = date('Y-m-d', strtotime($_POST['bulanan-tglclosing']));
				$bulananPemenuhan = $_POST['bulanan-pemenuhan'];
				$bulananKaryawan = $_POST['bulanan-karyawan'];
				$bulananTglmasuk = date('Y-m-d', strtotime($_POST['bulanan-tglmasuk']));
				$bulananSbrinternal = $_POST['bulanan-sbrinternal'];
				$bulananSbreksternal = $_POST['bulanan-sbreksternal'];
				$bulananLaineksternal = $_POST['bulanan-laineksternal'];
					
				$harianTglditerima = date('Y-m-d', strtotime($_POST['harian-tglditerima']));
				$harianTglclosing = date('Y-m-d', strtotime($_POST['harian-tglclosing']));
				$harianPemenuhan = $_POST['harian-pemenuhan'];
					
				$queryUpdateFptk = "UPDATE fptk SET namaPemohon = '$pemohonNama', nikPemohon = '$pemohonNik', posisiPemohon = '$pemohonPosisi', posisiBaruPemohon = '$pemohonPosisiBaru', departemenPemohon = '$pemohonDepartemen', 
									divisiPosisi = '$posisiDivisi', departemenPosisi = '$posisiDepartemen', jabatanPosisi = '$posisiJabatan', jabatanBaruPosisi = '$posisiJabatanBaru', levelPosisi = '$posisiLevel', 
									lokasiPosisi = '$posisiLokasi', jumlahPosisi = '$posisiJumlah', tujuanPosisi = '$posisiTujuan', penggantiPosisi = '$posisiPengganti', mppPosisi = '', 
									keteranganPosisi = '$posisiKeterangan', tanggalPosisi = STR_TO_DATE('$posisiTanggal', '%d-%m-%Y'), jobdesPosisi = '$posisiJobdes', statusPosisi = '$posisiStatus', 
									jumlahlKualifikasi = '$kualifikasiJumlahl', jumlahpKualifikasi = '$kualifikasiJumlahp', usiaKualifikasi = '$kualifikasiUsia', pendidikanKualifikasi = '$kualifikasiPendidikan', 
									jurusanKualifikasi = '$kualifikasiJurusan', pengalamanKualifikasi = '$kualifikasiPengalaman', lainlainKualifikasi = '$kualifikasiLainlain', 
									tglditerimaBulanan = '$bulananTglditerima', picBulanan = '$bulananPic', tglclosingBulanan = '$bulananTglclosing', pemenuhanBulanan = '$bulananPemenuhan', 
									karyawanBulanan = '$bulananKaryawan', tglmasukBulanan = '$bulananTglmasuk', sbrinternalBulanan = '$bulananSbrinternal', sbreksternalBulanan = '$bulananSbreksternal', laineksternalBulanan = '$bulananLaineksternal', 
									tglditerimaHarian = '$harianTglditerima', tglclosingHarian = '$harianTglclosing', pemenuhanHarian = '$harianPemenuhan' 
									WHERE idFptk = $idFptk";
				//echo $queryUpdateFptk;
				$execUpdateFptk = mysql_query($queryUpdateFptk);
				/*$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");*/
				?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Anda telah berhasil mengubah FPTK.
					</div>
					<a href="fptk.php"><button class="btn btn-success">Back</button></a>
				<?php
			}
				
			$getStatusFptk = "SELECT * FROM fptk WHERE idWorker = '$idWorker'";
			$execStatusFptk = mysql_query($getStatusFptk);
			$statusFptk = mysql_num_rows($execStatusFptk);
			include("templates/foot.php");
		}
		else if(isset($_SESSION['admin']))
		{
			header("Location:../admin/");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>