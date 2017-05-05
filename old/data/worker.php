<?php
include("../assets/dbconfig.php");
$id = $_GET['id'];
$getWorker = "SELECT * FROM userWorker WHERE idWorker = $id";
$execGetWorker = mysql_query($getWorker);
$resultGetWorker = mysql_fetch_array($execGetWorker);
echo $resultGetWorker['namaUser']." ";
echo $resultGetWorker['alamat']." ";
$birth = new DateTime($resultGetWorker['birthday']);
$now = new DateTime();
$age = $now->diff($birth);
echo $age->y." tahun ".$age->m." bulan"." ";
if($resultGetWorker['gender'] == "L"){
	echo "Pria ";
}else{
	echo "Wanita ";
}
echo $resultGetWorker['noPonsel']." ";
echo $resultGetWorker['otherPonsel']." ";
echo $resultGetWorker['emailUser']." ";

$getPendidikan = "SELECT pw.namaInstansi, tp.namaProvinsi, tpend.namaPendidikan, tj.namaJurusan, pw.nilai, pw.tahunLulus FROM pendidikanWorker pw ";
$getPendidikan .= "JOIN tableProvinsi tp ON pw.lokasiInstansi = tp.idProvinsi ";
$getPendidikan .= "JOIN tingkatPendidikan tpend ON pw.kualifikasiPendidikan = tpend.gradePendidikan ";
$getPendidikan .= "JOIN tableJurusan tj ON pw.jurusanPendidikan = tj.idJurusan ";
$getPendidikan .= "WHERE idWorker = $id ORDER BY tahunLulus DESC";

$execGetPendidikan = mysql_query($getPendidikan);
while($resultPendidikan = mysql_fetch_array($execGetPendidikan)){
	echo $resultPendidikan['tahunLulus']." ";
	echo $resultPendidikan['namaInstansi']." ";
	echo $resultPendidikan['namaJurusan']." ";
	echo "IPK/Nilai ".$resultPendidikan['nilai']." ";
	echo $resultPendidikan['namaProvinsi']." ";
}

$getPengalaman = "SELECT pw.posisi, pw.namaPerusahaan, bu.namaBidangUsaha, tp.namaProvinsi, pw.awalKerja, pw.akhirKerja, pw.deskripsi FROM pengalamanWorker pw ";
$getPengalaman .= "JOIN bidangUsaha bu ON bu.idUsaha = pw.bidangUsaha ";
$getPengalaman .= "JOIN tableProvinsi tp ON tp.idProvinsi = pw.lokasi ";
$getPengalaman .= "WHERE idWorker = $id ORDER BY awalKerja DESC";

$execGetPengalaman = mysql_query($getPengalaman);

while($resultPengalaman = mysql_fetch_array($execGetPengalaman)){
	$start = new DateTime($resultPengalaman['awalKerja']);
	if($resultPengalaman['akhirKerja'] == "0000-00-00"){
		$akhir = new DateTime();
		$end = " sekarang ";
		$long = $start->diff($akhir);
	}else{
		$akhir = new DateTime($resultPengalaman['akhirKerja']);
		$end = $akhir->format('d M Y');
		$long = $start->diff($akhir);
	}
	echo "Bekerja selama ".$long->y." tahun ".$long->m." bulan ";
	echo $resultPengalaman['posisi']." ";
	echo $resultPengalaman['namaBidangUsaha']." ";
	echo $resultPengalaman['namaPerusahaan']." ";
	echo $resultPengalaman['namaProvinsi']." ";
	echo $resultPengalaman['deskripsi']." ";
}

$getBahasa = "SELECT tb.namaBahasa, tkp.tingkatKeahlian as tkpas, tka.tingkatKeahlian tkak FROM skillBahasaWorker sbw ";
$getBahasa .= "JOIN tableBahasa tb ON sbw.idBahasa = tb.idBahasa ";
$getBahasa .= "JOIN tingkatKeahlian tkp ON sbw.tingkatKemampuanPasif = tkp.gradeKeahlian ";
$getBahasa .= "JOIN tingkatKeahlian tka ON sbw.tingkatKemampuanAktif = tka.gradeKeahlian ";
$getBahasa .= "WHERE idWorker = $id";
$execGetBahasa = mysql_query($getBahasa);

while($resultBahasa = mysql_fetch_array($execGetBahasa)){
	echo $resultBahasa['namaBahasa']." pasif ".$resultBahasa['tkpas']." aktif ".$resultBahasa['tkak']." ";
}

$getSkill = "SELECT sw.namaSkill, tk.tingkatKeahlian FROM skillWorker sw ";
$getSkill .= "JOIN tingkatKeahlian tk ON sw.tingkatSkill = tk.gradeKeahlian ";
$getSkill .= "WHERE idWorker = $id";
$execGetSkill = mysql_query($getSkill);

while($resultSkill = mysql_fetch_array($execGetSkill)){
	echo $resultSkill['namaSkill']."(".$resultSkill['tingkatKeahlian'].") ";
}

echo "Gaji yang diharapkan ".$resultGetWorker['minimalGaji']." ";
$queryLokasi = "SELECT tp1.namaProvinsi as lokasi1, tp2.namaProvinsi as lokasi2, tp3.namaProvinsi as lokasi3, kk.namaKategori FROM userWorker pw ";
$queryLokasi .= "JOIN tableProvinsi tp1 ON tp1.idProvinsi = pw.lokasiKerja1 ";
$queryLokasi .= "JOIN tableProvinsi tp2 ON tp2.idProvinsi = pw.lokasiKerja2 ";
$queryLokasi .= "JOIN tableProvinsi tp3 ON tp3.idProvinsi = pw.lokasiKerja3 ";
$queryLokasi .= "JOIN kategoriKerja kk ON pw.cariKerja = kk.idKategori ";
$queryLokasi .= "WHERE idWorker = $id";
$execLokasi = mysql_query($queryLokasi);
$resultLokasi = mysql_fetch_array($execLokasi);
echo "Prioritas 1: ".$resultLokasi['lokasi1']." ";
echo "Prioritas 2: ".$resultLokasi['lokasi2']." ";
echo "Prioritas 3: ".$resultLokasi['lokasi3']." ";

echo "Cari pekerjaan di bidang: ". $resultLokasi['namaKategori']." ";

if($resultGetWorker['bersedia'] == 1){
	echo "Bersedia ditempatkan di seluruh wilayah Indonesia ";
}

?>