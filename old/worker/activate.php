<?php
	session_start();
	$title = "Account Activation";
	include("../assets/dbconfig.php");
	include("templates/utilHead.php");

	if(isset($_GET['secret']))
	{
		$secret = $_GET['secret'];
		$now = date("Y-m-d H:i:s");
		$queryCek = "SELECT * from loginWorker WHERE resetCode = '$secret' and validUntil > '$now'";
		$resultCek = mysql_query($queryCek);
		$getIdLogin = mysql_fetch_array($resultCek);
		$idLogin = $getIdLogin['idLogin'];
		if(mysql_num_rows($resultCek) > 0)
		{
			$queryActivate = "UPDATE loginWorker SET resetCode = '', validUntil='', active = 1 WHERE resetCode = '$secret'";
			//echo $queryActivate;
			mysql_query($queryActivate);
			$queryGetIdWorker = "SELECT idWorker from userWorker WHERE idLogin = $idLogin";
			$execGetIdWorker = mysql_query($queryGetIdWorker);
			$resultGetIDWorker = mysql_fetch_array($execGetIdWorker);
			$idWorker = $resultGetIDWorker['idWorker'];
			$url = $webRoot."show/worker.php?id=".$idWorker;
			$queryInsertSearchTable = "INSERT INTO tableSearchWorker(idTable, idWorker, url) VALUES(null, $idWorker,'$url')";
			$execInsertSearchTable = mysql_query($queryInsertSearchTable) or die("SQL ERROR");
			?>
				<div class="center">
					<p>Your account has been activated. Please sign in accordance with the information you have submitted.</p>
					<a href="login.php"><button class="btn btn-primary">Login</button></a>
				</div>
			<?php
		}
		else
		{
			?>
				<div class="center">
					<form class="form-inline" role="form" action="activate.php" method="get">
						<div class="form-group">
							<label class="sr-only" for="secret">Secret Code</label>
								<input type="text" class="form-control" id="secret" placeholder="Enter The Code" name="secret">
						</div>
						<button type="submit" class="btn btn-primary">Activate</button>
					</form>
					<br><br>
					<p>If you are having trouble registering, please contact us.</p>
				</div>
			<?php
		}
	}
	else
	{
		?>
			<div class="center">
				<form class="form-inline" role="form" action="activate.php" method="get">
					<div class="form-group">
						<label class="sr-only" for="secret">Secret Code</label>
							<input type="text" class="form-control" id="secret" placeholder="Enter The Code" name="secret">
					</div>
					<button type="submit" class="btn btn-primary">Activate</button>
				</form>
				<br><br>
				<p>If you are having trouble registering, please contact us.</p>
			</div>
		<?php
	}
	include("templates/utilFoot.php");
?>