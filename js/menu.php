
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
                                    <button class="btn btn-success" type="submit" name="save" onclick="javascript:location.href='<?=$base_url?>index.php?r=menu-add'"><i class="fa fa-plus" style="margin-right:10px;"></i>Add New Menu</button>
                                </span>
                            </header>
							<div class="table-responsive">
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
									
									<button class="btn btn-primary btn-xs" onclick="javascript:location.href='<?=$base_url?>index.php?r=account-form&i=<?=$data['idLogin']?>'"><i class="fa fa-pencil"></i></button>
									<a href="<?=$base_url?>index.php?r=account-proses&del=<?=$data['idLogin']?>" class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash-o "></i></a>
									
								</td>
                            </tr>
							<?
							$query2=mysql_query("select * from tablemenu where parent='".$data['id']."'") or die(mysql_error());
							while($data2=mysql_fetch_array($query2)){
							?>
							<tr>
                                <td align="center"><?=$data2['id']?></td>
                                <td align="center"></td>
								<td align="left" style="padding-left:30px;">- <?=$data2['nama_menu']?></td>
                                <td align="left"><?=$data2['link']?></td>
                                <td align="center">
									
									<button class="btn btn-primary btn-xs" onclick="javascript:location.href='<?=$base_url?>index.php?r=account-form&i=<?=$data['idLogin']?>'"><i class="fa fa-pencil"></i></button>
									<a href="<?=$base_url?>index.php?r=account-proses&del=<?=$data['idLogin']?>" class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-trash-o "></i></a>
									
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
<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<div class="panel-body">
				<header><h3 class="tabs_involved">Data Menu</h3>
					<ul class="tabs"><div class="tambah" onclick="javascript:location.href='<?php echo $link ?>menu-add'">Tambah Menu</div></ul>
				</header>
				<?php
					$batas=20;
					$cari=!isset($_GET['cari']) ? '' : $_GET['cari'];
					$hal=!isset($_GET['hal']) ? '' : $_GET['hal'];
					if(empty($hal))
					{
						$posisi=0;
						$hal=1;	
					}
					else
					{
						$posisi=($hal-1)* $batas;
					}
					$kategori=mysql_query("Select * from tb_menu where nama_menu like '%$cari%' limit $posisi,$batas");
				?>
				<div class="tab_container">
					<table class="tablesorter" cellspacing="0"> 
						<thead> 
							<tr> 
								<th width="10%"></th> 
								<th>Nama Menu</th> 
								<th align="center">Icon</th> 
								<th align="center">Link</th> 
								<th align="center">Actions</th> 
							</tr> 
						</thead> 
						<tbody> 
							<?php
								$no=$posisi+1;
								while($cet_ven=mysql_fetch_array($kategori))
								{
									?>
										<tr> 
											<td align="center"><input type="checkbox"></td> 
											<td><?php echo $cet_ven['nama_menu'] ?></td> 
											<td align="center"><? if($cet_ven['icon']==''){}else{ ?><img src="<?php echo $url."images/".$cet_ven['icon'] ?>.png"  /> <? } ?></td> 
											<td align="center"><? if($cet_ven['link']==''){}else{ ?><?php echo $url.$cet_ven['link']; ?><? } ?></td> 
											<td align="center"><a href="<?php echo $link ?>menu-proses&kode=<?php echo $cet_ven['id'] ?>" onClick="return confirm('Anda yakin untuk menghapus data ini?');"><img src="images/icn_trash.png" /></a></td> 
										</tr> 
									<?php
									$no++; 
								} 
							?>
							<?php
								$tampil2= mysql_query("Select * from tb_menu where nama_menu like '%$cari%'");
								$jmldata=mysql_num_rows($tampil2);
								$jmlhalaman=ceil($jmldata/$batas);
								$file= $link."menu";
							?>	
						</tbody> 
					</table>
				</div><!-- end of .tab_container -->
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->
<?php
	$aa=$batas+1;
	if($jmldata<$aa){}
	else
	{
		?>
			<div class="pagging width_full">
				<?php
					//link ke halaman sebelumnya (previous)
					if($hal > 1)
					{
						$previous=$hal-1;
						echo "<A HREF=$file&hal=1&cari=$cari><<</A> 
							<A HREF=$file&hal=$previous&cari=$cari><</A> ";
					}
					else
					{ 
						echo "";
					}
					$angka=($hal > 3 ? " ... " : " ");
					for($i=$hal-2;$i<$hal;$i++)
					{
						if ($i < 1) 
						continue;
						$angka .= "<a href=$file&hal=$i&cari=$cari>$i</A> ";
					}
					$angka .= " <b>$hal</b> ";
					for($i=$hal+1;$i<($hal+3);$i++)
					{
						if ($i > $jmlhalaman) 
						break;
						$angka .= "<a href=$file&hal=$i&cari=$cari>$i</A> ";
					}
					$angka .= ($hal+2<$jmlhalaman ? " ...  
					  <a href=$file&hal=$jmlhalaman&cari=$cari>$jmlhalaman</A> " : " ");
					echo "$angka";
				
					//link kehalaman berikutnya (Next)
					if($hal < $jmlhalaman)
					{
						$next=$hal+1;
						echo "<A HREF=$file&hal=$next&cari=$cari>></A> 
						<A HREF=$file&hal=$jmlhalaman&cari=$cari>>></A> ";
					}
					else
					{ 
						echo " ";
					}
				?>
			</div>
		<?php 
	} 
?>
