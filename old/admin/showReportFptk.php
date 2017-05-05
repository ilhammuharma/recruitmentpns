<html> 
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
			$idLogin = $_SESSION['idLogin'];
			//$tab = "";
			$queryGetUser = "SELECT * FROM userWorker WHERE idLogin = '$idLogin'";
			$execGetUser = mysql_query($queryGetUser);
			$resultGetUser = mysql_fetch_array($execGetUser);
			$idWorker = $resultGetUser['idWorker'];
				
			/*if(isset($_POST['delete-fptk']))
			{
				$idFptk = $_POST['id-fptk'];
				$queryDeleteFptk = "DELETE FROM fptk WHERE idFptk = '$idFptk'";
				$execDeleteFptk = mysql_query($queryDeleteFptk) or die("SQL ERROR");
				$url = $webRoot."data/worker.php?id=".$idWorker;
				$content = populate_word($url);
				$queryUpdateSearch = "UPDATE tableSearchWorker SET content = '$content' WHERE idWorker = '$idWorker'"; 
				$execUpdateSearch = mysql_query($queryUpdateSearch) or die("SQL");
			}*/
			
			$getStatusFptk = "SELECT * FROM fptk WHERE idWorker = '$idWorker'";
			$execStatusFptk = mysql_query($getStatusFptk);
			$statusFptk = mysql_num_rows($execStatusFptk);	
			?>
				<?php
					$per_page = 5;
					$totalFptk = "SELECT * FROM fptk";
					$getTotalFptk = mysql_query($totalFptk);
					$resultTotalFptk = mysql_num_rows($getTotalFptk);
					$pages = ceil($resultTotalFptk/$per_page);
					$queryShowFptk = "SELECT f.idFptk, f.nomorFptk, f.namaPemohon, f.nikPemohon, f.posisiPemohon, kk1.namaKategori as posisi1, f.departemenPosisi, kde1.namaDepartemen as departemen1, 
									f.divisiPosisi, kdi.namaDivisi, f.departemenPosisi, kde2.namaDepartemen as departemen2, f.jabatanPosisi, kk2.namaKategori as posisi2, f.levelPosisi, kl.namaLevel, f.lokasiPosisi, tpr.namaProvinsi, f.jumlahPosisi, 
									f.tujuanPosisi, f.mppPosisi, f.keteranganPosisi, f.tanggalPosisi, f.jobdesPosisi, f.statusPosisi, 
									f.jumlahlKualifikasi, f.jumlahpKualifikasi, f.usiaKualifikasi, f.pendidikanKualifikasi, tpe.namaPendidikan, f.jurusanKualifikasi, tj.namaJurusan, f.pengalamanKualifikasi, f.lainlainKualifikasi,
									f.namaRecruitmentSuperintendent, f.tanggalRecruitmentSuperintendent FROM fptk f ";
					$queryShowFptk .= "JOIN kategoriKerja kk1 ON kk1.idKategori = f.posisiPemohon ";
					$queryShowFptk .= "JOIN kategoriDepartemen kde1 ON kde1.idDepartemen = f.departemenPemohon ";
					$queryShowFptk .= "JOIN kategoriDivisi kdi ON kdi.idDivisi = f.divisiPosisi ";
					$queryShowFptk .= "JOIN kategoriDepartemen kde2 ON kde2.idDepartemen = f.departemenPosisi ";
					$queryShowFptk .= "JOIN kategoriKerja kk2 ON kk2.idKategori = f.jabatanPosisi ";
					$queryShowFptk .= "JOIN kategoriLevel kl ON kl.idLevel = f.levelPosisi ";
					$queryShowFptk .= "JOIN tableProvinsi tpr ON tpr.idProvinsi = f.lokasiPosisi ";
					$queryShowFptk .= "JOIN tingkatPendidikan tpe ON tpe.gradePendidikan = f.pendidikanKualifikasi ";
					$queryShowFptk .= "JOIN tableJurusan tj ON tj.idJurusan = f.jurusanKualifikasi ";
					$queryShowFptk .= "ORDER BY nomorFptk ASC LIMIT 0, $per_page";
									
					//$queryShowFptk = "SELECT f.idFptk, f.namaPemohon, f.nikPemohon, f.posisiPemohon, kk.namaKategori, f.departemenPemohon, kd.namaDepartemen FROM fptk f ";
					//$queryShowFptk .= "JOIN kategoriKerja kk ON kk.idKategori = f.posisiPemohon ";
					//$queryShowFptk .= "JOIN kategoriDepartemen kd ON kd.idDepartemen = f.departemenPemohon ";
					//$queryShowFptk .= "WHERE idWorker = $idWorker";
									
					$execShowFptk = mysql_query($queryShowFptk);
					if(mysql_num_rows($execShowFptk) < 1)
					{
						echo "<em>Tidak ada FPTK</em>";
					}
					else
					{
						?>
							<h3><strong>Laporan FPTK</strong></h3>
							<input type="hidden" value="<?php echo $pages;?>" id="pages">
							<div class="table-responsive" id="total-fptk">
								<table class="table table-hover table-condensed" style="width: 3500px; border: 1px #333;">
									<tr>
										<th>Nomor FPTK</th><th>PIC</th><th>Tanggal Ditetapkan</th><th>Nama Pemohon</th><th>NIK Pemohon</th><th>Posisi Pemohon</th><th>Departemen Pemohon</th>
										<th>Divisi</th><th>Departemen</th><th>Posisi/Jabatan</th><th>Level</th><th>Lokasi Penempatan</th><th>Jumlah Kebutuhan</th><th>Tujuan Permintaan</th>
										<th>Sesuai MPP?</th><th>Keterangan</th><th>Tanggal Dibutuhkan</th><th>Job Description</th><th>Status Karyawan</th>
										<th>Jumlah Dibutuhkan (L)</th><th>Jumlah Dibutuhkan (P)</th><th>Usia</th><th>Pendidikan</th><th>Jurusan</th><th>Pengalaman</th><th>Lain-Lain</th>
									</tr>
									<tbody>
										<?php
											while($result = mysql_fetch_array($execShowFptk))
											{
												?>
													<tr>
														<td><a href="../show/viewFptk.php?id=<?php echo $result['idFptk'];?>"><?php echo $result['nomorFptk']?></a></td>
														<td><?php echo $result['namaRecruitmentSuperintendent']?></td>
														<td><?php echo $result['tanggalRecruitmentSuperintendent']?></td>
														<td><?php echo $result['namaPemohon']?></td>
														<td><?php echo $result['nikPemohon']?></td>
														<td><?php echo $result['posisi1']?></td>
														<td><?php echo $result['departemen1']?></td>
														
														<td><?php echo $result['namaDivisi']?></td>
														<td><?php echo $result['departemen2']?></td>
														<td><?php echo $result['posisi2']?></td>
														<td><?php echo $result['namaLevel']?></td>
														<td><?php echo $result['namaProvinsi']?></td>
														<td><?php echo $result['jumlahPosisi']?></td>
														<td><?php echo $result['tujuanPosisi']?></td>
														<td><?php echo $result['mppPosisi']?></td>
														<td><?php echo $result['keteranganPosisi']?></td>
														<td><?php echo $result['tanggalPosisi']?></td>
														<td><?php echo $result['jobdesPosisi']?></td>
														<td><?php echo $result['statusPosisi']?></td>
														
														<td><?php echo $result['jumlahlKualifikasi']?></td>
														<td><?php echo $result['jumlahpKualifikasi']?></td>
														<td><?php echo $result['usiaKualifikasi']?></td>
														<td><?php echo $result['namaPendidikan']?></td>
														<td><?php echo $result['namaJurusan']?></td>
														<td><?php echo $result['pengalamanKualifikasi']?></td>
														<td><?php echo $result['lainlainKualifikasi']?></td>
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
</html>