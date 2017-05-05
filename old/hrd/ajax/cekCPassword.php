<?php
	session_start();
	include("../../assets/dbconfig.php");
	$cpass = $_GET['cpass'];
	$md5password = md5($cpass);
	$username = $_SESSION['username'];
	$queryCek = "SELECT * FROM loginHrd WHERE password = '$md5password' and username = '$username'";
	$result = mysql_query($queryCek);
	if(mysql_num_rows($result) > 0)
	{
		$id = 1;
		$message = "Passwords match.";
	}
	else
	{
		$id = 0;
		$message = "The password does not match.";
	}
	$reply = '{"id" : '.$id.',"message" : "'.$message.'"}';
	echo $reply;
?>