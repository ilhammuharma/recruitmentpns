<?
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) 
	{
		// last request was more than 30 minutes ago
		session_unset();     // unset $_SESSION variable for the run-time 
		session_destroy();   // destroy session data in storage
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp	
	if(!isset($_SESSION['nama']))
	{ //header('location:'.$base_url.'index.php?r=fptk');
	}
	else
	{
		/*if($_POST['tanggal1']=='' or $_POST['tanggal2']=='')
		{
			$tanggal_sql="";
		}
		else
		{
			$tanggal1 = date("Y-m-d", strtotime($_POST['tanggal1']));
			$tanggal2 = date("Y-m-d", strtotime($_POST['tanggal2']));
			$tanggal_sql="and (tanggalDibuat between '$tanggal1' and '$tanggal2')";
		}*/
		//$where = "where posisi like '%".$_POST['posisi']."%' and namaUser like '%".$_POST['namaUser']."%' and domisili like '%".$_POST['domisili']."%' and sumberEksternal like '%".$_POST['sumberEksternal']."%' ";
		$cet_ven = "SELECT uw.*, kk.namaKategori as posisilamar, tp.namaProvinsi as dom, re.namaRefeksternal as sumberdata FROM userWorker uw ";
		$cet_ven .= "INNER JOIN kategoriKerja kk ON kk.idKategori = uw.posisi ";
		$cet_ven .= "INNER JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
		$cet_ven .= "INNER JOIN referensiEksternal re ON re.idRefeksternal = uw.sumberEksternal ";
		$cet_ven .= "where posisi like '%".$_POST['posisi']."%' and namaUser like '%".$_POST['namaUser']."%' and domisili like '%".$_POST['domisili']."%' and sumberEksternal like '%".$_POST['sumberEksternal']."%' ";
		$cetven = mysql_query($cet_ven);
		//echo $cet_ven;
		//$cet_ven .= "WHERE posisi='".$cet_list['posisi']."' and namaUser ='".$cet_list['namaUser']."' and domisili ='".$cet_list['domisili']."' and sumberEksternal ='".$cet_list['sumberEksternal']."' ";
		
		//$list=mysql_query("select * from userWorker where $where group by posisi");
		//echo "select posisi, namaUser, domisili, sumberEksternal from userWorker where $where group by posisi";
		//$list=mysql_query("select nomorFptk from fptk where nomorFptk like '%".$_POST['nomorFptk']."%' $tanggal_sql group by nomorFptk");
		?>
			<style>
				.print tr td
				{
					padding:1px 0px;
					vertical-align: top;
				}
				.table-datasource td, .table-datasource tr {
				  overflow: hidden; /* this is what fixes the expansion */
				  text-overflow: ellipsis; /* not supported in all browsers, but I accepted the tradeoff */
				  white-space: nowrap;
				}
			</style>
			<link rel="stylesheet" href="assets/print-invoice.css" media="print">
			<div class="page-head">
				<h3 class="m-b-less">SUMMARY REPORT</h3>
			</div>           
			<!--body wrapper start-->
			<div class="wrapper">
				<div class="row">
					<div class="col-sm-12">
						<section class="panel">
							<header class="panel-heading ">
								Report Data Sourcing
								<span class="tools pull-right">
									<a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
								</span>
							</header>
							<div style="padding:15px">
							<!--<div class="panel-body">
								<div id="bar-chart"></div>
							</div>-->
							<table class="table table-datasource data-table">
								<thead>
									<tr bgcolor="#ddd">
										<th style="text-align:center;">#</th>
										<th style="text-align:center;">Posisi</th>
										<th style="text-align:center;">Kandidat</th>
										<th style="text-align:center;">Tanggal Lahir</th>
										<th style="text-align:center;">No.Telp</th>
										<th style="text-align:center;">Email</th>
										<th style="text-align:center;">Domisili</th>
										<th style="text-align:center;">Pendidikan Terakhir</th>
										<th style="text-align:center;">Jurusan</th>
										<th style="text-align:center;">Nama Sekolah/Universitas</th>
										<th style="text-align:center;">Nama Perusahaan</th>
										<th style="text-align:center;">Jabatan</th>
										<th style="text-align:center;">Masa Kerja</th>
										<th style="text-align:center;">Nama Perusahaan</th>
										<th style="text-align:center;">Jabatan</th>
										<th style="text-align:center;">Masa Kerja</th>
										<th style="text-align:center;">Nama Perusahaan</th>
										<th style="text-align:center;">Jabatan</th>
										<th style="text-align:center;">Masa Kerja</th>
										<th style="text-align:center;">Total Masa Kerja</th>
										<th style="text-align:center;">Sumber Data</th>
										<th style="text-align:center;">Interview</th>
										<th style="text-align:center;">Keterangan</th>
										<th style="text-align:center;">Current Salary</th>
										<th style="text-align:center;">Expected Salary</th>
										<th style="text-align:center;">Status</th>
									</tr>
								</thead>
								<tbody>
									<?
										$no=1;
										while($cet_list=mysql_fetch_array($cetven))
										{
											$edu="SELECT pw.*, tp.namaPendidikan as jenjang, tj.namaJurusan as jurusan from pendidikanWorker pw ";
											$edu.= "INNER JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
											$edu.= "INNER JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
											$edu.= "WHERE idWorker=".$cet_list['idWorker']." ORDER BY tahunLulus DESC limit 1 ";
											$education = mysql_fetch_array(mysql_query($edu));
											
											$exp="SELECT * from pengalamanWorker ";
											$exp.= "WHERE idWorker=".$cet_list['idWorker']." ORDER BY akhirKerja DESC limit 3 ";
											$experience =  mysql_fetch_array(mysql_query($exp));
											?>
											<tr>
												<td align="center"><?=$no;?></td>
												<td align="center"><?=$cet_list['posisilamar'];?></td>
												<td align="center"><?=$cet_list['namaUser'];?></td>
												<td align="center"><?=tanggal2($cet_list['tanggalLahir'])?></td>
												<td align="center"><?=$cet_list['noPonsel'];?></td>
												<td align="center"><?=$cet_list['email'];?></td>
												<td align="center"><?=$cet_list['dom'];?></td>
												<td align="center"><?=$education['jenjang'];?></td>
												<td align="center"><?=$education['jurusan'];?></td>
												<td align="center"><?=$education['namaInstansi'];?></td>
												
												<td align="center"><?=$experience['namaPerusahaan'];?></td>
												<td align="center"><?=$experience['posisi'];?></td>
												<td align="center">-</td>
												<td align="center"><?=$experience['namaPerusahaan'];?></td>
												<td align="center"><?=$experience['posisi'];?></td>
												<td align="center">-</td>
												<td align="center"><?=$experience['namaPerusahaan'];?></td>
												<td align="center"><?=$experience['posisi'];?></td>
												<td align="center">-</td>
												
												<td align="center">-</td>
												<td align="center"><?=$cet_list['sumberdata'];?></td>
												<td align="center">-</td>
												<td align="center">-</td>
												<td align="center">-</td>
												<td align="center">Rp<?=number_format($cet_list['expSalary'],0,'.',',')?></td>
												<td align="center">-</td>
											</tr>
											<?
											$no++;
										}
									?>
								</tbody>
							</table>
							</div>
						</section>
					</div>
				</div>
			</div>
			<!--body wrapper end-->
		<? 
	} 
?>