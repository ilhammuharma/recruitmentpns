<?php
	session_start();
	include("../../assets/dbconfig.php");
	$username = $_SESSION['username'];
	$queryGetIDLogin = "SELECT idLogin FROM loginHrd WHERE username = '$username'";
	$execGetIDLogin = mysql_query($queryGetIDLogin) or die();
	$IDLogin = mysql_fetch_array($execGetIDLogin);
	$id = $IDLogin['idLogin'];
	if(!$_FILES['file']['error'])
	{
		$file = $_FILES['file'];
		//echo $file['tmp_name'];
		$inputPathDB = $webRoot."upload/hrd/";
		$uploadDir = $_SERVER['DOCUMENT_ROOT'].'/upload/hrd/';
		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
		$ext = strtolower($ext);
		$fileName = uniqid(time(), false).'.'.$ext;
		$destinationFile = $uploadDir.$fileName;
		$filePathDB = $inputPathDB.$fileName;
		if($_FILES['file']['size'] > 1024000)
		{
			echo "file_exceed";
		}
		else
		{
			$allowed =  array('gif','png' ,'jpg', 'jpeg');
			if(!in_array($ext, $allowed))
			{
				echo "type_error";
			}
			else
			{
				if(move_uploaded_file($file['tmp_name'], $destinationFile))
				{
					if($ext == 'jpeg' || $ext == 'jpg')
					{
						$img_src = imagecreatefromjpeg($destinationFile);
						$img_src_small = imagecreatefromjpeg($destinationFile);
					}
					else if($ext == 'png')
					{
						$img_src = imagecreatefrompng($destinationFile);
						$img_src_small = imagecreatefrompng($destinationFile);
					}
					else
					{
						$img_src = imagecreatefromgif($destinationFile);
						$img_src_small = imagecreatefromgif($destinationFile);
					}
					$src_width = imagesx($img_src);
					$src_height = imagesy($img_src);
					if($src_width > 300)
					{
						$dst_width = 300;
						$dst_height = ($dst_width/$src_width)*$src_height;
						$im = imagecreatetruecolor($dst_width, $dst_height);
						imagecopyresampled($im, $img_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
						if($ext == "jpeg" || $ext == "jpg")
						{
							imagejpeg($im, $uploadDir."resize_".$fileName);
						}
						else if($ext == "png")
						{
							imagepng($im, $uploadDir."resize_".$fileName);
						}
						else
						{
							imagegif($im, $uploadDir."resize_".$filename);
						}
						unlink($destinationFile);
						$filePathDB = $inputPathDB.'resize_'.$fileName;
					}
					$dst_width_small = 100;
					$dst_height_small = ($dst_width_small/$src_width)*$src_height;
					$im_small = imagecreatetruecolor($dst_width_small, $dst_height_small);
					imagecopyresampled($im_small, $img_src, 0, 0, 0, 0, $dst_width_small, $dst_height_small, $src_width, $src_height);
					if($ext == "jpeg" || $ext == "jpg")
					{
						imagejpeg($im_small, $uploadDir."resize_small_".$fileName);
					}
					else if($ext = "png")
					{
						imagepng($im_small, $uploadDir."resize_small_".$fileName);
					}
					else
					{
						imagegif($im_small, $uploadDir."resize_small_".$fileName);
					}
					$filePathDBSmall = $inputPathDB.'resize_small_'.$fileName;
					$queryUpdatePathFoto = "UPDATE userHrd SET pathLogo = '$filePathDB', smallLogo = '$filePathDBSmall' WHERE idLogin = $id";
					$execQueryUpdatePathFoto = mysql_query($queryUpdatePathFoto) or die();
					echo $filePathDB;
				}
				else
				{
					echo 'upload_error';
				}
			}
		}
	}
	else
	{
		echo "upload_error";
	}
?>