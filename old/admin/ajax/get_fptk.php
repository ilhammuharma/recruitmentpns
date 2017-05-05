<?php
	session_start();
	include("../../assets/dbconfig.php");
	$username = $_SESSION['username'];
	
	if(!isset($_SESSION['username']))
	{
		echo "ERROR LOGIN";
	}
	else
	{
		if(isset($_POST['page']))
		{
			$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			$item_per_page = 5;
			if(!is_numeric($page_number))
			{
				die('Invalid!');
			}
			$position = ($page_number * $item_per_page)-$item_per_page;
			$getFptk = "SELECT * FROM fptk ORDER BY namaPemohon ASC LIMIT $position, $item_per_page";
			$execFptk = mysql_query($getFptk);
			?>
			<table class="table table-hover table-condensed">
				<thead>
					<tr>
						<th>Nama Pemohon</th>
						<th>NIK Pemohon</th>
						<th>Posisi Pemohon</th>
						<th>Departemen Pemohon</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($result = mysql_fetch_array($execFptk))
						{
							?>
								<tr>
									<td><?php echo $result['namaPemohon']?></td>
									<td><?php echo $result['nikPemohon']?></td>
									<td><?php echo $result['posisiPemohon']?></td>
									<td><?php echo $result['departemenPemohon']?></td>
									<td>
										<a href="edit-fptk.php?id=<?php echo $result['idFptk'];?>"><button class="btn btn-xs btn-default">Edit</button></a>
										<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#delete<?php echo $result['idFptk'];?>">Delete</button>
									</td>
								</tr>
														
								<!-- Modal DELETE FPTK-->
								<div class="modal fade" id="delete<?php echo $result['idFptk'];?>" tabindex="-1" role="dialog" aria-labelledby="label-delete<?php echo $result['idFptk'];?>" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h4 class="modal-title" id="label-delete<?php echo $result['idFptk'];?>"><?php echo $result['namaPemohon'];?></h4>
											</div>
											<div class="modal-body">Are you sure want to delete this FPTK?</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
												<a href="delete-fptk.php?id=<?php echo $result['idFptk'];?>"><button type="button" class="btn btn-primary" name="delete-fptk">Delete</button></a>
											</div>
										</div>
									</div>
								</div>
							<?php
						}
					?>
				</tbody>
			</table>
		<?php
		}
	}
?>