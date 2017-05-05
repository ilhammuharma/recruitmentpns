<?php
session_start();
include("../../assets/dbconfig.php");

if(!isset($_POST['page']))
{
	echo "ERROR GETTING DATA";
}
else
{
	$page = $_POST['page'];
	$item_per_page = 10;
	$position = ($page * $item_per_page)-$item_per_page;
	$queryListEvent = "SELECT * from event_calendar ORDER BY id DESC LIMIT $position, $item_per_page";
	$execListEvent = mysql_query($queryListEvent);
	while($list = mysql_fetch_array($execListEvent))
	{
		?>
			<h4><a target="_blank" href="event.php?id=<?php echo $list['id'];?>"><?php echo $list['title'];?></a></h4>
			<div>
				<?php
					$date = new DateTime($list['event_date']);
					echo "<em>".$date->format('d M Y')."</em><br>";
					echo substr(strip_tags(html_entity_decode($list['description'])),0,250)."...<br/>"; 
				?>
			</div>
		<?php
	} 
}