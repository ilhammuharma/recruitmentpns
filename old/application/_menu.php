<form class="quick_search" style="width:300px; margin-left:18px;" method="get" action="<?php echo $link ?>">
    <input type="hidden" name="r" value="menu">
	<input type="text" value="Quick Search" name="cari" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
</form>

<!--body wrapper start-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<section class="panel">
				<div class="panel-body">
				<header><h3 class="tabs_involved">Data Menu</h3>
					<ul class="tabs"><div class="tambah" onclick="javascript:location.href='<?php echo $link ?>menu-add'">Tambah Menu</div></ul>
				</header>
				<?php
					$batas=20;
					$cari=!isset($_GET['cari']) ? '' : $_GET['cari'];
					$hal=!isset($_GET['hal']) ? '' : $_GET['hal'];
					if(empty($hal))
					{
						$posisi=0;
						$hal=1;	
					}
					else
					{
						$posisi=($hal-1)* $batas;
					}
					$kategori=mysql_query("Select * from tb_menu where nama_menu like '%$cari%' limit $posisi,$batas");
				?>
				<div class="tab_container">
					<table class="tablesorter" cellspacing="0"> 
						<thead> 
							<tr> 
								<th width="10%"></th> 
								<th>Nama Menu</th> 
								<th align="center">Icon</th> 
								<th align="center">Link</th> 
								<th align="center">Actions</th> 
							</tr> 
						</thead> 
						<tbody> 
							<?php
								$no=$posisi+1;
								while($cet_ven=mysql_fetch_array($kategori))
								{
									?>
										<tr> 
											<td align="center"><input type="checkbox"></td> 
											<td><?php echo $cet_ven['nama_menu'] ?></td> 
											<td align="center"><? if($cet_ven['icon']==''){}else{ ?><img src="<?php echo $url."images/".$cet_ven['icon'] ?>.png"  /> <? } ?></td> 
											<td align="center"><? if($cet_ven['link']==''){}else{ ?><?php echo $url.$cet_ven['link']; ?><? } ?></td> 
											<td align="center"><a href="<?php echo $link ?>menu-proses&kode=<?php echo $cet_ven['id'] ?>" onClick="return confirm('Anda yakin untuk menghapus data ini?');"><img src="images/icn_trash.png" /></a></td> 
										</tr> 
									<?php
									$no++; 
								} 
							?>
							<?php
								$tampil2= mysql_query("Select * from tb_menu where nama_menu like '%$cari%'");
								$jmldata=mysql_num_rows($tampil2);
								$jmlhalaman=ceil($jmldata/$batas);
								$file= $link."menu";
							?>	
						</tbody> 
					</table>
				</div><!-- end of .tab_container -->
			</section>
		</div>
	</div>
</div>
<!--body wrapper end-->
<?php
	$aa=$batas+1;
	if($jmldata<$aa){}
	else
	{
		?>
			<div class="pagging width_full">
				<?php
					//link ke halaman sebelumnya (previous)
					if($hal > 1)
					{
						$previous=$hal-1;
						echo "<A HREF=$file&hal=1&cari=$cari><<</A> 
							<A HREF=$file&hal=$previous&cari=$cari><</A> ";
					}
					else
					{ 
						echo "";
					}
					$angka=($hal > 3 ? " ... " : " ");
					for($i=$hal-2;$i<$hal;$i++)
					{
						if ($i < 1) 
						continue;
						$angka .= "<a href=$file&hal=$i&cari=$cari>$i</A> ";
					}
					$angka .= " <b>$hal</b> ";
					for($i=$hal+1;$i<($hal+3);$i++)
					{
						if ($i > $jmlhalaman) 
						break;
						$angka .= "<a href=$file&hal=$i&cari=$cari>$i</A> ";
					}
					$angka .= ($hal+2<$jmlhalaman ? " ...  
					  <a href=$file&hal=$jmlhalaman&cari=$cari>$jmlhalaman</A> " : " ");
					echo "$angka";
				
					//link kehalaman berikutnya (Next)
					if($hal < $jmlhalaman)
					{
						$next=$hal+1;
						echo "<A HREF=$file&hal=$next&cari=$cari>></A> 
						<A HREF=$file&hal=$jmlhalaman&cari=$cari>>></A> ";
					}
					else
					{ 
						echo " ";
					}
				?>
			</div>
		<?php 
	} 
?>
<div class="pagging width_full">
	<?phpecho "<p>Total Data : <font style='font-weight:bold;'>$jmldata</font> Data</p>";?>
</div>