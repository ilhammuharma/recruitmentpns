<?
$path = "assets/js/";
$files = scandir($path);
foreach ($files as &$value) { if($value=='.' or $value=='..'){}else{?>
	<script src="<?=$path.$value?>"></script>
<? }} ?>

