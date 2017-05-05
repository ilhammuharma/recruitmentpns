<?php
	session_start();
	$head = 'registrasi';
	include("assets/dbconfig.php");
	
	if(isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_POST['register']))
		{
			$username = clean($_POST['username']);
			$email = clean($_POST['email']);
			$password = clean($_POST['password']);
			$rpassword = clean($_POST['rpassword']);
			//$level = clean($_POST['level']);
			$nama = clean($_POST['nama']); //belum dipakai
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$_SESSION['emailValidMessage'] = "Your email is not valid. Please retry the registration process.";
			}
			else
			{
					$queryCekEmail = "SELECT * from loginUser WHERE email like '$email'";
					$resultCekEmail = mysql_query($queryCekEmail);
					if(mysql_num_rows($resultCekEmail) > 0)
					{
						$_SESSION['cekEmailMessage'] = "Registration failed. The email that you used have used others. Please retry the registration process.";
					}
					else
					{
						$queryCekUsername = "SELECT * from loginUser WHERE username like '$username'";
						$resultCekUsername = mysql_query($queryCekUsername);
						if(mysql_num_rows($resultCekUsername) > 0)
						{
							$_SESSION['cekUsernameMessage'] = "Registration failed. The username you choose is already in use in other people. Please retry the registration process.";
						}
						else
						{
							if($password != $rpassword)
							{
								$_SESSION['cekUserPasswordMessage'] = "The two passwords you entered are not the same. Please retry the registration process.";
							}
							else
							{
								$time = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+3, date("Y"));
								$generateKey = md5($email.$time);
								$now = date("Y-m-d H:i:s");
								$valid = date("Y-m-d H:i:s", strtotime("$now + 2 hours"));
								$md5password = md5($password);
								$queryRegisterUser = "INSERT INTO loginUser values('','$email', '$username', '$md5password', '$generateKey', '$valid', 1, 2, '')";
								$execRegister = mysql_query($queryRegisterUser);
								
								
									$queryIdLogin = "SELECT * FROM loginUser WHERE email='$email' and username='$username'";
									$execQueryIdLogin = mysql_query($queryIdLogin);
									$resultIdLogin = mysql_fetch_array($execQueryIdLogin);
									$idLogin = $resultIdLogin['idLogin'];
									$insertUser = "INSERT INTO userWorker(idWorker, idLogin, namaUser, emailUser, statusRekrut) VALUES('', '$idLogin','$nama','$email', 'Screening')";
									$execInsert = mysql_query($insertUser);
								
								if($execRegister)
								{
									echo ("<SCRIPT LANGUAGE='JavaScript'>
										window.alert('The registration process was successful.');
										window.location.href='index.php';
										</SCRIPT>");
								}
								else
								{
									echo ("<SCRIPT LANGUAGE='JavaScript'>
										window.alert('The registration process was failed.');
										window.location.href='wregister.php';
										</SCRIPT>");
								}
							}
						}
					}
			}
			include("templates/head.php");
			?>
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="box-no-border">
							<?php
								if(isset($_SESSION['emailValidMessage']) || isset($_SESSION['cekEmailMessage']) || isset($_SESSION['cekUsernameMessage']) || isset($_SESSION['cekUserPasswordMessage']) || isset($_SESSION['error_captcha']))
								{
									if(isset($_SESSION['emailValidMessage']))
									{
										echo	'<div class="alert alert-danger alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
													'.$_SESSION['emailValidMessage'].'
												</div>';
										unset($_SESSION['emailValidMessage']);
									}
									if(isset($_SESSION['cekEmailMessage']))
									{
										echo 	'<div class="alert alert-danger alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
													'.$_SESSION['cekEmailMessage'].'
												</div>';
										unset($_SESSION['cekEmailMessage']);
									}
									if(isset($_SESSION['cekUsernameMessage']))
									{
										echo 	'<div class="alert alert-danger alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
													'.$_SESSION['cekUsernameMessage'].'
												</div>';
										unset($_SESSION['cekUsernameMessage']);
									}
									if(isset($_SESSION['cekUserPasswordMessage']))
									{
										echo 	'<div class="alert alert-danger alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
													'.$_SESSION['cekUserPasswordMessage'].'
												</div>';
										unset($_SESSION['cekUserPasswordMessage']);
									}
									echo "<a href='wregister.php'><button class='btn btn-default'>Sign Up</button></a>";
								}
								else
								{
									if(isset($_SESSION['suksesMessage']))
									{
										echo 	'<div class="alert alert-success alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
													'.$_SESSION['suksesMessage'].'
												</div>';
										unset($_SESSION['suksesMessage']);
									}
									echo "<a href='worker/login.php'><button class='btn btn-primary'>Login</button></a>";
								}
							?>
						</div>
					</div>
					<?php include("templates/right-menu.php");?>
				</div>
			</div>
			<?php
				include("templates/foot.php");
		}
		else
		{
				include("templates/head.php");
			?>
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="box-no-border">
							<h2>Account Registration for Applicants</h2>
								<form class="form-horizontal" role="form" method="post" action="wregister.php">
									<div class="form-group">
										<label for="nama" class="col-sm-2 control-label">Name</label>
											<div class="col-sm-6">
												<input type="text" name="nama" class="form-control" id="nama" placeholder="Name" required>
													<p class="help-block">Your name</p>
											</div>
									</div>
									<div class="form-group">
										<label for="email" class="col-sm-2 control-label">Email</label>
											<div class="col-sm-6">
												<input name="email" type="email" class="form-control" id="email" placeholder="Email" required onchange="cekEmailUser();return false;">
													<div id="cekEmail"></div>
														<p class="help-block">Use your valid email</p>
											</div>
									</div>
									<div class="form-group">
										<label for="username" class="col-sm-2 control-label">Username</label>
											<div class="col-sm-6">
												<input name="username" type="text" class="form-control" id="username" placeholder="Username" required onchange="cekUsernameUser();return false;">
													<div id="cekUsername"></div>
														<p class="help-block">Select a username that you will use to sign in</p>
											</div>
									</div>
									<div class="form-group">
										<label for="password" class="col-sm-2 control-label">Password</label>
											<div class="col-sm-6">
												<input name="password" type="password" class="form-control" id="password" placeholder="Password" required onchange="cekPasswordUser();return false;">
													<div id="cekPassword"></div>
														<p class="help-block">Select your desired password. At least 8 letters</p>
											</div>
									</div>
									<div class="form-group">
										<label for="rpassword" class="col-sm-2 control-label">Retype Password</label>
											<div class="col-sm-6">
												<input name="rpassword" type="password" class="form-control" id="rpassword" placeholder="Retype Password" required onkeyup="cekRpasswordUser();return false;">
													<div id="cekRpassword"></div>
														<p class="help-block">Retype password that you have entered</p>
											</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-primary" id="button-register" name="register">Sign Up</button>
										</div>
									</div>
								</form>
								<script type="text/javascript">
									function cekEmailUser()
									{
										var email = $("#email").val();
										var cekEmail = document.getElementById("cekEmail");
										var buttonRegister = document.getElementById("button-register");
										$.ajax("ajax/wcekEmail.php?cekEmail="+email).done(function(data)
										{
											var json = JSON.parse(data);
											if(json.id == 0)
											{
												cekEmail.innerHTML = "<p style='color:red;'>"+json.message+"</p>";
												buttonRegister.disabled = true;
											}
											else
											{
												cekEmail.innerHTML = "<p style='color:green;'>"+json.message+"</p>";
												buttonRegister.disabled = false;
												cekPasswordUser();
												cekRpasswordUser();
											}
										});
									}
									function cekUsernameUser()
									{
										var username = $("#username").val();
										var cekUsername = document.getElementById("cekUsername");
										var buttonRegister = document.getElementById("button-register");
										$.ajax("ajax/wcekUsername.php?cekUsername="+username).done(function(data)
										{
											var json = JSON.parse(data);
											if(json.id == 0)
											{
												cekUsername.innerHTML = "<p style='color:red;'>"+json.message+"</p>";
												buttonRegister.disabled = true;
											}
											else
											{
												cekUsername.innerHTML = "<p style='color:green;'>"+json.message+"</p>";
												buttonRegister.disabled = false;
												cekPasswordUser();
												cekRpasswordUser();
											}
										});
									}
									function cekPasswordUser()
									{
										var password = $("#password").val();
										var cekPassword = document.getElementById("cekPassword");
										var buttonRegister = document.getElementById("button-register");
										if(password.length < 8)
										{
											cekPassword.innerHTML = "<p style='color:red;'>Password is at least 8 letters</p>";
											buttonRegister.disabled = true;
										}
										else
										{
											cekPassword.innerHTML = "";
											buttonRegister.disabled = false;
										}
									}
									function cekRpasswordUser()
									{
										var password = $("#password").val();
										var rpassword = $("#rpassword").val();
										var cekRpassword = document.getElementById("cekRpassword");
										var buttonRegister = document.getElementById("button-register");
										if(rpassword != password)
										{
											cekRpassword.innerHTML = "<p style='color:red;'>Password is not the same</p>";
											buttonRegister.disabled = true;
										}
										else
										{
											cekRpassword.innerHTML = "";
											buttonRegister.disabled = false;
											cekPasswordUser();
										}
									}
								</script>
						</div>
					</div>
					<?php include("templates/right-menu.php");?>
				</div>
			</div>
			<?php
				include("templates/foot.php");
		}
	}
?>