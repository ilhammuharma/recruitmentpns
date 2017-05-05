<?
//include("assets/dbconfig.php");
//echo $webRoot;
?>

        <!--Right Column Start-->
        <div class="col-md-3">
          <div class="box-no-border"> <!--padding dengan slider -->
            <?php if(!isset($_SESSION['username'])){ ?>
          <div <?php if($head=='index'){ echo 'id="hide-login"'; } ?>> <!-- Start hide login -->
            <div class="panel panel-primary"> <!--Panel Pelamar -->
              <div class="panel-heading">
              <h3 class="panel-title">USER PANEL</h3>
              </div>
              <div class="panel-body">
                <form class="form-horizontal" role="form" action="proseslogin.php" method="post">
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
                      <a href="wregister.php"><button type="button" class="btn btn-default">Sign Up</button></a>
                    </div>
                  </div>
                </form>
                <div class="list-group  lupa-password">
                  <a href="worker/forgot.php" class="list-group-item">Forgot Password</a>
                </div>
              </div>
            </div> <!--End Panel Pelamar -->
            </div><!-- End hide login -->
            <?php } ?>
            <!-- Panel Utility -->
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">UTILITY PANEL</h3>
              </div>
              <div class="list-group">
                  <a href="asearch.php" class="list-group-item">
                    Advanced Search
                  </a>
              </div>

<div class="kalender">
<!-- Calendar Start -->
<div id="Calendar"></div>
</div>
              <div class="list-group lupa-password">
                  <a href="show/all-event.php" class="list-group-item">
                    Show All Events
                  </a>
              </div>
<!-- Calendar End -->
            </div> <!-- End Panel Utility -->
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">PT PRATAMA NUSANTARA SAKTI</h3>
              </div>
<?
			//$aa=mysql_fetch_array(mysql_query("select * from aboutPPKPK where idTable='1'"));
              $queryGetPPKPK = "SELECT * FROM aboutppkpk WHERE idTable = '1'";
              $execGetPPKPK = mysql_query($queryGetPPKPK);
              $resultGetPPKPK = mysql_fetch_array($execGetPPKPK);
?>
              <div class="panel-body">
                Phone : 
                <?php 
                  if($resultGetPPKPK['telephone1'] != ""){ 
                    echo $resultGetPPKPK['telephone1'];
                  }else{ 
                    echo " - ";
                  } 
                  if($resultGetPPKPK['telephone2'] != ""){ 
                    echo ", ".$resultGetPPKPK['telephone2'];
                  } 
                ?></br>
                Email : <?php
                  if($resultGetPPKPK['email1'] != ""){
                    echo "<a href='mailto:".$resultGetPPKPK['email1']."'> ".$resultGetPPKPK['email1']."</a>";
                  }
                  if($resultGetPPKPK['email2'] != ""){
                    echo ", <a href='mailto:".$resultGetPPKPK['email2']."'>".$resultGetPPKPK['email2']."</a>";
                  }
                ?>
              </div>
            </div>
          </div> <!-- End Padding Slider -->
        </div> <!--End Right Column -->