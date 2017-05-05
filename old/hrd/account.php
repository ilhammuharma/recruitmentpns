<?php
session_start();
$title = "Department Account";
include("../assets/dbconfig.php");
if(!isset($_SESSION['username'])){
	header("Location:index.php");
}else{
	if(isset($_SESSION['hrd'])){
		include("templates/head.php");
		$idHrd = $_SESSION['idHrd'];
		$tab = "";
		$getIdLogin = "SELECT idLogin FROM userHrd WHERE idHrd = $idHrd";
		$queryIdLogin = mysql_query($getIdLogin);
		$fetchIdLogin = mysql_fetch_array($queryIdLogin);
		$idLogin = $fetchIdLogin['idLogin'];
		if(isset($_POST['save-company'])){
			$tab = "company";
			$id = $_POST['idHrd'];
			$namaPerusahaan = $_POST['nama'];
			$description = mysql_escape_string($_POST['description']);
			$alamat = $_POST['alamat'];
			$phone = "+62".$_POST['phone'];
			$fax = "+62".$_POST['fax'];
			$email = $_POST['email'];
			$url = $_POST['url'];
			$industri = $_POST['industri'];
			if($_POST['jumlah-pegawai'] == ""){
				$pegawai = 0;
			}else{
				$pegawai = $_POST['jumlah-pegawai'];
			}

			$queryUpdateCompany = "UPDATE userHrd SET namaPerusahaan = '$namaPerusahaan', deskripsiPerusahaan = '$description', emailPerusahaan = '$email', alamatPerusahaan = '$alamat', teleponPerusahaan = '$phone', faxPerusahaan = '$fax', urlWebsite = '$url', jenisIndustri = $industri, jumlahPegawai = $pegawai WHERE idHrd = $id";
			$execUpdateCompany = mysql_query($queryUpdateCompany) or die("SQL ERROR");
			//echo $execUpdateCompany;
			$queryUpdateLogin = "UPDATE loginHrd SET email = '$email' WHERE idLogin = $idLogin";
			$updateLogin = mysql_query($queryUpdateLogin) or die("SQL ERROR");

		}
		if(isset($_POST['save-contact'])){
			$tab = "contact";
			$idHrd = $_POST['idHrd'];
			$nama1 = $_POST['nama-hrd'];
			$jabatan1 = $_POST['jabatan'];
			$phone1 = "+62".$_POST['phone'];

			$nama2 = $_POST['nama-hrd-2'];
			$jabatan2 = $_POST['jabatan2'];
			$phone2 = "+62".$_POST['phone-2'];

			$queryUpdateContact = "UPDATE userHrd SET namaPenanggung1 = '$nama1', jabatanPenanggung1 = '$jabatan1', telpPenanggung1 = '$phone1', namaPenanggung2 = '$nama2', jabatanPenanggung2 = '$jabatan2', telpPenanggung2 = '$phone2' WHERE idHrd = $idHrd";
			$execUpdateContact = mysql_query($queryUpdateContact);
		}
		
		$queryShowCompany = "SELECT * FROM userHrd WHERE idHrd = $idHrd";
		$execShowCompany = mysql_query($queryShowCompany);
		$resultShowCompany = mysql_fetch_array($execShowCompany);
?>
		<h3>Department Account</h3>
		
		<!-- Tab Navigation Start -->
		<div class="background-tab">
		<ul class="nav nav-tabs nav-justified nav-pills" role="tablist">
			<li id="broder-tab" role="presentation"<?php if($tab == "" || $tab == "company"){echo " class='active'";}?>><a href="#company" role="tab" data-toggle="tab">Department Data</a></li>
			<li id="border-tab" role="presentation"<?php if($tab == "contact"){echo " class='active'";}?>><a href="#contact" role="tab" data-toggle="tab">Contact HRD</a></li>
		</ul>
		</div>
		<!-- Tab Navigation End -->
		
		<!-- Tab Content Start -->
		<div class="tab-content padding-top-tab"> 
			<!-- Company description start -->
			<div role="tabpanel" class="tab-pane<?php if($tab == "" || $tab == "company"){ echo " active";}?>" id="company">
				<div class="row">
					<div class="col-sm-8">
						<form class="form-horizontal" role="form" action="account.php" method="post">
							<input type="hidden" name="idHrd" value="<?php echo $idHrd; ?>">
							<div class="form-group">
								<label for="nama" class="col-sm-2 control-label">Department Name</label>
								<div class="col-sm-6">
									<input type="text" name="nama" class="form-control" id="nama" placeholder="Name" value="<?php echo $resultShowCompany['namaPerusahaan'];?>" required>
								</div>
							</div>
							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">Description</label>
								<div class="col-sm-8">
									<textarea name="description" id="description" rows="5" class="form-control" maxlength="1000"><?php echo $resultShowCompany['deskripsiPerusahaan'];?></textarea>
									<p class="help-block" style="text-align:right;"><span id="count"><?php echo strlen($resultShowCompany['deskripsiPerusahaan']);?></span>/1000</p>
								</div>

							</div>
							<div class="form-group">
								<label for="alamat" class="col-sm-2 control-label">Address</label>
								<div class="col-sm-8">
									<textarea name="alamat" id="alamat" rows="5" class="form-control"><?php echo $resultShowCompany['alamatPerusahaan'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="phone" class="col-sm-2 control-label">No. Telp.</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">+62</div>
										<input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number" value="<?php echo substr($resultShowCompany['teleponPerusahaan'], 3, 20);?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="fax" class="col-sm-2 control-label">No. Fax.</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">+62</div>
										<input type="tel" class="form-control" name="fax" id="fax" placeholder="Fax Number" value="<?php echo substr($resultShowCompany['faxPerusahaan'], 3, 20);?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-5">
									<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $resultShowCompany['emailPerusahaan'];?>">
								</div>
							</div>
							<div class="form-group">
								<label for="url" class="col-sm-2 control-label">Website</label>
								<div class="col-sm-6">
									<div class="input-group">
										<div class="input-group-addon">http://</div>
										<input class="form-control" name="url" id="url" placeholder="Website" value="<?php echo $resultShowCompany['urlWebsite'];?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="industri" class="col-sm-2 control-label">Type of Industry</label>
								<div class="col-sm-5">
<?php
									$queryIndustri = "SELECT * FROM bidangUsaha ORDER BY namaBidangUsaha ASC";
									$execIndustri = mysql_query($queryIndustri);
?>
									<select name="industri" id="industri" class="form-control">
<?php
										while($resultIndustri = mysql_fetch_array($execIndustri)){
?>
											<option value="<?php echo $resultIndustri['idUsaha'];?>" <?php if($resultIndustri['idUsaha'] == $resultShowCompany['jenisIndustri']){ echo "selected"; }?>><?php echo $resultIndustri['namaBidangUsaha'];?></option>
<?php
										}
?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="jumlah-pegawai" class="col-sm-2 control-label">Number of Employees</label>
								<div class="col-sm-4">
									<div class="input-group">
										<div class="input-group-addon"><u>+</u></div>
										<input type="number" class="form-control" name="jumlah-pegawai" id="jumlah-pegawai" placeholder="Number of Employees" value="<?php echo $resultShowCompany['jumlahPegawai'];?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-5">
									<button type="submit" class="btn btn-primary" name="save-company">Save</button>
								</div>
							</div>
						</form>
					</div> 
					<div class="col-sm-4">
						<div id="imageChange">
							<img src="<?php
								if($resultShowCompany['pathLogo'] != $webRoot.'upload/company_logo.png'){
									echo $resultShowCompany['pathLogo'];
								}else{
									echo $webRoot.'upload/company_logo.png';
								}
								?>" alt="<?php echo $resultShowCompany['namaPerusahaan'];?>" class="img-thumbnail img-responsive" id="user-photo">
						</div>
						<div class="status"></div>
						<p class="help-block">Click on the image to replace the latest photos.</p>
						<p class="help-block">*Maximum file is 1 MB.</p>
						<p class="help-block">**Files that can be uploaded are jpg, jpeg, png, gif.</p>
					</div>
				</div>
			</div><!-- Company description end -->
			
			<!-- HRD Contact Start-->
			<div role="tabpanel" class="tab-pane<?php if($tab == "contact"){ echo " active";}?>" id="contact">
				<div class="row">
					<div class="col-sm-8">
						<form class="form-horizontal" role="form" action="account.php" method="post">
							<input type="hidden" name="idHrd" value="<?php echo $idHrd;?>">
							<div class="form-group">
								<label for="" class="col-sm-4 control-label">Person In Charge</label>
							</div>
							<div class="form-group">
								<label for="nama-hrd" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="nama-hrd" id="nama-hrd" placeholder="Name" value="<?php echo $resultShowCompany['namaPenanggung1'];?>">
								</div>
							</div>
							<div class="form-group">
								<label for="jabatan" class="col-sm-2 control-label">Position</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Position" value="<?php echo $resultShowCompany['jabatanPenanggung1'];?>">
								</div>
							</div>
							<div class="form-group">
								<label for="phone" class="col-sm-2 control-label">No. Telp.</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">+62</div>
										<input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number" value="<?php echo substr($resultShowCompany['telpPenanggung1'], 3, 20);?>">
									</div>
								</div>
							</div>
							<div class="form-group has-success">
								<label for="" class="col-sm-4 control-label">Another Person In Charge*</label>
							</div>
							<div class="form-group has-success">
								<label for="nama-hrd-2" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="nama-hrd-2" id="nama-hrd-2" placeholder="Name" value="<?php echo $resultShowCompany['namaPenanggung2'];?>">
								</div>
							</div>
							<div class="form-group has-success">
								<label for="jabatan2" class="col-sm-2 control-label">Position</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="jabatan2" id="jabatan2" placeholder="Position" value="<?php echo $resultShowCompany['jabatanPenanggung2'];?>">
								</div>
							</div>
							<div class="form-group has-success">
								<label for="phone-2" class="col-sm-2 control-label">No. Telp.</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">+62</div>
										<input type="tel" class="form-control" name="phone-2" id="phone-2" placeholder="Phone Number" value="<?php echo substr($resultShowCompany['telpPenanggung2'], 3, 20);?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-5">
									<p class="help-block">*May not be filled.</p>
									<button type="submit" class="btn btn-primary" name="save-contact">Save</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div><!-- HRD COntact End -->

		</div><!-- Tab Content End -->
<?php
		include("templates/foot.php");
	}else{
		if(isset($_SESSION['admin'])){
			header("Location:../admin/");
		}else{
			header("Location:../worker/");
		}
	}
}
?>