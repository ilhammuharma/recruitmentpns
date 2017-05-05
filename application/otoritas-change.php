<?
if(isset($_GET['q'])){
	$id=$_GET['q'];
	$data=mysql_fetch_array(mysql_query("select * from loginuser where idLogin='$id'"));
	$dept=mysql_fetch_array(mysql_query("select namaDepartemen from kategoridepartemen where kodeDepartemen='".$data['departemen']."'"));
	$kode=$_GET['q'];
}
?>
<!-- page head start-->
<style>
#tree , #tree li{
	list-style-type:none;
	
}

</style>
<div class="page-head">
	<h3 class="m-b-less">
	Setting
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li>Home</li>
			<li>Setting</li>
			
			<li class="active">Authority Menu</li>
			
		</ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
                    <div class="col-lg-8">
                        <section class="panel">
                            <header class="panel-heading">
								Change Authority
							</header>
                            <div class="panel-body">
								<div class="form ">
                                    <form class="cmxform form-horizontal tasi-form " method="post" action="<?=$base_url?>index.php?r=account-proses">
								<div class="form-group">
									<div>
										<ul id="tree">
											<? $dep=mysql_query("select * from tablemenu where parent='0'"); while($cet_dep=mysql_fetch_array($dep)){ 
											$vc=mysql_query("select * from tablemenuuser where id_menu='".$cet_dep['id']."' and id_user='$id'");
											$cet_vc=mysql_num_rows($vc); if($cet_vc=='0'){$checked='';}else{$checked='checked';}
											?> 
											<li>
												<label class="checkbox-custom check-info">
													<input <?=$checked ?> type="checkbox" value="<?=$cet_dep['id']?>" name="cek[]"  id="<?=$cet_dep['id']?>">
													<label for="<?=$cet_dep['id']?>"><?=$cet_dep['nama_menu']?></label>
												</label>
												
												<ul>
													<? $dep1=mysql_query("select * from tablemenu where parent='".$cet_dep['id']."'"); while($cet_dep1=mysql_fetch_array($dep1)){  
													$vc2=mysql_query("select * from tablemenuuser where id_menu='".$cet_dep1['id']."' and id_user='$id'");
													$cet_vc2=mysql_num_rows($vc2); if($cet_vc2=='0'){$checked2='';}else{$checked2='checked';}
													?> 
													<li>
														<label class="checkbox-custom check-info">
															<input <?=$checked2?> type="checkbox" value="<?=$cet_dep1['id']?>" name="cek[]"  id="<?=$cet_dep1['id']?>">
															<label for="<?=$cet_dep1['id']?>"><?=$cet_dep1['nama_menu']?></label>
														</label>
														
														
													</li>
													<? } ?>
												</ul>
											</li>
											
											<? } ?>
										</ul>
										
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-offset-2 col-lg-10" style="text-align:right;">
										<input type="hidden" name="id" value="<?=$id?>">
										<input type="submit" class="btn btn-success" name="authentify" value="Change">
									</div>
									<br>
								</div>
								</form>
								</div>
                            </div>
							
                        </section>
                    </div>
					<div class="col-lg-4">
                        <section class="panel">
                    <div class="user-head" style="height:150px;">
                        <img src="assets/img/gallery/5.jpg" alt=""  style="height:150px;"/>
                    </div>
                    <div class="panel-body">
                        <div class="user-desk">
                            <div class="avatar">
                                <img src="assets/img/user.png" alt=""/>
                            </div>
                            <div class="clearfix"></div>
                            <h4 class="text-uppercase"><?=$data['nama']?></h4>
                            <span><?=$dept['namaDepartemen']?></span>
							<br>
							<span>Last login <? tanggal4($data['last_login']);?></span>
							<ul class="user-p-list">
								<? if($data['active']==1){?>
                                <li class="btn-success btn addon-btn m-b-10" ><i class="fa fa-check"></i>Active</li>
								<? }else{ ?>
                                <li class="btn-warning btn addon-btn m-b-10" ><i class="fa fa-exclamation"></i>Inctive</li>
								<? } ?>
                            </ul>
                            
                        </div>
                    </div>
                </section>
                    </div>
                </div>
				
</div>
	

<!--body wrapper end-->