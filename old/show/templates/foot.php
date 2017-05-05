			<!-- Start Footer -->
				<!-- <div class="top-padding-footer">
					<div class="footer navbar-default"> 
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="copyright">
										PT PRATAMA NUSANTARA SAKTI <br/>
										REKRUTMEN PEGAWAI BERBASIS ONLINE <br/>
									</div>
								</div>
							</div>
						</div>
					</div> 
				</div> -->
			<!--End Footer -->
			
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="../js/jquery.min.js"></script>
			
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="../js/bootstrap.min.js"></script>
			<script language="javascript" src="../assets/event-calendar/calendar_2.js"></script>
	
			<?php
				if($head == "showCompany" OR $head == "" OR $head = "press" OR $head == "event")
				{
					?>
						<script src="../assets/pagination/jquery.twbsPagination.min.js"></script>
						<script>
							var id = $("#id").val();
							$('#pagination').twbsPagination
							({
								totalPages: $("#pages").val(),
								visiblePages: 5,
								onPageClick: function (event, page) 
								{
									$("#listLowongan").load("ajax/get_page.php",
									{'page': page, 'id': id},function(){});
								}
							});

							$('#all-lowongan').twbsPagination
							({
								totalPages: $("#pages").val(),
								visiblePages: 5,
								onPageClick: function (event, page) 
								{
									$("#showAllLowongan").load("ajax/get_page_all.php",
									{'page': page },function(){});
								}
							});

							$('#all-article').twbsPagination
							({
								totalPages: $("#pages").val(),
								visiblePages: 5,
								onPageClick: function (event, page) 
								{
									$("#showAllArticle").load("ajax/get_all_article.php",
									{'page': page },function(){});
								}
							});

							$('#all-event').twbsPagination
							({
								totalPages: $("#pages").val(),
								visiblePages: 5,
								onPageClick: function (event, page) 
								{
									$("#showAllEvent").load("ajax/get_all_event.php",{'page': page },function(){});
								}
							});
						</script>
					<?php
				}
			?>
			<script type="text/javascript">
			$('.dropdown-toggle').dropdown();
			$(".alert").alert();
		</script>
	</body>
</html>