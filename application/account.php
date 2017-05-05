
<div class="page-head">
	<h3 class="m-b-less">
	User Account
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li><a href="">Home</a></li>
			<li><a href="">User Account</a></li>
			<li class="active">List User</li>
		</ol>
    </div>
</div>
            <!-- page head end-->
<!--body wrapper start-->
<div class="wrapper">
				
				<div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading head-border">
                                List User
                                <span class="tools pull-right">
                                    <!--<a class="fa fa-repeat box-refresh" href="javascript:;"></a>-->
                                    <button class="btn btn-success" type="submit" name="save" onclick="javascript:location.href='<?=$base_url?>index.php?r=account-form'"><i class="fa fa-plus" style="margin-right:10px;"></i>Add New User</button>
                                </span>
                            </header>
							<div class="table-responsive">
                            <table class="table responsive-data-table data-table table-striped custom-table table-hover">
                            <thead>
                            <tr bgcolor="#dedede">
                                <th style="text-align:center;" width="3%">Id</th>
                                <th style="text-align:center;">Name</th>
                                <th style="text-align:center;" width="15%">Username</th>
								<th style="text-align:center;" width="15%">Email</th>
                                <th style="text-align:center;" width="8%">Dept</th>
                                <th style="text-align:center;" width="10%">Status</th>
                                <th style="text-align:center;" width="18%">Last Login</th>
                                <th style="text-align:center;" width="10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?
							$query=mysql_query("select * from loginuser order by idLogin desc") or die(mysql_error());
							while($data=mysql_fetch_array($query)){
							if($data['active']==1){$status="<span class='label label-success label-mini'>Active</span>";}else{$status="<span class='label label-danger label-mini'>Inactive</span>";}
							?>
                            <tr>
                                <td align="center"><?=$data['idLogin']?></td>
                                <td align="center"><?=$data['nama']?></td>
                                <td align="center"><?=$data['username']?></td>
								<td align="center"><?=$data['email']?></td>
                                <td align="center"><?=$data['departemen']?></td>
                                <td align="center"><?=$status?></td>
                                <td align="center"><? tanggal4($data['last_login'])?></td>
                                <td align="center">
									
									<button class="btn btn-primary btn-xs" onclick="javascript:location.href='<?=$base_url?>index.php?r=account-form&i=<?=$data['idLogin']?>'"><i class="fa fa-pencil"></i></button>
									<a href="<?=$base_url?>index.php?r=account-proses&del=<?=$data['idLogin']?>" class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash-o "></i></a>
									
								</td>
                            </tr>
							<? } ?>
							
                            
                            </tbody>
                            </table>
							</div>
                        </section>
                    </div>

                </div>
				 
</div>