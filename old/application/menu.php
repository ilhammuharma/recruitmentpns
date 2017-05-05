
<div class="page-head">
	<h3 class="m-b-less">
	Setting
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li><a href="">Home</a></li>
			<li><a href="">Setting</a></li>
			<li class="active">Menu Management</li>
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
                                List Menu
                                <span class="tools pull-right">
                                    <!--<a class="fa fa-repeat box-refresh" href="javascript:;"></a>-->
                                    <button class="btn btn-success" type="submit" name="save" onclick="javascript:location.href='<?=$base_url?>index.php?r=menu-form'"><i class="fa fa-plus" style="margin-right:10px;"></i>Add New Menu</button>
                                </span>
                            </header>
							<div class="table-responsive" style="padding:15px;">
                            <table class="table table-menu data-table table-striped custom-table table-hover">
                            <thead>
                            <tr bgcolor="#dedede">
                                <th style="text-align:center;" width="5%">Id</th>
								<th style="text-align:center;" width="3%">Icon</th>
                                <th style="text-align:left;" width="25%">Menu Name</th>
								<th style="text-align:left;" >link</th>
                                <th style="text-align:center;" width="10%">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?
							$query=mysql_query("select * from tablemenu where parent=0 order by order_data asc") or die(mysql_error());
							while($data=mysql_fetch_array($query)){
							?>
                            <tr>
                                <td align="center"><?=$data['id']?></td>
                                <td align="center"><span class="fa <?=$data['icon']?>"></span></td>
								<td align="left"><b><?=$data['nama_menu']?></b></td>
                                <td align="left"><?=$data['link']?></td>
                                <td align="center">
									
									<button class="btn btn-primary btn-xs" onclick="javascript:location.href='<?=$base_url?>index.php?r=menu-form&i=<?=$data['idLogin']?>'"><i class="fa fa-pencil"></i></button>
									<a href="<?=$base_url?>index.php?r=menu-proses&del=<?=$data['idLogin']?>" class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure you want to delete this menu?');"><i class="fa fa-trash-o "></i></a>
									
								</td>
                            </tr>
							<?
							$query2=mysql_query("select * from tablemenu where parent='".$data['id']."' order by order_data asc") or die(mysql_error());
							while($data2=mysql_fetch_array($query2)){
							?>
							<tr>
                                <td align="center"><?=$data2['id']?></td>
                                <td align="center"></td>
								<td align="left" style="padding-left:30px;">- <?=$data2['nama_menu']?></td>
                                <td align="left"><?=$data2['link']?></td>
                                <td align="center">
									
									<button class="btn btn-primary btn-xs" onclick="javascript:location.href='<?=$base_url?>index.php?r=menu-form&i=<?=$data['idLogin']?>'"><i class="fa fa-pencil"></i></button>
									<a href="<?=$base_url?>index.php?r=menu-proses&del=<?=$data['idLogin']?>" class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure you want to delete this menu?');"><i class="fa fa-trash-o "></i></a>
									
								</td>
                            </tr>
							<? }} ?>
							
                            
                            </tbody>
                            </table>
							</div>
                        </section>
                    </div>

                </div>
				 
</div>
