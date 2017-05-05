<?
	if(isset($_GET['i']))
	{
		$id=$_GET['i'];
		$data=mysql_fetch_array(mysql_query("select * from loginuser where idLogin='$id'"));
	}
?>
<!-- page head start-->
<div class="page-head">
	<h3 class="m-b-less">
	SUMMARY REPORT
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li><a href="">Home</a></li>
			<li><a href="">Summary Report</a></li>
			<li class="active">Report Data Sourcing</li>
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
					Report Data Sourcing
				</header>
				<div class="panel-body">
					<form role="form" class="form-horizontal" id="reportdatasourcing" action="<?=$base_url?>index.php?r=report-datasourcing" method="post">
						<div class="form-group">
							<label class="control-label col-sm-2">Posisi</label>
							<div class="col-md-5">
								<select name="posisi" id="posisi" class="form-control select2" class="autocombo">
									<option value="">-- Select All --</option>
									<?
										/*$queryno = "SELECT * FROM fptk ORDER BY nomorFptk ASC";
										$execno = mysql_query($queryno);
										while($nofptk = mysql_fetch_array($execno))
										{?><option value="<? echo $nofptk['nomorFptk'];?>"><? echo $nofptk['nomorFptk']." (".$nofptk['namaPemohon'].")";?></option><?}*/
										$kat=mysql_query("select * from kategoriKerja where idKategori in (select posisi from userWorker group by posisi)"); 
										while($cet_kat=mysql_fetch_array($kat))
										{ ?> <option value="<? echo $cet_kat['idKategori'] ?>"><? echo $cet_kat['namaKategori'] ?></option> <? }
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Kandidat</label>
							<div class="col-md-5">
								<select name="namaUser" id="namaUser" class="form-control select2" class="autocombo">
									<option value="">-- Select All --</option>
									<?
										$kat=mysql_query("select namaUser from userWorker group by namaUser"); 
										while($cet_kat=mysql_fetch_array($kat))
										{ ?> <option value="<? echo $cet_kat['namaUser'] ?>"><? echo $cet_kat['namaUser'] ?></option> <? }
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Domisili</label>
							<div class="col-md-5">
								<select name="domisili" id="domisili" class="form-control select2" class="autocombo">
									<option value="">-- Select All --</option>
									<?
										$kat=mysql_query("select * from tableProvinsi where idProvinsi in (select provinsi from userWorker group by provinsi)"); 
										while($cet_kat=mysql_fetch_array($kat))
										{ ?> <option value="<? echo $cet_kat['idProvinsi'] ?>"><? echo $cet_kat['namaProvinsi'] ?></option> <? }
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Sumber Data</label>
							<div class="col-md-5">
								<select name="sumberEksternal" id="sumberEksternal" class="form-control select2" class="autocombo">
									<option value="">-- Select All --</option>
									<?
										$kat=mysql_query("select * from referensiEksternal where idRefeksternal in (select sumberEksternal from userWorker group by sumberEksternal)"); 
										while($cet_kat=mysql_fetch_array($kat))
										{ ?> <option value="<? echo $cet_kat['idRefeksternal'] ?>"><? echo $cet_kat['namaRefeksternal'] ?></option> <? }
									?>
								</select>
							</div>
						</div>
						<!--<div class="form-group">
							<label class="control-label col-sm-2">Expected Salary</label>
							<div class="col-md-5">
								<select name="expSalary" id="expSalary" class="form-control select2" class="autocombo">
									<option value="">-- Select All --</option>
									<?
										/*$kat=mysql_query("select * from userWorker"); 
										while($cet_kat=mysql_fetch_array($kat))
										{ ?> <option value="<? echo $cet_kat['expSalary'] ?>"><? echo $cet_kat['expSalary'] ?></option> <? }*/
									?>
								</select>
							</div>
						</div>-->
						<div class="form-group">
							<div class="col-md-offset-2 col-md-2">
								<?
									if(isset($_GET['i']))
									{?><input type="hidden" name="id" value="<?=$id?>"> <?}
									else
									{?><input class="btn btn-success" type="submit" name="save" value="Search"><?} 
								?>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->