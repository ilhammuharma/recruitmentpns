<?php
session_start();
include('module/config.php');

if(!isset($_SESSION['username']))
{header("Location:index.php");}
else
{
	if(isset($_SESSION['worker']))
	{
		include("templates/head.php");
		$idLogin = $_SESSION['idLogin'];
		$queryGetUser = "SELECT * FROM userWorker WHERE idLogin = '$idLogin'";
		$execGetUser = mysql_query($queryGetUser);
		$resultGetUser = mysql_fetch_array($execGetUser);
		$idWorker = $resultGetUser['idWorker'];
		?>
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
					<meta name="description" content="">
					<meta name="author" content="Mosaddek">
					<meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina">
					<link rel="shortcut icon" href="javascript:;" type="image/png">
					<? include('layout/css-file.php') ?>
					<title>PNS Career</title>

					<!--right slidebar-->
					<link href="assets/css/slidebars.css" rel="stylesheet">

					<!--switchery-->
					<link href="js/switchery/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />

					<!--iCheck-->
					<link href="js/icheck/skins/all.css" rel="stylesheet">

					<!--tagsinput-->
					<link href="assets/css/tagsinput.css" rel="stylesheet">

					<!--dropzone-->
					<link href="assets/css/dropzone.css" rel="stylesheet">

					<!--Select2-->
					<link href="assets/css/select2.css" rel="stylesheet">
					<link href="assets/css/select2-bootstrap.css" rel="stylesheet">

					<!--bootstrap-touchspin-->
					<link href="assets/css/bootstrap-touchspin.css" rel="stylesheet">
					
					<!--bootstrap picker-->
					<link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/assets/css/datepicker.css"/>
					<link rel="stylesheet" type="text/css" href="js/bootstrap-timepicker/compiled/timepicker.css"/>
					<link rel="stylesheet" type="text/css" href="js/bootstrap-colorpicker/assets/css/colorpicker.css"/>
					<link rel="stylesheet" type="text/css" href="js/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
					<link rel="stylesheet" type="text/css" href="js/bootstrap-datetimepicker/assets/css/datetimepicker.css"/>
					
					<!--common style-->
					<link href="assets/css/style.css" rel="stylesheet">
					<link href="assets/css/style-responsive.css" rel="stylesheet">
					
					<!-- Placed js at the end of the document so the pages load faster -->
					<script src="js/jquery-1.10.2.min.js"></script>
					<script src="js/jquery-migrate.js"></script>
					<script src="js/bootstrap.min.js"></script>
					<script src="js/modernizr.min.js"></script>
					
					<!--Nice Scroll-->
					<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

					<!--right slidebar-->
					<script src="js/slidebars.min.js"></script>

					<!--switchery-->
					<script src="js/switchery/switchery.min.js"></script>
					<script src="js/switchery/switchery-init.js"></script>

					<!--Sparkline Chart-->
					<script src="js/sparkline/jquery.sparkline.js"></script>
					<script src="js/sparkline/sparkline-init.js"></script>
					
					<!--common scripts for all pages-->
					<script src="js/scripts.js"></script>
					
					<!--Form Wizard-->
					<link rel="stylesheet" type="text/css" href="assets/css/jquery.steps.css" />
					
					<!--Form Validation-->
					<script src="js/bootstrap-validator.min.js" type="text/javascript"></script>

					<!--Form Wizard-->
					<script src="js/jquery.steps.min.js" type="text/javascript"></script>
					<script src="js/jquery.validate.min.js" type="text/javascript"></script>

					<!--wizard initialization-->
					<script src="js/wizard-init.js" type="text/javascript"></script>

					<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
					<!--[if lt IE 9]>
					<script src="js/html5shiv.js"></script>
					<script src="js/respond.min.js"></script>
					<![endif]-->
				</head>
			
				<body class="sticky-header">
					<section>
						<!-- sidebar left start-->
						<div class="sidebar-left">
							<!--responsive view logo start-->
							<div class="logo dark-logo-bg visible-xs-* visible-sm-*">
								<a href="index.html">
									<img src="assets/img/logo-icon.png" alt="">
									<!--<i class="fa fa-maxcdn"></i>-->
									<span class="brand-name"><img src="assets/img/logo2.png" alt=""></span>
								</a>
							</div>
							<!--responsive view logo end-->

							<div class="sidebar-left-info">
								<!-- visible small devices start-->
								<div class=" search-field">  </div>
								<!-- visible small devices end-->

								<!--sidebar nav start-->
								<ul class="nav nav-pills nav-stacked side-navigation">
									<li><a href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
									<li class="menu-list">
										<a href="index.php"><i class="fa fa-user"></i>  <span>Candidate Database</span></a>
										<ul class="child-list">
											<li><a href="jobseeker-list.php"> Daftar Pencari Kerja</a></li>
											<li><a href="jobseeker-application.html"> Formulir Lamaran Kerja</a></li>
										</ul>
									</li>
									<li class="menu-list">
										<a href="index.php"><i class="fa fa-file-archive-o"></i><span>FPTK Database</span></a>
										<ul class="child-list">
											<li><a href="fptk-list.php">Daftar Pengajuan FPTK</a></li>
											<li><a href="fptk-create.html">Buat FPTK</a></li>
										</ul>
									</li>
								</ul>
								<!--sidebar nav end-->
							</div>
						</div>
						<!-- sidebar left end-->

						<!-- body content start-->
						<div class="body-content">

							<!-- header section start-->
							<div class="header-section">

								<!--logo and logo icon start-->
								<div class="logo dark-logo-bg hidden-xs hidden-sm">
									<a href="index.html">
										<img src="assets/img/logo-icon.png" alt="">
										<!--<i class="fa fa-maxcdn"></i>-->
										<span class="brand-name"><img src="assets/img/logo2.png" alt=""></span>
									</a>
								</div>

								<div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
									<a href="index.php">
										<img src="assets/img/logo-icon.png" alt="">
										<!--<i class="fa fa-maxcdn"></i>-->
									</a>
								</div>
								<!--logo and logo icon end-->

								<!--toggle button start-->
								<a class="toggle-btn"><i class="fa fa-outdent"></i></a>
								<!--toggle button end-->

								<!--mega menu start-->
								<div id="navbar-collapse-1" class="navbar-collapse collapse yamm mega-menu">
									<ul class="nav navbar-nav">
									</ul>
								</div>
								<!--mega menu end-->
								<div class="notification-wrap">
								<!--left notification start-->
								<div class="left-notification">
								<ul class="notification-menu">
								</ul>
								</div>
								<!--left notification end-->

								<!--right notification start-->
								<div class="right-notification">
									<ul class="notification-menu">
										<li>
											<form class="search-content" action="index.php" method="post">
												<input type="text" class="form-control" name="keyword" placeholder="Search...">
											</form>
										</li>

										<li>
											<a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
												<img src="img/avatar-mini.jpg" alt="">John Doe
												<span class=" fa fa-angle-down"></span>
											</a>
											<ul class="dropdown-menu dropdown-usermenu purple pull-right">
												<li><a href="javascript:;">  Profile</a></li>
												<li>
													<a href="javascript:;">
														<span class="badge bg-danger pull-right">40%</span>
														<span>Settings</span>
													</a>
												</li>
												<li>
													<a href="javascript:;">
														<span class="label bg-info pull-right">new</span>Help
													</a>
												</li>
												<li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
											</ul>
										</li>
									</ul>
								</div>
								<!--right notification end-->
								</div>
							</div>
							<!-- header section end-->

							<?php
								if($_SERVER['REQUEST_URI']=='/index.php')
								{}
								else
								{	
									$aa=explode('r=',$_SERVER['REQUEST_URI']);
									$bb=explode('&',$aa[1]);
									//echo $_REQUEST['param'];
									$cc=explode('/',$_SERVER['REQUEST_URI']);
									//echo $cc['1'];
									$cek1=mysql_num_rows(mysql_query("select id from tb_menu where link='".$cc['1']."'"));
									//include("application/".$cc['1'].".php");
									//echo $cc['1'];
									if($cek1==0)
									{
										include("application/".$bb['0'].".php");
										//echo $cek1;
									}
									else
									{
										//echo $cek1;
										$cek2=mysql_fetch_array(mysql_query("select id from tb_menu where link='".$cc['1']."'"));
										$cek3=mysql_num_rows(mysql_query("select id from tb_menu_user where id_menu='".$cek2['id']."' and id_user='".$_SESSION['id']."'"));
										//echo $cek3;
										if($cek3==0){echo"Anda tidak punya akses kehalaman ini!";}else{include("application/".$bb['0'].".php");} 
									}
									//echo $_SERVER['REQUEST_URI'];
								} 
							?>

							<!--body wrapper start-->
							<div class="wrapper">
								<div class="row">
									<div class="col-lg-12">
										<section class="panel">
											<header class="panel-heading">
											</header>
											<div id="addFptk2" class="panel-body">
												<form role="form" class="form-horizontal" id="form-fptk" action="fptk-create-process.php" method="post">
													<input type="hidden" value="<?php echo $idWorker;?>" name="idWorker">
													<h4>I. Pemohon</h4>
													<div class="form-group">
														<label class="col-sm-2 control-label" class="required" for="pemohonNama">Nama Pemohon *</label>
														<div class="col-sm-10">
															<input type="text" name="pemohonNama" class="form-control" id="pemohonNama" placeholder="Nama Pemohon">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label" class="required" for="pemohonNik">NIK Pemohon *</label>
														<div class="col-sm-10">
															<input type="text" name="pemohonNik" class="form-control" id="pemohonNik" placeholder="NIK">
														</div>
													</div>
													<div class="form-group">
														<label for="pemohonPosisi" class="col-sm-2 control-label">Posisi/Jabatan *</label>
														<div class="col-sm-10">
															<select name="pemohonPosisi" id="pemohonPosisi" class="form-control" required>
																<option value="" disabled>-- Pilih Posisi --</option>
																<?php
																	$queryPosisi = "SELECT * FROM kategoriKerja ORDER BY idKategori ASC";
																	$execPosisi = mysql_query($queryPosisi);
																	while($resultPosisi = mysql_fetch_array($execPosisi))
																	{
																		?><option value="<?php echo $resultPosisi['idKategori'];?>"><?php echo $resultPosisi['namaKategori'];?></option><?php
																	}
																?>
															</select>
															<div class="input-group">
																<input type="text" id="pemohonPosisiBaru" name="pemohonPosisiBaru" placeholder="Nama posisi baru" class="form-control">
															</div>
														</div>
													</div>
													<div class="form-group" id="show"></div>
													<div class="form-group">
														<label for="pemohonDepartemen" class="col-sm-2 control-label">Departemen *</label>
														<div class="col-lg-10">
															<select name="pemohonDepartemen" id="pemohonDepartemen" class="form-control" required>
																<option value="" disabled>-- Pilih Departemen --</option>
																<?php
																	$queryDepartemen = "SELECT * FROM kategoriDepartemen ORDER BY namaDepartemen ASC";
																	$execDepartemen = mysql_query($queryDepartemen);
																	while($resultDepartemen = mysql_fetch_array($execDepartemen))
																	{
																		?><option value="<?php echo $resultDepartemen['idDepartemen'];?>"><?php echo $resultDepartemen['namaDepartemen'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													
													<h4>II. Informasi Posisi</h4>
													<div class="form-group">
														<label for="posisiDirektorat" class="col-sm-2 control-label">Direktorat</label>
														<div class="col-lg-10">
															<select name="posisiDirektorat" id="posisiDirektorat" class="form-control" required>
																<option value="" disabled>-- Pilih Direktorat --</option>
																<?php
																	$queryDirektorat1 = "SELECT * FROM kategoriDirektorat ORDER BY namaDirektorat ASC";
																	$execDirektorat1 = mysql_query($queryDirektorat1);
																	while($resultDirektorat1 = mysql_fetch_array($execDirektorat1))
																	{
																		?><option value="<?php echo $resultDirektorat1['idDirektorat'];?>"><?php echo $resultDirektorat1['namaDirektorat'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="posisiDepartemen" class="col-sm-2 control-label">Departemen</label>
														<div class="col-lg-10">
															<select name="posisiDepartemen" id="posisiDepartemen" class="form-control" required>
																<option value="" disabled>-- Pilih Departemen --</option>
																<?php
																	$queryDepartemen2 = "SELECT * FROM kategoriDepartemen ORDER BY namaDepartemen ASC";
																	$execDepartemen2 = mysql_query($queryDepartemen2);
																	while($resultDepartemen2 = mysql_fetch_array($execDepartemen2))
																	{
																		?><option value="<?php echo $resultDepartemen2['idDepartemen'];?>"><?php echo $resultDepartemen2['namaDepartemen'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="posisiSection" class="col-sm-2 control-label">Bagian</label>
														<div class="col-lg-10">
															<select name="posisiSection" id="posisiSection" class="form-control" required>
																<option value="" disabled>-- Pilih Bagian --</option>
																<?php
																	$querySection2 = "SELECT * FROM kategoriSection ORDER BY namaDepartemen ASC";
																	$execSection2 = mysql_query($querySection2);
																	while($resultSection2 = mysql_fetch_array($execSection2))
																	{
																		?><option value="<?php echo $resultSection2['idSection'];?>"><?php echo $resultSection2['namaSection'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="posisiJabatan" class="col-sm-2 control-label">Posisi/Jabatan</label>
														<div class="col-lg-10">
															<select name="posisiJabatan" id="posisiJabatan" class="form-control" required>
																<option value="" disabled>-- Pilih Posisi --</option>
																<?php
																	$queryPosisi2 = "SELECT * FROM kategoriKerja ORDER BY idKategori ASC";
																	$execPosisi2 = mysql_query($queryPosisi2);
																	while($resultPosisi2 = mysql_fetch_array($execPosisi2))
																	{
																		?><option value="<?php echo $resultPosisi2['idKategori'];?>"><?php echo $resultPosisi2['namaKategori'];?></option><?php
																	}
																?>
															</select>
															<div class="input-group">
																<input type="text" id="posisiJabatanBaru" name="posisiJabatanBaru" placeholder="Nama posisi baru" class="form-control">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label for="posisiLevel" class="col-sm-2 control-label">Level</label>
														<div class="col-lg-10">
															<select name="posisiLevel" id="posisiLevel" class="form-control" required>
																<option value="" disabled>-- Pilih Level --</option>
																<?php
																	$queryLevel = "SELECT * FROM kategoriLevel ORDER BY namaLevel ASC";
																	$execLevel = mysql_query($queryLevel);
																	while($resultLevel = mysql_fetch_array($execLevel))
																	{
																		?><option value="<?php echo $resultLevel['idLevel'];?>"><?php echo $resultLevel['namaLevel'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="posisiLokasi" class="col-sm-2 control-label">Lokasi Penempatan</label>
														<div class="col-lg-10">
															<select name="posisiLokasi" id="posisiLokasi" class="form-control" required>
																<option value="" disabled>-- Pilih Lokasi --</option>
																	<?php
																		$distrik = "SELECT * FROM kategoriDistrik ORDER BY namaDistrik ASC";
																		$execDistrik = mysql_query($distrik);
																		while($resultDistrik = mysql_fetch_array($execDistrik))
																		{ 
																			?><option value="<?php echo $resultDistrik['idDistrik'];?>"><?php echo $resultDistrik['namaDistrik'];?></option><?php
																		}
																	?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="posisiJumlah" class="col-sm-2 control-label">Jumlah Kebutuhan</label>
														<div class="col-lg-10">
															<input type="text" name="posisiJumlah" class="form-control" id="posisiJumlah" placeholder="Jumlah Kebutuhan" required>
														</div>
													</div>
													<div class="form-group">
														<label for="posisiTujuan" class="col-sm-2 control-label">Tujuan Permintaan</label>
														<div class="col-lg-10">
															<label class="radio-inline"><input type="radio" name="posisiTujuan" id="posisiTujuanBaru" value="Rekrut Baru" checked>Rekrut Baru</label>
															<label class="radio-inline"><input type="radio" name="posisiTujuan" id="posisiTujuanGanti" value="Penggantian">Penggantian</label>
															<div class="input-group">
																<input type="text" id="posisiPengganti" name="posisiPengganti" placeholder="Penggantian, Atas Nama" class="form-control">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label for="posisiTanggal" class="col-sm-2 control-label">Tanggal Dibutuhkan</label>
														<div class="col-lg-10">
															<?php $lahir = new DateTime;?>
															<input type="date" class="form-control" name="posisiTanggal" id="posisiTanggal" value="<?php echo $lahir->format('Y-m-d');?>" required>
														</div>
													</div>
													<div class="form-group">
														<label for="posisiJobdes" class="col-sm-2 control-label">Deskripsi Kerja</label>
														<div class="col-lg-10">
															<label class="radio-inline"><input type="radio" name="posisiJobdes" id="posisiJobdesAda" value="Ada" default>Ada</label>
															<label class="radio-inline"><input type="radio" name="posisiJobdes" id="posisiJobdesTidak" value="Tidak Ada">Tidak Ada</label>
															<p class="help-block">*Jika tidak ada, wajib membuat dan melampirkan.</p>
														</div>
													</div>
													<div class="form-group">
														<label for="posisiStatus" class="col-sm-2 control-label">Status Karyawan</label>
														<div class="col-lg-10">
															<label class="radio-inline"><input type="radio" name="posisiStatus" id="posisiStatusBulanan" value="Bulanan" default>Bulanan</label>
															<label class="radio-inline"><input type="radio" name="posisiStatus" id="posisiStatusHarian" value="Harian">Harian</label>
														</div>
													</div>
													
													<h4>III. Kualifikasi</h4>
													<div class="form-group">
														<label for="kualifikasiJumlahl" class="col-sm-2 control-label">Jumlah Dibutuhkan</label>
														<div class="col-lg-10">
															<div class="input-group">
																<div class="input-group-addon">Laki-Laki</div>
																<input type="text" name="kualifikasiJumlahl" class="form-control" id="kualifikasiJumlahl">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-offset-2 col-lg-10">
															<div class="input-group">
																<div class="input-group-addon">Perempuan</div>
																<input type="text" name="kualifikasiJumlahp" class="form-control" id="kualifikasiJumlahp">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label for="kualifikasiUsia" class="col-sm-2 control-label">Usia</label>
														<div class="col-lg-10">
															<input type="text" name="kualifikasiUsia" class="form-control" id="kualifikasiUsia" placeholder="Usia" required>
														</div>
													</div>
													<div class="form-group">
														<label for="kualifikasiPendidikan" class="col-sm-2 control-label">Pendidikan</label>
														<div class="col-lg-10">
															<select name="kualifikasiPendidikan" id="kualifikasiPendidikan" class="form-control" required>
																<?php
																	$queryPendidikan = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
																	$execPendidikan = mysql_query($queryPendidikan);
																	while($resultPendidikan = mysql_fetch_array($execPendidikan))
																	{
																		?><option value="<?php echo $resultPendidikan['gradePendidikan'];?>"><?php echo $resultPendidikan['namaPendidikan'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="kualifikasiJurusan" class="col-sm-2 control-label">Jurusan</label>
														<div class="col-lg-10">
															<select name="kualifikasiJurusan" id="kualifikasiJurusan" class="form-control" required>
																<?php
																	$queryJurusan = "SELECT * FROM tableJurusan ORDER BY namaJurusan ASC";
																	$execJurusan = mysql_query($queryJurusan);
																	while($resultJurusan = mysql_fetch_array($execJurusan))
																	{
																		?><option value="<?php echo $resultJurusan['idJurusan'];?>"><?php echo $resultJurusan['namaJurusan'];?></option><?php
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="kualifikasiPengalaman" class="col-sm-2 control-label">Pengalaman</label>
														<div class="col-lg-10">
															<input type="text" name="kualifikasiPengalaman" class="form-control" id="kualifikasiPengalaman" placeholder="Pengalaman" required>
														</div>
													</div>
													<div class="form-group">
														<label for="kualifikasiLainlain" class="col-sm-2 control-label">Lain-Lain</label>
														<div class="col-lg-10">
															<textarea type="text" name="kualifikasiLainlain" class="form-control" placeholder="Lain-Lain" id="kualifikasiLainlain"></textarea>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-offset-2 col-md-6">
															<button type="submit" class="btn btn-primary" id="saveFptk" name="saveFptk">Simpan</button>
															<button type="button" class="btn btn-default" id="batalFptk">Batal</button>
														</div>
													</div>
												</form>
											</div>
										</section>
									</div>
								</div>
							</div>
							<!--body wrapper end-->

							<!--footer section start-->
							<footer>2016 &copy; PT Pratama Nusantara Sakti</footer>
							<!--footer section end-->
						</div>
					<!-- body content end-->
					</section>	
		
		<link rel="shortcut icon" href="javascript:;" type="image/png">
		<? include('layout/css-file.php') ?>
		
		<!-- Placed js at the end of the document so the pages load faster -->
		<script src="js/jquery-1.10.2.min.js"></script>

		<!--jquery-ui-->
		<script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="js/jquery-migrate.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/modernizr.min.js"></script>

		<!--Nice Scroll-->
		<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

		<!--right slidebar-->
		<script src="js/slidebars.min.js"></script>

		<!--switchery-->
		<script src="js/switchery/switchery.min.js"></script>
		<script src="js/switchery/switchery-init.js"></script>

		<!--flot chart -->
		<script src="js/flot-chart/jquery.flot.js"></script>
		<script src="js/flot-chart/flot-spline.js"></script>
		<script src="js/flot-chart/jquery.flot.resize.js"></script>
		<script src="js/flot-chart/jquery.flot.tooltip.min.js"></script>
		<script src="js/flot-chart/jquery.flot.pie.js"></script>
		<script src="js/flot-chart/jquery.flot.selection.js"></script>
		<script src="js/flot-chart/jquery.flot.stack.js"></script>
		<script src="js/flot-chart/jquery.flot.crosshair.js"></script>

		<!--earning chart init-->
		<script src="js/earning-chart-init.js"></script>

		<!--Sparkline Chart-->
		<script src="js/sparkline/jquery.sparkline.js"></script>
		<script src="js/sparkline/sparkline-init.js"></script>

		<!--easy pie chart-->
		<script src="js/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="js/easy-pie-chart.js"></script>

		<!--vectormap-->
		<script src="js/vector-map/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="js/vector-map/jquery-jvectormap-world-mill-en.js"></script>
		<script src="js/dashboard-vmap-init.js"></script>

		<!--Icheck-->
		<script src="js/icheck/skins/icheck.min.js"></script>
		<script src="js/todo-init.js"></script>

		<!--jquery countTo-->
		<script src="js/jquery-countTo/jquery.countTo.js"  type="text/javascript"></script>

		<!--owl carousel-->
		<script src="js/owl.carousel.js"></script>

		<!--common scripts for all pages-->
		<script src="js/scripts.js"></script>

		<script type="text/javascript">
			$(document).ready(function() 
			{
				//countTo
				$('.timer').countTo();
				//owl carousel
				$("#news-feed").owlCarousel({
					navigation : true,
					slideSpeed : 300,
					paginationSpeed : 400,
					singleItem : true,
					autoPlay:true
				});
			});
			$(window).on("resize",function(){
				var owl = $("#news-feed").data("owlCarousel");
				owl.reinit();
			});
		</script>
	</body>
</html>		