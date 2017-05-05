

<div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg">
                <a href="index.html">
                    <img src="assets/img/logo-icon.png" alt="">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <span class="brand-name"><img src="assets/img/logo2.png" alt=""></span>
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
				
                <div class=" search-field">  </div>
                <!-- visible small devices end-->

                <!--sidebar nav start-->
				<?
				$cc=explode('/',$_SERVER['REQUEST_URI']);
				$oo=mysql_fetch_array(mysql_query("select id, parent from tablemenu where link='".$cc['1']."'"));
				?>
				<ul class="nav nav-pills nav-stacked side-navigation">
				<li  class="<? if($cc['1']==''){echo"nav-active";}else{}?>"><a href="<?=$base_url;?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
				<?
				
				//echo $cc['1'];
				$query_menu=mysql_query("select * from tablemenuuser inner join tablemenu on tablemenuuser.id_menu=tablemenu.id where tablemenuuser.id_user='".$_SESSION['id']."' and tablemenu.parent='0' order by tablemenu.order_data asc"); 
				while($data=mysql_fetch_array($query_menu)){ 
				$cek=mysql_num_rows(mysql_query("select id from tablemenu where parent='".$data['id']."'"));
				if($cek!=0){$class="menu-list";}else{$class="";}
				$query_submenu=mysql_query("select * from tablemenuuser inner join tablemenu on tablemenuuser.id_menu=tablemenu.id where tablemenuuser.id_user='".$_SESSION['id']."' and tablemenu.parent='".$data['id']."'  order by tablemenu.order_data asc"); 
				if($oo['parent']==$data['id']){$active1="nav-active";}else{$active1="";}
				
				 ?>
				
				<li class="<?=$class?> <?=$active1?>">
					<a href="<?=$base_url.$data['link']?>"><i class="fa <?=$data['icon']?>"></i><span><?=$data['nama_menu']?></span></a>
						<ul class="child-list">
						<? while($submenu=mysql_fetch_array($query_submenu)){ if($oo['id']==$submenu['id']){$active2="active";}else{$active2="";}?>
							<li class="<?=$active2?>"><a href="<?=$submenu['link']?>"><?=$submenu['nama_menu']?></a></li>
						<? } ?>
							
						</ul>
				</li>
				<? } ?>
					
					
				</ul>
                <!--sidebar nav end-->
            </div>
        </div>