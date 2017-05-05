<?php
	session_start();
	$head = "press";
	include("../assets/dbconfig.php");
	include("templates/head.php");
?>

<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="box-no-border">
				<h3>ARTIKEL</h3>
				<?php
					$per_page = 10;
					$queryTotal = "SELECT * FROM tableArticle";
					$execTotal = mysql_query($queryTotal);
					$queryListArticle = "SELECT * from tableArticle ORDER BY idArticle DESC LIMIT 0, $per_page";
					$execListArticle = mysql_query($queryListArticle);
					$totalPosting = mysql_num_rows($execTotal);
					$pages = ceil($totalPosting/$per_page);
				?>
				<input type="hidden" value="<?php echo $pages;?>" id="pages">
				<div id="showAllArticle">
					<?php
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
					?>                
				</div>
				<?php 
					if($pages > 1)
					{ 
						?>
							<ul id="all-article" class="pagination-sm"></ul>	
						<?php 
					} 
				?>
			</div>
		</div>
		<?php include("templates/right-menu.php");?>
	</div>
</div>
<?phpinclude("templates/foot.php");?>