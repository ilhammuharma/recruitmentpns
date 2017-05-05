<?php
	session_start();
	$head = "aboutus";
	include("assets/dbconfig.php");
	include("templates/head.php");
?>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<h2>PROFIL PERUSAHAAN</h2>
				<?php
				$getAbout = "SELECT about FROM aboutPPKPK WHERE idTable = 1";
				$execAbout = mysql_query($getAbout);
				$about = mysql_fetch_array($execAbout);
				echo html_entity_decode($about['about']);
				?>
			</div>
			<?php include("templates/right-menu.php");?>
		</div>
	</div>
<?php
	include("templates/foot.php");
?>