<?php
	include("../assets/dbconfig.php");

	$cekEmail = $_GET['cekEmail'];

	if($cekEmail == ""){
		$reply = '{"id" : 1,"message" : ""}';
		echo $reply;
	}else{
		if (!filter_var($cekEmail, FILTER_VALIDATE_EMAIL)) {
			$reply = '{"id" : 0,"message" : "Email tidak valid"}';
			echo $reply;
		}else{

			$queryCheckEmail = "SELECT * from loginHrd WHERE email Like '$cekEmail'";
			$result = mysql_query($queryCheckEmail);

			if(mysql_num_rows($result) > 0){
				$id = 0;
				$message = "Email telah digunakan pengguna lain. Silakan masukkan email baru";
			}else{
				$id = 1;
				$message =  "Email dapat digunakan";
			}

			$reply = '{"id" :'.$id.',"message" : "'.$message.'"}';

			echo $reply;
		}
	}
?>