<?php
include("../assets/dbconfig.php");
$id = $_GET['id'];
$getLowongan = "SELECT pl.idLowongan, uh.namaPerusahaan, pl.namaPosisi, pl.kodePosisi, kk.namaKategori, tp.namaPendidikan, pl.umurMaksimal, tprov.namaProvinsi, pl.gajiDitawarkan, pl.tanggalPosting, pl.batasAkhir, pl.kualifikasiLain, pl.idHrd FROM postingLowongan pl ";
$getLowongan .= "JOIN userHrd uh ON pl.idHrd = uh.idHrd ";
$getLowongan .= "JOIN kategoriKerja kk ON pl.kategoriPosisi = kk.idKategori ";
$getLowongan .= "JOIN tingkatPendidikan tp ON pl.pendidikanMinimal = tp.gradePendidikan ";
$getLowongan .= "JOIN tableProvinsi tprov ON pl.lokasiPenempatan = tprov.idProvinsi ";
$getLowongan .="WHERE idLowongan = $id";

$execGetLowongan = mysql_query($getLowongan);
$resultGetLowongan = mysql_fetch_array($execGetLowongan);
echo $resultGetLowongan['namaPosisi']." ";
echo $resultGetLowongan['kodePosisi']." ";
echo $resultGetLowongan['namaPerusahaan']." ";
echo $resultGetLowongan['namaKategori']." ";
$start = new DateTime($resultGetLowongan['tanggalPosting']);
$posting = $start->format('d M Y');
echo "Tanggal posting: ".$posting." ";
$ending = new DateTime($resultGetLowongan['batasAkhir']);
$hingga = $ending->format('d M Y');
echo "Batas akhir: ".$hingga." ";
echo "Minimal Pendidikan: ".$resultGetLowongan['namaPendidikan']." ";
echo "Usia Maksimal: ".$resultGetLowongan['umurMaksimal']." ";
echo "Penempatan Kerja: ".$resultGetLowongan['namaProvinsi']." ";
echo "Gaji yang ditawarkan: ".$resultGetLowongan['gajiDitawarkan']." ";
echo html_entity_decode($resultGetLowongan['kualifikasiLain'])." ";
?>