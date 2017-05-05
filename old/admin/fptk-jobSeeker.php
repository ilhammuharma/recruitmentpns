<?php
	session_start();
	$title = "job-seeker";
	include("../assets/dbconfig.php");
	
	/*if(!isset($_SESSION['username']))
	{
		header("Location: index.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
		{
			header("Location:../worker/");
		}
		else if(isset($_SESSION['hrd']))
		{
			header("Location:../hrd/");
		}
		else if(isset($_SESSION['admin']))
		{
			include("templates/head.php");*/
			//echo $_GET['contoh_get'];
			if($_GET['statusRekrut']=='2')
			{
				?>
				<label class="col-md-2">No. FPTK</label>
				<div class="col-md-8" id="show">	
					<select name="ubahFptk" id="ubahFptk"  class="form-control">
						<?php 
							$queryUbahFptk = "SELECT fptk.nomorFptk, kategoriKerja.namaKategori FROM fptk INNER JOIN kategoriKerja ON kategoriKerja.idKategori=fptk.jabatanPosisi ";
							$execUbahFptk = mysql_query($queryUbahFptk);
							while($statusFptk = mysql_fetch_array($execUbahFptk))
							{
								?><option value="<?php echo $statusFptk['nomorFptk'];?>"><?php echo $statusFptk['nomorFptk']." - ".$statusFptk['namaKategori'];?></option><?php 
							}
						?>
					</select>
				</div>
				<?php
			} 
		/*}
		else
		{
			header("Location:index.php");
		}
	}*/
?>