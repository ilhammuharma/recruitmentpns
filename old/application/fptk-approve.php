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
			<li class="active">Approval FPTK</li>
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
					Approval FPTK
					<span class="tools pull-right">
						<a class="fa fa-repeat box-refresh" href="javascript:;"></a>
						<a class="t-close fa fa-times" href="javascript:;"></a>
					</span>
				</header>
				<?php
					if($_GET['a']==1)
					{
						$getfptk = "SELECT * from fptk WHERE namaManager='' AND rejectFptk='' ORDER BY namaPemohon ASC";
						$tombol='approve1';
					}
					else if($_GET['a']==2)
					{
						$getfptk = "SELECT * from fptk WHERE namaManager!='' AND namaHrdSuperintendent='' AND rejectFptk='' ORDER BY namaPemohon ASC";
						$tombol='approve2';
					}
					else if($_GET['a']==3)
					{
						$getfptk = "SELECT * from fptk WHERE namaHrdSuperintendent!='' AND namaGeneralManager='' AND rejectFptk='' ORDER BY namaPemohon ASC";
						$tombol='approve3';
					}
					else if($_GET['a']==4)
					{
						$getfptk = "SELECT * from fptk WHERE namaGeneralManager!='' AND namaOdManager='' AND rejectFptk='' ORDER BY namaPemohon ASC";
						$tombol='approve4';
					}
					else if($_GET['a']==5)
					{
						$getfptk = "SELECT * from fptk WHERE namaOdManager!='' AND namaHrdManager='' AND rejectFptk='' ORDER BY namaPemohon ASC";
						$tombol='approve5';
					}
					else if($_GET['a']==6)
					{
						$getfptk = "SELECT * from fptk WHERE namaHrdManager!='' AND namaDirektur='' AND rejectFptk='' ORDER BY namaPemohon ASC";
						$tombol='approve6';
					}
					else if($_GET['a']==7)
					{
						$getfptk = "SELECT * from fptk WHERE namaDirektur!='' AND namaRecruitmentSuperintendent='' AND rejectFptk='' ORDER BY namaPemohon ASC";
						$tombol='approve7';
					}
					else
					{
						$getfptk = "SELECT * from fptk WHERE namaRecruitmentSuperintendent!='' AND closingby='' AND rejectFptk='' ORDER BY namaPemohon ASC";
						$tombol='approve7';
					}
					$kategori = mysql_query($getfptk);
					?>
						<div class="table-responsive">
							<table class="table responsive-data-table data-table table-striped custom-table table-hover">
								<thead>
									<tr bgcolor="#dedede">
										<th style="text-align:center;">No</th>
										<th style="text-align:center;">Create By</th>
										<th style="text-align:center;">Create Date</th>
										<th style="text-align:center;">MPP</th>
										<th style="text-align:center;">PIC</th>
										<th style="text-align:center;">Option</th>
									</tr>
								</thead>
								<tbody>
									<?php
										while($cet_ven=mysql_fetch_array($kategori))
										{
											?><tr>
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
													if($cet_ven['namaRecruitmentSuperintendent']!='')
													{?><?php echo $cet_ven['namaRecruitmentSuperintendent'];?><?}
													else
													{?><?php echo 'Pending';?><?}
												?>
											</td>
												<td align="center">
													<form action="<?=$base_url;?>index.php?r=fptk-view" method="post">
														<input type="hidden" name="idFptk" value="<?=$cet_ven['idFptk'];?>">
														<input type="hidden" name="a" value="<?=$_GET['a'];?>">
														<input class="btn btn-success" type="submit" name="approval" value="Approval">
													</form>
												</td>
											</tr><?php
										}
										?>
								</tbody>
							</table>
						</div>
					<?php
				?>		
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->