<?
	$penilaian = mysql_query("select * from penilaian");
	$integrity = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='1'"));
	$sinergy = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='2'"));
	$unique = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='3'"));
	$grow = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='4'"));
	$actowner = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='5'"));
	$result = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='6'"));
	
	$leadership = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='7'"));
	$planning = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='8'"));
	$analytical = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='9'"));
	$technical = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='10'"));
	$pemahaman = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='11'"));
	$kesiapan = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='12'"));
	$komunikasi = mysql_fetch_array(mysql_query("select * from penilaian where id_penilaian='13'"));
?>
<div class="popdown-content">
	<header>
		<h2><b>Interview HR Result</b></h2>
	</header>
	<? //while($cet_nilai=mysql_fetch_array($penilaian)){?>
	<section class="body">
		<form role="form" id="forminterviewhr" action="<?=$base_url?>status-proses.php" method="post">	
			<input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">
			<?//if($cet_nilai['id_penilaian']=='1'){?>
			<div class="col-sm-12"><h4><b><?=$integrity['kategori'];?></b></h4>
			<div class="form-group">
				<div class="col-sm-3"><label for="integrity" class="control-label" required="required" class="form-control"><b><?=$integrity['aspek'];?></b></label></div>
				<div class="col-sm-5"><h5><?=$integrity['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="integrity" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="integrity" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="integrity" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="integrity" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="integrity" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="integrity" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div>
			</div>
			<?//}
			
			//else if($cet_nilai['id_penilaian']=='2'){?>
			<div class="col-sm-12"class="form-group">
				<div class="col-sm-3"><label for="sinergy" class="control-label" required="required" class="form-control"><b><?=$sinergy['aspek'];?></b></label></div>
				<div class="col-sm-5"><h5><?=$sinergy['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="sinergy" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="sinergy" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="sinergy" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="sinergy" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="sinergy" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="integrity" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div>
			<?//}
			
			//else if($cet_nilai['id_penilaian']=='3'){?>
			<div class="col-sm-12" class="form-group">
				<div class="col-sm-3"><label for="unique" class="control-label" required="required" class="form-control"><b><?=$unique['aspek'];?></b></label></div>
				<div class="col-sm-5"><h5><?=$unique['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="unique" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="unique" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="unique" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="unique" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="unique" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="unique" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div>
			<?//}
			
			//else if($cet_nilai['id_penilaian']=='4'){?>
			<div class="col-sm-12" class="form-group">
				<div class="col-sm-3"><label for="grow" class="control-label" required="required" class="form-control"><b><?=$grow['aspek'];?></b></label></div>
				<div class="col-sm-5"><h5><?=$grow['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="grow" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="grow" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="grow" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="grow" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="grow" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="unique" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div>
			<?//}
			
			//else if($cet_nilai['id_penilaian']=='5'){?>
			<div class="col-sm-12" class="form-group">
				<div class="col-sm-3"><label for="actowner" class="control-label" required="required" class="form-control"><b><?=$actowner['aspek'];?></b></label></div>
				<div class="col-sm-5"><h5><?=$actowner['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="actowner" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="actowner" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="actowner" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="actowner" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="actowner" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="actowner" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div>
			<?//}
		
			//else if($cet_nilai['id_penilaian']=='6'){?>
			<div class="col-sm-12" class="form-group">
				<div class="col-sm-3"><label for="result" class="control-label" required="required" class="form-control"><b><?=$result['aspek'];?></b></label></div>
				<div class="col-sm-5"><h5><?=$result['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="result" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="result" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="result" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="result" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="result" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="result" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div>
			<?//}
			
			//else if($cet_nilai['id_penilaian']=='6'){?>
			<div class="col-sm-12"><h4><b><?=$leadership['kategori']?></b></h4>
			<div class="form-group">
				<div class="col-sm-3"><label for="leadership" class="control-label" required="required" class="form-control"><b><?=$leadership['aspek']?></b></label></div>
				<div class="col-sm-5"><h5><?=$leadership['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="leadership" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="leadership" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="leadership" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="leadership" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="leadership" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="leadership" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div></div>
			<?//}
			
			?><div class="col-sm-12" class="form-group">
				<div class="col-sm-3"><label for="planning" class="control-label" required="required" class="form-control"><b><?=$planning['aspek']?></b></label></div>
				<div class="col-sm-5"><h5><?=$planning['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="planning" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="planning" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="planning" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="planning" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="planning" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="planning" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div>
			
			<div class="col-sm-12"><h4><b><?=$analytical['kategori']?></b></h4>
			<div class="form-group">
				<div class="col-sm-3"><label for="analytical" class="control-label" required="required" class="form-control"><b><?=$analytical['aspek']?></b></label></div>
				<div class="col-sm-5"><h5><?=$analytical['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="analytical" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="analytical" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="analytical" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="analytical" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="analytical" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="analytical" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div></div>
			
			<div class="col-sm-12" class="form-group">
				<div class="col-sm-3"><label for="technical" class="control-label" required="required" class="form-control"><b><?=$technical['aspek']?></b></label></div>
				<div class="col-sm-5"><h5><?=$technical['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="technical" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="technical" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="technical" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="technical" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="technical" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="technical" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div>
			
			<div class="col-sm-12"><h4><b><?=$pemahaman['kategori']?></b></h4>
			<div class="form-group">
				<div class="col-sm-3"><label for="pemahaman" class="control-label" required="required" class="form-control"><b><?=$pemahaman['aspek']?></b></label></div>
				<div class="col-sm-5"><h5><?=$pemahaman['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="pemahaman" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="pemahaman" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="pemahaman" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="pemahaman" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="pemahaman" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="pemahaman" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div></div>
			
			<div class="col-sm-12" class="form-group">
				<div class="col-sm-3"><label for="kesiapan" class="control-label" required="required" class="form-control"><b><?=$kesiapan['aspek']?></b></label></div>
				<div class="col-sm-5"><h5><?=$kesiapan['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="kesiapan" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="kesiapan" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="kesiapan" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="kesiapan" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="kesiapan" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="kesiapan" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div>
			
			<div class="col-sm-12" class="form-group">
				<div class="col-sm-3"><label for="komunikasi" class="control-label" required="required" class="form-control"><b><?=$komunikasi['aspek']?></b></label></div>
				<div class="col-sm-5"><h5><?=$komunikasi['definisi']?></h5></div>
				<div class="col-sm-4">
				<label class="radio-inline"><input type="radio" name="komunikasi" id="sangatkurang" value="1">SK</b></label>
				<label class="radio-inline"><input type="radio" name="komunikasi" id="kurang" value="2">K</b></label>
				<label class="radio-inline"><input type="radio" name="komunikasi" id="cukup" value="3">C</b></label>
				<label class="radio-inline"><input type="radio" name="komunikasi" id="tinggi" value="4">T</b></label>
				<label class="radio-inline"><input type="radio" name="komunikasi" id="sangattinggi" value="5">ST</b></label>
				<!--<input type="text" name="komunikasi" class="form-control" placeholder="Integrity" required>-->
				</div>
			</div>
			
			<div class="col-sm-12" class="form-group">
				<h4><b>Rekomendasi User</b></h4>
				<!--<label for="rekomendasi" class="control-label"><b>Rekomendasi User</b></label>-->
				<select id="rekomendasi" name="rekomendasi" required="required" class="form-control"/>
					<option value="" >-- Select One --</option>
					<option value="1" <?//if($data['integrity'] == "SK"){ echo "selected";}?>>Tidak disarankan</option>
					<option value="2" <?//if($data['integrity'] == "K"){ echo "selected";}?>>Masih dapat dipertimbangkan</option>
					<option value="3" <?//if($data['integrity'] == "K"){ echo "selected";}?>>Disarankan</option>
					<option value="4" <?//if($data['integrity'] == "K"){ echo "selected";}?>>Sangat disarankan</option>
				</select>
				<!--<input type="text" name="integrity" class="form-control" placeholder="Integrity" required>-->
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary" id="saveinterviewhr" name="saveinterviewhr">Save</button>
				<!--<button type="button" class="btn btn-default" onclick="javascript:location.href='<?=$base_url?>index.php?r=vacancy-show'">Cancel</button>-->
			</div>
	</section>
		</form>
	<?//}?>
</div>