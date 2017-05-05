<?php
	session_start();
	include("../assets/dbconfig.php");
	echo $url;
	//$title = "fptk";

	if(!isset($_SESSION['username']))
	{
		header("Location: login.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
		{
			//echo $url;
			$title = "review";
			$tipe = mysql_fetch_array(mysql_query("SELECT level FROM loginUser WHERE idLogin='".$_SESSION['idLogin']."'"));
			$role = mysql_fetch_array(mysql_query("SELECT idLogin FROM loginUser"));
			if($tipe['level']==2)
			{
				include("templates/head.php"); 
				$idLogin = $_SESSION['idLogin'];
				$idWorker = $_SESSION['idWorker'];
				
				$getStatusEducation = "SELECT * FROM pendidikanWorker WHERE idWorker = $idWorker";
				$execStatusEducation = mysql_query($getStatusEducation);
				$statusEducation = mysql_num_rows($execStatusEducation);

				$getStatusExp = "SELECT * FROM pengalamanWorker WHERE idWorker = $idWorker";
				$execStatusExp = mysql_query($getStatusExp);
				$statusExp = mysql_num_rows($execStatusExp);

				$getStatusTraining = "SELECT * FROM skillTrainingWorker WHERE idWorker = $idWorker";
				$execStatusTraining = mysql_query($getStatusTraining);
				$statusTraining = mysql_num_rows($execStatusTraining);
				
				$getStatusSkill = "SELECT * FROM skillWorker WHERE idWorker = $idWorker";
				$execStatusSkill = mysql_query($getStatusSkill);
				$statusSkill = mysql_num_rows($execStatusExp);

				$getStatusBahasa = "SELECT * FROM skillBahasaWorker WHERE idWorker = $idWorker";
				$execStatusBahasa = mysql_query($getStatusBahasa);
				$statusBahasa = mysql_num_rows($execStatusBahasa);
				
				$getStatusDarurat = "SELECT * FROM keluargaDarurat WHERE idWorker = $idWorker";
				$execStatusDarurat = mysql_query($getStatusDarurat);
				$statusDarurat = mysql_num_rows($execStatusDarurat);
				
				$getStatusBesar = "SELECT * FROM keluargaBesar WHERE idWorker = $idWorker";
				$execStatusBesar = mysql_query($getStatusBesar);
				$statusBesar = mysql_num_rows($execStatusBesar);
					
				$getStatusInti = "SELECT * FROM keluargaInti WHERE idWorker = $idWorker";
				$execStatusInti = mysql_query($getStatusInti);
				$statusInti = mysql_num_rows($execStatusInti);
				/*
				$getStatusReferensi = "SELECT * FROM sosialReferensi WHERE idWorker = $idWorker";
				$execStatusReferensi = mysql_query($getStatusReferensi);
				$statusReferensi = mysql_num_rows($execStatusReferensi);
				
				$getStatusKenalan = "SELECT * FROM sosialKenalan WHERE idWorker = $idWorker";
				$execStatusKenalan = mysql_query($getStatusKenalan);
				$statusKenalan = mysql_num_rows($execStatusKenalan);
				
				$statusReferensi < 1 || $statusKenalan < 1
				*/
				
				if($statusEducation < 1 || $statusExp < 1 || $statusTraining < 1 || $statusSkill < 1 || $statusBahasa < 1 || $statusDarurat < 1 || $statusBesar < 1 || $statusInti < 1)
				{
					?>
						<div class="alert alert-warning" role="alert">
							<h4>Informasi data diri Anda belum lengkap. Silakan lengkapi!</h4>
							<a href="resume.php"><button class="btn btn-sm btn-primary">Melengkapi</button></a>
						</div>
					<?php
				}
				?>
				<h3>Lowongan kerja yang Anda daftarkan</h3>
				<?php
					$queryStatus = "SELECT al.idLowongan, uh.idHrd, uh.namaPerusahaan FROM applyLowongan al ";
					$queryStatus .= "JOIN postingLowongan pl ON pl.idLowongan = al.idLowongan ";
					$queryStatus .= "JOIN userHrd uh ON uh.idHrd = pl.idHrd ";
					$queryStatus .= "WHERE idWorker = $idWorker";
					$execStatus = mysql_query($queryStatus);
					if(mysql_num_rows($execStatus) < 1)
					{
						echo "<p>Belum ada lowongan kerja yang Anda daftarkan</p>";
					}
					else
					{
						$temp = array();
						echo "<ol>";
						while($status = mysql_fetch_array($execStatus))
						{
							if(!in_array($status['idHrd'], $temp))
							{
								echo "<li><strong><a target='_blank' href='".$webRoot."show/company.php?id=".$status['idHrd']."'>".$status['namaPerusahaan']."</a></strong></li>";
								$idLowongan = $status['idLowongan'];
								$idHrd = $status['idHrd'];
								echo "<ul>";
								$queryItem = "SELECT al.idLowongan, pl.namaPosisi, pl.kodePosisi FROM applyLowongan al ";
								$queryItem .= "JOIN postingLowongan pl ON pl.idLowongan = al.idLowongan ";
								$queryItem .= "JOIN userHrd uh ON uh.idHrd = pl.idHrd ";
								$queryItem .= "WHERE al.idWorker = $idWorker AND pl.idHrd = $idHrd";
								
								$execItem = mysql_query($queryItem);
								while($item = mysql_fetch_array($execItem))
								{
									echo "<li>";
									echo $item['namaPosisi'];
									if($item['kodePosisi'] != "")
									{
										echo " [".$item['kodePosisi']."]";
									}
									echo " <a target='_blank' href='".$webRoot."/show/post.php?id=".$item['idLowongan']."'><i class='fa fa-external-link'></i> </a>"; 
									echo "</li>";
								}
								echo "</ul>";
								array_push($temp, $status['idHrd']);
							}
						}
						echo "</ol>";
					}
				include("templates/foot.php");
			}
			
			else if($tipe['level']==3)
			{
				$title = "";
				include("templates/head.php");
				?>
					<div class="row"><div class="col-md-5"></div></div>
					<div style="display:none!important;" class="row"><input type="hidden" value="<?php echo $idWorker;?>"></div>
				<?php
				include("templates/foot.php");
			}
		} 
		else 
		{
			echo'You do not have permission to access this page!';
		}
	}
?>