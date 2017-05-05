<?php
	session_start();
	
	if(isset($_SESSION['username']))
	{
	header("Location:index.php");
	}
	else
	{
		?>
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<meta name="description" content="">
					<meta name="author" content="">
					<link rel="icon" href="../../favicon.ico">
					<title>Department Sign In</title>
					
					<!-- Bootstrap core CSS -->
					<link href="../css/bootstrap.min.css" rel="stylesheet">

					<!-- Custom styles for this template -->
					<link href="../css/signin.css" rel="stylesheet">

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
						<div class="container">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="index.php">PT PRATAMA NUSANTARA SAKTI</a>
							</div>
							<div class="navbar-collapse collapse">
								<ul class="nav navbar-nav">
									<li><a href="../index.php">HOME</a></li>
									<li><a href="../aboutus.php">PROFILE</a></li>
									<li><a href="../show/all-artikel.php">ARTICLE</a></li>
								</ul>
								<form class="navbar-form navbar-right" role="form" action="../search.php" method="get">
									<div class="form-group">
										<div class="input-group">
											<input type="text" placeholder="Search Vacancies" class="form-control" name="query" required>
											<span class="input-group-btn">
												<button type="submit"class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
											</span>
										</div>
									</div>
								</form>
							</div><!--/.nav-collapse -->
						</div>
					</div>
					
					<div class="container">
						<form class="form-signin" role="form" action="index.php" method="post">
							<h2 class="form-signin-heading center">Sign In Department</h2>
							<input name="username" type="text" class="form-control" placeholder="Username" required autofocus>
							<input name="password" type="password" class="form-control" placeholder="Password" required>
							<?php
								if(isset($_SESSION['error']))
								{
									echo	'<div class="alert alert-danger alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												'.$_SESSION['error'].'
											</div>';
									unset($_SESSION['error']);
								}
							?>					
							<button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
						</form>
						
						<div class="center">
							<a href="forgot.php"><p>Forgot Password</p></a>
								<?php
									if(isset($_SESSION['username']))
									{
										?>
											<a href="logout.php"><button class="btn btn-warning">Logout</button></a>
										<?php
									}
								?>
						</div>
					</div> <!-- /container -->
					<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
					<script src="../js/jquery.min.js"></script>
					<script src="../js/bootstrap.min.js"></script>
					<script src="../js/docs.min.js"></script>
					<script src="../js/ie10-viewport-bug-workaround.js"></script>
					<script type="text/javascript">
						$(".alert").alert();
					</script>
				</body>
			</html>
		<?php
	}
?>