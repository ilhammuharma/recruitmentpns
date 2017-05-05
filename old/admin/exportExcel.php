<?php
	session_start();
	error_reporting(0);
	$title = "job-seeker";
	include("../assets/dbconfig.php");
	require_once '../PHPExcel/Classes/PHPExcel.php';
	
	$objPHPExcel = new PHPExcel();
	$query = "SELECT * FROM userWorker ORDER BY namaUser ASC";
	$result = mysql_query($query) or die(mysql_error());
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getActiveSheet()->setTitle('Laporan Data Sourcing');
	$rowCount = 2;
	
	while($row = mysql_fetch_array($result))
	{
		$pendidikan = mysql_fetch_array(mysql_query("SELECT pendidikanWorker.namaInstansi, tingkatPendidikan.namaPendidikan, tableJurusan.namaJurusan FROM pendidikanWorker
					INNER JOIN tingkatPendidikan ON pendidikanWorker.kualifikasiPendidikan=tingkatPendidikan.gradePendidikan
					INNER JOIN tableJurusan ON pendidikanWorker.jurusanPendidikan=tableJurusan.idJurusan
					WHERE pendidikanWorker.idWorker='".$row['idWorker']."' ORDER BY tahunLulus DESC limit 1"));
				
		$riwayatKerja = mysql_query("SELECT pengalamanWorker.namaPerusahaan, pengalamanWorker.posisi, pengalamanWorker.awalKerja, pengalamanWorker.akhirKerja 
							FROM pengalamanWorker
							WHERE pengalamanWorker.idWorker='".$row['idWorker']."' ORDER BY awalKerja DESC limit 3");
		$i=1;
		while($pengalamanKerja = mysql_fetch_array($riwayatKerja))
		{
			$namaPerusahaan[$i]=$pengalamanKerja['namaPerusahaan'];
			$posisi[$i]=$pengalamanKerja['posisi'];
			$awalKerja[$i]=$pengalamanKerja['awalKerja'];
			$akhirKerja[$i]=$pengalamanKerja['akhirKerja'];
			$i++;
		}
		
		$currentSalary = mysql_fetch_array(mysql_query("SELECT pengalamanWorker.gaji FROM pengalamanWorker
							WHERE pengalamanWorker.idWorker='".$row['idWorker']."' ORDER BY awalKerja DESC limit 1"));
		
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['namaUser']);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['birthday']);
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['noPonsel']);
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['emailUser']);
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['alamatSekarang']);
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $pendidikan['namaPendidikan']);
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $pendidikan['namaJurusan']);
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $pendidikan['namaInstansi']);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $namaPerusahaan[3]);
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $posisi[3]);
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $awalKerja[3]);
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $akhirKerja[3]);
			
		$objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $namaPerusahaan[2]);
		$objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $posisi[2]);
		$objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $awalKerja[2]);
		$objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, $akhirKerja[2]);
			
		$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, $namaPerusahaan[1]);
		$objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, $posisi[1]);
		$objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, $awalKerja[1]);
		$objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, $akhirKerja[1]);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount, $row['sumberData_eksternal']);
		$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$rowCount, $currentSalary['gaji']);
		$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$rowCount, $row['minimalGaji']);
		$rowCount++;
		//pr($objPHPExcel);
	}

	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Nama');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Tanggal Lahir');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nomor Telepon');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'E-mail');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Domisili');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Pendidikan Terakhir');
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Jurusan');
	$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Nama Instansi');
	$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Nama Perusahaan');
	$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Jabatan');
	$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Awal Kerja');
	$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Akhir Kerja');
	$objPHPExcel->getActiveSheet()->setCellValue('M1', 'Nama Perusahaan');
	$objPHPExcel->getActiveSheet()->setCellValue('N1', 'Jabatan');
	$objPHPExcel->getActiveSheet()->setCellValue('O1', 'Awal Kerja');
	$objPHPExcel->getActiveSheet()->setCellValue('P1', 'Akhir Kerja');
	$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Nama Perusahaan');
	$objPHPExcel->getActiveSheet()->setCellValue('R1', 'Jabatan');
	$objPHPExcel->getActiveSheet()->setCellValue('S1', 'Awal Kerja');
	$objPHPExcel->getActiveSheet()->setCellValue('T1', 'Akhir Kerja');
	$objPHPExcel->getActiveSheet()->setCellValue('U1', 'Total Masa Kerja');
	$objPHPExcel->getActiveSheet()->setCellValue('V1', 'Sumber Data');
	$objPHPExcel->getActiveSheet()->setCellValue('W1', 'Interview');
	$objPHPExcel->getActiveSheet()->setCellValue('X1', 'Keterangan');
	$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'Current Salary');
	$objPHPExcel->getActiveSheet()->setCellValue('Z1', 'Expected Salary');
	$objPHPExcel->getActiveSheet()->setCellValue('AA1', 'Status');
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Data Sourcing.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
?>