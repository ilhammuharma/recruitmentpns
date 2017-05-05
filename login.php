<?php
	session_start();
	if(isset($_SESSION['id'])){header("Location:index.php");}else{
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <? include('layout/css-file.php') ?>
    <title>Login PNS Recruitment</title>
	<link rel="icon" href="assets/img/logo-icon.png" sizes="32x32" />
	<link rel="icon" href="assets/img/logo-icon.png" sizes="192x192">
    <!--easy pie chart-->
    <link href="js/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />

    <!--vector maps -->
    <link rel="stylesheet" href="js/vector-map/jquery-jvectormap-1.1.1.css">

    <!--right slidebar-->
	<link href="css/slidebars.css" rel="stylesheet">

    <!--switchery-->
    <link href="js/switchery/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />

	<!--Data Table-->
    <link href="js/data-table/css/jquery.dataTables.css" rel="stylesheet">
    <link href="js/data-table/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="js/data-table/css/dataTables.colVis.min.css" rel="stylesheet">
    <link href="js/data-table/css/dataTables.responsive.css" rel="stylesheet">
    <link href="js/data-table/css/dataTables.scroller.css" rel="stylesheet">
    <!-- Base Styles -->
	
    <!--jquery-ui-->
    <link href="js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" />

    <!--iCheck-->
    <link href="js/icheck/skins/all.css" rel="stylesheet">
	
	<!--common style-->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    <!--common style-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
		<body class="login-body">
			<div class="container log-row">
			
				<form class="form-signin" action="log.php" method="post">
					<div class="login-wrap" style="text-align:center;">
						<img src="assets/img/logo-login.png" alt="" style="margin:20px;"/>
						
						<? if(isset($_SESSION['username'])){ $kk=$_SESSION['username'];  ?>                 
							<div class="alert alert-block alert-danger fade in" style="padding:10px;">
								<button data-dismiss="alert" class="close close-sm" type="button">
									<i class="fa fa-times"></i>
								</button>
								<strong>Failed!</strong> Username or password not match.
							</div>
							
						<? }else{ $kk="";} ?>
						
						<input type="text" class="form-control" name="username" placeholder="Username" autofocus value="<?=$kk?>">
						<input type="password" class="form-control" placeholder="Password" name="password" >
						<input class="btn btn-lg btn-success btn-block" type="submit" value="LOGIN" name="login">
						
					</div>
					<!-- Modal -->
					
				</form>
			</div>
			<!--jquery-ui-->
			<script>
			setTimeout(function() {
				$('.alert-danger').fadeOut('slow');
			}, 2500);
			</script>
			<script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
			<script src="js/jquery-1.11.1.min.js"></script>
			<script src="js/jquery-migrate.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/modernizr.min.js"></script>
		</body>
		
</html>
<?php
	unset($_SESSION['username']);}
?>