	@extends('layouts.index')
	@section('content')
		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-header">
                            <h1>
                                Form Pejabat Struktural
                                <small>
                                (Isi dengan lengkap dan jelas)
                                </small>
                            </h1>
                        </div><!-- /.page-header -->


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@if (!empty($id_user))
								<form class="form-horizontal" role="form" action="{{url(route('users_eselon.update'))}}" method="POST" >
								@else
								<form class="form-horizontal" role="form" action="{{url(route('users_eselon.save'))}}" method="POST" >
								@endif
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="name_pic" placeholder="Nama" class="col-xs-10 col-sm-5" value="{{!empty($name_pic) ? $name_pic :''}}" />
										</div>
									</div>


									<div class="space-4"></div>


									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">Unit Kerja</label>
										<div class="col-sm-9">
											<select name="id_unit_kerja">
													<?php
													foreach ($unit_kerja as $key => $value) {
														$selected ="";
														if (!empty($id_unit_kerja)) {
																if ($id_unit_kerja == $value['id_unit_kerja']) {
																$selected ="selected";
																}

														}
														echo "<option value=".$value['id_unit_kerja']." ".$selected.">".$value['name_unit_kerja']."</option>";
													}


													 ?>
											</select>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
										</div>
									</div>
									<div class="clearfix form-actions">
									@if (!empty($id_user))
										<input type="hidden" name="update" value="{{$id_user}}">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="Submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Edit
											</button>
									@else
											<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="Submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>
									@endif
											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
										</div>
							</div>
						</form>
						<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue">Data Pejabat Struktural</h3>

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
		                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
		                        <thead>
		                            <tr>
		                                <th>Nama</th>
		                                <th>Unit Kerja</th>
		                                <th>action</th>
		                            </tr>
		                        </thead>

		                    </table>
						</div>
					</div>
				</div>

			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div><!-- /.main-content -->

	@section('js')
	<script>
	var urlAjaxTable = "{{ URL::to(route('users_eselon.indexAjax')) }}";
    var  urlEdit = "{{url('/admin/users_eselon-edit')}}";
    var  urlDelete = "{{url('/admin/users_eselon-delete')}}";

    var listTable = $('.listTable').DataTable( {
        "processing": true,
        "bFilter": false,
        "bInfo": false,
        "bLengthChange": false,
        "serverSide": true,
        "ajax": {
             "url": urlAjaxTable,
             "type": "GET"
         },
         "columns": [
            { "data": "name_pic" },
            { "data": "id_unit_kerja" },
			{ "render": function (data, type, row, meta) {

					   var edit = $('<a><button><i>')
								   .attr('class', "btn bg-blue-grey waves-effect edit-menu material-icons")
								   .attr('href',urlEdit+'/'+row.id_user)
								   .text('mode_edit')
								   .wrap('<div></div>')
								   .parent()
								   .html();
				   var del = $('<button><i>')
					   .attr('class', "btn btn-danger waves-effect delete-menu material-icons ")
					   .attr('onclick', "deletProcess('"+row.id_user+"')")
					   .text('delete')
					   .wrap('<div></div>')
					   .parent()
					   .html();

					   return edit+" | "+del;
								   }
		   },
        ],
        "buttons": [
           {
               extend: 'collection',
               text: 'Export',
               buttons: [
                   'copy',
                   'excel',
                   'csv',
                   'pdf',

               ]
           }
       ]
    });

    function deletProcess(id_user){
    swal({
        title: "Apakah anda yakin ?",
        text: "Anda akan menghapus data.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete ",
        closeOnConfirm: true,
    }, function () {
         window.location.href = urlDelete+'/'+id_user;
     });
    }
    function popupIMage(e) {
        var modal = document.getElementById('myModal');
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        modal.style.display = "block";
        modalImg.src = e.src;
        captionText.innerHTML = e.alt;
    }


</script>
	@endsection
@stop
