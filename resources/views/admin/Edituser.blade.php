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
								
								<form class="form-horizontal" role="form" action="{{url(route('users.updateEdit'))}}" method="POST" >
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
															if ($id_jabatan	== $value['id_jabatan'])
																$selected ="selected";
															
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
			</div><!-- /.row -->
		</div><!-- /.page-content -->	
	</div><!-- /.main-content -->
@stop