<!-- page head start-->
<div class="page-head">
	<h3 class="m-b-less">
	Vacancy
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li><a href="">Home</a></li>
			<li><a href="">Vacancy</a></li>
			<li class="active">List Vacancy</li>
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
					List Vacancy
					<span class="tools pull-right">
						<!--<a class="fa fa-repeat box-refresh" href="javascript:;"></a>-->
						<button class="btn btn-success" type="submit" name="save" onclick="javascript:location.href='<?=$base_url?>index.php?r=vacancy-form'"><i class="fa fa-plus" style="margin-right:10px;"></i>Add New Vacancy</button>
                    </span>
				</header>
				<div class="table-responsive">
					<table class="table responsive-data-table data-table table-striped custom-table table-hover">
						<thead>
							<tr bgcolor="#dedede">
								<th style="text-align:center;">Create Date</th>
								<th style="text-align:center;">Create By</th>
								<th style="text-align:center;">No.FPTK</th>
								<th style="text-align:center;">Department</th>
								<th style="text-align:center;">Section</th>
								<th style="text-align:center;">Position</th>
								<th style="text-align:center;">Level</th>
								<th style="text-align:center;">Status</th>
								<th style="text-align:center;">Options</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$kategori = "Select *, kdep.namaDepartemen, ks.namaSection, kk.namaKategori, kl.namaLevel from vacancy v ";
								//$kategori .= "JOIN fptk f ON v.fptk = f.nomorFptk ";
								$kategori .= "JOIN kategoriDepartemen kdep ON v.department = kdep.idDepartemen ";
								$kategori .= "JOIN kategoriSection ks ON v.section = ks.idSection ";
								$kategori .= "JOIN kategoriKerja kk ON v.position = kk.idKategori ";
								$kategori .= "JOIN kategoriLevel kl ON v.level = kl.idLevel ";
								$kategori .= "where createby='".$_SESSION['nama']."' order by createdate asc ";
								$execkategori = mysql_query($kategori);
								while($cet_ven=mysql_fetch_array($execkategori))
								{
									if($cet_ven['duedate']>=date('Y-m-d')){$status="<span class='label label-success label-mini'>Open</span>";} else {$status="<span class='label label-danger label-mini'>Closed</span>";}
									$vacancy = "select * from vacancyapply va ";
									$vacancy .= "where idvacancy = '".$cet_ven['idvacancy']."' ";
									$execvacancy = mysql_query($vacancy);
									$cet_vacancy=mysql_fetch_array($execvacancy);
									?>
										<tr>
											<td align="center"><?php tanggal2($cet_ven['createdate'])?></td>
											<td align="center"><?php echo $cet_ven['createby']?></td>
											<td align="center"><?php echo $cet_ven['fptk']?></td>
											<td align="center"><?php echo $cet_ven['namaDepartemen']?></td>
											<td align="center"><?php echo $cet_ven['namaSection']?></td>
											<td align="center"><?php echo $cet_ven['namaKategori']?></td>
											<td align="center"><?php echo $cet_ven['namaLevel']?></td>
											<td align="center"><?php echo $status?></td>
											<td align="center">
												<form action="<?=$base_url;?>index.php?r=vacancy-show" method="post">
													<input type="hidden" name="idvacancy" value="<?=$cet_ven['idvacancy'];?>">
													<?if($cet_vacancy['idVacancy']!='' and $cet_vacancy['idWorker']!=''){?>
													<button class="btn btn-success btn-xs" type="submit" name="viewvacancy"><i class="fa fa-eye"></i></button>
													<a class="btn btn-primary btn-xs" href="<?=$base_url?>index.php?r=vacancy-form&idvacancy=<?=$cet_ven['idvacancy']?>"><i class="fa fa-pencil"></i></a><?}
													else{?>
													<a href="<?=$base_url?>index.php?r=vacancy-proses&del=<?=$cet_ven['idvacancy']?>" class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure you want to delete this data?');"><i class="fa fa-trash-o "></i></a><?}
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