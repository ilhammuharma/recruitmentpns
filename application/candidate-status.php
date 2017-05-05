<script type="text/javascript"> //Bagian ini yang digunakan untuk refer
	var htmlobjek;
	$(document).ready(function()
	{
		//apabila terjadi event onchange terhadap object <select id=kategori>
		$(statusRekrut).change(function()
		{
			var statusRekrut = $("#statusRekrut").val();
			$.ajax
			({
				url: "application/candidate-statusfptk.php",
				data: "statusRekrut="+statusRekrut,
				cache: false,
				success: function(msg)
				{
					//jika data sukses diambil dari server kita tampilkan
					//di <select id=sub_kategori>
					$("#show").html(msg);
				}
			});
		});
	});
</script>

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
				<div class="panel-body">
				<? 
					if(isset($_GET['id']))
					{
						$idWorker = $_GET['id'];
						$status = "SELECT * FROM userWorker WHERE idWorker = $idWorker";
						$execstatus = mysql_query($status);
						$editstatus = mysql_fetch_array($execstatus);
					?>
					<form role="form" class="form-horizontal" id="statusdatasource" action="<?=$base_url?>index.php?r=candidate-proses" method="post">
						<input type="hidden" value="<?php echo $editstatus['idWorker'];?>" name="idWorker">
						<div class="form-group">
							<label for="statusRekrut <?php echo $editstatus['idWorker'];?>" class="control-label col-sm-2">Status</label>
							<div class="col-md-5">
								<select name="statusRekrut" id="statusRekrut" class="form-control select2" class="autocombo">
									<option value="">-- Select One --</option>
									<?
										$queryStatusRekrut = "SELECT * FROM tableStatusRekrut";
										$execStatusRekrut = mysql_query($queryStatusRekrut);
										while($statusRekrut = mysql_fetch_array($execStatusRekrut))
										{ 
											?> <option value="<?php echo $statusRekrut['idTable'];?>"><?php echo $statusRekrut['namaStatus'];?></option> <?
										}
										/*$kat=mysql_query("select * from fptk where nomorFptk in (select nomorFptk from userWorker group by nomorFptk ASC)"); 
										while($cet_kat=mysql_fetch_array($kat))
										{ ?> <option value="<? echo $cet_kat['nomorFptk'] ?>"><? echo $cet_kat['nomorFptk'] ?></option> <? }*/
									?>
								</select>
							</div>
						</div>
						<div class="form-group" id="show"></div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-2">
								<input type="hidden" name="idWorker" value="<?=$editstatus['idWorker'];?>">
								<input class="btn btn-primary" type="submit" name="update" value="Update">
							</div>
						</div>
					</form>
					<?
					}
					else
					{}
				?>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->