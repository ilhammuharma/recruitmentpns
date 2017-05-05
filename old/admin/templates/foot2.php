        </div> <!-- End Main Area -->
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/docs.min.js"></script>
	<script src="../assets/pagination/jquery.twbsPagination.min.js"></script>
	<script src="../assets/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../assets/ckeditor/ckeditor.js"></script>
	<script src="../assets/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../js/ajaxupload.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
    <?php 
		if($title == "resume")
		{
			?>
				<script src="../assets/datepicker/js/bootstrap-datepicker.js"></script>
				<script src="../js/ajaxupload.js"></script>
				
				<script type="text/javascript">
					$(document).ready(function()
					{
						$("#birthday").datepicker({format: 'dd-mm-yyyy'});
						$("#start-date-work").datepicker({format: 'dd-mm-yyyy'});
						$("#end-date-work").datepicker({format: 'dd-mm-yyyy'});
						
						$("#addEdu").click(function()
						{
							$("#addEducation").show();
							$("#addEdu").prop("disabled", true);
						});
						$("#batalEdu").click(function()
						{
							$("#addEducation").hide();
							$("#formEdu")[0].reset();
							$("#addEdu").prop("disabled", false);
							$("#hideEndKerja").show();
						})
						
						$("#addExp").click(function()
						{
							$("#addExperience").show();
							$("#addExp").prop("disabled", true);
						});
						$("#batalExp").click(function()
						{
							$("#addExperience").hide();
							$("#addExp").prop("disabled", false);
							$("#form-exp")[0].reset();
							$("#hideEndKerja").show();
						});
						
						$("#addLang").click(function()
						{
							$("#addBahasa").show();
							$("#addLang").prop("disabled", true);
						});
						$("#addOtherSkill").click(function()
						{
							$("#addOSkill").show();
							$("#addOtherSkill").prop("disabled", true)
						});
						$("#addTrainingPelatihan").click(function()
						{
							$("#addTraining").show();
							$("#addTrainingPelatihan").prop("disabled", true)
						});
						$("#addKemudi").click(function()
						{
							$("#addMengemudi").show();
							$("#addKem").prop("disabled", true);
						});
						$("#batalBhs").click(function()
						{
							$("#addBahasa").hide();
							$("#addLang").prop("disabled", false);
							$("#form-bahasa")[0].reset();
						});
						$("#batalSkill").click(function()
						{
							$("#addOSkill").hide();
							$("#addOtherSkill").prop("disabled", false);
							$("#form-skill")[0].reset();
						});
						$("#batalMengemudi").click(function()
						{
							$("#addMengemudi").hide();
							$("#addKem").prop("disabled", false);
							$("#form-mengemudi")[0].reset();
						});
						$("#batalTraining").click(function()
						{
							$("#addTraining").hide();
							$("#addTrainingPelatihan").prop("disabled", false);
							$("#form-training")[0].reset();
						});
						
						$("#addKeluargaInti").click(function()
						{
							$("#addKelInti").show();
							$("#addKeluargaInti").prop("disabled", true)
						});
						$("#addKeluargaBesar").click(function()
						{
							$("#addKelBesar").show();
							$("#addKeluargaBesar").prop("disabled", true)
						});
						$("#addKeluargaDarurat").click(function()
						{
							$("#addKelDarurat").show();
							$("#addKeluargaDarurat").prop("disabled", true)
						});
						$("#batalInti").click(function()
						{
							$("#addKelInti").hide();
							$("#addKeluargaInti").prop("disabled", false);
							$("#form-inti")[0].reset();
						});
						$("#batalBesar").click(function()
						{
							$("#addKelBesar").hide();
							$("#addKeluargaBesar").prop("disabled", false);
							$("#form-besar")[0].reset();
						});
						$("#batalDarurat").click(function()
						{
							$("#addKelDarurat").hide();
							$("#addKeluargaDarurat").prop("disabled", false);
							$("#form-darurat")[0].reset();
						});
						
						$("#addKen").click(function()
						{
							$("#addKenalan").show();
							$("#addKen").prop("disabled", true)
						});
						$("#addRef").click(function()
						{
							$("#addReferensi").show();
							$("#addRef").prop("disabled", true)
						});
						$("#addOrg").click(function()
						{
							$("#addOrganisasi").show();
							$("#addOrg").prop("disabled", true)
						});
						$("#addPsi").click(function()
						{
							$("#addPsikotest").show();
							$("#addPsi").prop("disabled", true)
						});
						$("#batalKenalan").click(function()
						{
							$("#addKenalan").hide();
							$("#addKen").prop("disabled", false);
							$("#form-kenalan")[0].reset();
						});
						$("#batalReferensi").click(function()
						{
							$("#addReferensi").hide();
							$("#addRef").prop("disabled", false);
							$("#form-referensi")[0].reset();
						});
						$("#batalOrganisasi").click(function()
						{
							$("#addOrganisasi").hide();
							$("#addOrg").prop("disabled", false);
							$("#form-organisasi")[0].reset();
						});
						$("#batalPsikotest").click(function()
						{
							$("#addPsikotest").hide();
							$("#addPsi").prop("disabled", false);
							$("#form-psikotest")[0].reset();
						});
						$("#endNow").click(function()
						{
							if($(this).prop("checked") == true)
							{
								//console.log("Checked");
								$("#hideEndKerja").hide();
							}
							else if($(this).prop("checked") == false)
							{
								//console.log("Unchecked");
								$("#hideEndKerja").show();
							}
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
					});    
				</script>
			<?php 
		}
		
		if($title == "fptk")
		{
			?>
				<script src="../assets/pagination/jquery.twbsPagination.min.js"></script>
				<script src="../assets/datepicker/js/bootstrap-datepicker.js"></script>
				<script src="../assets/ckeditor/ckeditor.js"></script>
				<script src="../assets/datepicker/js/bootstrap-datepicker.js"></script>
				<script src="../js/ajaxupload.js"></script>
				<script type="text/javascript">
					$(document).ready(function()
					{
						$('#tambah-fptk').click(function()
						{
							$('#add-fptk').show();
						});
						
						$("#addFptk").click(function()
						{
							$("#addFptk2").show();
							$("#addFptk").prop("disabled", true);
						});
						
						$("#batalFptk").click(function()
						{
							$("#addFptk2").hide();
							$("#addFptk").prop("disabled", false);
							$("#form-fptk")[0].reset();
						});
						
						$('#pagination').twbsPagination
						({
							totalPages: $("#pages").val(),
							visiblePages: 5,
							onPageClick: function (event, page) 
							{
								$("#total-fptk").load("ajax/get_fptk.php",{'page': page},function(){});
							}
						});
					});
				</script>
			<?php
		}
	?>
	</body>
</html>