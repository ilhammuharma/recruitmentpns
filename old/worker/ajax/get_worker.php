<?php
	session_start();
	include("../../assets/dbconfig.php");
	$username = $_SESSION['username'];
	if(!isset($_SESSION['username'])){
		echo "ERROR LOGIN";
	}else{
		if(isset($_POST['page'])){
			$page_number = filter_var($_POST['page'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			$item_per_page = 10;
			if(!is_numeric($page_number)){
				die("INVALID!!!");
			}else{
				$position = ($page_number * $item_per_page) - $item_per_page;
				$getWorker = "SELECT * FROM userWorker ORDER BY namaUser ASC LIMIT $position, $item_per_page";
				$execWorker = mysql_query($getWorker);
?>
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Email</th>
							<th>Phone</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
<?php
						while($result = mysql_fetch_array($execWorker)){
?>
							<tr>
								<td>
									<?php echo $result['namaUser'];?>
								</td>
								<td>
									<?php echo $result['emailUser'];?>
								</td>
								<td>
									<?php echo $result['noPonsel'];?>
								</td>
								<td>
									<a href="../show/worker.php?id=<?php echo $result['idWorker'];?>" target="_blank"><button class="btn btn-sm btn-default">Show Profile</button></a>
								</td>
							</tr>
<?php 
						}
?>
					</tbody>
				</table>
<?php
			}
		}
	}
?>