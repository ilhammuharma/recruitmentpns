<?php
	error_reporting(0);
	$nama=$_SESSION['nama'];
	$tanggal=date('Y-m-d H:i:s');
	$compname=php_uname('n');
	
	if(isset($_POST['update']))
	{
		$idWorker = $_POST['idWorker'];
		$statusRekrut = $_POST['statusRekrut'];
		if(isset($_POST['ubahFptk']))
		{
			$ubahFptk = $_POST['ubahFptk'];
			$user = $_SESSION['nama'];
		}
		else
		{
			$ubahFptk = "";
			$user = "";
		}
		if($statusRekrut=='2')
		{
			$update = "UPDATE userWorker SET statusRekrut='$statusRekrut', nomorFptk='$ubahFptk' WHERE idWorker = $idWorker";
		}
		else
		{
			$update = "UPDATE userWorker SET statusRekrut='$statusRekrut' WHERE idWorker = $idWorker";
		}
		$query = mysql_query($update);
		//echo $query;
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=candidate';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Update failed'); 
			self.history.back();
			</script>
			";	
		}
	}
	else{}
?>