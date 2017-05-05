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
			<li class="active">Summary Fullfilment</li>
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
					Summary Fullfilment
				</header>
				<div class="panel-body">
					<form role="form" class="form-horizontal" id="summaryFullfilment" action="<?=$base_url?>index.php?r=report-fullfilment" method="post">
						<div class="form-group">
							<label class="control-label col-sm-2">PIC</label>
							<div class="col-md-5">
								<select name="pic" id="pic" class="form-control" class="autocombo">
									<option value="">-- Select All --</option>
									<?
										$queryrecruiter = "SELECT idLogin, nama FROM loginUser where idlogin=61 or idLogin=62 or idLogin=63 order by nama asc";
										$execrecruiter = mysql_query($queryrecruiter);
										while($cet_list = mysql_fetch_array($execrecruiter))
										{?><option value="<? echo $cet_list['idLogin'];?>"><? echo $cet_list['nama'];?></option><?}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Periode</label>
							<div class="col-md-5">
								<select name="year" id="year" class="form-control select2" class="autocombo">
									<option value="">-- Select Year --</option>
									<?
										$sql=mysql_query("select extract(year from tanggalDibuat) as tahun from fptk group by extract(year from tanggalDibuat)");
										while($cet_tahun=mysql_fetch_array($sql)){
											echo"<option value=".$cet_tahun['tahun'].">".$cet_tahun['tahun']."</option>";
											}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-2">
								<?
									if(isset($_GET['i']))
									{?><input type="hidden" name="id" value="<?=$id?>"> <?}
									else
									{?><input class="btn btn-success" type="submit" name="search" value="Search"><?} 
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