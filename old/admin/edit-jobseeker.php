<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<style>
			.custom-combobox 
			{
				position: relative;
				display: inline-block;
			}
			.custom-combobox-toggle 
			{
				position: absolute;
				top: 0;
				bottom: 0;
				margin-left: -1px;
				padding: 0;
			}
			.custom-combobox-input 
			{
				margin: 0;
				padding: 5px 10px;
			}
		</style>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
		
		<script type="text/javascript"> //Bagian ini yang digunakan untuk refer
			var htmlobjek;
			$(document).ready(function()
			{
			  //apabila terjadi event onchange terhadap object <select id=kategori>
				$(statusRekrut).change(function()
				{
					var statusRekrut = $("#statusRekrut").val();
					$.ajax
					({
						url: "fptk-jobSeeker.php",
						data: "statusRekrut="+statusRekrut,
						cache: false,
						success: function(msg)
						{
							//jika data sukses diambil dari server kita tampilkan
							//di <select id=sub_kategori>
							$("#show").html(msg);
						}
					});
				});
			});
		</script>
	</head>

<?php
	session_start();
	$title = "job-seeker";
	include("../assets/dbconfig.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location: index.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
		{
			header("Location:../worker/");
		}
		else if(isset($_SESSION['hrd']))
		{
			header("Location:../hrd/");
		}
		else if(isset($_SESSION['admin']))
		{
			include("templates/head.php");
			if(isset($_POST['edit-jobseeker']))
			{
				$idWorker = $_POST['idWorker'];
				$statusRekrut = $_POST['statusRekrut'];
				if(isset($_POST['ubahFptk']))
				{
					$ubahFptk = $_POST['ubahFptk'];
					$user = $_SESSION['username'];
				}
				else
				{
					$ubahFptk = "";
					$user = "";
				}
				
				//echo $_POST['ubahFptk'];
				if($statusRekrut==2)
				{
					$queryUpdate = "UPDATE userWorker SET statusRekrut='$statusRekrut', nomorFptk='$ubahFptk', pic='$user' WHERE idWorker = $idWorker";
				}
				else
				{
					$queryUpdate = "UPDATE userWorker SET statusRekrut='$statusRekrut', pic='$user' WHERE idWorker = $idWorker";
				}
				$execUpdate = mysql_query($queryUpdate);
				?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>The status of the applicants have been successfully edited.
					</div>
					<a href="job-seeker.php"><button class="btn btn-success">Back</button></a>
				<?php
			}
			else
			{
				$idWorker = $_GET['id'];
				$queryEditStatusRekrut = "SELECT * FROM userWorker WHERE idWorker = $idWorker";
				$execEditStatusRekrut = mysql_query($queryEditStatusRekrut);
				$statusRekrut = mysql_fetch_array($execEditStatusRekrut);
				?>
					<h3>Edit Status</h3>
					<form action="edit-jobseeker.php" id="editJobseeker" role="form" class="form-horizontal" method="post">
						<input type="hidden" value="<?php echo $statusRekrut['idWorker'];?>" name="idWorker">
						<div class="form-group">
							<label for="statusRekrut<?php echo $statusRekrut['idWorker'];?>" class="col-md-2">Status</label>
							<div class="col-md-2">
								<select name="statusRekrut" id="statusRekrut" class="form-control" class="autocombo" onchange="change()">
									<?php 
										$queryStatusRekrut = "SELECT * FROM tableStatusRekrut";
										$execStatusRekrut = mysql_query($queryStatusRekrut);
										while($statusPelamar = mysql_fetch_array($execStatusRekrut))
										{
											?><option value="<?php echo $statusPelamar['idTable'];?>"><?php echo $statusPelamar['namaStatus'];?></option><?php 
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group" id="show"></div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-6">
								<button type="submit" name="edit-jobseeker" class="btn btn-primary btn-sm">Save</button>
							</div>
						</div>
					</form>
				<?php
			}
			include("templates/foot.php");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>
</html>