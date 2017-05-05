<? 
$parent = $_GET['parent'];
if($parent==0){
?>
<label for="icon" class="control-label col-lg-2">Icon</label>
<div class="col-lg-10">
	<div class="input-group m-b-10">
		<span class="input-group-addon lead m-b-10"><i class="fa picker-target"></i></span>
		<input data-placement="bottomLeft"  value="<?=$data['icon']?>"  type="text" class="form-control icp icp-auto action-create" name="icon">
	</div>
</div>
<? }else{} ?>