<?
session_start();
ini_set('display_errors', 1);
include('module/config.php');
ob_start();
$result = mysql_query('SELECT * FROM loginuser WHERE username="'.mysql_real_escape_string($_POST['username']).'" AND password="'.md5(md5($_POST['password'])."M0n5t3r").'" and active="1"');
$num_rows = mysql_num_rows($result);
$cet= mysql_fetch_array($result);
echo $num_rows;
if($num_rows==1){
	$_SESSION['username']= $cet['username'];
	$_SESSION['nama']= $cet['nama'];
	$_SESSION['department']= $cet['departemen'];
	$_SESSION['id']= $cet['idLogin'];
	$_SESSION['distrik']= $cet['distrik'];
	//echo $_SESSION['nama'];
	mysql_query("update loginuser set last_login='".date('Y-m-d H:i:s')."' where username='".$_SESSION['username']."'");
	header('location:'.$base_url.'index.php');
}else{
	$_SESSION['username']= $_POST['username'];
	header('location:'.$base_url.'login.php');	
} 
?>