<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<div class="panel-body">
					<form role="form" action="<?php echo $url ?>index.php?r=menu-proses" method="post">
						<header><h3>Buat Menu Baru</h3></header>
						<div class="form-group">
                            <label for="menu">Nama Menu</label>
                            <input type="text" class="form-control" name="menu">
                        </div>
						<div class="clear"></div>
						<div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" name="link">
                        </div>
						<div class="clear"></div>
                        <div class="form-group">
                            <label for="parent">Parent Menu</label>
							<select name="parent" class="form-control">
								<option value="">-- Tidak Ada Parent --</option>
								<? $dep=mysql_query("select * from tablemenu where parent='0'"); while($cet_dep=mysql_fetch_array($dep)){ ?> 
								<option value="<? echo $cet_dep['id'] ?>"><? echo $cet_dep['nama_menu'] ?></option>
								<? $dep1=mysql_query("select * from tablemenu where parent='".$cet_dep['id']."'"); while($cet_dep1=mysql_fetch_array($dep1)){  ?>
								<option value="<? echo $cet_dep1['id'] ?>"> - <? echo $cet_dep1['nama_menu'] ?></option>
								<? }} ?>	
                            </select>
                        </div>
						<div class="clear"></div>
                        <div class="form-group">
							<label>Icon</label><br /><br />
                            <input type="radio" name="icon" value="icn_new_article" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_new_article.png">
                           	<input type="radio" name="icon" value="icn_edit_article" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_edit_article.png">
                            <input type="radio" name="icon" value="icn_categories" style="margin-left:20px;margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_categories.png">
                            <input type="radio" name="icon" value="icn_tags" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_tags.png">
                            <input type="radio" name="icon" value="icn_add_user" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_add_user.png">
                            <input type="radio" name="icon" value="icn_view_users" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_view_users.png"> 
                            <input type="radio" name="icon" value="icn_profile" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_profile.png">
                            <input type="radio" name="icon" value="icn_folder" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_folder.png">
                            <input type="radio" name="icon" value="icn_photo" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_photo.png">
                            <input type="radio" name="icon" value="icn_audio" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_audio.png">
                            <input type="radio" name="icon" value="icn_video" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_video.png">
                            <input type="radio" name="icon" value="icn_settings" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_settings.png">
                            <input type="radio" name="icon" value="icn_security" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_security.png">
                            <input type="radio" name="icon" value="icn_jump_back" style="margin-left:20px; margin-bottom:10px;"><img src="<?php echo $url ?>images/icn_jump_back.png">
                            <input type="radio" name="icon" value="" style="margin-left:20px; margin-bottom:10px;" checked="checked">No Icon
                        </div>
                        <div class="clear"></div>
						<div class="submit_link">
							<input type="submit" value="Simpan" name="submit" class="btn btn-primary">
						</div>
					</form>
                </div>
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->