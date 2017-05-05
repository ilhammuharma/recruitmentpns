	<!--bootstrap picker-->
	<script type="text/javascript" src="../js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="../js/bootstrap-daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="../js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
	<script type="text/javascript" src="../js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
	
	<!--picker initialization-->
	<script src="../js/picker-init.js"></script>
	
	<script>
	$('body').on('change', '.pokok', function() {
		var total=0;
		$(".pokok").each(function(){
			quantity = parseInt($(this).val());
			if (!isNaN(quantity)) {
				total += quantity;
			}
		});
		$('.total').val(+total);
	});
	</script>
	
	