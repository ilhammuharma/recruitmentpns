        </div> <!-- End Main Area -->
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
	<?php
		if($title == "account")	
		{
			?>
				<script src="../js/ajaxupload.js"></script>
				<script>
					$(document).ready(function()
					{
						$("#description").keyup(function()
						{
							var count = $("#description").val().length;
							$("#count").html(count);
							///alert(count);
						});
					});
					$(function()
					{
						var file_type = '';
						var btnUpload = $('#imageChange');
						var status = $('.status');
						new AjaxUpload(btnUpload,
						{
							action : "ajax/upload.php",
							name : 'file',
							onSubmit: function(file, ext)
							{
								file_type = ext;
								status.html("Uploading...");
							},
							onComplete: function(file, response)
							{
								status.html('');
								if(response == "upload_error")
								{
									$("#imageChange").html("The upload process fails. Click this to retry.");
								}
								else if(response == "file_exceed")
								{
									$("#imageChange").html("The size of the file exceeds the requirements. A maximum of 1 MB. Click this to retry.");
								}
								else if(response == "type_error")
								{
									$("#imageChange").html("Uploaded file type is not valid. Use a gif, jpeg, jpg, or png. Click this to retry.");
								}
								else
								{
									$("#imageChange").html('');
									$("#imageChange").html('<img src="'+response+'" class="img-thumbnail img-responsive" id="user-photo">');
								}
							}
						});
					});
				</script>
			<?php
		}
	?>
	<?php 
		if($title == "posted")
		{
			?>
				<script src="../assets/pagination/jquery.twbsPagination.min.js"></script>
				<script>
					$('#pagination-demo').twbsPagination
					({
						totalPages: $("#pages").val(),
						visiblePages: 5,
						onPageClick: function (event, page) 
						{
							$("#show-lowongan").load("ajax/get_page.php",{'page': page},function(){});
							//$('#show-lowongan').text('Page ' + page);
						}
					});
					$("button").click(function()
					{
						console.log("jenggot");
					});
				</script>
			<?php
		}
	?>
	<?php
		if($title == "posting")
		{
			?>
				<script src="../assets/datepicker/js/bootstrap-datepicker.js"></script>
				<script src="../assets/ckeditor/ckeditor.js"></script>
				<script type="text/javascript">
					$(document).ready(function()
					{
						$("#batas-akhir").datepicker
						({
								format: 'dd-mm-yyyy'
						});
						//CKEDITOR.replace("deskripsi-kerja");
						CKEDITOR.replace("oqualification");
					});
				</script>
			<?php
		}
	?>
	</body>
</html>