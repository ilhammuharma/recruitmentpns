<?
	session_start();
	include('../module/config.php');
	if($_GET['statusRekrut']=='2')
	{
		?>
			<label class="control-label col-sm-2">No.FPTK</label>
			<div class="col-md-5" id="show">	
				<select name="ubahFptk" id="ubahFptk" class="form-control select2" class="autocombo">
					<option value="">-- Select One --</option>
					<?php 
						$queryUbahFptk = "SELECT fptk.nomorFptk, kategoriKerja.namaKategori FROM fptk INNER JOIN kategoriKerja ON kategoriKerja.idKategori=fptk.jabatanPosisi where pic='".$_SESSION['id']."' ";
						$execUbahFptk = mysql_query($queryUbahFptk);
						while($statusFptk = mysql_fetch_array($execUbahFptk))
						{ ?><option value="<?php echo $statusFptk['nomorFptk'];?>"><?php echo $statusFptk['nomorFptk']." - ".$statusFptk['namaKategori'];?></option><?php }
					?>
				<select>
			</div>
		<?
	}
?>