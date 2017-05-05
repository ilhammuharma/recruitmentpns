<?php
	session_start();
	$title = "event";
	include("../assets/dbconfig.php");
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_SESSION['worker']))
		{
			header("Location:../worker/");
		}
		else if(isset($_SESSION['admin']))
		{
			include("templates/head.php");
			if(isset($_POST['tambah']))
			{
				$nama = $_POST['nama'];
				$tanggal = $_POST['tanggal'];
				$deskripsi = htmlentities($_POST['deskripsi']);

				$queryTambahEvent = "INSERT INTO event_calendar VALUES(null, STR_TO_DATE('$tanggal', '%d-%m-%Y'), '$nama','$deskripsi')";
				$execTambahEvent = mysql_query($queryTambahEvent) or die(mysql_error());
			}
			?>
				<div class="row">
					<div class="col-md-5">
						<h3><strong>List of Events</strong></h3>
						<button class="btn btn-sm btn-success" id="tambah-event">Add Event</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6" style="display:none;padding:20px;" id="add-event">
						<form action="event.php" role="form" class="form-horizontal" method="post">
							<div class="form-group">
								<label for="nama" class="col-md-2 control-label">Name</label>
								<div class="col-md-10">
									<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Event" required>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="col-md-2 control-label">Date</label>
								<div class="col-md-6">
									<input type="text" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" required>
								</div>
							</div>
							<div class="form-group">
								<label for="deskripsi" class="col-md-2 control-label">Description</label>
								<div class="col-md-10">
									<textarea name="deskripsi" id="deskripsi" rows="8" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-2 col-md-6">
									<button type="submit" name="tambah" class="btn btn-primary btn-sm">Save</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-9">
					<?php
						$per_page = 5;
						$totalEvent = "SELECT * FROM event_calendar";
						$getTotalEvent = mysql_query($totalEvent);
						$resultTotalEvent = mysql_num_rows($getTotalEvent);
						$pages = ceil($resultTotalEvent/$per_page);

						$getEvents = "SELECT * from event_calendar ORDER BY event_date DESC LIMIT 0, $per_page";
						
						$execEvents = mysql_query($getEvents);
						if(mysql_num_rows($execEvents) < 1)
						{
							echo "<em>Tidak ada event</em>";
						}
						else
						{
							?>
								<input type="hidden" value="<?php echo $pages;?>" id="pages">
								<div class="table-responsive" id="total-event">
									<table class="table table-hover table-condensed">
										<thead><tr><th>Action</th><th>Name</th><th>Description</th><th>Date</th></tr></thead>
										<tbody>
											<?php
												while($result = mysql_fetch_array($execEvents))
												{
													?>
														<tr>
															<td>
																<a href="edit-event.php?id=<?php echo $result['id'];?>"><button class="btn btn-primary">Edit</button></a>
																<button class="btn btn-danger btn-primary" data-toggle="modal" data-target="#delete<?php echo $result['id'];?>">Delete</button>
															</td>
															<td><?php echo $result['title']?></td>
															<td><?php echo strip_tags(html_entity_decode($result['description']));?></td>
															<td>
															<?php
																$date = new DateTime($result['event_date']);
																echo $date->format('d M Y');
															?>
															</td>
														</tr>
														
														<!-- Modal DELETE EVENT-->
														<div class="modal fade" id="delete<?php echo $result['id'];?>" tabindex="-1" role="dialog" aria-labelledby="label-delete<?php echo $result['id'];?>" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																		<h4 class="modal-title" id="label-delete<?php echo $result['id'];?>"><?php echo $result['title'];?></h4>
																	</div>
																	<div class="modal-body">Are you sure want to delete this event?</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																		<a href="delete-event.php?id=<?php echo $result['id'];?>"><button type="button" class="btn btn-primary" name="delete-event">Delete</button></a>
																	</div>
																</div>
															</div>
														</div>
													<?php
												}
											?>
										</tbody>
									</table>
								</div>
							<?php
						}
						?>
						<?php if($pages > 1){ ?><ul id="pagination" class="pagination-sm"></ul><?php }?>
					</div>
				</div>
			<?php
			include("templates/foot.php");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>