<?php
	session_start();
	include("../assets/dbconfig.php");
	$title = "data-employee";
	
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
			
			if(isset($_POST['submit']))
			{
				mysql_query("DELETE from rolePermission WHERE idLogin='".$_POST['id']."'");
				$check = $_POST['permission2'];
				$check2 = count($check);
				for($i = 0; $i < $check2; $i++)
				{
					$query = mysql_query("INSERT INTO rolePermission VALUES(NULL, '".$_POST['id']."', '".$check[$i]."'");
				}
				//header('location: data-employee.php');
			}
			
			?>
				<h2>Role Permission</h2>
				<form class="form-horizontal" role="form" action="permissionProcess.php" method="post">
					<div class="form-group">
						<div class="col-sm-5">
							<table>
								<tr><th>User</th><th>Privileges</th></tr>
								<?php
									$updated = FALSE;
									/*
									if(count($_POST > 0))
									{
										
										array_map('intval',$superintendent);
										$superintendent = implode(',',$superintendent);
										mysql_query("UPDATE permission SET superintendent=0");
										mysql_query("UPDATE permission SET superintendent=1 WHERE idPermission IN ($superintendent)");
										$updated = TRUE;
									}
									*/
									
									$perm = mysql_query ("SELECT idPermission, namaPermission FROM permission ORDER by idPermission ASC");
									//$result = mysql_query($perm) or trigger_error(mysql_error(),E_USER_ERROR);
									
									//while(list($idPermission, $namaPermission, $superintendent) = mysql_fetch_row($result))
									while ($permission=mysql_fetch_array($perm))
									{
										$menu = mysql_num_rows(mysql_query("SELECT idPermission FROM rolePermission WHERE idLogin='".$_GET['id']."'AND idPermission='".$permission['idPermission']."'"));
										//$checked = ($superintendent==1) ? 'checked="checked"' : '';
										if($menu==0){$checked='';}else {$checked='checked';}										
										echo "<tr><td>".$permission['namaPermission']."</td><td><input type='checkbox' name='permission2[]' value='".$permission['idPermission']."' ".$checked."/></td></tr>"."\n";
									}
								?>
								<input type="hidden" name="id" value="<?php echo $_GET['id']?>">
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