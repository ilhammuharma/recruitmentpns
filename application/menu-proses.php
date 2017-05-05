<?php
	error_reporting(0);
	$user=$_SESSION['username'];
	$tanggal= date('Y-m-d H:i:s');
	//$compname=php_uname('n');

	if(isset($_POST['submit']))
	{
		$query=mysql_query("insert into tablemenu (
			id,
			nama_menu,
			icon,
			link,
			parent
			) values (
			'',
			'".$_POST['menu']."',
			'".$_POST['icon']."',
			'".$_POST['link']."',
			'".$_POST['parent']."'
		)");

		if($query)
		{ 
			echo"
			<script>
			alert('Data Berhasil Disimpan'); 
			window.location.href = '".$url."index.php?r=menu';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Data Gagal Disimpan'); 
			self.history.back();
			</script>
			";	
		}
	}
	else if(isset($_GET['kode']))
	{
		$query=mysql_query("DELETE from tablemenu WHERE id = '".$_GET['kode']."';");
		if($query)
		{ 
			echo"
			<script>
			alert('Data Berhasil Dihapus'); 
			window.location.href = '".$url."index.php?r=menu';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Data Gagal Dihapus'); 
			self.history.back();
			</script>
			";	
		}
	}
?>