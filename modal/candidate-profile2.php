<?
	include('../module/config.php');
?>
<link rel="stylesheet" href="../assets/print-invoice.css" media="print">

<?

		$id = 60;
		$data = "Select *, tp.namaProvinsi, kk.namaKategori from userWorker uw ";
		$data.= "JOIN tableProvinsi tp ON tp.idProvinsi = uw.domisili ";
		$data.= "JOIN kategoriKerja kk ON kk.idKategori = uw.posisi ";
		$data.= "where idWorker='".$id."' ";
		$execdata = mysql_query($data);
		$cet_data = mysql_fetch_array($execdata);
		
		$edu = "SELECT *, tprov.namaProvinsi as lokasi, tp.namaPendidikan as jenjang, tj.namaJurusan as jurusan from pendidikanWorker pw ";
		$edu.= "INNER JOIN tableProvinsi tprov ON tprov.idProvinsi = pw.lokasiInstansi ";
		$edu.= "INNER JOIN tingkatPendidikan tp ON tp.gradePendidikan = pw.kualifikasiPendidikan ";
		$edu.= "INNER JOIN tableJurusan tj ON tj.idJurusan = pw.jurusanPendidikan ";
		$edu.= "WHERE idWorker='".$id."' ORDER BY tahunLulus DESC";
		$execedu = mysql_query($edu);

		$exp = "SELECT *, bu.namaBidangUsaha as usaha, tprov.namaProvinsi as lokasi from pengalamanWorker exp ";
		$exp.= "INNER JOIN bidangUsaha bu ON bu.idUsaha = exp.bidangUsaha ";
		$exp.= "INNER JOIN tableProvinsi tprov ON tprov.idProvinsi = exp.lokasi ";
		$exp.= "WHERE idWorker='".$id."' ORDER BY akhirKerja DESC limit 3 ";
		$execexp = mysql_query($exp);
				
		$fam = "SELECT *, hk.namaHubungan as hub, tp.namaPendidikan as edu from keluarga fam ";
		$fam.= "INNER JOIN hubunganKeluarga hk ON hk.gradeHubungan = fam.hubungan ";
		$fam.= "INNER JOIN tingkatPendidikan tp ON tp.gradePendidikan = fam.pendidikan ";
		$fam.= "WHERE idWorker='".$id."' ORDER BY tanggalLahir ASC ";
		$execfam = mysql_query($fam);
				
		$training = "SELECT *, tkt.tingkatKetTraining as ket from skillTrainingWorker tr ";
		$training.= "INNER JOIN tingkatKetTraining tkt ON tkt.idKetTraining = tr.keteranganTraining ";
		$training.= "WHERE idWorker='".$id."' ORDER BY tahunTraining DESC ";
		$exectraining = mysql_query($training);
				
		$lang = "SELECT *, tb.namaBahasa as bahasa, tk1.tingkatKeahlian as lisan, tk2.tingkatKeahlian as menulis, tk3.tingkatKeahlian as membaca from skillBahasaWorker sbw ";
		$lang.= "INNER JOIN tableBahasa tb ON tb.idBahasa = sbw.idBahasa ";
		$lang.= "INNER JOIN tingkatKeahlian tk1 ON tk1.gradeKeahlian = sbw.tingkatLisan ";
		$lang.= "INNER JOIN tingkatKeahlian tk2 ON tk2.gradeKeahlian = sbw.tingkatMenulis ";
		$lang.= "INNER JOIN tingkatKeahlian tk3 ON tk3.gradeKeahlian = sbw.tingkatMembaca ";
		$lang.= "WHERE idWorker='".$id."' ORDER BY bahasa ASC ";
		$execlang = mysql_query($lang);
				
		$add = "SELECT *, tk.tingkatKeahlian as level from skillWorker sw ";
		$add.= "INNER JOIN tingkatKeahlian tk ON tk.gradeKeahlian = sw.tingkatSkill ";
		$add.= "WHERE idWorker='".$id."' ORDER BY namaSkill ASC ";
		$execadd = mysql_query($add);
	
?>
<!--body wrapper start-->
<div class="popdown-content">
	<section class="body">
		<div class="row">
			<div class="col-xs-3">
				<div class="ava">
					<img src="http://career.pratamanusantara.co.id/assets/img/avatar.jpg" width="200px" alt=""/>
					<div class="caption">
						<h3><?=$cet_data['namaUser'];?></h3>
						<p><?=$cet_data['namaKategori'];?></p>
					</div>
				</div>
			</div>
			<div class="col-xs-9" >
				<h1>Candidate Profile</h1>
			</div>
		</div>
		<br/>
					
		<div class="row">
			<div class="col-xs-12" >
				<h3><b>SUMMARY</b></h3>
				<h5><?=$cet_data['summary']?></h5>
				<div class="col-xs-6">
					<ul><i class="fa fa-list"></i>
					<span><?=$cet_data['agama']?></span></ul>
					<ul><i class="fa fa-birthday-cake"></i>
					<span><?=$cet_data['tempatLahir']?>, <?tanggal2($cet_data['tanggalLahir'])?> (<?=$cet_data['usia']?> years old)</span></ul>
					<ul><i class="fa fa-map-marker"></i>
					<span><?=$cet_data['alamatSekarang']?></span></ul>
				</div>
				<div class="col-xs-6">
					<ul><i class="fa fa-money"></i>
					<span>Rp<?=number_format($cet_data['expSalary'],0,'.',',')?></span></ul>
					<ul><i class="fa fa-phone"></i>
					<span><?=$cet_data['noPonsel']?></span></ul>
					<ul><i class="fa fa-envelope"></i>
					<span><?=$cet_data['email']?></span></ul>
				</div>
			</div>
		</div>
		</br>
					
		<div class="row">
			<div class="col-xs-12" >
				<h3><b>EDUCATIONS</b></h3>
			</div>
			<? while($cet_edu = mysql_fetch_array($execedu)){?>
			<div class="col-xs-3">
				<div class="item-block">
					<header>
						<div class="hgroup">
							<h4><?php echo $cet_edu['jenjang']?><small><?php if($cet_edu['nilai']>='4.0'){ ?> Score <?php echo $cet_edu['nilai']?> of 10 <?} else { ?> GPA <?php echo $cet_edu['nilai']?> of 4.0 <? }?></small></h4>
							<h5><?php echo $cet_edu['namaInstansi']?>, <?php echo $cet_edu['jurusan']?></h5>
							<h5><?php echo $cet_edu['lokasi']?></h5>
						</div>
						<h5 class="time"><?php echo $cet_edu['tahunMasuk']?> - <?php echo $cet_edu['tahunLulus']?></h5>
					</header>
				</div>
			</div>
			<? }?>
		</div>
		</br>
					
		<div class="row">
			<div class="col-xs-12" >
				<h3><b>WORK EXPERIENCES</b></h3>
			</div>
			<? while($cet_exp = mysql_fetch_array($execexp)){?>
			<div class="col-xs-4">
				<div class="item-block">
					<header>
						<div class="hgroup">
							<h4><?php echo $cet_exp['namaPerusahaan']?><small><?php echo $cet_exp['usaha']?></small></h4>
							<h5><?php echo $cet_exp['posisi']?></h5>
							<h5><i class="fa fa-map-marker"> <?php echo $cet_exp['lokasi']?></i></h5>
							<h5><i class="fa fa-money"> Rp<?=number_format($cet_exp['gaji'],0,'.',',')?> (<?php echo $cet_exp['grossNett']?>)</i></h5>
							<h5><i class="fa fa-odnoklassniki"> <?php echo $cet_exp['namaAtasan']?> - <?php echo $cet_exp['jabatanAtasan']?> (<?php echo $cet_exp['telpAtasan']?>)</i></h5>  
						</div>
						<h6 class="time"><?php tanggal2($cet_exp['awalKerja'])?> - <?php tanggal2($cet_exp['akhirKerja'])?></h6>
						<p><h5>Responsibilities:</h5></p>
						<h5><?php echo $cet_exp['jobdes']?></h5>
					</header>
				</div>
			</div>
			<? }?>
		</div>
		</br>
					
		<div class="row">
			<div class="col-xs-12" >
				<h3><b>FAMILIES</b></h3>
				<table class="table table-striped table-hover">
					<thead bgcolor="#dedede">
						<tr>
							<td align="center"><b>Name</b></td>
							<td align="center"><b>Place, Date of Birth</b></td>
							<td align="center"><b>Education</b></td>
							<td align="center"><b>Profession</b></td>
							<td align="center"><b>Company</b></td>
						</tr>
					</thead>
					<tbody>
						<? while($cet_fam = mysql_fetch_array($execfam)){?>
						<tr>
							<td align="center"><?php echo $cet_fam['nama']?></td>
							<td align="center"><?php echo $cet_fam['tempatLahir']?>, <?php tanggal2($cet_fam['tanggalLahir'])?></td>
							<td align="center"><?php echo $cet_fam['edu']?></td>
							<td align="center"><?php echo $cet_fam['pekerjaan']?></td>
							<td align="center"><?php if($cet_fam['perusahaan']!='') { echo $cet_fam['perusahaan']; } else{ echo "-"; }?></td>
						</tr>
						<? }?>
					</tbody>
				</table>
			</div>
		</div>
		</br>
					
		<div class="row">
			<div class="col-xs-12" >
				<h3><b>TRAINING</b></h3>
				<table class="table table-striped table-hover">
					<thead bgcolor="#dedede">
						<tr>
							<td align="center"><b>Institution</b></td>
							<td align="center"><b>Name</b></td>
							<td align="center"><b>Year</b></td>
							<td align="center"><b>Description</b></td>
						</tr>
					</thead>
					<tbody>
						<? while($cet_training = mysql_fetch_array($exectraining)){?>
						<tr>
							<td align="center"><?php echo $cet_training['penyelenggaraTraining']?></td>
							<td align="center"><?php echo $cet_training['namaTraining']?></td>
							<td align="center"><?php echo $cet_training['tahunTraining']?></td>
							<td align="center"><?php echo $cet_training['ket']?></td>
						</tr>
						<? }?>
					</tbody>
				</table>
			</div>
		</div>
		</br>
				
		<div class="row">
			<div class="col-xs-12" >
				<h3><b>LANGUAGE SKILLS</b></h3>
				<? while($cet_lang = mysql_fetch_array($execlang)){?>
				<div class="col-xs-4">
					<h4><?php echo $cet_lang['bahasa']?></h4>
					<div><span class="skill-name">Speaking</span></div>
					<? if($cet_lang['lisan']=='Beginner')
					{ ?> <div class="progress"><div class="progress-bar" style="width: 50%;"></div></div> <? }
					else if($cet_lang['lisan']=='Intermediate')
					{ ?> <div class="progress"><div class="progress-bar" style="width: 75%;"></div></div> <? }
					else
					{ ?> <div class="progress"><div class="progress-bar" style="width: 100%;"></div></div> <? }
					?>
						<div><span class="skill-name">Writing</span></div>
						<? if($cet_lang['menulis']=='Beginner')
						{ ?><div class="progress"><div class="progress-bar" style="width: 50%;"></div></div><? }
						else if($cet_lang['menulis']=='Intermediate')
						{ ?><div class="progress"><div class="progress-bar" style="width: 75%;"></div></div><? }
						else
						{ ?><div class="progress"><div class="progress-bar" style="width: 100%;"></div></div><? } 
					?>
						<div><span class="skill-name">Reading</span></div>
						<? if($cet_lang['membaca']=='Beginner')
						{ ?><div class="progress"><div class="progress-bar" style="width: 50%;"></div></div> <? }
						else if($cet_lang['membaca']=='Intermediate')
						{ ?> <div class="progress"><div class="progress-bar" style="width: 75%;"></div></div> <? }
						else
						{ ?> <div class="progress"><div class="progress-bar" style="width: 100%;"></div></div> <? } 
					?>
				</div>
				<? }?>
			</div>
		</div>
		</br>
					
		<div class="row">
			<div class="col-xs-12" >
				<h3><b>ADDITIONAL SKILLS</b></h3>
				<? while($cet_add = mysql_fetch_array($execadd)){?>
				<div class="col-xs-4">
					<div><span class="skill-name"><?php echo $cet_add['namaSkill']?><?php if($cet_add['keteranganSkill']!=''){ ?> - <?php echo $cet_add['keteranganSkill']?><? } else{ }?></span></div>
					<? if($cet_add['level']=='Beginner')
					{ ?> <div class="progress"><div class="progress-bar" style="width: 50%;"></div></div> <? }
					else if($cet_add['level']=='Intermediate')
					{ ?> <div class="progress"><div class="progress-bar" style="width: 75%;"></div></div> <? }
					else
					{ ?> <div class="progress"><div class="progress-bar" style="width: 100%;"></div></div> <? }
					?>
				</div>
				<? }?>
			</div>
		</div>
				
		<!--<div class="row">
			<div class="col-md-12">
				<div class="pull-left">
					<a class="btn btn-danger" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
				</div>
			</div>
		</div>-->
	</section>
	<?
	$hr = mysql_query("select * from penilaian_summary where tipe_penilaian = '1' and idWorker = '$id'");
	while($cet_hr = mysql_fetch_array($hr))
	{
		if($cet_hr['tipe_penilaian']=='1' and $cet_hr['idWorker']!='')
		{	
		?>
		<section class="body">
			<div class="row">
				<div class="col-xs-12" >
					<h1>Hasil Interview HR</h1>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-xs-6">
					<table border="0" width="100%" class="print">
						<tr>
							<td width="150px">Nama</td>
							<td width="20px">:</td>
							<td><?=$cet_data['namaUser'];?></td>
						</tr>
						<tr>
							<td>Tanggal Lahir</td>
							<td>:</td>
							<td><?=tanggal2($cet_data['tanggalLahir']);?></td>
						</tr>
						<tr>
							<td>Perusahaan Terakhir</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Pendidikan</td>
							<td>:</td>
							<td><?=$cet_edu['jurusan'];?></td>
						</tr>
					</table>
				</div>
				<div class="col-xs-6">
					<table border="0" width="100%" class="print">
						<tr>
							<td width="150px">Tanggal Wawancara</td>
							<td width="20px">:</td>
							<td><?=tanggal2($cet_hr['testdate']);?></td>
						</tr>
						<tr>
							<td width="150px">Posisi</td>
							<td width="20px">:</td>
							<td><?=$cet_data['namaKategori'];?></td>
						</tr>
						<tr>
							<td>No.Telp</td>
							<td>:</td>
							<td><?=$cet_data['noPonsel'];?></td>
						</tr>
						<tr>
							<td>Domisili</td>
							<td>:</td>
							<td><?=$cet_data['namaProvinsi'];?></td>
						</tr>
					</table>
				</div>
			</div>
			</br>
			<? hasil(1,$id);?>
			<!--<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<a class="btn btn-danger" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
					</div>
				</div>
			</div>-->
		</section>
		<?
		}
	}
	
	$psi = mysql_query("select * from penilaian_summary where tipe_penilaian = '2' and idWorker = '".$id."'");
	while($cet_psi = mysql_fetch_array($psi))
	{
		if($cet_psi['tipe_penilaian']=='2' and $cet_psi['idWorker']!='')
		{	
		?>
		<section class="body">
			<div class="row">
				<div class="col-xs-12" >
					<h1>Hasil Psikotest</h1>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-xs-6">
					<table border="0" width="100%" class="print">
						<tr>
							<td width="150px">Nama</td>
							<td width="20px">:</td>
							<td><?=$cet_data['namaUser'];?></td>
						</tr>
						<tr>
							<td>Tanggal Lahir</td>
							<td>:</td>
							<td><?=tanggal2($cet_data['tanggalLahir']);?></td>
						</tr>
						<tr>
							<td>Perusahaan Terakhir</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Pendidikan</td>
							<td>:</td>
							<td><?=$cet_edu['jurusan'];?></td>
						</tr>
					</table>
				</div>
				<div class="col-xs-6">
					<table border="0" width="100%" class="print">
						<tr>
							<td width="150px">Tanggal Psikotest</td>
							<td width="20px">:</td>
							<td><?=tanggal2($cet_psi['testdate']);?></td>
						</tr>
						<tr>
							<td width="150px">Posisi</td>
							<td width="20px">:</td>
							<td><?=$cet_data['namaKategori'];?></td>
						</tr>
						<tr>
							<td>No.Telp</td>
							<td>:</td>
							<td><?=$cet_data['noPonsel'];?></td>
						</tr>
						<tr>
							<td>Domisili</td>
							<td>:</td>
							<td><?=$cet_data['namaProvinsi'];?></td>
						</tr>
					</table>
				</div>
			</div>
			</br>
			<? hasil(2,$id);?>
			<!--<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<a class="btn btn-danger" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
					</div>
				</div>
			</div>-->
		</section>
		<?
		}
	}
	
	$user = mysql_query("select * from penilaian_summary where tipe_penilaian = '3' and idWorker = '".$id."'");
	while($cet_user = mysql_fetch_array($user))
	{
		if($cet_user['tipe_penilaian']=='3' and $cet_user['idWorker']!='')
		{	
		?>
		<section class="body">
			<div class="row">
				<div class="col-xs-12" >
					<h1>Hasil Interview User</h1>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-xs-6">
					<table border="0" width="100%" class="print">
						<tr>
							<td width="150px">Nama</td>
							<td width="20px">:</td>
							<td><?=$cet_data['namaUser'];?></td>
						</tr>
						<tr>
							<td>Tanggal Lahir</td>
							<td>:</td>
							<td><?=tanggal2($cet_data['tanggalLahir']);?></td>
						</tr>
						<tr>
							<td>Perusahaan Terakhir</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Pendidikan</td>
							<td>:</td>
							<td><?=$cet_edu['jurusan'];?></td>
						</tr>
					</table>
				</div>
				<div class="col-xs-6">
					<table border="0" width="100%" class="print">
						<tr>
							<td width="150px">Tanggal Wawancara</td>
							<td width="20px">:</td>
							<td><?=tanggal2($cet_user['testdate']);?></td>
						</tr>
						<tr>
							<td width="150px">Posisi</td>
							<td width="20px">:</td>
							<td><?=$cet_data['namaKategori'];?></td>
						</tr>
						<tr>
							<td>No.Telp</td>
							<td>:</td>
							<td><?=$cet_data['noPonsel'];?></td>
						</tr>
						<tr>
							<td>Domisili</td>
							<td>:</td>
							<td><?=$cet_data['namaProvinsi'];?></td>
						</tr>
					</table>
				</div>
			</div>
			</br>
			<? hasil(3,$id);?>
			<!--<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<a class="btn btn-danger" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
					</div>
				</div>
			</div>-->
		</section>
		<?
		}
	}
	?>
	</div>
<!--body wrapper end-->