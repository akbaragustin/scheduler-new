	@extends('layouts.index')
	@section('content')
		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-header">
                            <h1>
                                Form User
                                <small>
                                (Isi dengan lengkap dan jelas)
                                </small>
                            </h1>
                        </div><!-- /.page-header -->


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@if (!empty($id_user))
								<form class="form-horizontal" role="form" action="{{url(route('users.update'))}}" method="POST" >
								@else
								<form class="form-horizontal" role="form" action="{{url(route('users.save'))}}" method="POST" >
								@endif
								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Username</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="username" placeholder="Username" class="col-xs-10 col-sm-5" value="{{!empty($username) ? $username :''}}" />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email</label>

										<div class="col-sm-9">
											<input type="email" id="form-field-1" name="email" placeholder="Email" class="col-xs-10 col-sm-5" value="{{!empty($email) ? $email :''}}" />
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">Password</label>

										<div class="col-sm-9">
											<input type="password" name="password" id="form-field-2" placeholder="Password" class="col-xs-10 col-sm-5" value="{{!empty($password) ? 'true' : ''}}" />
										</div>
									</div>
									<div class="space-4"></div>
									  <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-2">Jabatan</label>
										<div class="col-sm-9">
											<select name="jabatan">
													<?php
													foreach ($jabatan as $key => $value) {
														$selected ="";
														if (!empty($id_jabatan)) {
																if ($id_jabatan == $value['id_jabatan']) {
																$selected ="selected";
																}

														}
														echo "<option value=".$value['id_jabatan']." ".$selected.">".$value['name_jabatan']."</option>";
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
										<h3 class="header smaller lighter blue">Data User</h3>

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
		                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
		                        <thead>
		                            <tr>
		                                <th>Username</th>
		                                <th>Email</th>
		                                <th>Jabatan</th>
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
	var urlAjaxTable = "{{ URL::to(route('users.indexAjax')) }}";
    var  urlEdit = "{{url('/admin/users-edit')}}";
    var  urlDelete = "{{url('/admin/users-delete')}}";

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
            { "data": "username" },
            { "data": "email" },
            { "data": "name_jabatan" },
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
