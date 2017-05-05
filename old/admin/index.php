<?php
	session_start();
	include("../assets/dbconfig.php");
	$title = "review";
	
	if(!isset($_SESSION['username']))
	{
		header("Location: login.php");
		
	}
	else
	{
		if($_SESSION['username'] == 'admin' && $_SESSION['admin'])
		{
			include("templates/head.php"); 
			?>
				<h3><strong>Resensi Lowongan Pekerjaan</strong></h3>
				<?php
					$idHrd = $_SESSION['idHrd'];
					$getStatusLowongan = "SELECT al.idTable, al.idLowongan, pl.namaPosisi FROM applyLowongan al ";
					$getStatusLowongan .= "JOIN postingLowongan pl ON pl.idLowongan = al.idLowongan ";
					$getStatusLowongan .= "JOIN userWorker uw ON uw.idWorker = al.idWorker ";
					$getStatusLowongan .= "WHERE pl.idHrd = $idHrd";
					//echo $getStatusLowongan;
					$execStatusLowongan = mysql_query($getStatusLowongan);
					$temp = array();
					if(mysql_num_rows($execStatusLowongan) > 0)
					{
						echo "<ol>";
						while($result = mysql_fetch_array($execStatusLowongan))
						{
							if(!in_array($result['idLowongan'], $temp))
							{
								echo "<li> <a target='_blank' href='".$webRoot."/show/post.php?id=".$result['idLowongan']."'><strong>".$result['namaPosisi']."</strong></a></li>";
								$idLowongan = $result['idLowongan'];
								$getPelamar = "SELECT  al.idWorker, uw.namaUser FROM applyLowongan al ";
								$getPelamar .= "JOIN userWorker uw ON uw.idWorker = al.idWorker ";
								$getPelamar .= "WHERE al.idLowongan = $idLowongan";
								$execGetPelamar = mysql_query($getPelamar);
								
								if(mysql_num_rows($execGetPelamar) > 0)
								{
									echo "<ul>";
									while($pelamar = mysql_fetch_array($execGetPelamar))
									{
										echo "<li>".$pelamar['namaUser']." <a target='_blank' href='".$webRoot."/show/worker.php?id=".$pelamar['idWorker']."'><i class='fa fa-external-link'></i> </a></li>";
									}	
									echo "</ul>";
								}
								else
								{
									echo "There has been no applicants.";
								}
								array_push($temp, $result['idLowongan']);
							}
						}
						echo "</ol>";
					}
					else
					{
						echo "There has been no applicants.";
					}
				?>	
			<?php
			include("templates/foot.php");
		} else {
			echo'You do not have permission to access this page!';
		}
	}
?>