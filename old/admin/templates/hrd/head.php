<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">
		<title>Department Dashboard</title>

		<!-- Bootstrap core CSS -->
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
						<li class="hide-menu <?php if($title == "review"){echo "active";}?>"><a href="index.php">Review</a></li>
						<li class="hide-menu"><a href="">Messages <span class="badge pull-right">0</span></a></li>
						<li class="hide-menu <?php if($title == "posting"){echo "active";}?>"><a href="posting.php">Posting Vacancy</a></li>
						<li class="hide-menu <?php if($title == "posted"){echo "active";}?>"><a href="posted.php">Existing Vacancies
							<?php
								$username = $_SESSION['username'];
								$queryGetTotalPost = "SELECT * from postingLowongan WHERE idHrd = (SELECT idHrd FROM userHrd WHERE idLogin = (SELECT idLogin FROM loginHrd WHERE username = '$username'))";
								$totalPost = mysql_num_rows(mysql_query($queryGetTotalPost));
							?>
							<span class="badge pull-right"><?php echo $totalPost;?></span></a>
						</li>
						<li class="hide-menu <?php if($title == "account"){echo "active";}?>"><a href="account.php">Department Account</a></li>
						<li class="hide-menu <?php if($title == "change"){ echo "active";}?>"><a href="changePassword.php">Change Password</a></li>
						<li class="hide-menu <?php if($title == "search"){echo "active";}?>"><a href="search.php">Quick Search of Applicants</a></li>
						<li class="hide-menu <?php if($title == "asearch"){echo "active";}?>"><a href="asearch.php">Advanced Search of Applicants</a></li>
						<li><a href="logout.php">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>
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
					<li<?php if($title == "review"){echo " class='active'";}?>><a href="index.php">Review</a></li>
					<!-- <li><a href="#">Another Company</a></li> -->
					<li><a href="">Messages <span class="badge pull-right">0</span></a></li>
				</ul>
				<ul class="nav nav-sidebar">
					<li<?php if($title == "posting"){echo " class='active'";}?>><a href="posting.php">Posting Vacancy</a></li>
					<li<?php if($title == "posted"){echo " class='active'";}?>><a href="posted.php">Existing Vacancies
						<?php
							$username = $_SESSION['username'];
							$queryGetTotalPost = "SELECT * from postingLowongan WHERE idHrd = (SELECT idHrd FROM userHrd WHERE idLogin = (SELECT idLogin FROM loginHrd WHERE username = '$username'))";
							$totalPost = mysql_num_rows(mysql_query($queryGetTotalPost));
						?>
						<span class="badge pull-right"><?php echo $totalPost;?></span></a>
					</li>
				</ul>
				<ul class="nav nav-sidebar">
					<li<?php if($title == "account"){echo " class='active'";}?>><a href="account.php">Department Account</a></li>
					<li<?php if($title == "change"){ echo " class='active'";}?>><a href="changePassword.php">Change Password</a></li>
				</ul>
				<ul class="nav nav-sidebar">
					<li<?php if($title == "search"){echo " class='active'";}?>><a href="search.php">Quick Search of Applicants</a></li>
					<li<?php if($title == "asearch"){echo " class='active'";}?>><a href="asearch.php">Advanced Search of Applicants</a></li>
				</ul>
				<!-- <form action="search.php" role="form">
					<div class="form-group">
						<div class="input-group">
							<input type="text" name="query" id="query" class="form-control" placeholder="Quick Search of Applicants" required>
							<span class="input-group-btn">
								<button class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
							</span>
						</div>                     
					</div>
				</form>
				<ul class="nav nav-sidebar">
					<li><div class="mid-button"><a href="asearch.php"><button class="btn btn-default">Advanced Search of Applicants</button></a></div></li>
				</ul> -->
				<!-- Kontak PNS -->
				<div class="panel panel-primary">
					<div class="panel-body">
						For more information please contact:<br>
						Phone : (021) 5794 1785 </br>
						Email : <a href="mail-to:career@pns.co.id">career@pns.co.id</a>, <a href="mail-to:hrd@pns.co.id">hrd@pns.co.id</a>
					</div>
				</div>         
				<!-- End Contact PNS -->
			</div> <!-- End Sidebar -->
			<!-- Start Main Area -->
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">