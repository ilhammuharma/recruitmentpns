<div class="popdown-content">
	<header>
		<h2>Education</h2>
	</header>
	<section class="body">
		<form role="form" id="formsourcing" action="<?=$base_url?>status-proses.php" method="post">
			<input type="hidden" name="id" value="<?php echo $_SESSION['id'];?>">
			<div class="form-group">
				<label for="namaInstansi" class="control-label">School/University</label>
				<input type="text" name="namaInstansi" class="form-control" placeholder="School/University" required>
			</div>
			<div class="form-group">
				<label for="lokasiInstansi" class="control-label">Location</label>
				<select name="lokasiInstansi" id="lokasiInstansi" class="form-control">
					<option value="" >-- Select One --</option>
					<?php
						$queryEduProv = "SELECT * FROM tableProvinsi";
						$execEduProv = mysql_query($queryEduProv);
						while($listEduProv = mysql_fetch_array($execEduProv))
						{
							?> <option value="<?php echo $listEduProv['idProvinsi'];?>" <?php if($listEduProv['idProvinsi'] == $resultEduProv['lokasiInstansi']){echo "selected";}?>> <?php echo $listEduProv['namaProvinsi'];?> </option> <?php
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="kualifikasiPendidikan" class="control-label">Qualification</label>
				<select class="form-control" name="kualifikasiPendidikan" id="kualifikasiPendidikan">
					<option value="" >-- Select One --</option>
					<?php
						$queryKualifikasi = "SELECT * FROM tingkatPendidikan ORDER BY gradePendidikan ASC";
						$execKualifikasi = mysql_query($queryKualifikasi);
						while($resultKualifikasi = mysql_fetch_array($execKualifikasi))
						{ ?><option value="<?php echo $resultKualifikasi['gradePendidikan'];?>"><?php echo $resultKualifikasi['namaPendidikan'];?></option><?php } 
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="jurusanPendidikan" class="col-sm-2 control-label">Major</label>
				<select name="jurusanPendidikan" id="jurusanPendidikan" class="form-control">
					<option value="" >-- Select One --</option>
					<?php
						$queryJurusan = "SELECT * FROM tableJurusan ORDER BY namaJurusan ASC";
						$execJurusan = mysql_query($queryJurusan);
						while($resultJurusan = mysql_fetch_array($execJurusan))
						{ ?><option value="<?php echo $resultJurusan['idJurusan'];?>"><?php echo $resultJurusan['namaJurusan'];?></option><?php }
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="nilai" class="control-label">GPA/Score</label>
				<input name="nilai" class="form-control" id="nilai" placeholder="GPA/Score (e.g. GPA 3.0 of 4.0 or Score 8.0 of 10)">
				<p class="help-block">Use a dot (.) as the decimal separator.</p>
			</div>
			<div class="form-group">
				<label for="tahunMasuk" class="control-label">Entrance Year</label>
				<input name="tahunMasuk" class="form-control" id="tahunMasuk" placeholder="Entrance year (e.g. 2013)">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary" id="saveEdu" name="saveEdu">Save</button>
				<!--<button type="button" class="btn btn-default" onclick="javascript:location.href='<?=$base_url?>index.php?r=vacancy-show'">Cancel</button>-->
			</div>
	</section>
		</form>
</div>