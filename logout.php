<?php
session_start();	
session_destroy();
include('config/config.php');


?>

<meta http-equiv="REFRESH" content=0;url=<?php echo $url ?>index.php>