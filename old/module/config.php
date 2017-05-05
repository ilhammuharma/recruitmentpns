<?php
	$server = "localhost";
	$username = "adminit";
	$password = "ruangit";
	$db = "zadmin_career";
	mysql_connect($server, $username, $password);
	mysql_select_db($db);
	mysqli_connect("localhost", "adminit", "ruangit", "zadmin_career");
	date_default_timezone_set('Asia/Jakarta');
	$base_url = "http://career.pratamanusantara.co.id/";
	
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
?>