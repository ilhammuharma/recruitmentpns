<?php
	session_start();
	include("../assets/dbconfig.php");
	$title = "article";
	
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
			?>
				<div class="row">
					<div class="col-md-8">
						<h3><strong>List of Articles</strong></h3>
						<a href="post-articles.php"><button class="btn btn-sm btn-success">Add Article</button></a>
						<?php
							$getTotalArticle = "SELECT * FROM tableArticle";
							$execTotalArticle = mysql_query($getTotalArticle);
							$totalArticle = mysql_num_rows($execTotalArticle);
							$per_page = 10;
							$pages = ceil($totalArticle/$per_page);

							$getArticle = "SELECT * FROM tableArticle ORDER BY tanggal DESC LIMIT 0, $per_page";
							$execArticle = mysql_query($getArticle);
							if(mysql_num_rows($execArticle) < 1)
							{
								echo "Tidak ada artikel";
							}
							else
							{
								?>
									<input type="hidden" value="<?php echo $pages;?>" id="pages">
									<div class="table-responsive" id="showArticle">
										<table class="table table-hover table-condensed">
											<thead><tr><th>Action</th><th>Title</th><th>Date Posting</th></tr></thead>
											<tbody>
												<?php
													while($result = mysql_fetch_array($execArticle)){
														?>
															<tr>
																<td>
																	<a href="edit-article.php?id=<?php echo $result['idArticle'];?>"><button class="btn btn-primary">Edit</button></a>
																	<button class="btn btn-danger btn-primary" data-toggle="modal" data-target="#hapus<?php echo $result['idArticle'];?>">Delete</button>
																</td>
																<td>
																	<?php echo $result['judulArticle'];?>
																</td>
																<td>
																	<?php
																		$post = new DateTime($result['tanggal']);
																		echo $post->format('d M Y');
																	?>
																</td>
															</tr>
															
															<!-- Modal Delete Lowongan -->
															<div class="modal fade" id="hapus<?php echo $result['idArticle'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-label-hapus<?php echo $result['idArticle']?>" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																			<h4 class="modal-title" id="modal-label-hapus<?php echo $result['idArticle']?>"><?php echo $result['judulArticle'];?></h4>
																		</div>
																		<div class="modal-body">Are you sure want to delete this article?</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																			<a href="delete-article.php?id=<?php echo $result['idArticle'];?>"><button type="button" class="btn btn-primary" name="hapus-artikel">Delete</button></a>
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
								if($pages > 1)
								{
									?><ul id="pagination"class="pagination-sm"></ul><?php
								}
							}
						?>
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