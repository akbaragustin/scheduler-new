<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>PuskimPu</title>
		 <link rel="icon" href="https://upload.wikimedia.org/wikipedia/id/a/a7/Logo_PU_%28RGB%29.jpg" type="image/x-icon">

		<meta name="description" content="with draggable and editable events" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link href="http://mugifly.github.io/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="{{ URL::asset('') }}plugins/select2/css/select2.min.css" />
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/fullcalendar.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{ URL::asset('') }}assets/js/ace-extra.min.js"></script>

 	    <link rel="stylesheet" href="{{ URL::asset('') }}plugins/swall/sweetalert.css">

    	<!-- Google Fonts -->
		<link href="{{ URL::asset('') }}plugins/fonts/fonts.googleapis.css" rel="stylesheet" type="text/css">
		<link href="{{ URL::asset('') }}plugins/fonts/icon.css" rel="stylesheet" type="text/css">


		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		@yield('header')

		<style>
			.error{
				color :red;
				font-size: 10px;
			}
			.footer-content{
/*				background: #B85D39;
*/				background: #03396c;
				font-size: 10px;
				border-top:1px  solid #0B56A7 !important;
				position:relative !important;
				left:0px !important;
				right:0px !important;
				bottom:0px !important;
				line-height: 20px !important;
				border-radius: 0 0 10px 10px;
			}
			.footer-content span{
				color:#fff;
			}
			.header-basic-light {
				box-shadow : 0 0 25px 0 #B85D3A !important;
			}
			.newnavbar{
				background-color: #03396c !important;
				position: fixed;
				width: 100%;
				top: 0;
				z-index: 1;
			}
			.newsidebar{
				margin-top: 45px !important;
				background-color: #fff !important;
				border-color: #fff !important;
				position: fixed;
			}
			.main-content{
				padding: 45px 10px 0 10px !important;
			}
			.login-layout{
				background-color: #03396c !important;
			}
			.boxlogin{
				background-color: #fff !important;
			}
			.setlogin{
				border: solid 1px #fff !important;
			    padding: 5px 5px 5px 5px !important;
			    color: #000;
			    border-radius: 7px;
			    margin-top: 25px;
			}
		</style>
	</head>
