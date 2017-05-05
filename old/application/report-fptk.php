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
		{
			$tanggal_sql="";
		}
		else
		{
			//$tanggal1=$_POST['tanggal1'];
			//$tanggal2=$_POST['tanggal2'];
			$tanggal1 = date("Y-m-d", strtotime($_POST['tanggal1']));
			$tanggal2 = date("Y-m-d", strtotime($_POST['tanggal2']));
			$tanggal_sql="and (tanggalDibuat between '$tanggal1' and '$tanggal2')";
		}
		$list=mysql_query("select nomorFptk from fptk where nomorFptk like '%".$_POST['nomorFptk']."%' $tanggal_sql group by nomorFptk");
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
								Report FPTK
								<span class="tools pull-right">
								</span>
							</header>
							<table class="table colvis-data-table data-table">
								<thead>
									<tr>
										<th style="text-align:center;">#</th>
										<th style="text-align:center;">Location</th>
										<th style="text-align:center;">Department</th>
										<th style="text-align:center;">Section</th>
										<th style="text-align:center;">Position</th>
										<th style="text-align:center;">Level</th>
										<th style="text-align:center;">FPTK Date</th>
										<th style="text-align:center;">No FPTK</th>
										<th style="text-align:center;">MPP</th>
										<th style="text-align:center;">PIC</th>
										<th style="text-align:center;">Sumber Data</th>
										<th style="text-align:center;">Closing Date</th>
										<th style="text-align:center;">Lama Pemenuhan</th>
										<th style="text-align:center;">Candidate</th>
										<th style="text-align:center;">Hired</th>
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
											$cet_fptk .= "WHERE nomorFptk='".$cet_list['nomorFptk']."' $tanggal_sql ";
											$cetfptk = mysql_fetch_array(mysql_query($cet_fptk));
											?>
											<tr>
												<td align="center"><?=$no;?></td>
												<td align="center"><?=$cetfptk['distrik2'];?></td>
												<td align="center"><?=$cetfptk['departemen2'];?></td>
												<td align="center"><?=$cetfptk['section2'];?></td>
												<td align="center"><?=$cetfptk['posisi2'];?></td>
												<td align="center"><?=$cetfptk['level2'];?></td>
												<td align="center">
													<?
														if($cetfptk['tanggalDibuat']!='')
														{?><?php tanggal2($cetfptk['tanggalDibuat'])?><?}
														else
														{?><?php echo '-';?><?}
													?>
												</td>
												<td align="center"><?=$cetfptk['nomorFptk'];?></td>
												<td align="center"><?=$cetfptk['mppPosisi'];?></td>
												<td align="center"><?=$cetfptk['namaRecruitmentSuperintendent'];?></td>
												<td align="center">Linkedin</td>
												<td align="center">
													<?
														if($cetfptk['closingdate']!='')
														{?><?php tanggal2($cetfptk['closingdate'])?><?}
														else
														{?><?php echo '-';?><?}
													?>
												</td>
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