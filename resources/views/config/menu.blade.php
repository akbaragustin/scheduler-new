     @extends('layouts.index')
    @section('content')

    <div class="main-content">
            <div class="main-content-inner">
                <div class="page-header">
                            <h1>
                                Form Menu
                                <small>
                                (Isi dengan lengkap dan jelas)
                                </small>
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-xs-12">
                            @if (!empty($id_menu))
                            <form class="form-horizontal" role="form" method="POST" action="{{url(route('config.menuUpdate'))}}">
                            @else
                            <form class="form-horizontal" role="form" method="POST" action="{{url(route('config.menuSave'))}}">
                            @endif
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Menu Name</label>

                                        <div class="col-sm-9">
                                            <input type="text" id="form-field-1" placeholder="Name Menu" class="col-xs-10 col-sm-5" name="name_menu" value="{{!empty($name_menu) ? $name_menu : ''}}" />

                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Url/Link</label>

                                        <div class="col-sm-9">
                                            <input type="text" id="form-field-1" placeholder="Url/Link" class="col-xs-10 col-sm-5 " name="url_menu" value="{{!empty($url_menu) ? $url_menu : ''}}" />
                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Parent</label>

                                        <div class="col-sm-9">
                                            <input type="text" id="parent_menu_name" placeholder="Parent" class="col-xs-10 col-sm-5 openParent" name="parent_name" value="{{isset($parent_name) ? $parent_name : 'Root'}}" />
                                            <input type="hidden" id="parent_menu" placeholder="Parent" class="col-xs-10 col-sm-5 openParent" name="parent_menu" value="{{isset($parent_menu) ? $parent_menu : ''}}" />
                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Icon</label>

                                        <div class="col-sm-9">
                                            <input type="text" id="icon_menu_name" placeholder="Icon" class="col-xs-10 col-sm-5 onIcon" name="icon_menu" value="{{!empty($icon_menu) ? $icon_menu : ''}}" />
                                        </div>
                                    </div>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <!-- <input type="submit" name="simpan"> -->

                                    <div class="clearfix form-actions">
                                        @if (!empty($id_menu))
                                          <input type="hidden" name="update" value="{{$id_menu}}">
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
                                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id ="myTable">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Url/Link</th>
                                        <th>Parent</th>
                                        <th>Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                   foreach ($dataMenu as $key => $value) {
                                ?>
                                    <tr>
                                        <td>{{$value->name_menu}}</td>
                                        <td>{{$value->url_menu}}</td>
                                        <td>{{$value->parent_menu}}</td>

                                        <td><i class="material-icons">{{$value->icon_menu}}</i></td>
                                        <td>
                                            <a href="{{url('/admin/config/menu-edit')}}/{{$value->id_menu}}" class="btn bg-blue-grey waves-effect edit-menu material-icons">
                                                mode_edit
                                            </a>

                                            <div class="btn btn-danger waves-effect delete-menu material-icons" onclick="deletProcess({{$value->id_menu}})">
                                                delete
                                            </div>

                                        </td>
                                        
                                    </tr>


                                <?php
                                   }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    @section('js')
<script type="text/javascript">
var urlView = "{{url('/admin/config/menu-view')}}";
var urlViewIcon = "{{url('/admin/config/menu-viewIcon')}}";
var  urlDelete = "{{url('/admin/config/menu-delete')}}";
    $(".openParent").click(function(){

        window.open(urlView,"","width=800px, height=500px");
    });
  $(".onIcon").click(function(){

        window.open(urlViewIcon,"","width=800px, height=500px");
    });
    $('#myTable').DataTable();

  function deletProcess(id_menu){
    swal({
        title: "Apakah anda yakin ?",
        text: "Anda akan menghapus data.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete ",
        closeOnConfirm: true,
    }, function () {
         window.location.href = urlDelete+'/'+id_menu;
     });
    }

</script>
    @endsection
@stop
