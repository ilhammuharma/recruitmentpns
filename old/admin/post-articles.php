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
			if(isset($_POST['save-article']))
			{
				$judul = addslashes($_POST['judul']);
				$isi = htmlentities($_POST['isi']);
				$queryInsertArticle = "INSERT INTO tableArticle(judulArticle, isiArticle) VALUES('$judul', '$isi')";
				$execInsertArticle = mysql_query($queryInsertArticle) or die("SQL ERROR");
				?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>The article was successfully posted.
					</div>
					<a href="articles.php"><button class="btn btn-success">Back</button></a>
				<?php
			}
			else
			{
				?>
					<h3>Posting Article</h3>
					<form action="post-articles.php" class="form-horizontal" role="form" method="post">
						<div class="form-group">
							<label for="judul" class="col-md-2 control-label">Title</label>
							<div class="col-md-5">
								<input type="text" class="form-control" name="judul" id="judul" placeholder="The Title of the Article" required>
							</div>
						</div>
						<div class="form-group">
							<label for="isi" class="col-md-2 control-label">Content</label>
							<div class="col-md-8">
								<textarea name="isi" id="isi" rows="8" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-3">
								<button type="submit" class="btn btn-primary" name="save-article">Save</button>
							</div>
						</div>
					</form>
				<?php
			}
			include("templates/foot.php");
		}
		else
		{
			header("Location:index.php");
		}
	}
?>