<!-- page head start-->
<div class="page-head">
	<h3 class="m-b-less">
	CANDIDATE
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li><a href="">Home</a></li>
			<li><a href="">Candidate</a></li>
			<li class="active">Status Data Source</li>
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
					Status Data Source
				</header>
				<? 
					$kategori = "SELECT * FROM userWorker uw
								INNER JOIN loginUser lu ON lu.idLogin = uw.idLogin WHERE lu.level=3 
								ORDER BY namaUser ASC";
					$execkategori = mysql_query($kategori);
				?>
				<div class="table-responsive">
					<table class="table responsive-data-table data-table table-striped custom-table table-hover">
						<thead>
							<tr bgcolor="#dedede">
								<th style="text-align:center;">Nama</th>
								<th style="text-align:center;">Email</th>
								<th style="text-align:center;">Telepon</th>
								<th style="text-align:center;">FPTK</th>
								<th style="text-align:center;">Status</th>
								<th style="text-align:center;">Options</th>
							</tr>
						</thead>
						<tbody>
							<?
								while($cet_ven = mysql_fetch_array($execkategori))
								{
									$status=mysql_fetch_array(mysql_query("SELECT namaStatus FROM tableStatusRekrut where idTable='".$cet_ven['statusRekrut']."'"));
									?>
										<tr>
											<td align="center"><?php echo $cet_ven['namaUser']?></td>
											<td align="center"><?php echo $cet_ven['email']?></td>
											<td align="center"><?php echo $cet_ven['noPonsel']?></td>
											<td align="center"><?php if($cet_ven['nomorFptk']==''){ echo 'Undefined'; } else { echo $cet_ven['nomorFptk']; }?></td>
											<td align="center"><?php if($cet_ven['statusRekrut']==''){ echo 'Undefined'; } else { echo $status['namaStatus']; }?></td>
											<td align="center">
												<a href="<?=$base_url;?>index.php?r=candidate-status&id=<?php echo $cet_ven['idWorker'];?>"><button class="btn btn-success btn-xs">Update</button></a>
												<!--<form action="<?=$base_url;?>index.php?r=candidate-status" method="post">
													<input type="hidden" name="idWorker" value="<?=$cet_ven['idWorker'];?>">
													<input class="btn btn-success btn-xs" type="submit" name="status" value="Update">
												</form>-->
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