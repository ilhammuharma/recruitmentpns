<?
if(isset($_GET['i'])){
	$id=$_GET['i'];
	$data=mysql_fetch_array(mysql_query("select * from loginuser where idLogin='$id'"));
}
?>
<!-- page head start-->
<div class="page-head">
	<h3 class="m-b-less">
	User Account
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li>Home</li>
			<li>User Account</li>
			<?if(isset($_GET['i'])){ ?>
			<li class="active">Edit User</li>
			<? }else{?>
			<li class="active">Add New User</li>
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
                                Edit User
								<? }else{?>
								Add New User
								<? } ?>
                            </header>
                            <div class="panel-body">
                                <div class="form ">
                                    <form class="cmxform form-horizontal tasi-form " id="newUser" method="post" action="<?=$base_url?>index.php?r=account-proses">
										
                                        <div class="form-group ">
                                            <label for="name" class="control-label col-lg-2">Name *</label>
                                            <div class="col-lg-10">
                                                <input class=" form-control" id="name" name="name" type="text" value="<?=$data['nama']?>"/>
                                            </div>
                                        </div>
										<div class="form-group ">
                                            <label for="email" class="control-label col-lg-2">Email *</label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="email" name="email" type="email" value="<?=$data['email']?>" />
                                            </div>
                                        </div>
										<div class="form-group ">
                                            <label for="username" class="control-label col-lg-2">Username *</label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="username" name="username" type="text" value="<?=$data['username']?>" />
                                            </div>
                                        </div>
										<?if(isset($_GET['i'])){}else{ ?>
                                        <div class="form-group ">
                                            <label for="password" class="control-label col-lg-2">Password *</label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="password" name="password" type="password" />
                                            </div>
                                        </div>
										<? } ?>
										<div class="form-group ">
                                            <label for="nik" class="control-label col-lg-2">NIK *</label>
                                            <div class="col-lg-10">
                                                <input class=" form-control" id="nik" name="nik" type="text" value="<?=$data['nik']?>" />
                                            </div>
                                        </div>
										<div class="form-group ">
                                            <label for="departemen" class="control-label col-lg-2">Department *</label>
                                            <div class="col-lg-10">
												<select name="departemen" id="departemen id" class="form-control select2">
													<option value=""></option>
													<optgroup label="Select Department">
													<? 
														$dep=mysql_query("select * from kategoriDepartemen"); 
														while($cet_dep=mysql_fetch_array($dep))
														{ ?> <option <?=($cet_dep['kodeDepartemen']==$data['departemen'])?'selected':'';?> value="<?=$cet_dep['kodeDepartemen'] ?>"><? echo $cet_dep['namaDepartemen'] ?></option><? } 
													?>
												</select>
                                            </div>
                                        </div>
										<div class="form-group ">
                                            <label for="distrik" class="control-label col-lg-2">District *</label>
                                            <div class="col-lg-10">
												<select name="distrik" id="distrik" class="form-control select2">
													<option value=""></option>
													<optgroup label="Select District">
													<? 
														$distrik=mysql_query("select * from kategoridistrik"); 
														while($cet_distik=mysql_fetch_array($distrik))
														{ ?> <option <?=($cet_distik['kodeDistrik']==$data['distrik'])?'selected':'';?> value="<? echo $cet_distik['kodeDistrik'] ?>"><? echo $cet_distik['namaDistrik'] ?></option><? } 
													?>
												</select>
                                            </div>
                                        </div>
										<div class="form-group ">
                                            <label for="atasan" class="control-label col-lg-2">Responsible to *</label>
                                            <div class="col-lg-10">
												<select name="atasan" id="atasan" class="form-control select2">
													<option value=""></option>
													<optgroup label="Responsible to">
													<option <?=(isset($data['parent'])&&$data['parent']==0)?'selected':'';?> value="0">None</option>
													<? 
														$distrik=mysql_query("select idLogin, nama from loginuser"); 
														while($cet_distik=mysql_fetch_array($distrik))
														{ ?> <option <?=($cet_distik['idLogin']==$data['parent'])?'selected':'';?> value="<? echo $cet_distik['idLogin'] ?>"><? echo $cet_distik['nama'] ?></option><? } 
													?>
												</select>
                                            </div>
                                        </div>
										<div class="form-group ">
                                            <label for="status" class="control-label col-lg-2">Status *</label>
                                            <div class="col-lg-10">
												<select name="status" id="status" class="form-control">
													<option <?=(isset($data['active'])&&$data['active']==1)?'selected':'';?> value="1">Active</option>
													<option <?=(isset($data['active'])&&$data['active']==0)?'selected':'';?> value="0">Inactive</option>
												</select>
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
                                                
                                                <button class="btn btn-default" type="button" onclick="javascript:location.href='<?=$base_url?>index.php?r=account'">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
				<?if(isset($_GET['i'])){ ?>
				<div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
								Change Password
                            </header>
                            <div class="panel-body">
                                <div class="form ">
                                    <form class="cmxform form-horizontal tasi-form " id="changePass" method="post" action="<?=$base_url?>index.php?r=account-proses">
										
                                        
                                        <div class="form-group ">
                                            <label for="password" class="control-label col-lg-2">New Password *</label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="password" name="password" type="password" />
                                            </div>
                                        </div>
										
										
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
												
												<input type="hidden" name="id" value="<?=$id?>"> 
												<input class="btn btn-success" type="submit" name="changePass" value="Change Password">
												
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
				<? } ?>

</div>

<!--body wrapper end-->