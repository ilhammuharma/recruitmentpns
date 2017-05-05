<html> 
<?php
	session_start();
	$title = "reportDataSourcing";
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
			
			$getStatusSourcing = "SELECT * FROM userWorker WHERE idWorker = '$idWorker'";
			$execStatusSourcing = mysql_query($getStatusSourcing);
			$statusSourcing = mysql_num_rows($execStatusSourcing);	
			
			?>
				<?php
					$per_page = 20;
					$totalSourcing = "SELECT * FROM userWorker";
					$getTotalSourcing = mysql_query($totalSourcing);
					$resultTotalSourcing = mysql_num_rows($getTotalSourcing);
					$pages = ceil($resultTotalSourcing/$per_page);
					
					$queryShowSourcing = "SELECT * FROM userWorker
										JOIN loginUser ON loginUser.idLogin = userWorker.idLogin WHERE loginUser.level=2
										ORDER BY namaUser ASC LIMIT 0, $per_page";
					$execShowSourcing = mysql_query($queryShowSourcing);
					
					if(mysql_num_rows($execShowSourcing) < 1)
					{
						echo "<em>Tidak ada Data Sourcing</em>";
					}
					else
					{
						?>
							<h3><strong>Laporan Sourcing Data</strong></h3>
							<a href="resume.php"><button class="btn btn-sm btn-success">Tambah Data</button></a>
							<input type="hidden" value="<?php echo $pages;?>" name="pages" id="pages">
							<div class="table-responsive" id="total-fptk">
								<table class="table table-hover table-condensed" style="width: 4000px; border: 1px #333;">
									<tr>
										<th>Action</th><th>Posisi</th><th>Level</th><th>Divisi</th><th>Departemen</th>
										<th>Nama</th><th>Status</th><th>Tanggal Lahir</th><th>No.Telepon</th><th>Email</th><th>Domisili</th>
										<th>Pendidikan Terakhir</th><th>Jurusan</th><th>Instansi</th>
										<th>Nama Perusahaan</th><th>Jabatan</th><th>Awal Kerja</th><th>Akhir Kerja</th>
										<th>Nama Perusahaan</th><th>Jabatan</th><th>Awal Kerja</th><th>Akhir Kerja</th>
										<th>Nama Perusahaan</th><th>Jabatan</th><th>Awal Kerja</th><th>Akhir Kerja</th>
										<th>Referensi Data</th><th>Current Salary</th><th>Expected Salary</th>
									</tr>
									<tbody>
										<?php
											while($result = mysql_fetch_array($execShowSourcing))
											{
												$fptk = mysql_fetch_array(mysql_query("SELECT kategoriKerja.namaKategori, kategoriLevel.namaLevel, kategoriDivisi.namaDivisi, kategoriDepartemen.namaDepartemen FROM fptk
														INNER JOIN kategoriKerja ON fptk.jabatanPosisi=kategoriKerja.idKategori
														INNER JOIN kategoriLevel ON fptk.levelPosisi=kategoriLevel.idLevel
														INNER JOIN kategoriDivisi ON fptk.divisiPosisi=kategoriDivisi.idDivisi
														INNER JOIN kategoriDepartemen ON fptk.departemenPosisi=kategoriDepartemen.idDepartemen
														WHERE fptk.nomorFptk='".$result['nomorFptk']."'"));
												
												$pendidikan = mysql_fetch_array(mysql_query("SELECT pendidikanWorker.namaInstansi, tingkatPendidikan.namaPendidikan, tableJurusan.namaJurusan FROM pendidikanWorker
															INNER JOIN tingkatPendidikan ON pendidikanWorker.kualifikasiPendidikan=tingkatPendidikan.gradePendidikan
															INNER JOIN tableJurusan ON pendidikanWorker.jurusanPendidikan=tableJurusan.idJurusan
															WHERE pendidikanWorker.idWorker='".$result['idWorker']."' ORDER BY tahunLulus DESC limit 1"));
														
												$riwayatKerja = mysql_query("SELECT pengalamanWorker.namaPerusahaan, pengalamanWorker.posisi, pengalamanWorker.awalKerja, pengalamanWorker.akhirKerja FROM pengalamanWorker
																WHERE pengalamanWorker.idWorker='".$result['idWorker']."' ORDER BY awalKerja DESC limit 3");
												$i=1;
												while($pengalamanKerja = mysql_fetch_array($riwayatKerja))
												{
													$namaPerusahaan[$i]=$pengalamanKerja['namaPerusahaan'];
													$posisi[$i]=$pengalamanKerja['posisi'];
													$awalKerja[$i]=$pengalamanKerja['awalKerja'];
													$akhirKerja[$i]=$pengalamanKerja['akhirKerja'];
													$i++;
												}
												
												$statusKandidat = mysql_fetch_array(mysql_query("SELECT userWorker.statusRekrut, tableStatusRekrut.namaStatus FROM userWorker
																INNER JOIN tableStatusRekrut ON userWorker.statusRekrut=tableStatusRekrut.idTable
																WHERE userWorker.idWorker='".$result['idWorker']."'"));
												
												$currentSalary = mysql_fetch_array(mysql_query("SELECT pengalamanWorker.gaji FROM pengalamanWorker
																WHERE pengalamanWorker.idWorker='".$result['idWorker']."' ORDER BY awalKerja DESC limit 1"));
																
												//$kategoriFptk = mysql_fetch_array(mysql_query("SELECT jabatanPosisi, levelPosisi, divisiPosisi, departemenPosisi FROM FPTK where nomorFptk=
												?>
													<tr>
														<td><a href="../admin/resume.php?id=<?php echo $result['idWorker'];?>"><button class="btn btn-sm btn-success">Update</button></a></td>
														<td><?php echo $fptk['namaKategori']?></td>
														<td><?php echo $fptk['namaLevel']?></td>
														<td><?php echo $fptk['namaDivisi']?></td>
														<td><?php echo $fptk['namaDepartemen']?></td>
														<td><a href="../show/worker.php?id=<?php echo $result['idWorker'];?>"><?php echo $result['namaUser']?></a></td>
														<td><?php echo $statusKandidat['namaStatus']?></td>
														<td><?php echo $result['birthday']?></td>
														<td><?php echo $result['noPonsel']?></td>
														<td><?php echo $result['emailUser']?></td>
														<td><?php echo $result['alamatSekarang']?></td>
														<td><?php echo $pendidikan['namaPendidikan']?></td>
														<td><?php echo $pendidikan['namaJurusan']?></td>
														<td><?php echo $pendidikan['namaInstansi']?></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td><?php echo $result['sumberData_eksternal']?></td>
														<td><?php echo $currentSalary['gaji']?></td>
														<td><?php echo $result['minimalGaji']?></td>
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