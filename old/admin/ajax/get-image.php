<?php
include("../../assets/dbconfig.php");
if(!isset($_POST['id'])){
	echo "ERROR Loading";
}else{
	$id = $_POST['id'];
	$getImage = "SELECT * FROM tableSlider WHERE idTable = $id";
	$execImage = mysql_query($getImage);
	$result = mysql_fetch_array($execImage);
	$image = $result['pathSlider'];
?>
	<img src="<?php echo $image;?>" alt="<?php echo $result['namaSlider'];?>" class="img-responsive">
<?php
}
?>