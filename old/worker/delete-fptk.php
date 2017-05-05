<?php
	session_start();
	$title = "fptk";
	include("../assets/dbconfig.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
		{
			if(!isset($_GET['idFptk']))
			{
				header("Location: fptk.php");
			}
			else
			{
				$idFptk = $_GET['idFptk'];
				$queryGetDeleteRecord = "SELECT * FROM fptk WHERE idFptk = $idFptk";
				$execGetDeleteRecord = mysql_query($queryGetDeleteRecord);
				if(mysql_num_rows($execGetDeleteRecord) > 0)
				{
					$queryDeleteRecord = "DELETE FROM idFptk WHERE idFptk = $idFptk";
					$execDeleteRecord = mysql_query($queryDeleteRecord);

					include("templates/head.php");
					?>
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							The FPTK has been deleted.
						</div>
						<a href="fptk.php"><button type="button" class="btn btn-primary">Back</button></a>
					<?php
					include("templates/foot.php");
				}
				else
				{
					header("Location: fptk.php");
				}
			}
		}
		else if(isset($_SESSION['admin']))
		{
			header("Location:../admin/");
		}
		else if(isset($_SESSION['hrd']))
		{
			header("Location:../hrd/");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>