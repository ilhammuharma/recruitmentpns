<?
$path = "assets/css/";
$files = scandir($path);
foreach ($files as &$value) { if($value=='.' or $value=='..'){}else{?>
	<link rel="stylesheet" href="<?=$path.$value?>">
<? }} ?>

