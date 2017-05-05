<?php
session_start();
include("../../assets/dbconfig.php");
$username = $_SESSION['username'];
if(!isset($_SESSION['username'])){
	echo "ERROR LOGIN";
}else{
	if(isset($_POST['page'])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$item_per_page = 5;
		if(!is_numeric($page_number)){
			die('Invalid!');
		}

		$position = ($page_number * $item_per_page)-$item_per_page;

		$getEvents = "SELECT * FROM event_calendar ORDER BY event_date DESC LIMIT $position, $item_per_page";
		$execEvents = mysql_query($getEvents);
?>
		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					<th>Nama Event</th>
					<th>Deskripsi</th>
					<th>Tanggal</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
			while($result = mysql_fetch_array($execEvents)){
	?>
				<tr>
					<td><?php echo $result['title']?></td>
					<td><?php echo strip_tags(html_entity_decode($result['description']));?></td>
					<td>
					<?php
						$date = new DateTime($result['event_date']);
						echo $date->format('d M Y');
					?>
					</td>
					<td>
						<a href="edit-event.php?id=<?php echo $result['id'];?>"><button class="btn btn-xs btn-default">Edit</button></a>
						<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#delete<?php echo $result['id'];?>">Hapus</button>
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
				      <div class="modal-body">
				        Anda yakin untuk menghapus event ini?
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				        <a href="delete-event.php?id=<?php echo $result['id'];?>"><button type="button" class="btn btn-primary" name="delete-event">Hapus</button></a>
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