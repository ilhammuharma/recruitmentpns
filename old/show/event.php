<?php
session_start();
$head = "event";
include("../assets/dbconfig.php");
include("templates/head.php");
?>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="box-no-border">
<?php
				if(!isset($_GET['id'])){
					header("Location:all-event.php");
				}else{
					$id = $_GET['id'];
					$getEvent = "SELECT * FROM event_calendar WHERE id = $id";
					$execEvent = mysql_query($getEvent);
					if(mysql_num_rows($execEvent) < 1){
						echo "<h3>Not a valid link.</h3>";
					}else{
						$event = mysql_fetch_array($execEvent);
						echo "<h3>".$event['title']."</h3>";
						$tanggal = new DateTime($event['event_date']);
						echo "<em>Diadakan pada: ".$tanggal->format('d M Y')."</em>";
						echo "<div>".html_entity_decode($event['description'])."</div>";
					}
				}
?>
				</div>
			</div>
			<?php include("templates/right-menu.php");?>
		</div>
	</div>
<?php
include("templates/foot.php");
?>