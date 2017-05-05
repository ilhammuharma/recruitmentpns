<?php
	$server = "localhost";
	$username = "adminit";
	$password = "ruangit";
	$db = "zadmin_career";
	mysql_connect($server, $username, $password);
	mysql_select_db($db);
	mysqli_connect("localhost", "adminit", "ruangit", "zadmin_career");
	date_default_timezone_set('Asia/Jakarta');
	$base_url = "http://recruitment.pns.co.id/";
	
	function tanggal($data)
	{
		$datetime=explode(" ", $data);
		$date=explode("-",$datetime[0]);
		$time=explode(":",$datetime[1]);
		if($date[1]=="01"){$bulan="January";}
		else if($date[1]=="02"){$bulan="February";}
		else if($date[1]=="03"){$bulan="March";}
		else if($date[1]=="04"){$bulan="April";}
		else if($date[1]=="05"){$bulan="May";}
		else if($date[1]=="06"){$bulan="June";}
		else if($date[1]=="07"){$bulan="July";}
		else if($date[1]=="08"){$bulan="August";}
		else if($date[1]=="09"){$bulan="September";}
		else if($date[1]=="10"){$bulan="October";}
		else if($date[1]=="11"){$bulan="November";}
		else if($date[1]=="12"){$bulan="December";}
		echo $datetime[1]."<br>".$date[2]." $bulan ".$date[0];
	}
	
	function tanggal2($data)
	{
		$datetime=explode(" ", $data);
		$date=explode("-",$datetime[0]);
		if($date[1]=="01"){$bulan="January";}
		else if($date[1]=="02"){$bulan="February";}
		else if($date[1]=="03"){$bulan="March";}
		else if($date[1]=="04"){$bulan="April";}
		else if($date[1]=="05"){$bulan="May";}
		else if($date[1]=="06"){$bulan="June";}
		else if($date[1]=="07"){$bulan="July";}
		else if($date[1]=="08"){$bulan="August";}
		else if($date[1]=="09"){$bulan="September";}
		else if($date[1]=="10"){$bulan="October";}
		else if($date[1]=="11"){$bulan="November";}
		else if($date[1]=="12"){$bulan="December";}
		echo $date[2]." $bulan ".$date[0];
	}
	
	function tanggal4($data)
	{
		if($data=='0000-00-00 00:00:00')
		{}
		else
		{
			$datetime=explode(" ", $data);
			$date=explode("-",$datetime[0]);
			$time=explode(":",$datetime[1]);
			if($date[1]=="01"){$bulan="January";}
			else if($date[1]=="02"){$bulan="February";}
			else if($date[1]=="03"){$bulan="March";}
			else if($date[1]=="04"){$bulan="April";}
			else if($date[1]=="05"){$bulan="May";}
			else if($date[1]=="06"){$bulan="June";}
			else if($date[1]=="07"){$bulan="July";}
			else if($date[1]=="08"){$bulan="August";}
			else if($date[1]=="09"){$bulan="September";}
			else if($date[1]=="10"){$bulan="October";}
			else if($date[1]=="11"){$bulan="November";}
			else if($date[1]=="12"){$bulan="December";}
			echo $date[2]." $bulan ".$date[0]." ".$datetime[1];
		}
	}
	
	function hari($hari)
	{
		if($hari=='Sunday'){echo "Minggu";}
		else if($hari=='Monday'){echo "Senin";}
		else if($hari=='Tuesday'){echo "Selasa";}
		else if($hari=='Wednesday'){echo "Rabu";}
		else if($hari=='Thursday'){echo "Kamis";}
		else if($hari=='Friday'){echo "Jumat";}
		else if($hari=='Saturday'){echo "Sabtu";}
	}
	
	function bilangRatusan($x)
	{
		$kata = array('', 'Satu ', 'Dua ', 'Tiga ' , 'Empat ', 'Lima ', 'Enam ', 'Tujuh ', 'Delapan ', 'Sembilan ');
		$string = '';
		$ratusan = floor($x/100);
		$x = $x % 100;
		if ($ratusan > 1) $string .= $kata[$ratusan]."Ratus ";
		else if ($ratusan == 1) $string .= "Seratus ";
		$puluhan = floor($x/10);
		$x = $x % 10;
		if ($puluhan > 1)
		{
			$string .= $kata[$puluhan]."Puluh ";
			$string .= $kata[$x];
		}
		else if (($puluhan == 1) && ($x > 0)) $string .= $kata[$x]."Belas ";
		else if (($puluhan == 1) && ($x == 0)) $string .= $kata[$x]."Sepuluh ";
		else if ($puluhan == 0) $string .= $kata[$x];
		return $string;
	}
	
	function terbilang($x)
	 
	{
		$x = number_format($x, 0, "", ".");
		$pecah = explode(".", $x);
		$string = "";
		for($i = 0; $i <= count($pecah)-1; $i++)
		{
			if ((count($pecah) - $i == 5) && ($pecah[$i] != 0)) $string .= bilangRatusan($pecah[$i])."Triliyun ";
			else if ((count($pecah) - $i == 4) && ($pecah[$i] != 0)) $string .= bilangRatusan($pecah[$i])."Milyar ";
			else if ((count($pecah) - $i == 3) && ($pecah[$i] != 0)) $string .= bilangRatusan($pecah[$i])."Juta ";
			else if ((count($pecah) - $i == 2) && ($pecah[$i] == 1)) $string .= "Seribu ";
			else if ((count($pecah) - $i == 2) && ($pecah[$i] != 0)) $string .= bilangRatusan($pecah[$i])."Ribu ";
			else if ((count($pecah) - $i == 1) && ($pecah[$i] != 0)) $string .= bilangRatusan($pecah[$i]);
		}
		return $string;
	}
	
	function soal($type)
	{
		?>
		<div class="form-group">
			<label for="testdate" class="control-label"><b>Tanggal Test</b></label>
			<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" class="input-append date dpYears">
				<input type="text" name="testdate" class="form-control" required>
				<span class="input-group-btn add-on">
					<button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
				</span>
			</div>
			<span class="help-block">Select date</span>
		</div>
		
		<table class="table table-soal data-table custom-table table-hover">
			<thead>
				<tr bgcolor="#dedede">
					<th rowspan='2' style="text-align:center;" width="15%">Aspek</th>
					<th rowspan='2' style="text-align:center;">Definisi</th>
					<th style="text-align:center;" width="1%">SK</th>
					<th style="text-align:center;" width="1%">K</th>
					<th style="text-align:center;" width="1%">C</th>
					<th style="text-align:center;" width="1%">B</th>
					<th style="text-align:center;" width="1%">BS</th>
					<th rowspan='2' style="text-align:center;" width="30%">Keterangan</th>
				</tr>
				<tr>
					<th style="text-align:center;" >1</th>
					<th style="text-align:center;" >2</th>
					<th style="text-align:center;" >3</th>
					<th style="text-align:center;" >4</th>
					<th style="text-align:center;" >5</th>
				</tr>
			</thead>
			<tbody>
				<?
					$type=$type;
					$group_q=mysql_query("select kategori from penilaian where tipe_penilaian='$type' and `status`=1 group by kategori");
					while($group=mysql_fetch_array($group_q))
					{
						?>
							<tr>
								<td colspan="8"><b><?=$group['kategori']?></b></td>
							</tr>
							<?
								$list_q=mysql_query("select * from penilaian where kategori='".$group['kategori']."' and tipe_penilaian='$type' and `status`='1'");
								while($list=mysql_fetch_array($list_q))
								{
									
									?>
									<tr>
										<td style="padding-left:20px;"><?=$list['aspek']?></td>
										<td ><?=$list['definisi']?></td>
										<td align="center"><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="1"></td>
										<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="2"></td>
										<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="3"></td>
										<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="4"></td>
										<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="5"></td>
										<td ><textarea name="keterangan<?=$list['id_penilaian']?>" style="width:100%; height:100%;"></textarea></td>
									</tr>
									<? 
								}
					}
				?>
				<input type="hidden" name="type" value="<?=$type?>">
			</tbody>
		</table>
		
		<div class="form-group">
			<label for="kelebihan" required="required" class="control-label"><b>Strength</b></label>
			<textarea type="text" name="kelebihan" class="form-control" style="width:100%; height:100%;"></textarea>
		</div>
		
		<div class="form-group">
			<label for="kekurangan" required="required" class="control-label"><b>Weakness</b></label>
			<textarea type="text" name="kekurangan" class="form-control" style="width:100%; height:100%;"></textarea>
		</div>
			
		<div class="form-group">
			<label for="kesimpulan" required="required" class="control-label"><b>Kesimpulan</b></label>
			<textarea type="text" name="kesimpulan" class="form-control" style="width:100%; height:100%;" required></textarea>
		</div>
		<?		
	}
	
	function hasil($type,$id)
	{
		?>
		<table class="table table-soal data-table custom-table table-hover">
			<thead>
				<tr bgcolor="#dedede">
					<th rowspan='2' style="text-align:center;" width="15%">Aspek</th>
					<th rowspan='2' style="text-align:center;">Definisi</th>
					<th style="text-align:center;" width="1%">SK</th>
					<th style="text-align:center;" width="1%">K</th>
					<th style="text-align:center;" width="1%">C</th>
					<th style="text-align:center;" width="1%">B</th>
					<th style="text-align:center;" width="1%">BS</th>
					<th rowspan='2' style="text-align:center;" width="30%">Keterangan</th>
				</tr>
				<tr>
					<th style="text-align:center;" >1</th>
					<th style="text-align:center;" >2</th>
					<th style="text-align:center;" >3</th>
					<th style="text-align:center;" >4</th>
					<th style="text-align:center;" >5</th>
				</tr>
			</thead>
			<tbody>
				<?
					$type=$type;
					$group_q=mysql_query("select kategori from penilaian where tipe_penilaian='$type' and `status`=1 group by kategori");
					while($group=mysql_fetch_array($group_q))
					{
						?>
							<tr>
								<td colspan="8"><b><?=$group['kategori']?></b></td>
							</tr>
							<?
								$list_q=mysql_query("select * from penilaian where kategori='".$group['kategori']."' and tipe_penilaian='$type' and `status`='1'");
								while($list=mysql_fetch_array($list_q))
								{
									
									$nilai_detail = mysql_query("select * from penilaian_detail where id_penilaian = '".$list['id_penilaian']."' and idWorker = '".$id."'");
									$cet_nilai = mysql_fetch_array($nilai_detail);
									
									//=============hitung bobot
									$lvl=1;
									if($lvl==1){ $bobot=$list['bobot1'];}else{$bobot=$list['bobot2'];}
									$total_bobot[$list['id_penilaian']]=($cet_nilai['nilai']/3)*$bobot;
									///============hitung bobot
									?>
									<tr>
										<?//="select * from penilaian_detail where id_penilaian = '".$list['id_penilaian']."' and idWorker = '".$id."'";?>
										<td style="padding-left:20px;"><?=$list['aspek']?></td>
										<td ><?=$list['definisi'];?> </td>
										<td align="center"><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="1" <? if($cet_nilai['nilai'] == "1"){ echo "checked";}?> disabled></td>
										<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="2" <? if($cet_nilai['nilai'] == "2"){ echo "checked";}?> disabled></td>
										<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="3" <? if($cet_nilai['nilai'] == "3"){ echo "checked";}?> disabled></td>
										<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="4" <? if($cet_nilai['nilai'] == "4"){ echo "checked";}?> disabled></td>
										<td align="center" ><input type="radio" name="nilai<?=$list['id_penilaian']?>" value="5" <? if($cet_nilai['nilai'] == "5"){ echo "checked";}?> disabled></td>
										<td ><p name="keterangan<?=$list['id_penilaian']?>" style="width:100%; height:100%;"><?=$cet_nilai['keterangan']?></p></td>
									</tr>
									<? 
								}
							?>
						<?
					}
				?>
				<input type="hidden" name="type" value="<?=$type?>">
			</tbody>
		</table>
		<?
		$nilai_summary = mysql_query("select * from penilaian_summary where tipe_penilaian = '$type' and idWorker = '".$id."'");
		$cet_sum = mysql_fetch_array($nilai_summary);
		
		$grand_bobot= array_sum($total_bobot);
		unset($total_bobot);
		?>
		<div class="form-group">
		<label for="rekomendasi" required="required" class="control-label"><b>Rekomendasi User</b> <?//=$grand_bobot;?>  <?//=$cek;?></label>
		<?if($grand_bobot > 120){?> <button class="btn btn-sm btn-success addon-btn m-b-10"><i><?=number_format($grand_bobot,0,'.',',');?></i>Sangat Disarankan</button><?}
		else if($grand_bobot > 100 && $grand_bobot <= 120){?> <button class="btn btn-sm btn-success addon-btn m-b-10"><i><?=number_format($grand_bobot,0,'.',',');?></i>Disarankan</button><?}
		else if($grand_bobot > 80 && $grand_bobot <= 100){?> <button class="btn btn-sm btn-warning addon-btn m-b-10"><i><?=number_format($grand_bobot,0,'.',',');?></i>Dipertimbangkan</button><?}
		else if($grand_bobot <= 80){?> <button class="btn btn-sm btn-danger addon-btn m-b-10"><i><?=number_format($grand_bobot,0,'.',',');?></i>Tidak Disarankan</button><?}
		?></div>
		
		<!--<div class="form-group">
			<label for="rekomendasi" required="required" class="control-label"><b>Rekomendasi User</b> <?=$grand_bobot;?>  <?=$cek;?></label>
			<label class="radio-inline"><input type="radio" name="rekomendasi" id="sangatdisarankan" value="1" <? if($grand_bobot > 120){ echo "checked";}?> disabled>Sangat Disarankan</label>
			<label class="radio-inline"><input type="radio" name="rekomendasi" id="disarankan" value="2" <? if($grand_bobot > 100 && $grand_bobot <= 120){ echo "checked";}?> disabled>Disarankan</label>
			<label class="radio-inline"><input type="radio" name="rekomendasi" id="dipertimbangkan" value="3" <? if($grand_bobot > 80 && $grand_bobot <= 100){ echo "checked";}?> disabled>Dipertimbangkan</label>
			<label class="radio-inline"><input type="radio" name="rekomendasi" id="tidakdisarankan" value="4" <? if($grand_bobot <= 80){ echo "checked";}?> disabled>Tidak Disarankan</label>
		</div>-->
		
		<div class="form-group">
			<label for="kelebihan" required="required" class="control-label"><b>Strength</b></label>
			<textarea type="text" name="kelebihan" class="form-control" style="width:100%; height:100%;" disabled><?=$cet_sum['kelebihan']?></textarea>
		</div>
		
		<div class="form-group">
			<label for="kekurangan" required="required" class="control-label"><b>Weakness</b></label>
			<textarea type="text" name="kekurangan" class="form-control" style="width:100%; height:100%;" disabled><?=$cet_sum['kekurangan']?></textarea>
		</div>
			
		<div class="form-group">
			<label for="kesimpulan" required="required" class="control-label"><b>Kesimpulan</b></label>
			<textarea type="text" name="kesimpulan" class="form-control" style="width:100%; height:100%;" required disabled><?=$cet_sum['kesimpulan']?></textarea>
		</div>
		<?		
	}
?>