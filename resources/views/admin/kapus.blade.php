	@extends('layouts.index')
	@section('content')

		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-header">
                            <h1>
                                Form Agenda Kapus
                                <small>
                                (Isi dengan lengkap dan jelas)
                                </small>
                            </h1>
                        </div><!-- /.page-header -->


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								@if(!empty($id_rapat))
								<form class="form-horizontal" role="form" method="POST" action="{{url(route('kapus.update'))}}">@else
								<form class="form-horizontal" role="form" method="POST" action="{{url(route('kapus.save'))}}">
								@endif
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agenda Rapat</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="Agenda Rapat" class="col-xs-10 col-sm-5" name="agenda_rapat" value="{{!empty($agenda_rapat) ? $agenda_rapat : ''}}" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pelaksana </label>

										<div class="col-sm-9">
											<select name="status_pelaksana" class="col-xs-10 col-sm-5 status_pelaksana" >
												<option value="" >Masukan Pelaksana</option>
												<?php
												$testruktur ="";
												$nonterstruktur ="";
												if (!empty($status_pelaksana)) {
													if ($status_pelaksana == 'unitkerja') {
														$testruktur = 'selected';
													}else{
														$nonterstruktur = 'selected';
													}
												}


												 ?>
												<option value="unitkerja" <?php echo $testruktur; ?> >Unit Kerja </option>
												<option value="nonunitkerja" <?php echo $nonterstruktur; ?> >Non Unit Kerja</option>
											</select>
										</div>
									</div>
									<?php
									$hiddenN ="";
									$hiddenP ="";
									if (empty ($pj_rapat)){
										$hiddenN ="hidden";

									}

									if (empty ($pelaksana)){
										$hiddenP ="hidden";

									}


									 ?>

									<div class="form-group {{$hiddenN}} nonunitkerja">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Non Unit Kerja</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="Pelaksana" class="col-xs-10 col-sm-5" name="pj_rapat" value="{{!empty($pj_rapat) ? $pj_rapat : ''}}" />
										</div>
									</div>

									<div class="form-group {{$hiddenP}} unitkerja">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Unit Kerja </label>

										<div class="col-sm-9">
										<select class="col-xs-10 col-sm-5 " name="pelaksana" data-tags="false" data-placeholder="Select an option" style="width:340px">
										<?php
										echo "<option value=''></option>";
										foreach ($unit_kerja as $key => $value) {
											$selected ="";
												if (!empty($pelaksana)) {
														if ($pelaksana == $value['name_unit_kerja']) {
															$selected ="selected";
														}
												}

											echo "<option value ='".$value['name_unit_kerja']."' ".$selected." >".$value['name_unit_kerja']."</option>";
										}


										 ?>
									 </select>
									 </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">PIC </label>

										<div class="col-sm-9">
										<select class="col-xs-10 col-sm-5 " name="PIC" data-tags="false" data-placeholder="Select an option" style="width:340px">
										<?php
										echo "<option value=''></option>";
										foreach ($master_pic as $key => $value) {
											$selected ="";
												if (!empty($PIC)) {
														if ($PIC == $value['name_master_pic']) {
															$selected ="selected";
														}
												}

											echo "<option value ='".$value['name_master_pic']."' ".$selected." >".$value['name_master_pic']."</option>";
										}


										 ?>
									 </select>
									 </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fasilitator</label>

										<div class="col-sm-9">
											<select name="status_fasilitator" class="col-xs-10 col-sm-5 status_fasilitator" >
												<option value="" >Masukan Fasilitator</option>
												<?php
												$unitkerja ="";
												$nonunitkerja ="";
												if (!empty($status_fasilitator)) {
													if ($status_fasilitator == 'unitkerjaFasilitator') {
														$unitkerja = 'selected';
													}else{
														$nonunitkerja = 'selected';
													}
												}


												 ?>
												<option value="unitkerjaFasilitator" <?php echo $unitkerja; ?> >Unit Kerja </option>
												<option value="nonunitkerjaFasilitator" <?php echo $nonunitkerja; ?> >Non Unit Kerja</option>
											</select>
										</div>
									</div>
									<?php
									$hiddenNF ="";
									$hiddenF ="";
									if (empty ($fasilitatornon)){
										$hiddenNF ="hidden";

									}

									if (empty ($fasilitator)){
										$hiddenF ="hidden";

									}


									 ?>

									<div class="form-group {{$hiddenNF}} nonunitkerjaFasilitator">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Non Unit Kerja</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="Fasilitator" class="col-xs-10 col-sm-5" name="fasilitatornon" value="{{!empty($fasilitatornon) ? $fasilitatornon : ''}}" />
										</div>
									</div>

									<div class="form-group {{$hiddenF}} unitkerjaFasilitator">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Unit Kerja </label>

										<div class="col-sm-9">
										<select class="col-xs-10 col-sm-5 " name="fasilitator" data-tags="false" data-placeholder="Select an option fasilitator" style="width:340px">
										<?php
										echo "<option value=''></option>";
										foreach ($unit_kerja as $key => $value) {
											$selected ="";
												if (!empty($fasilitator)) {
														if ($fasilitator == $value['name_unit_kerja']) {
															$selected ="selected";
														}
												}

											echo "<option value ='".$value['name_unit_kerja']."' ".$selected." >".$value['name_unit_kerja']."</option>";
										}


										 ?>
									 </select>
									 </div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Waktu</label>

									<div class="col-sm-9">
										<p>
											<input type="text" name="start_tgl_rapat" value="{{!empty($start_tgl_rapat) ? $start_tgl_rapat : ''}}" class="start_tgl_rapat">
											-
											<input type="text" name="end_tgl_rapat" value="{{!empty($end_tgl_rapat) ? $end_tgl_rapat : ''}}" class="end_tgl_rapat">
											<a href="#" id="tambahHari" >
												<i class="material-icons">add_circle</i>
												<small>Tambah Hari </small>
											</a>
										</p>

									</div>
								</div>
									<?php
									$hiddenHari ="hidden";
									if (!empty ($phari)){
										$hiddenHari ="";

									}


									 ?>
									<div class="form-group {{$hiddenHari}} block-tambahHari">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
										<div class="col-sm-4">
											<input type="number" id="form-field-1" placeholder="1/2/3.." class="col-xs-10 col-sm-5" name="tambahHari" value="{{!empty($phari) ? $phari : ''}}" />
											<input type="text" id="form-field-1" placeholder="Pelaksana" class="col-xs-10 col-sm-5" name="" value="/Hari" disabled />

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tempat </label>

										<div class="col-sm-9">
											<select name="status_ruangan_rapat" class="col-xs-10 col-sm-5 status" >
												<option value="" >Masukan Status</option>
												<?php
												$internal ="";
												$external ="";
												if (!empty($status_ruangan_rapat)) {
													if ($status_ruangan_rapat == 'internal') {
														$internal = 'selected';
													}else{
														$external = 'selected';
													}
												}


												 ?>
												<option value="internal" <?php echo $internal; ?> >Intenal</option>
												<option value="external" <?php echo $external; ?> >External</option>
											</select>
										</div>

									</div>
									<?php
									$hidden ="";
									$hiddenT ="";
									if (empty ($id_ruangan)){
										$hidden ="hidden";

									}

									if (empty ($tempat_rapat)){
										$hiddenT ="hidden";

									}


									 ?>
									<div class="form-group {{$hiddenT}} block-tempat">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tempat </label>
										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="Tempat" class="col-xs-10 col-sm-5" name="tempat_rapat" value="{{!empty($tempat_rapat) ? $tempat_rapat : ''}}" />
										</div>
									</div>

									<div class="form-group {{$hidden}} block-ruangan">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ruangan </label>
										<div class="col-sm-9">
										<select name="ruangan_rapat" class="col-xs-10 col-sm-5">
											<option value="">Masukan Ruangan</option>
										<?php

											foreach ($allRuangan as $key => $value) {
													$selected ="";
													if (!empty ($id_ruangan)) {
														if ($id_ruangan == $value['id_ruangan']) {
															$selected ="selected";
														}
													}
												echo "<option value=".$value['id_ruangan']." ".$selected.">".$value['name_ruangan']."<small> (".$value['max_ruangan'].")</option>";
											}

											 ?>


										</select>
										<a href="#" id="showRuangan" >
											<i class="material-icons">remove_red_eye</i>
											<small>lihat data ruangan</small>
										</a>
									  </div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pendamping</label>

										<div class="col-sm-9">

										<select name="name_infant[]" class ="js-example-tokenizer form-control select2-hidden-accessible col-xs-10 col-sm-5 infant" style="width:400px"  multiple="multiple">
											<?php
												if (!empty($name_infant)) {
												foreach ($name_infant as $key => $value) {
													foreach ($value as $k => $v) {
													echo  "<option value ='".$v->disposisi_rapat."' selected='selected'>".$v->disposisi_rapat."</option>";
														}
													}
												}
											 ?>

										</select>
									</div>
								</div>
									<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pendamping Pejabat Struktural</label>

									<div class="col-sm-9">
									<select class="col-xs-10 col-sm-5 products" name="infant_eselon[]" data-tags="false" data-placeholder="Select an option">
					  				<?php
									echo "<option value=''></option>";
					  				foreach ($name_pic as $key => $value) {
										$selected ="";
											if (!empty($infant_eselon)) {
												foreach ($infant_eselon as $keys => $values) {
													foreach ($values as $k => $v) {
														if ($v->id_user == $value['id_user']) {
															$selected ="selected='selected'";
														}
													}
												}
											}
										echo "<option value = ".$value['id_user']." ".$selected.">".$value['name_pic']."</option>";
					  				}


					  				 ?>
                     			 </select>
                     			 </div>
                     			</div>
										<input type="hidden" name="_token" value="{{ csrf_token() }}">

									<!-- <input type="submit" name="simpan"> -->

									<div class="clearfix form-actions">
										@if(!empty($id_rapat))
										<input type="hidden" name="update" value="{{$id_rapat}}">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Edit
											</button>
										@else
											<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
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
										<div class="pull-right" style="padding-right:20px;padding-top:5px">
										    <a href="#">
											 <button type="button" class="btn btn-info waves-effect edit-menu modalFilterKapus">Filter</button>
										    </a>
										</div>
										<h3 class="header smaller lighter blue">Data Kapus</h3>
										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
		                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
		                        <thead>
		                            <tr>
		                                <th>Agenda</th>
		                                <th>Waktu Mulai</th>
		                                <th>Waktu Akhir</th>
		                                <th>Status</th>
		                                <th>Tempat</th>
		                                <th>Detail</th>
		                                <th>action</th>
		                            </tr>
		                        </thead>

		                    </table>
						</div>
					</div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
	<!-- Modal -->
     <div class="modal fade filterKapus" role="dialog">
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
	   						<option value="bulan">Bulan</option>
	   						<option value="tahun">Tahun</option>
	      					</select>
	      				</div>
	      			</div>
				<div class="form-group">
       				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agenda </label>

       				<div class="col-sm-9">
       					<input type="text" id="form-field-1" placeholder="Agenda" class="col-xs-10 col-sm-5 agenda_rapatKapus" name="agenda_rapat" value="" />
       				</div>
       			</div>
       			<div class="form-group">
       				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pelaksana </label>

       				<div class="col-sm-9">
       					<input type="text" id="form-field-1" placeholder="Pelaksana" class="col-xs-10 col-sm-5 pj_rapatKapus" name="pj_rapat" value="" />
       				</div>
       			</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> PIC </label>

					<div class="col-sm-9">
						<input type="text" id="form-field-1" placeholder="PIC" class="col-xs-10 col-sm-5 PIC" name="PIC" value="{{!empty($PIC) ? $PIC : ''}}" />
					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Waktu</label>

				<div class="col-sm-9">
					<p>
						<input type="text" name="start_tgl_rapat" class="start_filter">
						-
						<input type="text" name="end_tgl_rapat" class="end_filter">
					</p>

				</div>
				</div>
    	   </div>
    	   <div class="modal-footer">
    		   <button class="btn btn-info ajaxSearchKapus" type="button">
    			   <i class="ace-icon fa fa-check bigger-110"></i>
    			   Search
    		   </button>
    		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	   </div>
    	 </div>
   	 	</form>
       </div>
     </div>
	<!-- /.main-content -->
	@section('js')
	<?php
	$data_eselon = !empty ($infant_eselon) ? $infant_eselon : [];
	$data_eselon_undang = !empty ($undang_eselon) ? $undang_eselon : [];
	 ?>
	<script>
	var urlAjaxTable = "{{ URL::to(route('kapus.indexAjax')) }}";
	var dataSelected = <?php echo json_encode($data_eselon) ?>;
	var dataSelectedUndang = <?php echo json_encode($data_eselon_undang) ?>;
	var  urlEdit = "{{url('/admin/kapus-edit')}}";
    var  urlAjaxShow = "{{url('/admin/kapus-show')}}";
    var  urlDelete = "{{url('/admin/kapus-delete')}}";
	var urlView ="{{url('/admin/kapus-show-ruangan')}}";
	var urlSelect2 = "{{url(route('kapus.searchAjax'))}}";
    var token = "{{ csrf_token() }}";
    	$('.status').change(function(){
    		var status = $(this).val();
    		if (status == "internal") {
    			$(".block-tempat").addClass('hidden');
    			$(".block-ruangan").removeClass('hidden');
    		}else if(status == "external"){
    			$(".block-ruangan").addClass('hidden');
    			$(".block-tempat").removeClass('hidden');

    		}else{
				$(".block-ruangan").addClass('hidden');
				$(".block-tempat").addClass('hidden');
			}
    	});
		$('.status_pelaksana').change(function(){
			var status = $(this).val();
			if (status == "nonunitkerja") {
				$(".unitkerja").addClass('hidden');
				$(".nonunitkerja").removeClass('hidden');
			}else if (status == "unitkerja"){
				$(".nonunitkerja").addClass('hidden');
				$(".unitkerja").removeClass('hidden');

			}else{
				$(".nonunitkerja").addClass('hidden');
				$(".unitkerja").addClass('hidden');
			}
		});
		$('.status_fasilitator').change(function(){
			var status = $(this).val();
			if (status == "unitkerjaFasilitator") {
				$(".nonunitkerjaFasilitator").addClass('hidden');
				$(".unitkerjaFasilitator").removeClass('hidden');
			}else if (status == "nonunitkerjaFasilitator"){
				$(".unitkerjaFasilitator").addClass('hidden');
				$(".nonunitkerjaFasilitator").removeClass('hidden');

			}else{
				$(".nonunitkerjaFasilitator").addClass('hidden');
				$(".unitkerjaFasilitator").addClass('hidden');
			}
		});
		$('.pelaksana').select2({
				tags :false,
				multiple :false,
				 ajax: {
					url : urlSelect2,
					type : "GET",
					dataType :"JSON",

					data: function(term, page) {
					  return {
						q: term
					  };
					},
					processResults: function(data, page) {
							return { results: data };
					 }

				  }
				});
    	$(".js-example-tokenizer").select2({
		  tags: true,
		  multiple :true
		});
    	$(".infant").select2({
		  tags: true,
		  multiple :true
		});

    var listTable = $('.listTable').DataTable( {
        "processing": false,
        "bFilter": false,
        "bInfo": false,
        "bLengthChange": false,
        "serverSide": true,
        "ajax": {
             "url": urlAjaxTable,
             "type": "GET"
         },
         "columns": [
            { "data": "agenda_rapat" },
            { "data": "start_tgl_rapat" },
            { "data": "end_tgl_rapat" },
            { "data": "status_ruangan_rapat" },
            { "data": "tempat_rapat" },
            { "render": function (data, type, row, meta) {

                        var show = $('<a><button>')
                                    .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                    .attr('onclick', "showProcess('"+row.id_rapat+"')")
                                    .text('Show')
                                    .wrap('<div></div>')
                                    .parent()
                                  .html();


                        return show ;
           					 }
            },
			{ "render": function (data, type, row, meta) {

					   var edit = $('<a><button><i>')
								   .attr('class', "btn bg-blue-grey waves-effect edit-menu material-icons")
								   .attr('href',urlEdit+'/'+row.id_rapat)
								   .text('mode_edit')
								   .wrap('<div></div>')
								   .parent()
								   .html();
				   var del = $('<button><i>')
					   .attr('class', "btn btn-danger waves-effect delete-menu material-icons ")
					   .attr('onclick', "deletProcess('"+row.id_rapat+"')")
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

    function showProcess(id_rapat){
		window.open(urlAjaxShow+"?id_rapat="+id_rapat,"width=800px, height=500px");
	}

    function deletProcess(id_rapat){
    swal({
        title: "Apakah anda yakin ?",
        text: "Anda akan menghapus data.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete ",
        closeOnConfirm: true,
    }, function () {
         window.location.href = urlDelete+'/'+id_rapat;
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

	$('.modalFilterKapus').click(function(){
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
		$('.start_filter').val("");
		$('.end_filter').val("");
		 $('.filterKapus').modal('show');

	});
	$('.start_tgl_rapat').appendDtpicker({
		"closeOnSelected": true,
		"closeOfSelected": true
	});

	$('.end_tgl_rapat').appendDtpicker({
		"closeOnSelected": true
	});

	$('.end_filter').appendDtpicker({
		"closeOnSelected": true
	});
	$('.start_filter').appendDtpicker({
		"closeOnSelected": true
	});
	$('.ajaxSearchKapus').click(function () {
		var waktuM = $('.start_filter').val();
		var waktuA = $('.end_filter').val();
		if (waktuM != '' && waktuA == '') {
				swal("GAGAL!!",'Waktu Akhir harap Di isi!')
			return false;
		}
		if (waktuM == '' && waktuA != '') {
			swal("GAGAL!!",'Waktu Mulai harap Di isi!')
			return false;
		}
		$('.filterKapus').modal('hide');
		var agenda_rapat = $('.agenda_rapatKapus').val();
		var Pic = $('.PIC').val();
		var pj_rapat = $('.pj_rapatKapus').val();
		var filterWaktu = $('.filterWaktu').val();
		$('.listTable').DataTable( {
		"processing": true,
		"bFilter": false,
		"bInfo": false,
		"bLengthChange": false,
		"serverSide": true,
		"ajax": {
			 "url": urlAjaxTable,
			 "type": "GET",
			 "data" : {
				 waktuM : waktuM,
				 waktuA : waktuA,
				 agenda_rapat : agenda_rapat,
				 filterWaktu : filterWaktu,
				 Pic : Pic,
				 pj_rapat : pj_rapat
			 }
		 },
		 "columns": [
			{ "data": "agenda_rapat" },
			{ "data": "start_tgl_rapat" },
			{ "data": "end_tgl_rapat" },
			{ "data": "status_ruangan_rapat" },
			{ "data": "tempat_rapat"  },
			{ "render": function (data, type, row, meta) {

                        var show = $('<a><button>')
                                    .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                    .attr('onclick', "showProcess('"+row.id_rapat+"')")
                                    .text('Show')
                                    .wrap('<div></div>')
                                    .parent()
                                  .html();


                        return show ;
           					 }
            },
			{ "render": function (data, type, row, meta) {

					   var edit = $('<a><button><i>')
								   .attr('class', "btn bg-blue-grey waves-effect edit-menu material-icons")
								   .attr('href',urlEdit+'/'+row.id_rapat)
								   .text('mode_edit')
								   .wrap('<div></div>')
								   .parent()
								   .html();
				   var del = $('<button><i>')
					   .attr('class', "btn btn-danger waves-effect delete-menu material-icons ")
					   .attr('onclick', "deletProcess('"+row.id_rapat+"')")
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
	   ],
		     "destroy" : true
		});
	});
	$('#showRuangan').click(function(){

		var waktuM = $('.start_tgl_rapat').val();
		var waktuA = $('.end_tgl_rapat').val();
		 window.open(urlView+"?waktuM="+waktuM+"&waktuA="+waktuA,"width=800px, height=500px");

	});
	$('#tambahHari').click(function(){
		$(".block-tambahHari").removeClass('hidden');
		// $(".block-ruangan").removeClass('hidden');

	});
	$('.products').select2({
			tags :false,
			tokeSeparators :[","," "],
			multiple :true,
			 ajax: {
				url : urlSelect2,
				type : "GET",
				dataType :"JSON",

				data: function(term, page) {
				  return {
					q: term
				  };
				},
				processResults: function(data, page) {
						return { results: data };
				 }

			  }
			});
var ds = [];
 $(dataSelected).each(function(index,value){
	$(value).each(function(i,v){
	 	ds.push(v.id_user);
 	});
});
$('.products').val(ds).trigger("change");

	$('.products1').select2({
			tags :false,
			tokeSeparators :[","," "],
			multiple :true,
			 ajax: {
				url : urlSelect2,
				type : "GET",
				dataType :"JSON",

				data: function(term, page) {
				  return {
					q: term
				  };
				},
				processResults: function(data, page) {
						return { results: data };
				 }

			  }
			});
var dsUndang = [];
 $(dataSelectedUndang).each(function(index,value){
	$(value).each(function(i,v){
	 	dsUndang.push(v.id_user);
 	});
});
$('.products1').val(dsUndang).trigger("change");


</script>
			<style type="text/css">

.daterangepicker{
	z-index:9999 !important;
}

		</style>


		@endsection
@stop
