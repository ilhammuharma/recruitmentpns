<?php
	session_start();
	include("../assets/dbconfig.php");
	if(isset($_GET['approve']))
	{
		$idFptk = $_GET['idFptk'];
		$approve = $_GET['approve'];
		$username = $_SESSION['username'];
		$tanggal = date('Y-m-d');
		if($approve==1)
		{
			$updateFptk = "UPDATE fptk SET namaManager='$username', tanggalManager='$tanggal' WHERE idFptk='$idFptk'";
		}
		else if($approve==2)
		{
			$updateFptk = "UPDATE fptk SET namaHrdSuperintendent='$username', tanggalHrdSuperintendent='$tanggal' WHERE idFptk='$idFptk'";
		}
		else if($approve==3)
		{
			$updateFptk = "UPDATE fptk SET namaGeneralManager='$username', tanggalGeneralManager='$tanggal' WHERE idFptk='$idFptk'";
		}
		else if($approve==4)
		{
			$mpp = mysql_fetch_array(mysql_query("SELECT mppPosisi from fptk WHERE idFptk='$idFptk'"));
			if($mpp['mppPosisi']=="Sesuai")
			{
				$updateFptk = "UPDATE fptk SET namaOdManager='$username', tanggalOdManager='$tanggal', namaDirektur='Auto Approved', tanggalDirektur='$tanggal' WHERE idFptk='$idFptk'";
			}
			else
			{
				$updateFptk = "UPDATE fptk SET namaOdManager='$username', tanggalOdManager='$tanggal' WHERE idFptk='$idFptk'";
			}
		}
		else if($approve==5)
		{
			$updateFptk = "UPDATE fptk SET namaHrdManager='$username', tanggalHrdManager='$tanggal' WHERE idFptk='$idFptk'";
		}
		else
		{
			$updateFptk = "UPDATE fptk SET namaDirektur='$username', tanggalDirektur='$tanggal' WHERE idFptk='$idFptk'";
		}			
		$queryFptk = mysql_query($updateFptk);
		if($queryFptk)
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('FPTK was successfully approved.');
					window.location.href='approvalFptk.php?id=$approve';
					</SCRIPT>");
		}	
		else
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('FPTK was failed approved.');
					 window.history.back();
					</SCRIPT>");
		}
	}
	else if(isset($_POST['alasanReject']))
	{
		$reject = $_POST['idFptk'];
		//$approve = $_GET['r'];
		$username = $_SESSION['username'];
		$tanggal = date('Y-m-d');
		$keteranganReject = $_POST['keteranganReject'];
		$rejectFptk = mysql_query("UPDATE fptk SET rejectFptk='$username', tanggalReject='$tanggal', keteranganReject='$keteranganReject' WHERE nomorFptk='$reject'");
		if($rejectFptk)
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('FPTK was successfully rejected.');
				window.location.href='approvalFptk.php?id=$approve';
				</SCRIPT>");
		}	
		else
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('FPTK was failed rejected.');
				window.history.back();
				</SCRIPT>");
		}
	}
	else if(isset($_POST['submit']))
	{
		$idFptk = $_POST['idFptk'];
		$approve = $_POST['approve'];
		$username = $_SESSION['username'];
		$tanggal = date('Y-m-d');
		$mppPosisi = $_POST['mppPosisi'];
		
		$updateFptk = "UPDATE fptk SET namaHrdSuperintendent='$username', mppPosisi='$mppPosisi', tanggalHrdSuperintendent='$tanggal' WHERE idFptk='$idFptk'";
	
		$queryFptk = mysql_query($updateFptk);
		if($queryFptk)
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('FPTK was successfully approved.');
					window.location.href='approvalFptk.php?id=$approve';
					</SCRIPT>");
		}	
		else
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('FPTK was failed approved.');
					 window.history.back();
					</SCRIPT>");
		}
	}
?>