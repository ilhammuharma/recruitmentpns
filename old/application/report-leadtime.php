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
		if($_POST['tanggal1']=='' or $_POST['tanggal2']=='')
		{$tanggal_sql="";}
		else
		{
			//$tanggal1=$_POST['tanggal1'];
			//$tanggal2=$_POST['tanggal2'];
			$tanggal1 = date("Y-m-d", strtotime($_POST['tanggal1']));
			$tanggal2 = date("Y-m-d", strtotime($_POST['tanggal2']));
			$tanggal_sql="and (tanggalDibuat between '$tanggal1' and '$tanggal2')";
		}
		$list=mysql_query("select namaRecruitmentSuperintendent from fptk where namaRecruitmentSuperintendent like '%".$_POST['leadtime']."%' $tanggal_sql group by namaRecruitmentSuperintendent");
		?>
			<style>
				.print tr td
				{
					padding:1px 0px;
					vertical-align: top;
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
								Summary Leadtime
								<span class="tools pull-right">
								</span>
							</header>
							<table class="table colvis-data-table data-table">
								<thead>
									<tr>
										<th style="text-align:center;">#</th>
										<th style="text-align:center;">Bulan</th>
										<th style="text-align:center;">Posisi Sebelumnya</th>
										<th style="text-align:center;">FPTK Bulan Ini</th>
										<th style="text-align:center;">Jumlah Posisi</th>
										<th style="text-align:center;">Fullfilment</th>
										<th style="text-align:center;">Disc</th>
										<th style="text-align:center;">%</th>
									</tr>
								</thead>
								<tbody>
									<?
										$no=1;
										while($cet_list=mysql_fetch_array($list))
										{
											//$cet_fptk = mysql_fetch_array(mysql_query("select * from fptk where nomorFptk='".$cet_list['nomorFptk']."' $tanggal_sql "));
											$cet_fptk = "SELECT f.idFptk, f.tanggalDibuat, f.namaPemohon, f.nikPemohon, f.direktoratPosisi, kdir2.namaDirektorat as direktorat2, 
														f.departemenPosisi, kde2.namaDepartemen as departemen2, f.sectionPosisi, ks2.namaSection as section2, 
														f.jabatanPosisi, kk2.namaKategori as posisi2, f.levelPosisi, kl2.namaLevel as level2, f.lokasiPosisi, kdis2.namaDistrik as distrik2, 
														f.namaRecruitmentSuperintendent, f.mppPosisi, f.nomorFptk, f.closingdate FROM fptk f ";
											$cet_fptk .= "INNER JOIN kategoriDirektorat kdir2 ON kdir2.idDirektorat = f.direktoratPosisi ";
											$cet_fptk .= "INNER JOIN kategoriDepartemen kde2 ON kde2.idDepartemen = f.departemenPosisi ";
											$cet_fptk .= "INNER JOIN kategoriSection ks2 ON ks2.idSection = f.sectionPosisi ";
											$cet_fptk .= "INNER JOIN kategoriKerja kk2 ON kk2.idKategori = f.jabatanPosisi ";
											$cet_fptk .= "INNER JOIN kategoriLevel kl2 ON kl2.idLevel = f.levelPosisi ";
											$cet_fptk .= "INNER JOIN kategoriDistrik kdis2 ON kdis2.idDistrik = f.lokasiPosisi ";
											$cet_fptk .= "WHERE namaRecruitmentSuperintendent='".$cet_list['namaRecruitmentSuperintendent']."' $tanggal_sql ";
											$cet_fptk = mysql_fetch_array(mysql_query($cet_fptk));
											?>
											<tr>
												<td align="center"><?=$no=1;?></td>
												<td align="center">-</td>
												<td align="center">-</td>
												<td align="center">-</td>
												<td align="center">-</td>
												<td align="center">-</td>
												<td align="center">-</td>
												<td align="center">-</td>
											</tr>
											<?
											$no++;
										}
									?>
								</tbody>
							</table>
						</section>
					</div>
				</div>
			</div>
			<!--body wrapper end-->
		<? 
	} 
?>