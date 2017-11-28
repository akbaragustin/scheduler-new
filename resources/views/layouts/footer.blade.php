	<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{ URL::asset('') }}assets/js/jquery-2.1.4.min.js"></script>
		<script src="{{ URL::asset('') }}plugins/select2/js/select2.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{{ URL::asset('') }}assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="{{ URL::asset('') }}assets/js/jquery.dataTables.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/dataTables.buttons.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/dataTables.select.min.js"></script>

		<script src="{{ URL::asset('') }}assets/js/jquery-ui.custom.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/moment.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/fullcalendar.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/bootbox.js"></script>
		<script src="http://mugifly.github.io/jquery-simple-datetimepicker/jquery.simple-dtpicker.js"></script>

		<!-- ace scripts -->
		<script src="{{ URL::asset('') }}assets/js/ace-elements.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script src="{{ URL::asset('') }}assets/js/chosen.jquery.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/spinbox.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/bootstrap-datepicker.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/bootstrap-timepicker.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/moment.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/daterangepicker.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/jquery.knob.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/autosize.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/jquery.inputlimiter.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/jquery.maskedinput.min.js"></script>
		<script src="{{ URL::asset('') }}assets/js/bootstrap-tag.min.js"></script>
		<script src="{{ URL::asset('') }}plugins/swall/sweetalert-dev.js"></script>


	@yield('js')
	@include('layouts.errorMessage')
	</body>
</html>
