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
				//echo $_POST['id'];
				mysql_query("DELETE from rolePermission WHERE idLogin='".$_POST['id']."'");
				$check = $_POST['permission2'];
				$check2 = count($check);
				for($i = 0; $i < $check2; $i++)
				{
					$query = mysql_query("INSERT INTO rolePermission VALUES('', '".$_POST['id']."', '".$check[$i]."')");
					//echo $check[$i];
				}
				echo "<meta http-equiv='refresh' content='0;url=data-employee.php'>";
			}
		}
	}
?>