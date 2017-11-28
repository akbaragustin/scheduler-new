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
			<a href="{{url(route('frontend'))}}" class="selected">Internal</a>
			<a href="{{url(route('ruanganFe'))}}" style="color:white">Jadwal Ruangan</a>
			<a href="{{url(route('kapusShow'))}}" style="color:white">Struktural & Kapus</a>
		</nav>
	</div>

</header>
<div class="container">

	<div class="col-xs-12" style="margin-top:5px">
		<div class="pull-right" style="padding-right:20px;padding-top:15px">

			<a href="#">
				<button type="button" class="btn btn-info waves-effect edit-menu filterModal " style="background-color:#23589A !important; border-color:#23589A !important">Filter</button>
			</a>

			<button type="button" name="button" class="clear_filter hidden" style="background-color:#23589A !important; border-color:#23589A !important; color:white;"><i class="material-icons">clear</i></button>

		</div>
		<div class="pull-right" style="padding-right:20px;padding-top:15px">

			<a href="#">
				<button type="button" class="btn btn-info waves-effect edit-menu showTable " style="background-color:#23589A !important; border-color:#23589A !important">Show</button>
			</a>


		</div>

		<div style="background:#FFD700; padding:10px">
			<h3 class="header smaller lighter " style="color:#23589A; font-weight:bold">Agenda Internal</h3>
		</div>
		<br>
		<br>
		<table class="table table-striped table-hover dataTable listTable">
			<thead>
				<tr>
					<th>No</th>
					<th><center>Hari & Tanggal</center></th>
					<th><center>Waktu</center></th>
					<th><center>Agenda</center></th>
					<th><center>Tempat</center></th>
					<th><center>Penanggung Jawab</center></th>
				</tr>
			</thead>
		</table>
	</div>

<!-- Modal -->
 <div class="modal fade" id="filter" role="dialog">
   <div class="modal-dialog">

	 <!-- Modal content-->
	 <div class="modal-content">
	   <div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal">&times;</button>
		 <h4 class="modal-title">Modal Header</h4>
	   </div>
	   <div class="modal-body">
		   <form class="form-horizontal" role="form" method="POST" action="{{url(route('kapus.save'))}}">
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
   				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pelaksana </label>

   				<div class="col-sm-9">
   					<input type="text" id="form-field-1" placeholder="Pelaksana" class="col-xs-10 col-sm-5 pj_rapat" name="pj_rapat" value="{{!empty($pj_rapat) ? $pj_rapat : ''}}" />
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
   					<input type="text" id="form-field-1" placeholder="waktu Mulai" class="col-xs-10 col-sm-5 datepicker" name="start_tgl_rapat" value="" />
   				</div>
   			</div>
   			<div class="form-group">
   				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tanggal Akhir</label>

   				<div class="col-sm-9">
   					<input type="text" id="form-field-1" placeholder="Waktu Akhir" class="col-xs-10 col-sm-5 datepicker1" name="end_tgl_rapat" value="" />
   				</div>
   			</div>
	   </div>
	   <div class="modal-footer">
		   <button class="btn btn-info ajaxSearch" type="button">
			   <i class="ace-icon fa fa-check bigger-110"></i>
			   Search
		   </button>
		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	   </div>
	 </div>

   </div>
 </div>
	<div class="viewShow hidden">

	</div>
</div>
</body>
</html>
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
var urlAjaxTable = "{{ URL::to(route('frontend.indexAjax')) }}";
var  urlAjaxShow = "{{URL::to(route('frontend.showAjax'))}}";
var  showTable = "{{URL::to(route('frontend.showTable'))}}";
var token = "{{ csrf_token() }}";
var listTable = $('.listTable').DataTable( {
	"processing": true,
	"bFilter": false,
	"bInfo": false,
	"bLengthChange": false,
	"serverSide": true,
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
			"width": "20%"

	 },
		{ "data": "waktu",
			"width": "10%"
	 },
		{ "data": "agenda_rapat",
			"width": "30%"
	 },
	 { "data": "tempat_rapat"  },
		{ "data": "pj_rapat" },
	],
	oLanguage: {
        oPaginate: {
            sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
        }
    },
});
$('.clear_filter').click(function () {
listTable.ajax.reload();
$('.clear_filter').addClass('hidden');
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
$('.showTable').click(function () {
	window.open(showTable);
});
$('.ajaxSearch').click(function () {
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
	$('#filter').modal('hide');
	var agenda_rapat = $('.agenda_rapat').val();
	var pj_rapat = $('.pj_rapat').val();
	var Pic = $('.PIC').val();
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
			 Pic : Pic,
			 filterWaktu : filterWaktu
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
 		{ "data": "agenda_rapat",
 			"width": "30%"
 	 },
	 	{ "data": "tempat_rapat"  },
		{ "data": "pj_rapat" },
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
$('.filterModal').click(function(){
	$('.datepicker').val("");
	$('.datepicker1').val("");
	 $('#filter').modal('show');

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
tr .even{
	background-color: blue !important;
}
</style>
@endsection
@stop
