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
			<li class="active">Report FPTK</li>
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
					Report FPTK
				</header>
				<div class="panel-body">
					<form role="form" class="form-horizontal" id="reportfptk" action="<?=$base_url?>index.php?r=report-fptk" method="post">
						<div class="form-group">
							<label class="control-label col-sm-2">No. FPTK</label>
							<div class="col-md-5">
								<select name="nomorFptk" id="nomorFptk" class="form-control select2" class="autocombo">
									<option value="">-- Select All --</option>
									<?
										$queryno = "SELECT * FROM fptk ORDER BY nomorFptk ASC";
										$execno = mysql_query($queryno);
										while($nofptk = mysql_fetch_array($execno))
										{?><option value="<? echo $nofptk['nomorFptk'];?>"><? echo $nofptk['nomorFptk']." (".$nofptk['namaPemohon'].")";?></option><?}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Date Range</label>
							<div class="col-md-5">
								<div class="input-group input-large custom-date-range" data-date-format="dd/mm/yyyy">
									<input type="text" class="form-control dpd1" id="tanggal1" name="tanggal1">
									<span class="input-group-addon">To</span>
									<input type="text" class="form-control dpd2" id="tanggal2" name="tanggal2">
								</div>
								<span class="help-block">Select date range</span>
							</div>
						</div>
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