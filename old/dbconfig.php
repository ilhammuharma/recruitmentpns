<?php
	$server = "localhost";
	$username = "adminit";
	$password = "ruangit";

	$db = "zadmin_recruitment";

	mysql_connect($server, $username, $password) or die(mysql_error());
	mysql_select_db($db);
	
	date_default_timezone_set('Asia/Jakarta');
	$webRoot = "http://recruitment.pns.co.id";
	$emailAdmin = "career@pns.co.id";
	$nameAdmin = "Admin PNS";  
	$url = "http://$_SERVER[HTTP_HOST]";
	//$url = "http://$_SERVER[HTTP_HOST]/skripsi/";
?>
