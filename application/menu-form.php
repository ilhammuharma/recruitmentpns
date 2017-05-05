<?
if(isset($_GET['i'])){
	$id=$_GET['i'];
	$data=mysql_fetch_array(mysql_query("select * from loginuser where idLogin='$id'"));
}
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kategori>
  $("#parent").change(function(){
    var parent = $("#parent").val();
    $.ajax({
        url: "application/get/get_icon.php",
        data: "parent="+parent,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=sub_kategori>
            $("#icon").html(msg);
        }
    });
  });
  
});

</script>
<script>
$(function() {
    $('#icon').hide(); 
    $('#parent').change(function(){
        if($('#parent').val() == 0) {
            $('#icon').show(); 
        } else {
            $('#icon').hide(); 
        } 
    });
});
</script>
<!-- page head start-->
<div class="page-head">
	<h3 class="m-b-less">
	Setting
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li>Home</li>
			<li>Setting</li>
			<?if(isset($_GET['i'])){ ?>
			<li class="active">Edit Menu</li>
			<? }else{?>
			<li class="active">Add New Menu</li>
			<? } ?>
		</ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
								<?if(isset($_GET['i'])){ ?>
                                Edit Menu
								<? }else{?>
								Add New Menu
								<? } ?>
                            </header>
                            <div class="panel-body">
                                <div class="form ">
                                    <form class="cmxform form-horizontal tasi-form " id="newMenu" method="post" action="<?=$base_url?>index.php?r=menu-proses">
										
                                        <div class="form-group ">
                                            <label for="name" class="control-label col-lg-2">Menu Name</label>
                                            <div class="col-lg-10">
                                                <input class=" form-control" id="name" name="name" type="text" value="<?=$data['nama']?>"/>
                                            </div>
                                        </div>
										<div class="form-group ">
                                            <label for="link" class="control-label col-lg-2">Link</label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="link" name="link" type="text" value="<?=$data['link']?>" />
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="username" class="control-label col-lg-2">Parent Menu</label>
                                            <div class="col-lg-10">
                                                <select id="parent" name="parent" class="form-control select2" >
													<option value=""></option>
													<option value="0">None</option>
													<? $dep=mysql_query("select * from tablemenu where parent='0'"); while($cet_dep=mysql_fetch_array($dep)){ ?> 
													<option value="<? echo $cet_dep['id'] ?>"><? echo $cet_dep['nama_menu'] ?></option>
													
													<? } ?>	
												</select>
                                            </div>
                                        </div>
										<div class="form-group " id="icon">
                                            <label for="icon" class="control-label col-lg-2">Icon</label>
                                            <div class="col-lg-10">
												<div class="input-group m-b-10">
												<span class="input-group-addon lead m-b-10"><i class="fa picker-target"></i></span>
												<input data-placement="bottomLeft"  value="<?//=$data['icon']?>"  type="text" class="form-control icp icp-auto action-create" name="icon">
												</div>
												
													
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
												<?if(isset($_GET['i'])){ ?>
												<input type="hidden" name="id" value="<?=$id?>"> 
												<input class="btn btn-success" type="submit" name="edit" value="Edit">
												<? }else{?>
												<input class="btn btn-success" type="submit" name="save" value="Save">
												<? } ?>
                                                
                                                <button class="btn btn-default" type="button" onclick="javascript:location.href='<?=$base_url?>index.php?r=menu'">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
				
</div>

<!--body wrapper end-->



