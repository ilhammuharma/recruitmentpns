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
	$queryListArticle = "SELECT * from tableArticle ORDER BY idArticle DESC LIMIT $position, $item_per_page";
	$execListArticle = mysql_query($queryListArticle);
	while($list = mysql_fetch_array($execListArticle))
	{
		?>
			<h4><a target="_blank" href="article.php?id=<?php echo $list['idArticle'];?>"><?php echo $list['judulArticle'];?></a></h4>
			<div>
				<?php
					echo substr(strip_tags(html_entity_decode($list['isiArticle'])), 0, 250)."...<br/>";
					$date = new DateTime($list['tanggal']);
					echo "<em>".$date->format('d M Y')."</em>";
				?>
			</div>
		<?php
	} 
}