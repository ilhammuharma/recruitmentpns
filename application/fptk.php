<!-- page head start-->
<div class="page-head">
	<h3 class="m-b-less">
	FPTK
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li><a href="">Home</a></li>
			<li><a href="">FPTK</a></li>
			<li class="active">List FPTK</li>
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
					List FPTK
					<span class="tools pull-right">
						<!--<a class="fa fa-repeat box-refresh" href="javascript:;"></a>-->
						<button class="btn btn-success" type="submit" name="save" onclick="javascript:location.href='<?=$base_url?>index.php?r=fptk-form'"><i class="fa fa-plus" style="margin-right:10px;"></i>Add New FPTK</button>
                    </span>
				</header>
				<div class="table-responsive">
					<table class="table responsive-data-table data-table table-striped custom-table table-hover">
						<thead>
							<tr bgcolor="#dedede">
								<th style="text-align:center;">No</th>
								<th style="text-align:center;">Create By</th>
								<th style="text-align:center;">Create Date</th>
								<th style="text-align:center;">MPP</th>
								<th style="text-align:center;">PIC</th>
								<th style="text-align:center;">Status</th>
								<th style="text-align:center;">Options</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$kategori=mysql_query("Select * from fptk where namaPemohon='".$_SESSION['nama']."' order by tanggalDibuat asc");
								/*$kategori = "Select *, lu.nama from fptk f ";
								$kategori .= "INNER JOIN loginUser lu ON f.pic = lu.idLogin ";
								$kategori .= "where namaPemohon='".$_SESSION['nama']."' order by tanggalDibuat asc ";
								echo $kategori;
								$execkategori = mysql_query($kategori);*/
								while($cet_ven=mysql_fetch_array($kategori))
								{
									$pic = mysql_fetch_array(mysql_query("SELECT * FROM loginUser where nama='".$_SESSION['nama']."'"));
									if($cet_ven['rejectFptk']!=''){$status="<span class='label label-danger label-mini'>Reject</span>";}
									else if($cet_ven['closingBy']!='' and $cet_ven['rejectFptk']==''){$status="<span class='label label-info label-mini'>FPTK Closed</span>";}
									else if($cet_ven['namaDirektur']!='' and $cet_ven['rejectFptk']==''){$status="<span class='label label-success label-mini'>Final Approved</span>";}
									else if($cet_ven['namaHrdManager']!='' and $cet_ven['rejectFptk']==''){$status="<span class='label label-success label-mini'>HR Manager Approved</span>";}
									else if($cet_ven['namaOdManager']!='' and $cet_ven['rejectFptk']==''){$status="<span class='label label-success label-mini'>OD Approved</span>";}
									else if($cet_ven['namaGeneralManager']!='' and $cet_ven['rejectFptk']==''){$status="<span class='label label-success label-mini'>GM Approved</span>";}
									else if($cet_ven['namaHrdSuperintendent']!='' and $cet_ven['rejectFptk']==''){$status="<span class='label label-success label-mini'>HR Superintendent Approved</span>";}
									else if($cet_ven['namaManager']!='' and $cet_ven['rejectFptk']==''){$status="<span class='label label-success label-mini'>Manager Approved</span>";}
									else {$status="<span class='label label-info label-mini'>Pending</span>";}
									?>
										<tr>
											<td align="center"><?php echo $cet_ven['nomorFptk']?></td>
											<td align="center"><?php echo $cet_ven['namaPemohon']?></td>
											<td align="center"><?php tanggal2($cet_ven['tanggalDibuat'])?></td>
											<td align="center">
												<?
													if($cet_ven['mppPosisi']!='')
													{?><?php echo $cet_ven['mppPosisi'];?><?}
													else
													{?><?php echo 'Pending';?><?}
												?>
											</td>
											<td align="center">
												<?
													if($cet_ven['pic']!='')
													{ ?><?php echo $pic['nama'];?><? }
													else
													{ ?><?php echo 'Pending';?><? }
												?>
											</td>
											<td align="center"><?php echo $status?></td>
											<td align="center">
												<!--<button class="btn btn-success btn-xs" onclick="javascript:location.href='<?//=$base_url?>index.php?r=fptk-show&i=<?//=$cet_ven['idFptk']?>'"><i class="fa fa-eye"></i></button>-->
												<form action="<?=$base_url;?>index.php?r=fptk-show" method="post">
													<input type="hidden" name="idFptk" value="<?=$cet_ven['idFptk'];?>">
													<button class="btn btn-success btn-xs" type="submit" name="viewFptk"><i class="fa fa-eye"></i></button>
													<?
														if ($cet_ven['namaManager']!='' and $cet_ven['rejectFptk']=='')
														{} 
														else
														{
															?><a class="btn btn-primary btn-xs" href="<?=$base_url?>index.php?r=fptk-form&idFptk=<?=$cet_ven['idFptk']?>"><i class="fa fa-pencil"></i></a>
															<a href="<?=$base_url?>index.php?r=fptk-proses&del=<?=$cet_ven['idFptk']?>" class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure you want to delete this data?');"><i class="fa fa-trash-o "></i></a><?
														}
													?>
												</form>
											</td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->