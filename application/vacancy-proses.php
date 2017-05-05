<?php
	error_reporting(0);
	$nama=$_SESSION['nama'];
	$tanggal=date('Y-m-d H:i:s');
	$compname=php_uname('n');
	
	if(isset($_POST['save']))
	{
		$duedate = date("Y-m-d", strtotime($_POST['duedate']));
		$query=mysql_query("insert into vacancy (
			idvacancy,
			createdate,
			createby,
			fptk,
			department,
			section,
			position,
			level,
			location,
			experience,
			salary,
			education,
			major,
			gpa,
			age,
			duedate,
			other,
			jobdes
			) values (
			'',
			'".date('Y-m-d')."',
			'".$_SESSION['nama']."',
			'".$_POST['fptk']."',
			'".$_POST['department']."',
			'".$_POST['section']."',
			'".$_POST['position']."',
			'".$_POST['level']."',
			'".$_POST['location']."',
			'".$_POST['experience']."',
			'".$_POST['salary']."',
			'".$_POST['education']."',
			'".$_POST['major']."',
			'".$_POST['gpa']."',
			'".$_POST['age']."',
			'$duedate',
			'".$_POST['other']."',
			'".$_POST['jobdes']."'
			)");
		if($query)
		{ 
			echo"
			<script>
			alert('Data successfully saved'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
		$duedate = date("Y-m-d", strtotime($_POST['duedate']));
		$query=mysql_query("update vacancy set 
			fptk='".$_POST['fptk']."',
			department='".$_POST['department']."',
			section='".$_POST['section']."',
			position='".$_POST['position']."',
			level='".$_POST['level']."',
			location='".$_POST['location']."',
			experience='".$_POST['experience']."',
			salary='".$_POST['salary']."',
			education='".$_POST['education']."',
			major='".$_POST['major']."',
			gpa='".$_POST['gpa']."',
			age='".$_POST['age']."',
			duedate='".$duedate."',
			other='".$_POST['other']."',
			jobdes='".$_POST['jobdes']."'
			where idvacancy='".$_POST['idvacancy']."'");
		/*echo "update vacancy set 
			fptk='".$_POST['fptk']."',
			department='".$_POST['department']."',
			section='".$_POST['section']."',
			position='".$_POST['position']."',
			level='".$_POST['level']."',
			location='".$_POST['location']."',
			experience='".$_POST['experience']."',
			salary='".$_POST['salary']."',
			education='".$_POST['education']."',
			major='".$_POST['major']."',
			gpa='".$_POST['gpa']."',
			age='".$_POST['age']."',
			duedate='".$duedate."',
			other='".$_POST['other']."',
			jobdes='".$_POST['jobdes']."'
			where idvacancy='".$_POST['idvacancy']."'";*/
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
		$query=mysql_query("DELETE from vacancy WHERE idvacancy = '".$_GET['del']."';");
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been deleted'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	else if(isset($_GET['kode']))
	{
		$query=mysql_query("DELETE from vacancy WHERE idvacancy = '".$_GET['kode']."';");
		if($query)
		{ 
			echo"
			<script>
			alert('Data Berhasil Dihapus'); 
			window.location.href = '".$url."index.php?r=vacancy';
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