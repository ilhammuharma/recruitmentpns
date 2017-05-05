<?
	session_start();
	include('module/config.php');
	$result = mysql_query('SELECT * FROM loginuser WHERE username="'.mysql_real_escape_string($_POST['username']).'" AND password="'.md5(md5($_POST['password'])."M0n5t3r").'" and active="1"');
	$num_rows = mysql_num_rows($result);
	echo $num_rows;

	/* $cet= mysql_fetch_array($result);
	if($num_rows==1){
		$_SESSION['username']= $cet['username'];
		$_SESSION['nama']= $cet['nama'];
		$_SESSION['department']= $cet['department'];
		$_SESSION['id']= $cet['id'];
		$_SESSION['distrik']= $cet['distrik	'];
		
		mysql_query("update user set last_login='".date('Y-m-d H:i:s')."' where username='".$_SESSION['username']."'");
		header('location:'.$url.'index.php');
	}else{
		$_SESSION['username']= $_POST['username'];
		header('location:'.$url.'login.php');
		/* echo"
		<script>
		alert('Username atau password tidak tepat'); 
		window.location.href = '".$url."login.php';
		</script>
		"; 
		//header('location:'.$url.'index.php');
	}
	 */
?>