<?php
	session_start();
	include("../assets/dbconfig.php");
	$title = "about";
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
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
			if(isset($_POST['update-ppkpk']))
			{
				$about = htmlentities($_POST['about']);
				$admin = $_POST['admin'];
				$tel1 = $_POST['tel1'];
				$tel2 = $_POST['tel2'];
				$email1 = $_POST['email1'];
				$email2 = $_POST['email2'];
				$alamat = addslashes($_POST['alamat']);

				$queryUpdate = "UPDATE aboutPPKPK SET about = '$about', adminPPKPK = '$admin', telephone1 = '$tel1', telephone2 = '$tel2', email1 = '$email1', email2 = '$email2', alamat = '$alamat' WHERE idTable = 1";
				$execUpdate = mysql_query($queryUpdate) or die("SQL ERROR");
			}
			$queryAboutPPKPK = "SELECT * FROM aboutPPKPK";
			$execAboutPPKPK = mysql_query($queryAboutPPKPK);
			$result = mysql_fetch_array($execAboutPPKPK);
			?>
				<form action="about.php" role="form" method="post" class="form-horizontal">
					<div class="form-group">
						<label for="about" class="col-md-2 control-label">About Company</label>
						<div class="col-md-8">
							<textarea name="about" id="about" rows="15" class="form-control" value="<?php echo $result['about'];?>">
							<?php echo html_entity_decode($result['about']);?>
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="admin" class="col-md-2 control-label">Admin</label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="admin" id="admin" value="<?php echo $result['adminPPKPK'];?>" placeholder="Admin PPKPK">
						</div>
					</div>
					<div class="form-group">
						<label for="tel1" class="col-md-2 control-label">Phone Number</label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="tel1" id="tel1" placeholder="No Telephone" value="<?php echo $result['telephone1'];?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="tel2" class="col-md-2 control-label">Other Phone Number</label>
						<div class="col-md-5">
							<input type="tel" class="form-control" name="tel2" id="tel2" value="<?php echo $result['telephone2'];?>" placeholder="Other Phone Number">
						</div>
					</div>
					<div class="form-group">
						<label for="email1" class="col-md-2 control-label">Email</label>
						<div class="col-md-5">
							<input type="email" class="form-control" name="email1" id="email1" placeholder="Email" value="<?php echo $result['email1'];?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="email2" class="col-md-2 control-label">Other Email</label>
						<div class="col-md-5">
							<input type="email" class="form-control" name="email2" id="email2" placeholder="Email Lain" value="<?php echo $result['email2'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="alamat" class="col-md-2 control-label">Address</label>
						<div class="col-md-5">
							<textarea name="alamat" id="alamat" rows="3" class="form-control"><?php echo $result['alamat'];?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-4">
							<button type="submit" name="update-ppkpk" class="btn btn-primary">Save</button>
						</div>
					</div>		
				</form>
			<?php
			include("templates/foot.php");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>