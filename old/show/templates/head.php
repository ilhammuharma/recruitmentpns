<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Career Development Center PT Pratama Nusantara Sakti</title>

		<!-- Bootstrap -->
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link href="../assets/event-calendar/calendar.css" rel="stylesheet" type="text/css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	
	<body>
		<!-- Fixed navbar -->
			<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="../index.php">PT PRATAMA NUSANTARA SAKTI</a>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li<?php if($head == "index"){ echo " class='active'";}?>><a href="../index.php">HOME</a></li>
							<li<?php if($head == "aboutus"){ echo " class='active'";}?>><a href="../aboutus.php">PROFILE</a></li>
							<li<?php if($head == "press"){ echo " class='active'";}?>><a href="all-artikel.php">ARTICLE</a></li>
						</ul>
						<?php 
							if(isset($_SESSION['username']))
							{ 
								?>
									<ul class="nav navbar-nav navbar-right">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "Hello, ".$_SESSION['username'];?> <span class="caret"></span></a>
											<ul class="dropdown-menu" role="menu">
												<li><a href="../worker/index.php">DASHBOARD</a></li>
												<li><a href="../logout.php">SIGN OUT <span class="glyphicon glyphicon-log-out"></span></a></li>
											</ul>
										</li>
									</ul>
								<?php 
							} 
						?>
						<form class="navbar-form navbar-right" role="form" action="../search.php" method="get">
							<div class="form-group">
								<div class="input-group">
									<input type="text" placeholder="Cari Lowongan" class="form-control" name="query" required>
									<span class="input-group-btn">
										<button type="submit"class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
									</span>
								</div>
							</div>
						</form>
					</div><!--/.nav-collapse -->
				</div>
			</div>
			
			<!--Start Jumbotron -->
				<!--<h1>Jumbotron</h1>
					<p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
					<p><a class="btn btn-primary btn-lg">Learn more</a></p>
				-->
			<!-- End Jumbotron -->