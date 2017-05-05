<?php
	session_start();
	$idFptk = $_POST['id'];
	//echo $idFptk;
	?>
		<div style="margin:20px 40px">
		<h3>Sertakan Keterangan Anda Reject FPTK No. <?php echo $resultFptk['nomorFptk'];?></h3>
		<form action="approvalProcess.php" id="keteranganReject" role="form" class="form-horizontal" method="post">
			<input type="hidden" value="<?php echo $idFptk;?>" name="idFptk">
			<div class="form-group">
				<label for="keteranganReject<?php echo $alasanReject['idFptk'];?>" class="col-md-3">Isi Keterangan</label>
				<div class="col-md-2">
					<textarea style="width:350px" class="form-control" id="keteranganReject" name="keteranganReject" rows="5" placeholder="Keterangan Reject FPTK" required></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-6">
					<button type="submit" name="alasanReject" class="btn btn-primary btn-sm">Simpan</button>
				</div>
			</div>
		</form>
		</div>