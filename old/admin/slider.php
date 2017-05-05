<?php
	session_start();
	$title = "slider";
	include("../assets/dbconfig.php");
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
			header("Location:../worker/");
		}
		else if(isset($_SESSION['admin']))
		{
			include("templates/head.php");
			if(isset($_POST['update']))
			{
				$id = $_POST['id'];
				if(isset($_POST['active']))
				{
					$active = 1;
				}
				else
				{
					$active = 0;
				}
				$queryUpdate = "UPDATE tableSlider SET active = $active WHERE idTable = $id";
				$execUpdate = mysql_query($queryUpdate) or die('SQL Error');
			}
			
			if(isset($_POST['delete']))
			{
				$id = $_POST['id'];
				$getFile = "SELECT * FROM tableSlider WHERE idTable = $id";
				$execFile = mysql_query($getFile);
				$result = mysql_fetch_array($execFile);
				$file = $result['pathSlider'];
				$queryDelete = "DELETE FROM tableSlider WHERE idTable = $id";
				$execDelete = mysql_query($queryDelete) or die("SQL Error");
				unlink("../upload/slider/".basename($file));
			}

			if(isset($_POST['upload']))
			{
				if(!$_FILES['slider']['error'])
				{
					$namaSlider = $_POST['nama'];
					$file = $_FILES['slider'];
					$inputPathDB = $webRoot."upload/slider/";
					$uploadDir = $_SERVER['DOCUMENT_ROOT'].'/upload/slider/';

					$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
					$ext = strtolower($ext);
					$fileName = uniqid(time(), false).'.'.$ext;
					$destinationFile = $uploadDir.$fileName;
					$filePathDB = $inputPathDB.$fileName;

					if($_FILES['slider']['size'] > 2048000)
					{
						$_SESSION['overSize'] = "FILE MELEBIHI KETENTUAN.";
					}
					else
					{
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						if(!in_array($ext, $allowed))
						{
							$_SESSION['notAllowedExt'] = "FILE TIDAK SESUAI.";
						}
						else
						{
							if(move_uploaded_file($file['tmp_name'], $destinationFile))
							{
								$queryTambah = "INSERT INTO tableSlider VALUES(null, '$namaSlider', '$filePathDB', 0)";
								$execTambah = mysql_query($queryTambah) or die("SQL Error");
							}
						}
					}
				}
			}
			?>
				<div class="row">
					<div class="col-md-4">
						<h3><strong>Slider</strong></h3>
						<p class="help-block">Use 1200x200px</p>
						<button class="btn btn-sm btn-success" onclick="showForm();">Add Picture</button>
						
						<div id="showTambah" style="display:none; padding: 20px;">
							<form action="" class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
								<div class="form-group">
									<input type="text" class="form-control" name="nama" placeholder="Nama Slider">
								</div>
								<div class="form-group">
									<div class="input-group">
										<input type="file" class="form-control" name="slider">
										<span class="input-group-btn">
										  <button type="submit"class="btn btn-success" name="upload"><span class="glyphicon glyphicon-cloud-upload"></span></button>
										</span>
									</div>
								</div>
							</form>
						</div>
						
					</div>
					<div class="col-md-5"></div>
				</div>
				<div class="row">
					<div class="col-md-6" id="list-slider">
					<?php
						$getSlider = "SELECT * FROM tableSlider";
						$execSlider = mysql_query($getSlider);
						if(mysql_num_rows($execSlider) < 1)
						{
							echo "<em>Tidak ada Slider</em>";
						}
						else
						{
							?>
								<div class="table-responsive">
									<table class="table table-condensed table-hover">
										<thead>
											<tr>
												<th>Action</th>
												<th>Slider Name</th>
												<th>Active</th>
											</tr>
										</thead>
										<tbody>
											<?php		
												while($slider = mysql_fetch_array($execSlider))
												{
													?>
														<tr>
															<td>
																<input type="hidden" name="id" value="<?php echo $slider['idTable'];?>">
																<button class="btn btn-primary btn-success" onclick="show(<?php echo $slider['idTable'];?>);return false;">Show</button>
																<button type="submit" name="update" class="btn btn-primary btn-default">Update</button>
																<button type="button" data-toggle="modal" data-target="#delete<?php echo $slider['idTable'];?>" class="btn btn-primary btn-danger">Delete</button>
															</td>
															<td><?php echo $slider['namaSlider'];?></td>
															<td>
																<form action="slider.php" method="post">
																	<input type="checkbox" value="1" name="active" id="slide<?php echo $slider['idTable'];?>" <?php if($slider['active'] == 1){ echo "checked";}?>>
																</form>
															</td>
														</tr>
														<!-- Modal Delete Slider-->
														<div class="modal fade" id="delete<?php echo $slider['idTable'];?>" tabindex="-1" role="dialog" aria-labelledby="delete-label<?php echo $slider['idTable'];?>" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																		<h4 class="modal-title" id="delete-label<?php echo $slider['idTable'];?>">Delete Slider</h4>
																	</div>
																	<div class="modal-body">Are you sure want to delete this picture?</div>
																	<div class="modal-footer">
																		<form action="slider.php" method="post">
																			<input type="hidden" name="id" value="<?php echo $slider['idTable'];?>">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
																			<button type="submit" name="delete"class="btn btn-primary">Delete</button>
																		</form>
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
						}
						?>
					</div>
				</div>
			<div class="row">
				<div class="col-md-12" id="show-slider"></div>
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