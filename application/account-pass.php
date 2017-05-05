<div class="page-head">
	<h3 class="m-b-less">
	User Account
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li>Home</li>
			<li>User Account</li>
			
			<li class="active">Change Password</li>
			
		</ol>
    </div>
</div>
<div class="wrapper">
	<div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
								Change Password
                            </header>
                            <div class="panel-body">
                                <div class="form ">
                                    <form class="cmxform form-horizontal tasi-form " id="changePass2" method="post" action="<?=$base_url?>index.php?r=account-proses">
										
                                        <div class="form-group ">
                                            <label for="new_password" class="control-label col-lg-2">New Password</label>
                                            <div class="col-lg-10">
                                                <input class=" form-control" id="new_password" name="new_password" type="password" />
                                            </div>
                                        </div>
										<div class="form-group ">
                                            <label for="confirm_pass" class="control-label col-lg-2">Confirm Password</label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="confirm_pass" name="confirm_pass" type="password" />
                                            </div>
                                        </div>
										<div class="form-group ">
                                            <label for="password" class="control-label col-lg-2">Old Password</label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="password" name="password" type="password"/>
                                            </div>
                                        </div>
										
										<?//=$_SESSION['id']?>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
												<input type="hidden" name="id" value="<?=$_SESSION['id']?>"> 
												<input class="btn btn-success" type="submit" name="change" value="Change">
												
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
				

</div>
