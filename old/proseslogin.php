<?php
	session_start();
	include("assets/dbconfig.php");
	$title = "review";
	
		if(!empty($_POST['username']))
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
			
			$username = clean($_POST['username']);
			$password = clean($_POST['password']);
			$md5password = md5($password);

			$queryLogin = "SELECT * from loginUser WHERE username = '$username' and password = '$md5password' and active = 1";
			$result = mysql_query($queryLogin);
			$getIdLogin = mysql_fetch_array($result);
			$idLogin = $getIdLogin['idLogin'];
			$level = $getIdLogin['level'];

			if($result)
			{
				if(mysql_num_rows($result) > 0)
				{
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $md5password;
					$_SESSION['idLogin'] = $idLogin;
					$_SESSION['level'] = $level;
					if($level==1)
					{
						$queryHrd = "SELECT * FROM userHrd WHERE idLogin = $idLogin";
						$execHrd = mysql_query($queryHrd);
						$getIdHrd = mysql_fetch_array($execHrd);
						$idHrd = 1;
						$_SESSION['idHrd'] = $idHrd;
						$_SESSION['admin'] = true;
						header("Location:admin/index.php");
					}
					else if($level==2)
					{
						$queryWorker = "SELECT * FROM userWorker WHERE idLogin = $idLogin";
						$execWorker = mysql_query($queryWorker);
						$getIdWorker = mysql_fetch_array($execWorker);
						$idWorker = $getIdWorker['idWorker'];
						$_SESSION['idWorker'] = $idWorker;
						$_SESSION['worker'] = true;
						header("Location:worker/index.php");
					}
					else if($level==3)
					{
						$queryWorker = "SELECT * FROM userWorker WHERE idLogin = $idLogin";
						$execWorker = mysql_query($queryWorker);
						$getIdWorker = mysql_fetch_array($execWorker);
						$idWorker = $getIdWorker['idWorker'];
						$_SESSION['idWorker'] = $idWorker;
						$_SESSION['worker'] = true;
						header("Location:worker/index.php");
					}
				}
				else
				{
					$_SESSION['error'] = "Login incorrect. The login information you entered is incorrect or your account has not been activated. Please try again!";
					header("Location:index.php");
				}
			}
		}
		else
		{
			header("Location:login.php");		
		}
?>