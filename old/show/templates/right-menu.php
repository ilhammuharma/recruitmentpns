<!--Right Column Start-->
<div class="col-md-3">
    <div class="box-no-border"> <!--padding dengan slider -->
        <?php 
			if(!isset($_SESSION['username']))
			{ 	
				?>
					<div <?php if($head=='index'){ echo 'id="hide-login"'; } ?>> <!-- Start hide login -->
						<div class="panel panel-primary"> <!--Applicant Panel -->
							<div class="panel-heading">
								<h3 class="panel-title">APPLICANT PANEL</h3>
							</div>
							<div class="panel-body">
								<form class="form-horizontal" role="form" action="../worker/index.php" method="post">
									<div class="form-group">
										<div class="col-sm-12">
											<input name="username" type="text" class="form-control" id="username" placeholder="Username" required>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-primary">Sign In</button>
											<a href="../wregister.php"><button type="button" class="btn btn-default">Sign Up</button></a>
										</div>
									</div>
								</form>
								<div class="list-group  lupa-password">
									<a href="../worker/forgot.php" class="list-group-item">Forgot Password</a>
								</div>
							</div>
						</div> <!--End Panel Pelamar -->
					</div><!-- End hide login -->
				<?php 
			} 
		?>
        <!-- Utility Panel -->
        <div class="panel panel-primary">
            <div class="panel-heading">
				<h3 class="panel-title">UTILITY PANEL</h3>
            </div>
            <div class="list-group">
                <a href="../asearch.php" class="list-group-item">Advanced Search</a>
            </div>
			<div class="kalender">
				<!-- Calendar Start -->
				<div id="Calendar"></div>
			</div>
            <div class="list-group lupa-password">
                <a href="all-event.php" class="list-group-item">Show All Events</a>
            </div>
			<!-- Calendar End -->
        </div> <!-- End Panel Utility -->
        <div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">PT PRATAMA NUSANTARA SAKTI</h3>
			</div>
			<div class="panel-body">
				Phone : (021) 57941785 </br>
				Email : <a href="mail-to:career@pns.co.id">career@pns.co.id</a>, <a href="mail-to:career@pns.co.id">career@pns.co.id</a>
			</div>
        </div>
    </div> <!-- End Padding Slider -->
</div> <!--End Right Column -->