<?php
	session_start();
	$head = "";
	include("../assets/dbconfig.php");
	include("templates/head.php");
?>

<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="box-no-border">
				<?php
					if(!isset($_GET['id']))
					{
						header("Location:all-artikel.php");
					}
					else
					{
						$id = $_GET['id'];
						$getArticle = "SELECT * FROM tableArticle WHERE idArticle = $id";
						$execArticle = mysql_query($getArticle);
						if(mysql_num_rows($execArticle) < 1)
						{
							echo "<h3>Not a valid link.</h3>";
						}
						else
						{
							$article = mysql_fetch_array($execArticle);
							echo "<h3>".$article['judulArticle']."</h3>";
							$tanggal = new DateTime($article['tanggal']);
							echo "<em>Posted on: ".$tanggal->format('d M Y')."</em>";
							echo "<div>".html_entity_decode($article['isiArticle'])."</div>";
						}
					}	
				?>	
			</div>
		</div>
		<?php include("templates/right-menu.php");?>
	</div>
</div>
<?phpinclude("templates/foot.php");?>