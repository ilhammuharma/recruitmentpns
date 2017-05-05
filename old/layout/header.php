<div class="header-section">

                <!--logo and logo icon start-->
                <div class="logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="<?=$base_url;?>">
                        <img src="assets/img/logo-icon.png" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                        <span class="brand-name"><img src="assets/img/logo2.png" alt=""></span>
                    </a>
                </div>

                <div class="icon-logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="<?=$base_url;?>">
                        <img src="assets/img/logo-icon.png" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->

                <!--mega menu start-->
                <div id="navbar-collapse-1" class="navbar-collapse collapse yamm mega-menu">
                    <ul class="nav navbar-nav">
                    </ul>
                </div>
                <!--mega menu end-->
                <div class="notification-wrap">
                <!--left notification start-->
                <div class="left-notification">
                <ul class="notification-menu">
                </ul>
                </div>
                <!--left notification end-->

                <!--right notification start-->
                <div class="right-notification">
                    <ul class="notification-menu">
                        

                        <li>
                            <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="assets/img/user.png" alt=""><?=$_SESSION['username']?>
                               
                            </a>
                            
                        </li>
                        <li>
							
                            <div class="sb-toggle-right">
                                <i class="fa fa-sign-out" alt="Logout" onclick="javascript:location.href='<?=$base_url?>logout.php'"></i>
                            </div>
							
                        </li>
                    </ul>
                </div>
                <!--right notification end-->
                </div>
            </div>