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
				$getHrd = "SELECT * FROM userHrd ORDER BY namaPerusahaan ASC LIMIT $position, $item_per_page";
				$execHrd = mysql_query($getHrd);
?>
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th>Perusahaan</th>
							<th>Email</th>
							<th>Telepon</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
<?php
						while($result = mysql_fetch_array($execHrd)){
?>
							<tr>
								<td>
									<?php echo $result['namaPerusahaan'];?>
								</td>
								<td>
									<?php echo $result['emailPerusahaan'];?>
								</td>
								<td>
									<?php echo $result['teleponPerusahaan'];?>
								</td>
								<td>
									<a href="../show/company.php?id=<?php echo $result['idHrd'];?>" target="_blank"> <button class="btn btn-sm btn-default">Show Profile</button></a>
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