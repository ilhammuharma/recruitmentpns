<?php
	session_start();
	$title = "posted";
	include("../assets/dbconfig.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_SESSION['admin']))
		{
			if(!isset($_GET['id']))
			{
				header("Location:articles.php");
			}
			else
			{
				$id = $_GET['id'];
				$queryGetDeleteRecord = "SELECT * FROM tableArticle WHERE idArticle = $id";
				$execGetDeleteRecord = mysql_query($queryGetDeleteRecord);
				if(mysql_num_rows($execGetDeleteRecord) > 0)
				{
					$queryDeleteRecord = "DELETE FROM tableArticle WHERE idArticle = $id";
					$execDeleteRecord = mysql_query($queryDeleteRecord) or die("SQL ERROR");

					include("templates/head.php");
					?>
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							The article has been deleted.
						</div>
						<a href="articles.php"><button type="button" class="btn btn-primary">Back</button></a>
					<?php
					include("templates/foot.php");
				}
				else
				{
					header("Location:articles.php");
				}
			}
		}
		else if(isset($_SESSION['worker']))
		{
			header("Location:../worker/");
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