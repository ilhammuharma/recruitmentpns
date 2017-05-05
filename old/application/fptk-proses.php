<?php
	error_reporting(0);
	//$nama=$_SESSION['nama'];
	$tanggal=date('Y-m-d H:i:s');
	$compname=php_uname('n');
	
	$waktuTahun = date('Y');
	$nomor = mysql_query("SELECT * FROM fptk WHERE nomorFptk LIKE '%$waktuTahun' ORDER BY nomorFptk DESC LIMIT 1");
	$cek_nomor = mysql_num_rows($nomor);
	if($cek_nomor=='0')
	{$running_num = "0001";}
	else
	{
		$cetak_nomor = mysql_fetch_array($nomor);
		$get_nomor = $cetak_nomor['nomorFptk'];
		$pisah_num = explode('/',$get_nomor);
		$next_num = $pisah_num['0'] +1;
		$leng_num = strlen($next_num);
		if($leng_num=='1')
		{$running_num = "000".$next_num;}
		else if($leng_num=='2')
		{$running_num = "00".$next_num;}
		else if($leng_num=='3')
		{$running_num = "0".$next_num;}
		else
		{$running_num = $next_num;}
	}
	$waktuBulan = date('m');
	if($waktuBulan=='01')
	{$running_bulan = "I";}
	else if($waktuBulan=='02')
	{$running_bulan = "II";}
	else if($waktuBulan=='03')
	{$running_bulan = "III";}
	else if($waktuBulan=='04')
	{$running_bulan = "IV";}
	else if($waktuBulan=='05')
	{$running_bulan = "V";}
	else if($waktuBulan=='06')
	{$running_bulan = "VI";}
	else if($waktuBulan=='07')
	{$running_bulan = "VII";}
	else if($waktuBulan=='08')
	{$running_bulan = "VIII";}
	else if($waktuBulan=='09')
	{$running_bulan = "IX";}
	else if($waktuBulan=='10')
	{$running_bulan = "X";}
	else if($waktuBulan=='11')
	{$running_bulan = "XI";}
	else if($waktuBulan=='12')
	{$running_bulan = "XII";}
	$fptkNomor = $running_num."/HRD-HO"."/".$running_bulan."/".$waktuTahun;
	
	$posisiTanggal = date("Y-m-d", strtotime($_POST['posisiTanggal']));
	
	if(isset($_POST['save']))
	{
		$query=mysql_query("insert into fptk (
			idFptk,
			idLogin,
			nomorFptk,
			namaPemohon,
			nikPemohon,
			departemenPemohon,
			direktoratPosisi,
			departemenPosisi,
			sectionPosisi,
			jabatanPosisi,
			levelPosisi,
			lokasiPosisi,
			jumlahPosisi,
			tujuanPosisi,
			penggantiPosisi,
			tanggalPosisi,
			jobdesPosisi,
			statusPosisi,
			jumlahlKualifikasi,
			jumlahpKualifikasi,
			usiaKualifikasi,
			pendidikanKualifikasi,
			jurusanKualifikasi,
			pengalamanKualifikasi,
			lainlainKualifikasi,
			akunPemohon,
			tanggalDibuat
			) values (
			'',
			'',
			'$fptkNomor',
			'".$_SESSION['nama']."',
			'',
			'',
			'".$_POST['posisiDirektorat']."',
			'".$_POST['posisiDepartemen']."',
			'".$_POST['posisiSection']."',
			'".$_POST['posisiJabatan']."',
			'".$_POST['posisiLevel']."',
			'".$_POST['posisiLokasi']."',
			'".$_POST['posisiJumlah']."',
			'".$_POST['posisiTujuan']."',
			'".$_POST['posisiPengganti']."',
			'$posisiTanggal',
			'".$_POST['posisiJobdes']."',
			'".$_POST['posisiStatus']."',
			'".$_POST['kualifikasiJumlahl']."',
			'".$_POST['kualifikasiJumlahp']."',
			'".$_POST['kualifikasiUsia']."',
			'".$_POST['kualifikasiPendidikan']."',
			'".$_POST['kualifikasiJurusan']."',
			'".$_POST['kualifikasiPengalaman']."',
			'".$_POST['kualifikasiLainlain']."',
			'".$_SESSION['username']."',
			'".date('Y-m-d')."'
			)");
		if($query)
		{ 
			echo"
			<script>
			alert('Data successfully saved'); 
			window.location.href = '".$url."index.php?r=fptk';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Data could not be saved'); 
			self.history.back();
			</script>
			";	
		}
		/*echo "insert into fptk (
			idFptk,
			idLogin,
			nomorFptk,
			namaPemohon,
			nikPemohon,
			departemenPemohon,
			direktoratPosisi,
			departemenPosisi,
			sectionPosisi,
			jabatanPosisi,
			levelPosisi,
			lokasiPosisi,
			jumlahPosisi,
			tujuanPosisi,
			penggantiPosisi,
			tanggalPosisi,
			jobdesPosisi,
			statusPosisi,
			jumlahlKualifikasi,
			jumlahpKualifikasi,
			usiaKualifikasi,
			pendidikanKualifikasi,
			jurusanKualifikasi,
			pengalamanKualifikasi,
			lainlainKualifikasi,
			akunPemohon,
			tanggalDibuat
			) values (
			'',
			'',
			'$fptkNomor',
			'".$_SESSION['nama']."',
			'',
			'',
			'".$_POST['posisiDirektorat']."',
			'".$_POST['posisiDepartemen']."',
			'".$_POST['posisiSection']."',
			'".$_POST['posisiJabatan']."',
			'".$_POST['posisiLevel']."',
			'".$_POST['posisiLokasi']."',
			'".$_POST['posisiJumlah']."',
			'".$_POST['posisiTujuan']."',
			'".$_POST['posisiPengganti']."',
			'".$_POST['posisiTanggal']."',
			'".$_POST['posisiJobdes']."',
			'".$_POST['posisiStatus']."',
			'".$_POST['kualifikasiJumlahl']."',
			'".$_POST['kualifikasiJumlahp']."',
			'".$_POST['kualifikasiUsia']."',
			'".$_POST['kualifikasiPendidikan']."',
			'".$_POST['kualifikasiJurusan']."',
			'".$_POST['kualifikasiPengalaman']."',
			'".$_POST['kualifikasiLainlain']."',
			'".$_SESSION['username']."',
			'".date('Y-m-d')."'
			)";*/
	}
	else if(isset($_POST['edit']))
	{
		$query=mysql_query("update fptk set 
			direktoratPosisi='".$_POST['posisiDirektorat']."',
			departemenPosisi='".$_POST['posisiDepartemen']."',
			sectionPosisi='".$_POST['posisiSection']."',
			jabatanPosisi='".$_POST['posisiJabatan']."',
			levelPosisi='".$_POST['posisiLevel']."',
			lokasiPosisi='".$_POST['posisiLokasi']."',
			jumlahPosisi='".$_POST['posisiJumlah']."',
			tujuanPosisi='".$_POST['posisiTujuan']."',
			penggantiPosisi='".$_POST['posisiPengganti']."',
			tanggalPosisi='".$_POST['posisiTanggal']."',
			jobdesPosisi='".$_POST['posisiJobdes']."',
			statusPosisi='".$_POST['posisiStatus']."',
			jumlahlKualifikasi='".$_POST['kualifikasiJumlahl']."',
			jumlahpKualifikasi='".$_POST['kualifikasiJumlahp']."',
			usiaKualifikasi='".$_POST['kualifikasiUsia']."',
			pendidikanKualifikasi='".$_POST['kualifikasiPendidikan']."',
			jurusanKualifikasi='".$_POST['kualifikasiJurusan']."',
			pengalamanKualifikasi='".$_POST['kualifikasiPengalaman']."',
			lainlainKualifikasi='".$_POST['kualifikasiLainlains']."'
			where idFptk='".$_POST['id']."'");
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=fptk';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Update failed'); 
			self.history.back();
			</script>
			";	
		}
	}
	else if(isset($_GET['del']))
	{
		$query=mysql_query("DELETE from fptk WHERE idFptk = '".$_GET['del']."';");
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been deleted'); 
			window.location.href = '".$url."index.php?r=fptk';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Delete failed'); 
			self.history.back();
			</script>
			";	
		}
	}
	else if(isset($_POST['approval']))
	{
		$idFptk = $_POST['idFptk'];
		$approve = $_POST['a'];
		$username = $_SESSION['nama'];
		$tanggal = date('Y-m-d');
		$approve = $_POST['a'];
		$mppPosisi = $_POST['mppPosisi'];
		$closingDate = date("Y-m-d", strtotime($_POST['closingDate']));
		if($approve==1)
		{
			$updateFptk = "UPDATE fptk SET namaManager='$username', tanggalManager='$tanggal' WHERE idFptk='$idFptk'";
		}
		else if($approve==2)
		{
			$updateFptk = "UPDATE fptk SET namaHrdSuperintendent='$username', tanggalHrdSuperintendent='$tanggal' WHERE idFptk='$idFptk'";
		}
		else if($approve==3)
		{
			$updateFptk = "UPDATE fptk SET namaGeneralManager='$username', tanggalGeneralManager='$tanggal' WHERE idFptk='$idFptk'";
		}
		else if($approve==4)
		{
			$mpp = mysql_fetch_array(mysql_query("SELECT mppPosisi from fptk WHERE idFptk='$idFptk'"));
			if($mpp['mppPosisi']=='Sesuai')
			{
				$updateFptk = "UPDATE fptk SET namaOdManager='$username', tanggalOdManager='$tanggal', mppPosisi='$mppPosisi', namaDirektur='Auto Approved', tanggalDirektur='$tanggal' WHERE idFptk='$idFptk'";
				//$updateFptk = "UPDATE fptk SET namaOdManager='$username', tanggalOdManager='$tanggal', mppPosisi='$mppPosisi' WHERE idFptk='$idFptk'";
			}
			else
			{
				$updateFptk = "UPDATE fptk SET namaOdManager='$username', tanggalOdManager='$tanggal', mppPosisi='$mppPosisi' WHERE idFptk='$idFptk'";
				//$updateFptk = "UPDATE fptk SET namaOdManager='$username', tanggalOdManager='$tanggal', mppPosisi='$mppPosisi', namaDirektur='Auto Approved', tanggalDirektur='$tanggal' WHERE idFptk='$idFptk'";
			}
		}
		else if($approve==5)
		{
			$updateFptk = "UPDATE fptk SET namaHrdManager='$username', tanggalHrdManager='$tanggal' WHERE idFptk='$idFptk'";
		}
		else if($approve==6)
		{
			$updateFptk = "UPDATE fptk SET namaDirektur='$username', tanggalDirektur='$tanggal' WHERE idFptk='$idFptk'";
		}		
		else if($approve==7)
		{
			$updateFptk = "UPDATE fptk SET namaRecruitmentSuperintendent='$username', tanggalRecruitmentSuperintendent='$tanggal' WHERE idFptk='$idFptk'";
		}
		else
		{
			$updateFptk = "UPDATE fptk SET closingBy='$username', closingDate='$closingDate' WHERE idFptk='$idFptk'";
		}
		$query = mysql_query($updateFptk);
		//echo $updateFptk;
		if($query)
		{ 
			echo"
			<script>
			alert('Data successfully approved'); 
			window.location.href = '".$url."index.php?r=fptk';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Data could not be approved'); 
			self.history.back();
			</script>
			";	
		}
	}
	else if(isset($_POST['mpp']))
	{
		$idFptk = $_POST['idFptk'];
		$approve = $_POST['a'];
		$username = $_SESSION['nama'];
		$tanggal = date('Y-m-d');
		$mppPosisi = $_POST['mppPosisi'];
		$updateFptk = "UPDATE fptk SET namaHrdSuperintendent='$username', mppPosisi='$mppPosisi', tanggalHrdSuperintendent='$tanggal' WHERE idFptk='$idFptk'";
		$query = mysql_query($updateFptk);
		if($query)
		{ 
			echo"
			<script>
			alert('Data successfully approved'); 
			window.location.href = '".$url."index.php?r=fptk';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Data could not be approved'); 
			self.history.back();
			</script>
			";	
		}
	}
	else if(isset($_GET['kode']))
	{
		$query=mysql_query("DELETE from fptk WHERE idFptk = '".$_GET['kode']."';");
		if($query)
		{ 
			echo"
			<script>
			alert('Data Berhasil Dihapus'); 
			window.location.href = '".$url."index.php?r=fptk';
			</script>
			";
		}
		else
		{
			echo"
			<script>
			alert('Data Gagal Dihapus'); 
			self.history.back();
			</script>
			";	
		}
	}
?>