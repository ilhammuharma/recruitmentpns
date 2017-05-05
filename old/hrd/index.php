<?php
	session_start();
	$title = "Review";
	include("../assets/dbconfig.php");

	if(!isset($_SESSION['username']) && !$_SESSION['hrd'])
	{
		if(isset($_POST['username']))
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
			
			$queryLogin = "SELECT * from loginHrd WHERE username = '$username' and password = '$md5password'";
			$result = mysql_query($queryLogin);
			$getIdLogin = mysql_fetch_array($result);
			$idLogin = $getIdLogin['idLogin'];
			
			$queryHrd = "SELECT * FROM userHrd WHERE idLogin = $idLogin";
			$execHrd = mysql_query($queryHrd);
			$getIdHrd = mysql_fetch_array($execHrd);
			$idHrd = $getIdHrd['idHrd'];

			if($result)
			{
				if(mysql_num_rows($result) > 0)
				{
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $md5password;
					$_SESSION['idLogin'] = $idLogin;
					$_SESSION['idHrd'] = $idHrd;
					$_SESSION['hrd'] = true;
					header("Location:index.php");
				}
				else
				{
					$_SESSION['error'] = "You do not activate your account. Please check your email and follow the instructions.";
					header("Location:login.php");
				}
				//echo "Login Berhasil";
			}
			else
			{
				$_SESSION['error'] = "The login information you entered is incorrect. Please retry again!";
				header("Location:login.php");
			}
		}
		else
		{
			header("Location:login.php");
			//echo "You are not logged in";
		}
	}
	else
	{
		if($_SESSION['hrd'])
		{
			include("templates/head.php");
			$idHrd = $_SESSION['idHrd'];
			$getStatusLowongan = "SELECT al.idTable, al.idLowongan, pl.namaPosisi FROM applyLowongan al ";
			$getStatusLowongan .= "JOIN postingLowongan pl ON pl.idLowongan = al.idLowongan ";
			$getStatusLowongan .= "JOIN userWorker uw ON uw.idWorker = al.idWorker ";
			$getStatusLowongan .= "WHERE pl.idHrd = $idHrd";
			//echo $getStatusLowongan;
			$execStatusLowongan = mysql_query($getStatusLowongan);
			?>
				<h3>Vacancies Review</h3>
			<?php
			$temp = array();
			if(mysql_num_rows($execStatusLowongan) > 0)
			{
				echo "<ol>";
				while($result = mysql_fetch_array($execStatusLowongan))
				{
					if(!in_array($result['idLowongan'], $temp))
					{
						echo "<li> <a target='_blank' href='".$webRoot."show/post.php?id=".$result['idLowongan']."'><strong>".$result['namaPosisi']."</strong></a></li>";
						$idLowongan = $result['idLowongan'];
						$getPelamar = "SELECT  al.idWorker, uw.namaUser FROM applyLowongan al ";
						$getPelamar .= "JOIN userWorker uw ON uw.idWorker = al.idWorker ";
						$getPelamar .= "WHERE al.idLowongan = $idLowongan";
						$execGetPelamar = mysql_query($getPelamar);
						if(mysql_num_rows($execGetPelamar) > 0)
						{
							echo "<ul>";
							while($pelamar = mysql_fetch_array($execGetPelamar))
							{
								echo "<li>".$pelamar['namaUser']." <a target='_blank' href='".$webRoot."show/worker.php?id=".$pelamar['idWorker']."'><i class='fa fa-external-link'></i> </a></li>";
							}	
							echo "</ul>";
						}
						else
						{
							echo "There has been no applicants.";
						}
						array_push($temp, $result['idLowongan']);
					}
				}
				echo "</ol>";
			}
			else
			{
				echo "There has been no applicants.";
			}
			include("templates/foot.php");
		}
		else
		{
			//$_SESSION['error'] = "If you have a login with another user, please logout first, and re-enter your login information in accordance with the information you have.";
			//header("Location:login.php");
			if(isset($_SESSION['admin']))
			{
				header("Location:../admin/");
			}
			else
			{
				header("Location:../worker/");
			}
		}
	}
?>