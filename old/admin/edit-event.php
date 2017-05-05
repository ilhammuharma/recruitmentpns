<?php
	session_start();
	include("../assets/dbconfig.php");
	$title = "event";
	
	if(!isset($_SESSION['username']))
	{
		header("Location:index.php");
	}
	else
	{
		if(isset($_SESSION['hrd']))
		{
			header("Location:../hrd/");
		}
		else if(isset($_SESSION['worker']))
		{
			header("Location: ../worker/");
		}
		else if(isset($_SESSION['admin']))
		{
			include("templates/head.php");
			if(isset($_POST['edit-event']))
			{
				$id = $_POST['id'];
				$nama = $_POST['nama'];
				$tanggal = $_POST['tanggal'];
				$deskripsi = htmlentities($_POST['deskripsi']);

				$queryUpdate = "UPDATE event_calendar SET event_date = STR_TO_DATE('$tanggal', '%d-%m-%Y'), title = '$nama', description = '$deskripsi' WHERE id = $id";
				$execUpdate = mysql_query($queryUpdate) or die("SQL ERROR");
				?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>The article was successfully edited.
					</div>
					<a href="event.php"><button class="btn btn-success">Back</button></a>
				<?php
			}
			else
			{
				if(!isset($_GET['id']))
				{
					header("Location:event.php");
				}
				else
				{
					$id = $_GET['id'];
					$queryEditEvent = "SELECT * FROM event_calendar WHERE id = $id";
					$execEditEvent = mysql_query($queryEditEvent);
					$event = mysql_fetch_array($execEditEvent);
					$eventDate = new DateTime($event['event_date']);
					$date = $eventDate->format('d-m-Y');
					?>
						<h3>Edit Event</h3>
						<form action="edit-event.php" role="form" class="form-horizontal" method="post">
							<input type="hidden" value="<?php echo $event['id'];?>" name="id">
							<div class="form-group">
								<label for="nama" class="col-md-2 control-label">Name</label>
								<div class="col-md-10">
									<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Event" value="<?php echo $event['title'];?>" required>
								</div>
							</div>
							<div class="form-group">
								<label for="tanggal" class="col-md-2 control-label">Date</label>
								<div class="col-md-6">
									<input type="text" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo $date;?>"required>
								</div>
							</div>
							<div class="form-group">
								<label for="deskripsi" class="col-md-2 control-label">Description</label>
								<div class="col-md-10">
									<textarea name="deskripsi" id="deskripsi" rows="8" class="form-control"><?php echo html_entity_decode($event['description']);?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-2 col-md-6">
									<button type="submit" name="edit-event" class="btn btn-primary btn-sm">Save</button>
								</div>
							</div>
						</form>
					<?php
				}
			}
			include("templates/foot.php");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>