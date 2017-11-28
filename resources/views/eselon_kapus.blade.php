@extends('layouts.indexFrontend')
@section('content')
@section('header')
	<link rel="stylesheet" href="{{ URL::asset('') }}assets/headerFe/demo.css">
	<link rel="stylesheet" href="{{ URL::asset('') }}assets/headerFe/header-basic-light.css">
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
@endsection
</head>
	<body style="background-color:#fff">

	<header class="header-basic-light" style="background-color:#0d2d6c; position:fix">
		<div class="header-limiter">
			<h1><img src="https://upload.wikimedia.org/wikipedia/id/a/a7/Logo_PU_%28RGB%29.jpg"  height="55px" width="55px"></h1>
			<nav>
				<a href="{{url(route('frontend'))}}" style="color:white" >Internal</a>
				<a href="{{url(route('ruanganFe'))}}" style="color:white">Jadwal Ruangan</a>
				<a href="{{url(route('kapusShow'))}}" class="selected">Struktural & Kapus</a>
			</nav>
		</div>

	</header>
<div class="container">
<!-- <div class="row" style="padding-right:18px;padding-left:18px;" > -->
	<div class="col-xs-12" style="margin-top:5px">
		<div class="pull-right" style="padding-right:20px;padding-top:15px;">
			<button type="button" name="button" class="clear_filter hidden" style="background-color:#23589A !important; border-color:#23589A !important; color:white;"><i class="material-icons">clear</i></button>
		    <a href="#" style="padding-right:8px;">
			 <button type="button" class="btn btn-info waves-effect edit-menu modalFilterEselon" style="background-color:#23589A !important; border-color:#23589A !important">Filter</button>
		    </a>
		    <a href="#" style="padding-right:8px;">
			 <button type="button" class="btn btn-info waves-effect edit-menu showTable" style="background-color:#23589A !important; border-color:#23589A !important">Show</button>
		    </a>
		    <a href="{{url(route('kapusShow'))}}">
			 <button type="button" class="btn btn-Basic waves-effect edit-menu">Agenda Kapus</button>
		    </a>
		    <a href="{{url(route('eselon_kapus'))}}">
			 <button type="button" class="btn btn-warning waves-effect edit-menu">Agenda Struktural</button>
		    </a>
		</div>

	<div style="background:#FFD700;padding:10px;">
			<h3 class="header smaller lighter " style="color:#797C7B; font-weight:bold; color:#0d2d6c;">Agenda Struktural</h3>
	</div>
		<br>
		<br>

<table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable" style="background-color:#fff !important">
	<thead>
		<tr>
			<th>No</th>
			<th>Hari & Tanggal</th>
			<th>Waktu</th>
			<th>Pejabat Struktural</th>
			<th>Agenda</th>
			<th>Tempat</th>
			<th>Penanggung Jawab</th>
			<th>Pendamping</th>
		</tr>
	</thead>
</table>
  </div>
<!-- </div> -->
    <!-- Modal -->
     <div class="modal fade" id="filterEselon" role="dialog">
       <div class="modal-dialog">

    	 <!-- Modal content-->
    	 <div class="modal-content">
    	   <div class="modal-header">
    		 <button type="button" class="close" data-dismiss="modal">&times;</button>
    		 <h4 class="modal-title">Modal Header</h4>
    	   </div>
    	   <div class="modal-body">
    		   <form class="form-horizontal" role="form" method="POST" action="">
				   <div class="form-group">
					   <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Filter Tanggal</label>

					   <div class="col-sm-9">
						   <select class="filterWaktu" name="filterWaktu">
							   <option value="">Masukan Filter Tanggal</option>
							   <option value="hari">Hari</option>
 	  						<option value="minggu">Minggu</option>
 	  						<option value="bulan">Bulan</option>
						   </select>
					   </div>
				   </div>
			<div class="form-group">
   				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Pejabat</label>

   				<div class="col-sm-9">
   				<select class="col-xs-10 col-sm-5 products" id="products" name="name_pic[]" data-tags="false" data-placeholder="Select an option" style="width:40%">
   				<?php
   				echo "<option value=''></option>";
   				foreach ($name_pic as $key => $value) {
   					$selected ="";
   					if (!empty($name_eselon)) {

   						foreach ($name_eselon as $keys => $values) {
   							foreach ($values as $k => $v) {

   							}
   						}
   					}
   					echo "<option ".$selected." value = ".$value['id_user'].">".$value['name_pic']."</option>";
   				}


   				 ?>
   			 </select>
   			 </div>
   			</div>

       			<div class="form-group">
       				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pelaksana </label>

       				<div class="col-sm-9">
       					<input type="text" id="form-field-1" placeholder="Pelaksana" class="col-xs-10 col-sm-5 pj_rapat" name="pj_rapat" value="" />
       				</div>
       			</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> PIC </label>

					<div class="col-sm-9">
						<input type="text" id="form-field-1" placeholder="PIC" class="col-xs-10 col-sm-5 PIC" name="PIC" value="{{!empty($PIC) ? $PIC : ''}}" />
					</div>
				</div>
       				<div class="form-group">
       				<label class="col-sm-3 control-label no-padding-right" for="form-field-1" id ="start_data">Tanggal Mulai</label>

       				<div class="col-sm-9">
       					<input type="text" id="form-field-1" placeholder="waktu Mulai" class="col-xs-10 col-sm-5 datepicker" name="start_tgl_rapat" value="{{!empty($start_tgl_rapat) ? $start_tgl_rapat : date('d-m-Y H:i A')}}" />
       				</div>
       			</div>
       			<div class="form-group">
       				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Akhir</label>

       				<div class="col-sm-9">
       					<input type="text" id="form-field-1" placeholder="Waktu Akhir" class="col-xs-10 col-sm-5 datepicker1" name="end_tgl_rapat" value="{{!empty($end_tgl_rapat) ? $end_tgl_rapat : date('d-m-Y H:i A') }}" />
       				</div>
       			</div>
    	   </div>
    	   <div class="modal-footer">
    		   <button class="btn btn-info ajaxSearchEselon" type="button">
    			   <i class="ace-icon fa fa-check bigger-110"></i>
    			   Search
    		   </button>
    		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	   </div>
    	 </div>
    	</form>
       </div>
     </div>
 </div>
	 <style>
	 	.daterangepicker{
	 		z-index: 10000;
	 	}
		.header-basic-light {
			box-shadow: 0 0 25px 0 rgba(0, 0, 0, 0.15);
		}
		.header{
			border-bottom: none;
		}
		html{
			background-color:#fff;
		}
	 </style>
     @section('js')
     <script type="text/javascript">
     var urlAjaxTable = "{{ URL::to(route('frontend.indexAjaxEselon')) }}";
     var urlAjaxTableKapus = "{{ URL::to(route('frontend.indexAjaxKapus')) }}";
     var  urlAjaxShowKapus = "{{URL::to(route('frontend.showAjaxKapus'))}}";
     var  urlAjaxShow = "{{URL::to(route('frontend.showAjaxEselon'))}}";
     var  showTable = "{{URL::to(route('frontend.showTableEselon'))}}";
	 var urlSelect2 = "{{url(route('eselonFe.searchAjax'))}}";
     var token = "{{ csrf_token() }}";
     var listTable = $('.listTable').DataTable( {
     	"processing": true,
     	"bFilter": false,
     	"bInfo": false,
     	"bLengthChange": false,
     	"serverSide": true,
     	"pageLength": 10,
		 "ordering": false,
     	"ajax": {
     		 "url": urlAjaxTable,
     		 "type": "GET"
     	 },
     	 "columns": [
		 { "data": "no",
 				"width": "5%"

 		 },
			 { "data": "start_tgl_rapat",
 				"width": "12%"

 		 },
 			{ "data": "waktu",
 				"width": "10%"
 		 },
		 { "data": "name_eselon"  },
 			{ "data": "agenda_rapat",
 				"width": "30%"
 		 },
		 	{ "data": "tempat_rapat"  },
     		{ "data": "pj_rapat" },
     		{ "data": "infant_biasa"  },
     	],
		oLanguage: {
	        oPaginate: {
	            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
	            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
	        }
	    },
     });
     function showProcess(id_rapat){
     		jQuery.ajax({
     			url: urlAjaxShow,
     			type: 'GET',
     			dataType: 'json',
     			data: {
     					id : id_rapat,
     				_token : token
     			},
     			 success: function(doc) {
     			 	$('.row').addClass("hidden");
     				$('.viewShow').html(doc.data);
     				$('.viewShow').removeClass('hidden');
     				$('.closeRuangan').click(function(){
     					$('.row').removeClass("hidden");
     					$('.viewShow').addClass('hidden');
     				})

     			 }
     	});
     }

	 $('.datepicker').appendDtpicker({
	 	"closeOnSelected": true
	 });
	 $('.datepicker1').appendDtpicker({
	 	"closeOnSelected": true
	 });

     $('.modalFilterEselon').click(function(){
     	$('.datepicker').val("");
     	$('.datepicker1').val("");
     	 $('#filterEselon').modal('show');

     });
     $('.ajaxSearchEselon').click(function () {
     	var waktuM = $('.datepicker').val();
     	var waktuA = $('.datepicker1').val();
     	if (waktuM != '' && waktuA == '') {
     		swal("GAGAL!!",'Waktu Akhir harap Di isi!')
     		return false;
     	}
     	if (waktuM == '' && waktuA != '') {
     		swal("GAGAL!!",'Waktu Mulai harap Di isi!')
     		return false;
     	}
     	$('#filterEselon').modal('hide');
     	var agenda_rapat = $('.agenda_rapat').val();
     	var pj_rapat = $('.pj_rapat').val();
     	var Pic = $('.PIC').val();
		var name_pic = $('.products').val();
		var filterWaktu = $('.filterWaktu').val();
		$('.clear_filter').removeClass('hidden');
     	$('.listTable').DataTable( {
     	"processing": true,
     	"bFilter": false,
     	"bInfo": false,
     	"bLengthChange": false,
     	"serverSide": true,
		 "ordering": false,
     	"ajax": {
     		 "url": urlAjaxTable,
     		 "type": "GET",
     		 "data" : {
     			 waktuM : waktuM,
     			 waktuA : waktuA,
     			 agenda_rapat : agenda_rapat,
     			 pj_rapat : pj_rapat,
				 filterWaktu : filterWaktu,
				 name_pic :name_pic,
				 Pic :Pic
     		 }
     	 },
     	 "columns": [
			 { "data": "no",
	 			"width": "5%"

	 	 },
			 { "data": "start_tgl_rapat",
	 			"width": "12%"

	 	 },
	 		{ "data": "waktu",
	 			"width": "10%"
	 	 },
		 { "data": "name_eselon"  },
	 		{ "data": "agenda_rapat",
	 			"width": "30%"
	 	 },
		 { "data": "tempat_rapat"  },
     		{ "data": "pj_rapat" },
     		{ "data": "infant_biasa"  },

     	],
		oLanguage: {
	        oPaginate: {
	            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
	            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
	        }
	    },

     	     "destroy" : true
     	});
     });
	 $('.clear_filter').click(function () {
	 listTable.ajax.reload();
	 $('.clear_filter').addClass('hidden');
	 });
	 $('.showTable').click(function () {
	 	window.open(showTable);
	 });

			 $( "#DataTables_Table_0_wrapper div.row:nth-child(1)" ).remove();
			 $('.dataTables_paginate').parent('div').parent('div').css('background', '#fff');
			 </script>
			 <style>

			 table {
			   border-collapse: separate;
			   border-spacing: 0 1px;
			 }

			 thead th {
			   background-color: #23589A;
			   color: #fff !important;
			   border-bottom:10px solid #FFD700 !important;
			 	 font-size: 15px;
			 }


			 tbody td {
			   background-color: #FFFFFF;
			 	 font-size: 15px;
				  font-weight: bold;
			 }

			 tr td:first-child,
			 tr th:first-child {
			   border-top-left-radius: 6px;
			   border-bottom-left-radius: 6px;

			 }

			 tr td:last-child,
			 tr th:last-child {
			   border-top-right-radius: 6px;
			   border-bottom-right-radius: 6px;
			 }
			 .header-basic-light .header-limiter nav a.selected {
			 	padding : 23px 10px !important;
			 	margin-top:-10px;
			 	background: #23589A;
			 }
			 .dataTables_wrapper .row:first-child{
				 background-color:white !important;
			 }
			 .dataTables_wrapper .row:last-child{
				 background-color:white !important;
			 }
			 </style>
	 @endsection
	 @stop
