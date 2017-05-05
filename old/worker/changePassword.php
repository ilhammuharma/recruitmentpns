<?php
	session_start();
	$title = "change";
	include("../assets/dbconfig.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_POST['change']))
		{
			include("templates/head.php");
			$cpassword = $_POST['cpassword'];
			$npassword = $_POST['npassword'];
			$rnpassword = $_POST['rnpassword'];
			$username = $_SESSION['username'];
			$md5Password = md5($cpassword);
			$newMd5Password = md5($npassword);
			$queryCek = "SELECT * FROM loginWorker WHERE username = '$username' and password = '$md5Password'";
			$resultCek = mysql_query($queryCek);
			if(mysql_num_rows($resultCek) == 0)
			{
				$_SESSION['errorPasswordMessage'] = "The old password you entered match. Please retry again.";
			}
			else
			{
				$queryUpdatePassword = "UPDATE loginWorker SET password = '$newMd5Password' WHERE username = '$username'";
				if($npassword != $rnpassword)
				{
					$_SESSION['errorPasswordBedaMessage'] = "The two passwords that you provide are not the same. Please retry again.";
				}
				else
				{
					if(strlen($npassword) < 8)
					{
						$_SESSION['errorLength'] = "Password less than 8 letters.";
					}
					else
					{
						$ganti = mysql_query($queryUpdatePassword);
						$_SESSION['suksesGanti'] = "The password has been successfully changed.";
					}
				}
			}
			if(isset($_SESSION['errorPasswordMessage']) || isset($_SESSION['errorPasswordBedaMessage']) || isset($_SESSION['errorLength']))
			{
				if(isset($_SESSION['errorPasswordMessage']))
				{
					echo 	'<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              					'.$_SESSION['errorPasswordMessage'].'
            				</div>';
					unset($_SESSION['errorPasswordMessage']);
					echo "<a href='changePassword.php'><button class='btn btn-danger'>Back</button></a>";
				}
				if(isset($_SESSION['errorPasswordBedaMessage']))
				{
					echo 	'<div class="alert alert-danger alert-dismissible" role="alert">
              					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              					'.$_SESSION['errorPasswordBedaMessage'].'
            				</div>';
					unset($_SESSION['errorPasswordBedaMessage']);
					echo "<a href='changePassword.php'><button class='btn btn-danger'>Back</button></a>";
				}
				if(isset($_SESSION['errorLength']))
				{
					echo 	'<div class="alert alert-danger alert-dismissible" role="alert">
              					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              					'.$_SESSION['errorLength'].'
            				</div>'; 
            		unset($_SESSION['errorLength']);
            		echo "<a href='changePassword.php'><button class='btn btn-danger'>Back</button></a>";
				}
			}
			if(isset($_SESSION['suksesGanti']))
			{
				echo 	'<div class="alert alert-success alert-dismissible" role="alert">
              				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              				'.$_SESSION['suksesGanti'].'
            			</div>';
				unset($_SESSION['suksesGanti']);
				echo "<a href='changePassword.php'><button class='btn btn-success'>Back</button></a>";
			}
			include("templates/foot.php");
		}
		else
		{
			if(isset($_SESSION['worker']))
			{
				include("templates/head.php");
				?>
					<h3>Change Password</h3>
						<form class="form-horizontal" role="form" method="post" action="changePassword.php">
							<div class="form-group">
								<label for="cpassword" class="col-sm-2 control-label">Current password</label>
									<div class="col-sm-6">
										<input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Current password" required onchange="cekCPassword();return false;">
											<div id="cekPassword"></div>
												<p class="help-block">Enter your current password</p>
									</div>
							</div>
							<div class="form-group">
								<label for="npassword" class="col-sm-2 control-label">New Password</label>
									<div class="col-sm-6">
										<input name="npassword" type="password" class="form-control" id="npassword" placeholder="New Password" required onchange="cekNPassword();return false;">
											<div id="cekNewPasword"></div>
												<p class="help-block">Enter the new password you want. At least 8 letters.</p>
									</div>
							</div>
							<div class="form-group">
								<label for="rnpassword" class="col-sm-2 control-label">Retype New Password</label>
									<div class="col-sm-6">
										<input name="rnpassword" type="password" class="form-control" id="rnpassword" placeholder="Retype New Password" required onkeyup="cekRNPassword();return false;">
											<div id="cekRNewPassword"></div>
												<p class="help-block">Retype the new password that you want</p>
									</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="change-password" name="change">Change Password</button>
								</div>
							</div>
						</form>
						<script type="text/javascript">
							function cekCPassword()
							{
								var cpass = $("#cpassword").val();
								var cekPass = document.getElementById("cekPassword");
								$.ajax("ajax/cekCPassword.php?cpass="+cpass).done(function(data)
								{
									var json = JSON.parse(data);
									if(json.id == 0)
									{
										cekPass.innerHTML = "<p style='color:red'>"+json.message+"</p>";
									}
									else
									{
										cekPass.innerHTML = "<p style='color:green'>"+json.message+"</p>";
									}
								});
							}
							function cekNPassword()
							{
								var npass = $("#npassword").val();
								var cekNPass = document.getElementById("cekNewPasword");
								if(npass.length < 8)
								{
									cekNPass.innerHTML = "<p style='color:red'>Password at least 8 letters</p>";
								}
								else
								{
									cekNPass.innerHTML = "";
								}
							}
							function cekRNPassword()
							{
								var npass = $("#npassword").val();
								var rnpass = $("#rnpassword").val();
								var cek = document.getElementById("cekRNewPassword");
								if(npass != rnpass)
								{
									cek.innerHTML = "<p style='color:red'>The two passwords are not the same.</p>";
								}
								else
								{
									cek.innerHTML = "";
								}
							}
						</script>
				<?php
				include("templates/foot.php");
			}
			else
			{
				if(isset($_SESSION['admin']))
				{
					header("Location:../admin/");
				}
				else
				{
					header("Location:../hrd/");
				}
			}
		}
	}
?>