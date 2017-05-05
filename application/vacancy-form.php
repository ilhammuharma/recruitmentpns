<?
	if(isset($_GET['idvacancy']))
	{
		$idvacancy = $_GET['idvacancy'];
		$data = mysql_fetch_array(mysql_query("select * from vacancy where idvacancy='$idvacancy'"));
		
		/*$fptk = "select * from fptk where nomorFptk = '".$data['fptk']."' and pic = '".$cet_user['idWorker']."' ";
		$execfptk = mysql_query($fptk);
		$cet_fptk = mysql_fetch_array($execfptk);*/
	}
?>

<!-- page head start-->
<div class="page-head">
	<h3 class="m-b-less">
	Vacancy
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
		<ol class="breadcrumb m-b-less bg-less">
			<li>Home</li>
			<li>Vacancy</li>
			<?if(isset($_GET['idvacancy'])){ ?>
			<li class="active">Edit Vacancy</li>
			<? }else{?>
			<li class="active">Add New Vacancy</li>
			<? } ?>
		</ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					<?if(isset($_GET['idvacancy']))
					{ ?>Edit Vacancy<? }
					else
					{?>Add New Vacancy<? } ?>
				</header>
				<div class="panel-body spinner">
					<form role="form" class="form-horizontal" id="newVacancy" action="<?=$base_url?>index.php?r=vacancy-proses" method="post">
					<div class="form-group">
							<label for="fptk" class="col-sm-2 control-label">No.FPTK</label>
							<div class="col-lg-10">
								<select name="fptk" id="fptk" class="form-control select2">
									<option value=""></option>
									<optgroup label="-- Select No.FPTK --">
									<?
										$fptk=mysql_query("select * from fptk where namaRecruitmentSuperintendent!='' and tanggalRecruitmentSuperintendent!='' and pic = '".$_SESSION['id']."' ORDER BY tanggalDibuat DESC"); 
										while($cet_fptk=mysql_fetch_array($fptk))
										{ ?> <option <?=($cet_fptk['nomorFptk']==$data['fptk'])?'selected':'';?> value="<?=$cet_fptk['nomorFptk'] ?>"><? echo $cet_fptk['nomorFptk'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="department" class="col-sm-2 control-label">Department</label>
							<div class="col-lg-10">
								<select name="department" id="department" class="form-control select2">
									<option value=""></option>
									<optgroup label="-- Select Department --">
									<? 
										$dep=mysql_query("select * from kategoriDepartemen order by namaDepartemen"); 
										while($cet_dep=mysql_fetch_array($dep))
										{ ?> <option <?=($cet_dep['idDepartemen']==$data['department'])?'selected':'';?> value="<?=$cet_dep['idDepartemen'] ?>"><? echo $cet_dep['namaDepartemen'] ?></option><? }
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="section" class="col-sm-2 control-label">Section</label>
							<div class="col-lg-10">
								<select name="section" id="section" class="form-control select2">
									<option value=""></option>
									<optgroup label="-- Select Section --">
									<? 
										$sec=mysql_query("select * from kategoriSection order by namaSection"); 
										while($cet_sec=mysql_fetch_array($sec))
										{ ?> <option <?=($cet_sec['idSection']==$data['section'])?'selected':'';?> value="<?=$cet_sec['idSection'] ?>"><? echo $cet_sec['namaSection'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="position" class="col-sm-2 control-label">Position</label>
							<div class="col-lg-10">
								<select name="position" id="position" class="form-control select2">
									<option value=""></option>
									<optgroup label="-- Select Position --">
									<? 
										$jab=mysql_query("select * from kategoriKerja order by namaKategori"); 
										while($cet_jab=mysql_fetch_array($jab))
										{ ?> <option <?=($cet_jab['idKategori']==$data['position'])?'selected':'';?> value="<?=$cet_jab['idKategori'] ?>"><? echo $cet_jab['namaKategori'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label">Level</label>
							<div class="col-lg-10">
								<select name="level" id="level" class="form-control select2">
									<option value=""></option>
									<optgroup label="-- Select Level --">
									<? 
										$lev=mysql_query("select * from kategoriLevel order by namaLevel"); 
										while($cet_lev=mysql_fetch_array($lev))
										{ ?> <option <?=($cet_lev['idLevel']==$data['level'])?'selected':'';?> value="<?=$cet_lev['idLevel'] ?>"><? echo $cet_lev['namaLevel'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="location" class="col-sm-2 control-label">Placed Location</label>
							<div class="col-lg-10">
								<select name="location" id="location" class="form-control select2">
									<option value=""></option>
									<optgroup label="-- Select Location --">
									<? 
										$dis=mysql_query("select * from kategoriDistrik order by namaDistrik"); 
										while($cet_dis=mysql_fetch_array($dis))
										{ ?> <option <?=($cet_dis['idDistrik']==$data['location'])?'selected':'';?> value="<?=$cet_dis['idDistrik'] ?>"><? echo $cet_dis['namaDistrik'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="experience" class="col-sm-2 control-label">Experience</label>
							<div class="col-lg-10">
								<input type="text" name="experience" class="form-control" id="experience" value="<?=$data['experience']?>" placeholder="Only number (example, 2)" required>
							</div>
						</div>
						<div class="form-group">
							<label for="salary" class="col-sm-2 control-label">Salary</label>
							<div class="col-lg-10">
								<div class="input-group">
									<div class="input-group-addon"><u>+</u> Rp</div>
									<input type="text" name="salary" class="form-control" id="salary" value="<?=$data['salary']?>" placeholder="Only number (example, 5000000)"required>
								</div>
								<p class="help-block">Enter zero (0) if not given salary offer.</p>
							</div>
						</div>
						<div class="form-group">
							<label for="education" class="col-sm-2 control-label">Minimum Education</label>
							<div class="col-lg-10">
								<select name="education" id="education" class="form-control select2" required>
								<option value=""></option>
									<optgroup label="-- Select Education --">
									<? 
										$edu=mysql_query("select * from tingkatPendidikan order by gradePendidikan"); 
										while($cet_edu=mysql_fetch_array($edu))
										{ ?> <option <?=($cet_edu['gradePendidikan']==$data['education'])?'selected':'';?> value="<?=$cet_edu['gradePendidikan'] ?>"><? echo $cet_edu['namaPendidikan'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="major" class="col-sm-2 control-label">Major</label>
							<div class="col-lg-10">
								<select name="major" id="major" class="form-control select2" required>
								<option value=""></option>
									<optgroup label="-- Select Major --">
									<? 
										$jur=mysql_query("select * from tableJurusan order by namaJurusan"); 
										while($cet_jur=mysql_fetch_array($jur))
										{ ?> <option <?=($cet_jur['idJurusan']==$data['major'])?'selected':'';?> value="<?=$cet_jur['idJurusan'] ?>"><? echo $cet_jur['namaJurusan'] ?></option><? } 
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="gpa" class="col-sm-2 control-label">Minimum GPA</label>
							<div class="col-lg-10">
								<input type="text" name="gpa" class="form-control" id="gpa" value="<?=$data['gpa']?>" placeholder="Only number (example, 3.0)" required>
								<p class="help-block">*Enter zero (0) if it does not require a minimum GPA.</p>
								<p class="help-block">**Use dot (.) as the decimal separator.</p>
							</div>
						</div>
						<div class="form-group">
							<label for="age" class="col-sm-2 control-label">Maximum Age</label>
							<div class="col-lg-10">
								<input type="text" name="age" class="form-control" id="age" value="<?=$data['age']?>" placeholder="Only number (example, 30)" required>
								<p class="help-block">*Enter zero (0) if it does not require a limit age.</p>
							</div>
						</div>
						<div class="form-group">
							<label for="duedate" class="col-sm-2 control-label">Close Date</label>
							<div class="col-lg-10">
								<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" class="input-append date dpYears" required>
									<input type="text" name="duedate" class="form-control" value="<?=date("d-m-Y", strtotime($data['duedate']))?>" required>
									<span class="input-group-btn add-on">
										<button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
								<span class="help-block">Select date</span>
							</div>
						</div>
						<div class="form-group">
							<label for="other" class="col-sm-2 control-label">Preferred Qualifications</label>
							<div class="col-lg-10">
								<textarea name="other" id="other" class="form-control" value="<?=$data['other']?>"><?=$data['other']?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="jobdes" class="col-sm-2 control-label">Responsibilities</label>
							<div class="col-lg-10">
								<textarea name="jobdes" id="jobdes" class="form-control" value="<?=$data['jobdes'];?>"><?=$data['jobdes'];?></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-2">
								<?if(isset($_GET['idvacancy'])){ ?>
								<input type="hidden" name="idvacancy" value="<?=$idvacancy?>"> 
								<input class="btn btn-success" type="submit" name="edit" value="Edit">
								<? }else{?>
								<input class="btn btn-success" type="submit" name="save" value="Save">
								<? } ?>
								<button type="button" class="btn btn-default" onclick="javascript:location.href='<?=$base_url?>index.php?r=vacancy'">Cancel</button>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->