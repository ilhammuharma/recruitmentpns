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
				<h3>List of Events</h3>
				<?php
					$per_page = 10;
					$queryTotal = "SELECT * FROM event_calendar";
					$execTotal = mysql_query($queryTotal);
					$queryListEvent = "SELECT * from event_calendar ORDER BY event_date DESC LIMIT 0, $per_page";
					$execListEvent = mysql_query($queryListEvent);
					$totalPosting = mysql_num_rows($execTotal);
					$pages = ceil($totalPosting/$per_page);
				?>
				<input type="hidden" value="<?php echo $pages;?>" id="pages">
				<div id="showAllEvent">
					<?php
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
					?>                
				</div>
					<?php 
						if($pages > 1)
						{ 
							?><ul id="all-event" class="pagination-sm"></ul>	<?php 
						} 
					?>
				</div>
			</div>
			<?php include("templates/right-menu.php");?>
		</div>
	</div>
<?phpinclude("templates/foot.php");?>