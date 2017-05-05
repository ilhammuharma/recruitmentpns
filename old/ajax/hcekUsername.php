<?php
	include("../assets/dbconfig.php");

	$cekUsername = $_GET['cekUsername'];

	if($cekUsername == ""){
		$reply = '{"id" : 1,"message" : ""}';
		echo $reply;
	}else{
		$queryCekUsername = "SELECT * from loginHrd WHERE username Like '$cekUsername'";
		$result = mysql_query($queryCekUsername);

		if(mysql_num_rows($result) > 0){
			$id = 0;
			$message = "Username telah digunakan pengguna lain. Gunakan username lain";
		}else{
			$id = 1;
			$message =  "Username dapat digunakan";
		}

		$reply = '{"id" :'.$id.',"message" : "'.$message.'"}';

		echo $reply;

	}
?>