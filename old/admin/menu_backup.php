<?php
	session_start();
	include("../assets/dbconfig.php");
	$title = "permission";
	
	if(!isset($_SESSION['username']))
	{
		header("Location: login.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
		{
			header("Location:../worker/");
		}
		else if(isset($_SESSION['admin']))
		{
			include("templates/head.php"); 
			function clean($str) 
			{
				$str = @trim($str);
				if(get_magic_quotes_gpc()) 
				{
					$str = stripslashes($str);
				}
				return mysql_real_escape_string($str);
			}
			
			?>
				<h2>Role Permission</h2>
				<form class="form-horizontal" role="form" action="menu.php" method="post">
					<div class="form-group">
						<div class="col-sm-5">
							<table>
								<tr><th>Superintendent</th><th>Privileges</th></tr>
								<?php
									$updated = FALSE;
									if(count($_POST > 0))
									{
										$superintendent = $_POST['superintendent'];
										array_map('intval',$superintendent);
										$superintendent = implode(',',$superintendent);
										mysql_query("UPDATE permission SET superintendent=0");
										mysql_query("UPDATE permission SET superintendent=1 WHERE idPermission IN ($superintendent)");
										$updated = TRUE;
									}
									
									$perm = "SELECT idPermission, namaPermission, superintendent FROM permission ORDER by idPermission ASC";
									$result = mysql_query($perm) or trigger_error(mysql_error(),E_USER_ERROR);
									while(list($idPermission, $namaPermission, $superintendent) = mysql_fetch_row($result))
									{
										$checked = ($superintendent==1) ? 'checked="checked"' : '';
										echo '<tr><td>'.$namaPermission.'</td><td><input type="checkbox" name="superintendent[]" value="'.$idPermission.'" '.$checked.'/></td></tr>'."\n";
									}
								?>
							</table> 
							<table>
								<tr><th>Manager</th><th>Privileges</th></tr>
								<?php
									$updated = FALSE;
									if(count($_POST > 0))
									{
										$manager = $_POST['manager'];
										array_map('intval',$manager);
										$manager = implode(',',$manager);
										mysql_query("UPDATE permission SET manager=0");
										mysql_query("UPDATE permission SET manager=1 WHERE idPermission IN ($manager)");
										$updated = TRUE;
									}
									
									$perm2 = "SELECT idPermission, namaPermission, manager FROM permission ORDER by idPermission ASC";
									$result2 = mysql_query($perm2) or trigger_error(mysql_error(),E_USER_ERROR);
									while(list($idPermission, $namaPermission, $manager) = mysql_fetch_row($result2))
									{
										$checked2 = ($manager==1) ? 'checked="checked"' : '';
										echo '<tr><td>'.$namaPermission.'</td><td><input type="checkbox" name="manager[]" value="'.$idPermission.'" '.$checked2.'/></td></tr>'."\n";
									}
								?>
							</table> 
							<table>
								<tr><th>HRD Superintendent</th><th>Privileges</th></tr>
								<?php
									$updated = FALSE;
									if(count($_POST > 0))
									{
										$hrdSuperintendent = $_POST['hrdSuperintendent'];
										array_map('intval',$hrdSuperintendent);
										$hrdSuperintendent = implode(',',$hrdSuperintendent);
										mysql_query("UPDATE permission SET hrdSuperintendent=0");
										mysql_query("UPDATE permission SET hrdSuperintendent=1 WHERE idPermission IN ($hrdSuperintendent)");
										$updated = TRUE;
									}
									
									$perm3 = "SELECT idPermission, namaPermission, hrdSuperintendent FROM permission ORDER by idPermission ASC";
									$result3 = mysql_query($perm3) or trigger_error(mysql_error(),E_USER_ERROR);
									while(list($idPermission, $namaPermission, $hrdSuperintendent) = mysql_fetch_row($result3))
									{
										$checked3 = ($hrdSuperintendent==1) ? 'checked="checked"' : '';
										echo '<tr><td>'.$namaPermission.'</td><td><input type="checkbox" name="hrdSuperintendent[]" value="'.$idPermission.'" '.$checked3.'/></td></tr>'."\n";
									}
								?>
							</table> 
							<table>
								<tr><th>General Manager</th><th>Privileges</th></tr>
								<?php
									$updated = FALSE;
									if(count($_POST > 0))
									{
										$generalManager = $_POST['generalManager'];
										array_map('intval',$generalManager);
										$generalManager = implode(',',$generalManager);
										mysql_query("UPDATE permission SET generalManager=0");
										mysql_query("UPDATE permission SET generalManager=1 WHERE idPermission IN ($generalManager)");
										$updated = TRUE;
									}
									
									$perm4 = "SELECT idPermission, namaPermission, generalManager FROM permission ORDER by idPermission ASC";
									$result4 = mysql_query($perm4) or trigger_error(mysql_error(),E_USER_ERROR);
									while(list($idPermission, $namaPermission, $generalManager) = mysql_fetch_row($result4))
									{
										$checked4 = ($generalManager==1) ? 'checked="checked"' : '';
										echo '<tr><td>'.$namaPermission.'</td><td><input type="checkbox" name="generalManager[]" value="'.$idPermission.'" '.$checked4.'/></td></tr>'."\n";
									}
								?>
							</table> 
							<table>
								<tr><th>HRD Manager</th><th>Privileges</th></tr>
								<?php
									$updated = FALSE;
									if(count($_POST > 0))
									{
										$hrdManager = $_POST['hrdManager'];
										array_map('intval',$hrdManager);
										$hrdManager = implode(',',$hrdManager);
										mysql_query("UPDATE permission SET hrdManager=0");
										mysql_query("UPDATE permission SET hrdManager=1 WHERE idPermission IN ($hrdManager)");
										$updated = TRUE;
									}
									
									$perm5 = "SELECT idPermission, namaPermission, hrdManager FROM permission ORDER by idPermission ASC";
									$result5 = mysql_query($perm5) or trigger_error(mysql_error(),E_USER_ERROR);
									while(list($idPermission, $namaPermission, $hrdManager) = mysql_fetch_row($result5))
									{
										$checked5 = ($hrdManager==1) ? 'checked="checked"' : '';
										echo '<tr><td>'.$namaPermission.'</td><td><input type="checkbox" name="hrdManager[]" value="'.$idPermission.'" '.$checked5.'/></td></tr>'."\n";
									}
								?>
							</table> 
							<tr><td colspan="2"><input class="btn btn-primary" type="submit" name="submit" value="Update" /></td></tr>
							<?php
								if($updated === TRUE)
								{
									echo '<div>Previleges updated!</div>';
								}
							?>
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