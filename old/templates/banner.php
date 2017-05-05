<?php
          $getSlider = "SELECT * FROM tableSlider WHERE active = 1";
          $execIndicator = mysql_query($getSlider);
          if(mysql_num_rows($execIndicator) > 0){
?>
<!-- Start Carousel -->
        <div id="slider" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php
              $x = 0;
              while($indicators = mysql_fetch_array($execIndicator)){
            ?>
              <li data-target="#slider<?php echo $indicators['idTable']?>" data-slide-to="<?php echo $x;?>" <?php if($x == 0){echo "class='active'";}?>></li>
            <?php
                $x++;
              }
            ?>
          </ol>
          <div class="carousel-inner">
          <?php
            $execSlider = mysql_query($getSlider);
            $y = 0;
            while($slides = mysql_fetch_array($execSlider)){
          ?>
            <div class="item <?php if($y == 0){ echo "active";}?>">
              <img src="<?php echo $slides['pathSlider'];?>" alt="<?php echo $slides['namaSlider'];?>">
              <!-- <div class="container">
                <div class="carousel-caption">
                  <h1>Example headline.</h1>
                  <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
                  <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                </div>
              </div> -->
            </div>
          <?php
            $y++;
            }
          ?>
          </div>
          <a class="left carousel-control" href="#slider" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
          <a class="right carousel-control" href="#slider" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div><!-- /.carousel -->
<?php
        }
?>     