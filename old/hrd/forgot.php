<?php
	session_start();
	$title = "Forgot Password";
	include("../assets/dbconfig.php");
	
	if(isset($_POST['email']))
	{
		function clean($str) 
		{
			$str = @trim($str);
			if(get_magic_quotes_gpc()) 
			{
				$str = stripslashes($str);
			}
			return mysql_real_escape_string($str);
		}
		$email = clean($_POST['email']);
		$querySearchEmail = "SELECT * from loginHrd where email like '$email'";
		$result = mysql_query($querySearchEmail);
		if($result)
		{
			if(mysql_num_rows($result) > 0)
			{
				//Update table login
				$time = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+3, date("Y"));
				$generateKey = md5($email.$time);
				$now = date("Y-m-d H:i:s");
				$valid = date("Y-m-d H:i:s", strtotime("$now + 2 hours"));
				$queryUpdate = "UPDATE loginHrd SET resetCode='$generateKey', validUntil = '$valid' WHERE email like '$email'";
				$exec = mysql_query($queryUpdate);

				//Using Mandrill API
				$uri = 'https://mandrillapp.com/api/1.0/messages/send.json';
				$from = $emailAdmin;
				$name = $nameAdmin;
				$linkReset = $webRoot."hrd/reset.php?secret=".$generateKey;
				$subject = "Reset Password";
				$message = "Hello,<br><br>";
				$message .= "Please click <a href='".$linkReset."''>the following link</a> to reset your password. These links are only valid for 2 hours.<br>";
				$message .= "If the link cannot be used, please go to the link <em>".$webRoot."worker/reset.php</em> and then enter the following code <strong>".$generateKey."</strong> in the required field<br>";
				$message .= "Thank you.<br><br>";
				$message .= "<em>nb: Please ignore if you do not feel have reset your password</em>";
				$slashedMessage = addslashes($message);
				$postString = 
				'{
					"key": "KcBpnFMXRMS5-TxXONTOHQ",
					"message":
					{
						"html":"'.$message.'",
						"subject":"'.$subject.'",
						"from_email":"'.$from.'",
						"from_name":"'.$name.'",
						"to":
						[{
							"email":"'.$email.'",
							"name":"User PT Pratama Nusantara Sakti",
							"type":"to"
						}],
						"headers":
						{
							"Reply-To": "'.$emailAdmin.'"
						},
						"track_opens": null,
						"track_clicks": null,
						"auto_text": null,
						"url_strip_gs": null,
						"preserve_recipients": null,
						"merge": null,
						"global_merge_vars":[],
						"merge_vars":[],
						"tags":[],
						"google_analytics_domains":[],
						"google_analytics_campaigns": "...",
						"metadata":[],
						"recipient_metadata":[],
						"attachments":[]
					},
					"async": false    
				}';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $uri);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
				$result = curl_exec($ch);
				//echo $result;

				$_SESSION['sukses'] = true;
				header("Location:forgot.php");
			}
			else
			{
				$_SESSION['error'] = "The email you entered is not registered in our system. Please retry again!";
				header("Location:forgot.php");
			}
		}
	}
	else
	{
		include("templates/utilHead.php");
			?>
				<div class="center">
					<?php
						if(isset($_SESSION['sukses']))
						{
							?>
								<p>Please check your email. After that follow the directives in accordance with the email has been sent</p>
								<a href="login.php"><button class="btn btn-primary">Sign In</button></a>
							<?php
							unset($_SESSION['sukses']);
						}
						else
						{
							?>
								<p>Please enter the email you used when you registered. Then we will send you a password reset link to your email.</p>
									<form class="form-signin" role="form" action="" method="post">
										<input name="email" type="email" class="form-control" placeholder="email" required autofocus>
											<?php
												if(isset($_SESSION['error']))
												{
													echo 	'<br><div class="alert alert-danger alert-dismissible" role="alert">
																<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																'.$_SESSION['error'].'
															</div>';
													unset($_SESSION['error']);
												}
											?>
											<br>
											<button class="btn btn-lg btn-primary btn-block" type="submit">Forgot Password</button>
									</form> 
							<?php
						}
					?>
				</div>
			<?php
		include("templates/utilFoot.php");
	}
?>