<?php
	session_start();
	include("../assets/dbconfig.php");
	
	if(!isset($_GET['secret']))
	{
		if(isset($_POST['email']))
		{
			$email = $_POST['email'];
			$npassword = $_POST['npassword'];
			$rnpassword = $_POST['rnpassword'];
			$md5password = md5($npassword);
			$queryReset = "UPDATE loginWorker SET password = '$md5password', resetCode = '', active = 1 WHERE email='$email'";
			$execQuery = mysql_query($queryReset);
			include("templates/utilHead.php");
				?>
					<div class="center">
						<p>The password has been reset. Please sign in</p>
						<a href="login.php"><button class="btn btn-primary">Sign In</button></a>
					</div>
				<?php
			include("templates/utilFoot.php");
		}
		else
		{
			//header("Location:login.php");
			include("templates/utilHead.php");
				?>	
					<div class="center">
						<form class="form-inline" role="form" action="reset.php" method="get">
							<div class="form-group">
								<label class="sr-only" for="secret">Secret Code</label>
								<input type="text" class="form-control" id="secret" placeholder="Enter The Code" name="secret">
							</div>
							<button type="submit" class="btn btn-primary">Reset Password</button>
						</form>
					</div>
				<?php
			include("templates/utilFoot.php");
		}
	}
	else
	{
		$secret = $_GET['secret'];
		$now = date("Y-m-d H:i:s");
		$queryCheck = "SELECT * from loginWorker WHERE resetCode = '$secret' and validUntil > '$now'";
		$result = mysql_query($queryCheck);
		$email = mysql_fetch_array($result);
		if($result)
		{
			if(mysql_num_rows($result) > 0)
			{
				include("templates/utilHead.php");
				//echo $email['email'];
					?>
						<div class="center">
							<p>Silakan masukkan password baru yang Anda kehendaki.</p>
							<form class="form-signin" role="form" action="reset.php" method="post">
								<input type="hidden" name="email" value="<?php echo $email['email'];?>">
								<input name="npassword" type="password" class="form-control" placeholder="New Password" required autofocus id="npassword">
								<input name="rnpassword" type="password" class="form-control" placeholder="Retype New Password" required id="rnpassword" onkeyup="checkPassword();return false;">
								<div id="message" style="color:red;"></div>
								<br>
								<button class="btn btn-lg btn-primary btn-block" type="submit" disabled id="buttonResetPassword">Reset Password</button>
							</form>
							<script type="text/javascript">
								function checkPassword()
								{
									var npassword = $('#npassword').val();
									var rnpassword = $('#rnpassword').val();
									var message = document.getElementById('message');
									var buttonResetPassword = document.getElementById('buttonResetPassword');
									if(npassword.length < 8)
									{
										message.innerHTML = "Password minimal 8 karakter.";
									}
									else
									{
										if(npassword != rnpassword)
										{
											message.innerHTML = "Kedua password tidak sama.";
											buttonResetPassword.disabled = true;
										}
										else
										{
											message.innerHTML = "";
											buttonResetPassword.disabled = false;
										}
									}
								}
							</script>
						</div>
					<?php
				include("templates/utilFoot.php");
			}
			else
			{
				include("templates/utilHead.php");
					?>
						<div class="center">
							<p>Link has expired. Please return to the main page</p>
							<a href="../index.php"><button class="btn btn-primary">Home</button></a>
						</div>
					<?php
				include("templates/utilFoot.php");
			}
		}
	}
?>