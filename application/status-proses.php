<?
	error_reporting(0);
	$nama=$_SESSION['nama'];
	$tanggal=date('Y-m-d H:i:s');
	$compname=php_uname('n');
	
	if(isset($_POST['verifikasisourcing']))
	{
		foreach($_POST['sourcing'] as $sourcing)
		{
			$query = mysql_query("update vacancyapply set status='2', tglsortlist='".date('Y-m-d')."' where idvacancy='".$_POST['idvacancy']."' and idWorker='$sourcing' ");
			//echo "update vacancyapply set status='2' where idWorker='$sourcing' <br>";
		}
		
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	else if(isset($_POST['verifikasisortlist']))
	{
		foreach($_POST['sortlist'] as $sortlist)
		{
			$query = mysql_query("update vacancyapply set status='3', tglhr='".date('Y-m-d')."' where idvacancy='".$_POST['idvacancy']."' and idWorker='$sortlist' ");
			//echo "update vacancyapply set status='3' where idWorker='$sortlist' <br>";
		}
		
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	else if(isset($_POST['verifikasihr']))
	{
		foreach($_POST['interviewhr'] as $hr)
		{
			$query = mysql_query("update vacancyapply set status='4', tglpsiko='".date('Y-m-d')."' where idvacancy='".$_POST['idvacancy']."' and idWorker='$hr' ");
			//echo "update vacancyapply set status='4' where idWorker='$hr' <br>";
		}
		
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	else if(isset($_POST['verifikasipsikotest']))
	{
		foreach($_POST['psikotest'] as $psikotest)
		{
			$query = mysql_query("update vacancyapply set status='5', tgluser='".date('Y-m-d')."' where idvacancy='".$_POST['idvacancy']."' and idWorker='$psikotest' ");
			//echo "update vacancyapply set status='5' where idWorker='$psikotest' <br>";
		}
		
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	else if(isset($_POST['verifikasiuser']))
	{
		foreach($_POST['interviewuser'] as $user)
		{
			$query = mysql_query("update vacancyapply set status='6', tglnego='".date('Y-m-d')."' where idvacancy='".$_POST['idvacancy']."' and idWorker='$user' ");
			//echo "update vacancyapply set status='6' where idWorker='$user' <br>";
		}
		
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	else if(isset($_POST['verifikasinego']))
	{
		foreach($_POST['nego'] as $nego)
		{
			$query = mysql_query("update vacancyapply set status='7', tglmcu='".date('Y-m-d')."' where idvacancy='".$_POST['idvacancy']."' and idWorker='$nego' ");
			//echo "update vacancyapply set status='7' where idWorker='$nego' <br>";
		}
		
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	else if(isset($_POST['savejoin']))
	{
		$id = $_GET['id'];
		$v = $_GET['v'];
		$joindate = date("Y-m-d", strtotime($_POST['joindate']));
		$query = mysql_query("update vacancyapply set status='8', tgljoin='".date('Y-m-d')."', 
				joinreject='".$_POST['joinreject']."', joindate='".$joindate."', ketjoin='".$_POST['ketjoin']."' 
				where idVacancy='".$_POST['v']."' and idWorker='".$_POST['id']."' ");
				
		/*echo "update vacancyapply set status='8', tgljoin='".date('Y-m-d')."', 
			joinreject='".$_POST['joinreject']."', joindate='".$joindate."', ketjoin='".$_POST['ketjoin']."' 
			where idVacancy='".$_POST['v']."' and idWorker='".$_POST['id']."' ";*/	
		
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	/*else if(isset($_POST['verifikasimcu']))
	{
		foreach($_POST['mcu'] as $mcu)
		{
			$query = mysql_query("update vacancyapply set status='8', tglmcu='".date('Y-m-d')."' where idvacancy='".$_POST['idvacancy']."' and idWorker='$mcu' ");
			//echo "update vacancyapply set status='8' where idWorker='$mcu' <br>";
		}
		
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	else if(isset($_POST['verifikasijoin']))
	{
		foreach($_POST['join'] as $join)
		{
			$query = mysql_query("update vacancyapply set status='9', tgljoin='".date('Y-m-d')."' where idvacancy='".$_POST['idvacancy']."' and idWorker='$join' ");
			//echo "update vacancyapply set status='9' where idWorker='$join' <br>";
		}
		
		if($query2)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	}*/
	
	else if(isset($_POST['savesort']))
	{
		$query = mysql_query("update vacancyapply set ketsort='".$_POST['ketsort']."' where idvacancy='".$_POST['idvacancy']."' and idWorker='".$_POST['idWorker']."' ");
		if($query)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	else if(isset($_POST['savehr']))
	{
		$id = $_GET['id'];
		$testdate = date("Y-m-d", strtotime($_POST['testdate']));
		$penilaian = mysql_query("select * from penilaian where tipe_penilaian='".$_POST['type']."' and status='1'");
		while($soal=mysql_fetch_array($penilaian))
		{ 
			$query1 = mysql_query("insert into penilaian_detail (
			id_penilaian,
			idWorker,
			nilai,
			keterangan
			) values (
			'".$soal['id_penilaian']."',
			'".$_POST['idWorker']."',
			'".$_POST['nilai'.$soal['id_penilaian']]."',
			'".$_POST['keterangan'.$soal['id_penilaian']]."'
			)");
			$nilai[$soal['id_penilaian']]=$_POST['nilai'.$soal['id_penilaian']];
			//echo $nilai[$soal['id_penilaian']];
		}	
		$jumlahsoal = count($nilai);
		$jumlahnilai = array_sum($nilai);
		unset($nilai);
		//echo $jumlahsoal;
		//echo $jumlahnilai;
		
		$query2 = mysql_query("insert into penilaian_summary (
			tipe_penilaian,
			createby,
			createdate,
			testdate,
			idWorker,
			jumlah_penilaian,
			nilai,
			rekomendasi,
			kelebihan,
			kekurangan,
			kesimpulan,
			gajipokok,
			tunjangan,
			tunjanganlain,
			premi,
			total,
			makan,
			lembur,
			bonus,
			transport,
			kesehatan,
			cuti,
			dll,
			expectation
			) values (
			'".$_POST['type']."',
			'".$_SESSION['id']."',
			'".date('Y-m-d')."',
			'$testdate',
			'".$_POST['idWorker']."',
			'$jumlahsoal',
			'$jumlahnilai',
			'',
			'".$_POST['kelebihan']."',
			'".$_POST['kekurangan']."',
			'".$_POST['kesimpulan']."',
			'".$_POST['gajipokok']."',
			'".$_POST['tunjangan']."',
			'".$_POST['tunjanganlain']."',
			'".$_POST['premi']."',
			'".$_POST['total']."',
			'".$_POST['makan']."',
			'".$_POST['lembur']."',
			'".$_POST['bonus']."',
			'".$_POST['transport']."',
			'".$_POST['kesehatan']."',
			'".$_POST['cuti']."',
			'".$_POST['dll']."',
			'".$_POST['expectation']."'
			)");
		/*echo "insert into penilaian_summary (
			tipe_penilaian,
			createby,
			createdate,
			testdate,
			idWorker,
			jumlah_penilaian,
			nilai,
			rekomendasi,
			kelebihan,
			kekurangan,
			kesimpulan,
			gajipokok,
			tunjangan,
			tunjanganlain,
			premi,
			total,
			makan,
			lembur,
			bonus,
			transport,
			kesehatan,
			cuti,
			dll,
			expectation
			) values (
			'".$_POST['type']."',
			'".$_SESSION['id']."',
			'".date('Y-m-d')."',
			'$testdate',
			'".$_POST['idWorker']."',
			'$jumlahsoal',
			'$jumlahnilai',
			'',
			'".$_POST['kelebihan']."',
			'".$_POST['kekurangan']."',
			'".$_POST['kesimpulan']."',
			'".$_POST['gajipokok']."',
			'".$_POST['tunjangan']."',
			'".$_POST['tunjanganlain']."',
			'".$_POST['premi']."',
			'".$_POST['total']."',
			'".$_POST['makan']."',
			'".$_POST['lembur']."',
			'".$_POST['bonus']."',
			'".$_POST['transport']."',
			'".$_POST['kesehatan']."',
			'".$_POST['cuti']."',
			'".$_POST['dll']."',
			'".$_POST['expectation']."'
			)";*/
			
		//echo $soal['id_penilaian']." ".$_POST['nilai'.$soal['id_penilaian']]." ".$_POST['keterangan'.$soal['id_penilaian']]." <br>";
		
		if($query2)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	else if(isset($_POST['savepsi']))
	{
		$testdate = date("Y-m-d", strtotime($_POST['testdate']));
		$penilaian = mysql_query("select * from penilaian where tipe_penilaian='".$_POST['type']."' and status='1'");
		while($soal=mysql_fetch_array($penilaian))
		{ 
			$query1 = mysql_query("insert into penilaian_detail (
			id_penilaian,
			idWorker,
			nilai,
			keterangan
			) values (
			'".$soal['id_penilaian']."',
			'".$_POST['idWorker']."',
			'".$_POST['nilai'.$soal['id_penilaian']]."',
			'".$_POST['keterangan'.$soal['id_penilaian']]."'
			)");
			$nilai[$soal['id_penilaian']]=$_POST['nilai'.$soal['id_penilaian']];
			//echo $nilai[$soal['id_penilaian']];
		}	
		$jumlahsoal = count($nilai);
		$jumlahnilai = array_sum($nilai);
		unset($nilai);
		//echo $jumlahsoal;
		//echo $jumlahnilai;
		$query2 = mysql_query("insert into penilaian_summary (
			tipe_penilaian,
			createby,
			createdate,
			testdate,
			idWorker,
			jumlah_penilaian,
			nilai,
			rekomendasi,
			kelebihan,
			kekurangan,
			kesimpulan
			) values (
			'".$_POST['type']."',
			'".$_SESSION['id']."',
			'".date('Y-m-d')."',
			'$testdate',
			'".$_POST['idWorker']."',
			'$jumlahsoal',
			'$jumlahnilai',
			'".$_POST['rekomendasi']."',
			'".$_POST['kelebihan']."',
			'".$_POST['kekurangan']."',
			'".$_POST['kesimpulan']."'
			)");
		/*echo "insert into penilaian_summary (
			tipe_penilaian,
			createby,
			createdate,
			testdate,
			idWorker,
			jumlah_penilaian,
			nilai,
			rekomendasi,
			kelebihan,
			kekurangan,
			kesimpulan
			) values (
			'".$_POST['type']."',
			'".$_SESSION['id']."',
			'".date('Y-m-d')."',
			'$testdate',
			'".$_POST['idWorker']."',
			'$jumlahsoal',
			'$jumlahnilai',
			'".$_POST['rekomendasi']."',
			'".$_POST['kelebihan']."',
			'".$_POST['kekurangan']."',
			'".$_POST['kesimpulan']."'
			)";*/
			
		//echo $soal['id_penilaian']." ".$_POST['nilai'.$soal['id_penilaian']]." ".$_POST['keterangan'.$soal['id_penilaian']]." <br>";
		
		if($query2)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
	
	else if(isset($_POST['saveuser']))
	{
		$id = $_GET['id'];
		$testdate = date("Y-m-d", strtotime($_POST['testdate']));
		$penilaian = mysql_query("select * from penilaian where tipe_penilaian='".$_POST['type']."' and status='1'");
		while($soal=mysql_fetch_array($penilaian))
		{ 
			$query1 = mysql_query("insert into penilaian_detail (
			id_penilaian,
			idWorker,
			nilai,
			keterangan
			) values (
			'".$soal['id_penilaian']."',
			'".$_POST['idWorker']."',
			'".$_POST['nilai'.$soal['id_penilaian']]."',
			'".$_POST['keterangan'.$soal['id_penilaian']]."'
			)");
			$nilai[$soal['id_penilaian']]=$_POST['nilai'.$soal['id_penilaian']];
			//echo $nilai[$soal['id_penilaian']];
		}	
		$jumlahsoal = count($nilai);
		$jumlahnilai = array_sum($nilai);
		unset($nilai);
		//echo $jumlahsoal;
		//echo $jumlahnilai;
		
		/*$gaji = mysql_query("select * from penilaian_summary where tipe_penilaian='".$_POST['type']."' and idWorker='".$id."'");
		while($tot=mysql_fetch_array($gaji))
		{
			$totalgaji1[$tot['gajipokok']]=$_POST['total'.$tot['gajipokok']];
			$totalgaji2[$tot['tunjangan']]=$_POST['total'.$tot['tunjangan']];
			$totalgaji3[$tot['tunjanganlain']]=$_POST['total'.$tot['tunjanganlain']];
			$totalgaji4[$tot['premi']]=$_POST['total'.$tot['premi']];
		}
		$totalgaji = array_sum($totalgaji1,$totalgaji2,$totalgaji3,$totalgaji4);
		echo $totalgaji;*/
		
		$totalgaji = array_sum($_POST['gajipokok'], $_POST['tunjangan'], $_POST['tunjanganlain'], $_POST['premi']);
		//echo $totalgaji;
		$query2 = mysql_query("insert into penilaian_summary (
			tipe_penilaian,
			createby,
			createdate,
			testdate,
			idWorker,
			jumlah_penilaian,
			nilai,
			rekomendasi,
			kelebihan,
			kekurangan,
			kesimpulan,
			gajipokok,
			tunjangan,
			tunjanganlain,
			premi,
			total,
			makan,
			lembur,
			bonus,
			transport,
			kesehatan,
			cuti,
			dll,
			expectation
			) values (
			'".$_POST['type']."',
			'".$_SESSION['id']."',
			'".date('Y-m-d')."',
			'$testdate',
			'".$_POST['idWorker']."',
			'$jumlahsoal',
			'$jumlahnilai',
			'',
			'".$_POST['kelebihan']."',
			'".$_POST['kekurangan']."',
			'".$_POST['kesimpulan']."',
			'".$_POST['gajipokok']."',
			'".$_POST['tunjangan']."',
			'".$_POST['tunjanganlain']."',
			'".$_POST['premi']."',
			'$totalgaji',
			'".$_POST['makan']."',
			'".$_POST['lembur']."',
			'".$_POST['bonus']."',
			'".$_POST['transport']."',
			'".$_POST['kesehatan']."',
			'".$_POST['cuti']."',
			'".$_POST['dll']."',
			'".$_POST['expectation']."'
			)");
		/*echo "insert into penilaian_summary (
			tipe_penilaian,
			createby,
			createdate,
			testdate,
			idWorker,
			jumlah_penilaian,
			nilai,
			rekomendasi,
			kelebihan,
			kekurangan,
			kesimpulan,
			gajipokok,
			tunjangan,
			tunjanganlain,
			premi,
			total,
			makan,
			lembur,
			bonus,
			transport,
			kesehatan,
			cuti,
			dll,
			expectation
			) values (
			'".$_POST['type']."',
			'".$_SESSION['id']."',
			'".date('Y-m-d')."',
			'$testdate',
			'".$_POST['idWorker']."',
			'$jumlahsoal',
			'$jumlahnilai',
			'',
			'".$_POST['kelebihan']."',
			'".$_POST['kekurangan']."',
			'".$_POST['kesimpulan']."',
			'".$_POST['gajipokok']."',
			'".$_POST['tunjangan']."',
			'".$_POST['tunjanganlain']."',
			'".$_POST['premi']."',
			'".$_POST['total']."',
			'".$_POST['makan']."',
			'".$_POST['lembur']."',
			'".$_POST['bonus']."',
			'".$_POST['transport']."',
			'".$_POST['kesehatan']."',
			'".$_POST['cuti']."',
			'".$_POST['dll']."',
			'".$_POST['expectation']."'
			)";*/
			
		//echo $soal['id_penilaian']." ".$_POST['nilai'.$soal['id_penilaian']]." ".$_POST['keterangan'.$soal['id_penilaian']]." <br>";
		
		if($query2)
		{ 
			echo"
			<script>
			alert('Data has been updated'); 
			window.location.href = '".$url."index.php?r=vacancy';
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
?>