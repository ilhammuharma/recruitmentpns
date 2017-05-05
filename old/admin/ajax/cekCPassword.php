<?php
	session_start();
	include("../../assets/dbconfig.php");

	$cpass = $_GET['cpass'];
	$md5password = md5($cpass);
	$username = $_SESSION['username'];

	$queryCek = "SELECT * FROM loginAdmin WHERE password = '$md5password' and username = '$username'";
	$result = mysql_query($queryCek);

	if(mysql_num_rows($result) > 0){
		$id = 1;
		$message = "Password cocok.";
	}else{
		$id = 0;
		$message = "Password tidak cocok.";
	}

	$reply = '{"id" : '.$id.',"message" : "'.$message.'"}';
	echo $reply;

?>