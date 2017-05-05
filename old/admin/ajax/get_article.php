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

		$getArticle = "SELECT * FROM tableArticle ORDER BY tanggal DESC LIMIT $position, $item_per_page";
		$execArticle = mysql_query($getArticle);
?>
		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					<th>Judul</th>
					<th>Tanggal Posting</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
				while($result = mysql_fetch_array($execArticle)){
?>
				<tr>
					<td>
						<?php echo $result['judulArticle'];?>
					</td>
					<td>
						<?php
							$post = new DateTime($result['tanggal']);
							echo $post->format('d M Y');
						?>
					</td>
					<td>
						<a href="edit-article.php?id=<?php echo $result['idArticle'];?>"><button class="btn btn-xs btn-default">Edit</button></a>
						<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus<?php echo $result['idArticle'];?>">Hapus</button>
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
				      <div class="modal-body">
				        Apakah Anda yakin untuk menghapus artikel ini?
				      </div>
				      <div class="modal-footer">
	        	        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	        	        <a href="delete-article.php?id=<?php echo $result['idArticle'];?>"><button type="button" class="btn btn-primary" name="hapus-artikel">Hapus</button></a>
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