<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>Admin Dashboard</title>

		<!-- Bootstrap core CSS -->
		<script src="../js/jquery.min.js"></script>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/font-awesome.css">

		<!-- Custom styles for this template -->
		<link href="../css/dashboard.css" rel="stylesheet">
		
		<!--<link rel="stylesheet" href="../css/style.css">-->
		<?php if($title == "resume"){?> <link rel="stylesheet" href="../assets/datepicker/css/datepicker.css"><?php }?>

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="../js/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">PT PRATAMA NUSANTARA SAKTI</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="../">HOME</a></li>
						<li><a href="../aboutus.php">PROFILE</a></li>
						<li><a href="../show/all-artikel.php">ARTICLE</a></li>
						<li><a href="logout.php">SIGN OUT <span class="glyphicon glyphicon-log-out"></span></a></li>
						<li class="hide-menu <?php if($title == "review"){echo "active";}?>"><a href="index.php">Review</a></li>
						<li class="hide-menu <?php if($title == "fptk"){echo "active";}?>"><a href="fptk.php">Posting FPTK</a></li>
						<li class="hide-menu <?php if($title == "posting"){echo "active";}?>"><a href="posting.php">Posting Vacancy</a></li>
						<li class="hide-menu <?php if($title == "existingVacancies"){echo "active";}?>"><a href="existingVacancies.php">Existing Vacancies
							<?php
								$username = $_SESSION['username'];
								$queryGetTotalPost = "SELECT * from postingLowongan WHERE idHrd = (SELECT idHrd FROM userHrd WHERE idLogin = (SELECT idLogin FROM loginHrd WHERE username = '$username'))";
								$totalPost = mysql_num_rows(mysql_query($queryGetTotalPost));
							?>
							<span class="badge pull-right"><?php echo $totalPost;?></span></a>
						</li>
						<li class="hide-menu <?php if($title == "change"){ echo "active";}?>"><a href="changePassword.php">Change Password</a></li>
						<li class="hide-menu <?php if($title == "search"){echo "active";}?>"><a href="search.php">Quick Search of Applicants</a></li>
						<li class="hide-menu <?php if($title == "asearch"){echo "active";}?>"><a href="asearch.php">Advanced Search of Applicants</a></li>
						
					</ul>

					<!--<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search...">
					</form>-->
				</div>
			</div>
		</div>
    <div class="container-fluid">
		<div class="row">
        <!-- Start Sidebar -->
			<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li<?php if($title=="review"){ echo ' class="active"';}?>><a href="index.php">RESENSI</a></li>
				
				<?php
					$queryDataEmployee = "SELECT * FROM loginUser WHERE level=3";
					$execDataEmployee = mysql_query($queryDataEmployee);
				?>
				<li<?php if($title=="data-employee"){ echo ' class="active"';}?>><a href="data-employee.php">DAFTAR PEGAWAI<span class="badge pull-right"><?php echo mysql_num_rows($execDataEmployee);?></span></a></li>
				
				<?php
					$queryJobSeeker = "SELECT * FROM userWorker INNER JOIN loginUser ON loginUser.idLogin = userWorker.idLogin WHERE loginUser.level=2";
					$execJobSeeker = mysql_query($queryJobSeeker);
				?>
				<li<?php if($title=="job-seeker"){ echo ' class="active"';}?>><a href="job-seeker.php">DAFTAR KANDIDAT<span class="badge pull-right"><?php echo mysql_num_rows($execJobSeeker);?></span></a></li>
				
				<li<?php if($title == "fptk"){echo " class='active'";}?>><a href="fptk.php">DAFTAR FPTK
				<span class="badge pull-right">
					<?php
						$queryFptk = "SELECT * FROM fptk";
						$execFptk = mysql_query($queryFptk);
						echo mysql_num_rows($execFptk);
					?>
				</span></a></li>
				
				<li<?php if($title == "reportDataSourcing"){echo " class='active'";}?>><a href="reportDataSourcing.php">LAPORAN DATA SOURCING
				<span class="badge pull-right">
					<?php
						$queryReportSourcing = "SELECT * FROM fptk";
						$execReportSourcing = mysql_query($queryReportSourcing);
						echo mysql_num_rows($execReportSourcing);
					?>
				</span></a></li>
				
				<?php
					$queryReportFptk = "SELECT * FROM fptk";
					$execReportFptk = mysql_query($queryReportFptk);
				?>
				<li<?php if($title=="reportFptk"){ echo ' class="active"';}?>><a href="reportFptk.php">LAPORAN FPTK</a></li>
				
				<li<?php if($title=="registrasi"){ echo ' class="active"';}?>><a href="eregister.php">TAMBAH PEGAWAI</a></li>
				
				<?php
					$queryHrd = "SELECT * FROM userWorker";
					$execHrd = mysql_query($queryHrd);
				?>
				<li<?php if($title=="department"){ echo ' class="active"';}?>><a href="company.php">AKUN PERUSAHAAN</a></li>

				<li<?php if($title == "posting"){echo " class='active'";}?>><a href="posting.php">PASANG LOWONGAN</a></li>
				
				<li<?php if($title=="posted"){ echo ' class="active"';}?>><a href="posted.php">DAFTAR LOWONGAN 
				<span class="badge pull-right">
					<?php
						$queryJobList = "SELECT * FROM postingLowongan";
						$execJobList = mysql_query($queryJobList);
						echo mysql_num_rows($execJobList);
					?>
				</span></a></li>
				
				<li<?php if($title == "search"){echo " class='active'";}?>><a href="search.php">PENCARIAN CEPAT</a></li>
				
				<li<?php if($title == "asearch"){echo " class='active'";}?>><a href="asearch.php">PENCARIAN LANJUT</a></li>
				
				<li<?php if($title=="event"){ echo ' class="active"';}?>><a href="event.php">ACARA 
				<span class="badge pull-right">
					<?php
						$queryEvents = "SELECT * FROM event_calendar";
						$execEvents = mysql_query($queryEvents);
						echo mysql_num_rows($execEvents);
					?>
				</span></a></li>
				
				<li<?php if($title=="article"){ echo ' class="active"';}?>><a href="articles.php">ARTIKEL 
				<span class="badge pull-right">
					<?php
						$queryArticle = "SELECT * FROM tableArticle";
						$execArticle = mysql_query($queryArticle);
						echo mysql_num_rows($execArticle);
					?>
				</span></a></li>
				
				<li<?php if($title == "slider"){ echo " class='active'";}?>><a href="slider.php">GAMBAR SLIDER</a></li>
				
				<li<?php if($title == "about"){ echo " class='active'";}?>><a href="about.php">INFORMASI PERUSAHAAN</a></li>
				
				<li<?php if($title == "change"){ echo " class='active'";}?>><a href="changePassword.php">GANTI KATA SANDI</a></li>
			</ul>
			
			<!--<form action="#" role="form">
				<div class="form-group">
					<input type="text" name="" id="" class="form-control" placeholder="Quick Search Job Seeker">
					<button type="submit" class="btn btn-success inner-input"><span class="glyphicon glyphicon-search"></span></button>
					<div class="mid-button"><button class="btn btn-default">Advance Search</button></div>           
				</div>
			</form> -->
        </div> <!-- End Sidebar -->
        <!-- Start Main Area -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">