<?php
	//$server = "103.29.151.147";
	//$username = "zadmin_admin_it";
	//$password = "ruangit";
	
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
?>