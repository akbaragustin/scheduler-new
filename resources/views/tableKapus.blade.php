@include("layouts.header")
<table class="table table-striped table-hover js-basic-example dataTable listTableKapus">
    <thead>
        <tr>
            <th>No</th>
            <th>Hari & Tanggal</th>
            <th>Waktu</th>
            <th>Agenda</th>
            <th>Tempat</th>
            <th>Penanggung Jawab</th>
            <th>Pendamping</th>
        </tr>
    </thead>
</table>
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
@include("layouts.footer")
@section('js')
<script type="text/javascript">
var urlAjaxTableKapus = "{{ URL::to(route('frontend.indexAjaxKapus')) }}";
var listTable = $('.listTableKapus').DataTable( {
	"processing": true,
	"bFilter": false,
	"bInfo": false,
	"bLengthChange": false,
	"serverSide": true,
	"ordering": false,
	"ajax": {
		 "url": urlAjaxTableKapus,
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
 		{ "data": "agenda_rapat",
 			"width": "30%"
 	 },
	 	{ "data": "tempat_rapat"  },
		{ "data": "pj_rapat" },
		{ "data": "infant"  },

	],
	oLanguage: {
		oPaginate: {
			sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
			sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
		}
	},
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
</style>
