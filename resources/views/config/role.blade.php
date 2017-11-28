
@extends('layouts.index')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card">
      <div class="page-header">
          <h1>
           Form Role
            <small>
              (Isi dengan lengkap dan jelas)
            </small>
          </h1>
      </div><!-- /.page-header -->

            <form id="form-menu-role" action="{{url(route('config.roleSave'))}}" method="post" enctype="multipart/form-data">
        <div class="row clearfix">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="body">
                    <!-- Vertical Layout -->

                       <div class="row clearfix">
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                   <label for="email_address">User Group</label>
                                   <div class="form-group">
                                       <div class="form-line">
                                           <select class="form-control change"  id ="mySelect"  name="group_name">
                                               <option value=""> ----- </option>
                                               @foreach($listGroup as $key => $val)
                                                    <option value="{{$val->id_jabatan}}">{{$val->name_jabatan}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <br>
                                   <button type="submit" class="btn btn-primary waves-effect btn-save-role">SAVE</button>
                           </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 listView">

        </div>
                       </div>

                </div>
            </div> <!-- enf form -->
     </div>
                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
  </div>
    <style>
        h2.group-title{
            margin-left:15px
        }
        [type="checkbox"]:not(:checked), [type="checkbox"]:checked {
            position: relative !important;
            left: 0px !important;
            opacity: 1 !important;
        }
    </style>
</section>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros vestibulum ut. Ut accumsan
                            vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus ullamcorper.
                            Fusce pulvinar libero vel ligula iaculis ullamcorper. Integer dapibus, mi ac tempor varius, purus
                            nibh mattis erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa egestas fringilla.
                            Vestibulum egestas consectetur nunc at ultricies. Morbi quis consectetur nunc.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

@section('js')


<script>
    var urlEditMenuSelected = "{{url(route('config.reloadMenu'))}}";

   $(".change").change(function(){
    var id = $(this).val();

    $.ajax({
       type : "GET",
       dataType :"json",
       url :urlEditMenuSelected,
       data :{'id' :id},
       success : function(retval){
        $(".listView").html(retval.html);
        console.log(retval.html);
       }
    });

   });
</script>
@endsection
@stop
