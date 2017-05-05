<?php
	error_reporting(0);
	$user=$_SESSION['username'];
	$tanggal= date('Y-m-d H:i:s');
	$compname=php_uname('n');

	if(isset($_POST['save']))
	{
		$query=mysql_query("insert into loginUser (
			idLogin,
			email,
			username,
			password,
			nama,
			departemen,
			distrik,
			tgladd,
			active,
			level,
			parent,
			nik
			) values (
			'',
			'".$_POST['email']."',
			'".$_POST['username']."',
			'".md5(md5($_POST['password'])."M0n5t3r")."',
			'".$_POST['name']."',
			'".$_POST['departemen']."',
			'".$_POST['distrik']."',
			'".date('Y-m-d')."',
			'".$_POST['status']."',
			'3',
			'".$_POST['atasan']."',
			'".$_POST['nik']."'
			)");
		if($query)
		{ 
			echo"
			<script>
			alert('Data successfully saved'); 
			window.location.href = '".$url."index.php?r=account';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Data could not be saved'); 
			self.history.back();
			</script>
			";	
		}
	}
	else if(isset($_POST['edit']))
	{
			/* echo "update loginuser set
			username='".$_POST['username']."',
			nama='".$_POST['name']."',
			nik='".$_POST['nik']."',
			active='".$_POST['status']."',
			email='".$_POST['email']."',
			departemen='".$_POST['departemen']."',
			distrik='".$_POST['distrik']."',
			parent='".$_POST['atasan']."'
			where idLogin='".$_POST['id']."'"; */
			$query=mysql_query("update loginuser set
			username='".$_POST['username']."',
			nama='".$_POST['name']."',
			nik='".$_POST['nik']."',
			active='".$_POST['status']."',
			email='".$_POST['email']."',
			departemen='".$_POST['departemen']."',
			distrik='".$_POST['distrik']."',
			parent='".$_POST['atasan']."'
			where idLogin='".$_POST['id']."'");
		
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=account';
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
	
	else if(isset($_GET['del']))
	{
		$query=mysql_query("DELETE from loginuser WHERE idLogin = '".$_GET['del']."';");
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been deleted'); 
			window.location.href = '".$url."index.php?r=account';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Delete failed'); 
			self.history.back();
			</script>
			";	
		}
	}
	else if(isset($_POST['changePass']))
	{
		$query=mysql_query("update loginuser set password='".md5(md5($_POST['password'])."M0n5t3r")."' where idLogin='".$_POST['id']."'");
		if($query)
		{ 
			echo"
			<script>
			alert('Password has been updated'); 
			window.location.href = '".$url."index.php?r=account';
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
	else if(isset($_POST['change']))
	{
		$data=mysql_fetch_array(mysql_query("select password from loginuser where idLogin='".$_POST['id']."'"));
		$aa=md5(md5($_POST['password'])."M0n5t3r");
		//echo $data['password']."<br>";
		if($data['password']==$aa){
		$query=mysql_query("update loginuser set password='".md5(md5($_POST['new_password'])."M0n5t3r")."' where idLogin='".$_POST['id']."'");
		if($query)
		{ 
			echo"
			<script>
			alert('Password has been updated'); 
			window.location.href = '".$url."index.php?r=account';
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
		}else{
			echo"
			<script>
			alert('Your old password not valid'); 
			self.history.back();
			</script>
			";	
		} 
	}else if(isset($_POST['authentify'])){
		mysql_query("DELETE FROM tablemenuuser WHERE id_user='".$_POST['id']."'");
		$ceklis=$_POST[cek];
		$jumlah=count($ceklis);
		//echo $jumlah;
		for($i=0;$i<$jumlah;$i++){
		  $query=mysql_query("insert into tablemenuuser (id_menu,id_user,createdate) values ('$ceklis[$i]','".$_POST['id']."','$tanggal')");
		}

	

if($query){ 
	echo"
	<script>
	alert('Authority has been updated'); 
	window.location.href = '".$url."index.php?r=otoritas';
	</script>
	";
	}else{
	echo"
	<script>
	alert('Update failed'); 
	self.history.back();
	</script>
	";	
	}
}
?>