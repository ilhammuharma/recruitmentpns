<?php
session_start();

$head = "";
include("../assets/dbconfig.php");

if(!isset($_SESSION['worker']))
{
	header("Location:../index.php");
}
else
{
	if(isset($_POST['apply']))
	{
		include("templates/head.php");
		//$idTable = $_POST['idTable'];
		$idLowongan = $_POST['id-lowongan'];
		$idWorker = $_SESSION['idWorker'];
		//$_SESSION['idWorker'] = $idWorker;
		$getStatus = "SELECT * FROM applyLowongan WHERE idLowongan = '$idLowongan' AND idWorker = '$idWorker'";
		//echo $getStatus;
		$execStatus = mysql_query($getStatus);
		?>
			<div class="container">
				<div class="col-md-9">
					<div class="box-no-border">
						<?php
							if(mysql_num_rows($execStatus) > 0)
							{
								?>
									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<p>Anda telah mendaftar lowongan ini. Silakan cari lowongan lainnya!</p>
									</div>
									<a href="../index.php"><button class="btn btn-success">Back to Homepage</button></a>
								<?php
							}
							else
							{
								$queryApply = "INSERT INTO applyLowongan (idTable, idLowongan, idWorker) VALUES('','$idLowongan', '$idWorker')";
								//echo $queryApply;
								$execApply = mysql_query($queryApply);
								?>
									<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<p>Anda telah mendaftar lowongan ini.</p>
									</div>
									<a href="../index.php"><button class="btn btn-success">Back to Homepage</button></a>
								<?php 
							}
						?>
					</div>
				</div>
				<?php include("templates/right-menu.php"); ?>
			</div>
		<?php
		include("templates/foot.php");
	}
	else
	{
		header("Location:../index.php");
	}
}
?>