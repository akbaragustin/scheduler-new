
@include('layouts.header')
<div class="row">
            <div class="col-xs-12">
                <h3 class="header smaller lighter blue">Data Ruangan {{$data[0]['tanggalM']}} s/d {{$data[0]['tanggalA']}}</h3>

                <div class="pull-right">
                    <a href="#" id="closeRuangan">
                        <i class="material-icons">backspace</i>
                    </a>
                </div>
                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable listTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Kapasitas</th>
                <th>Status</th>
                <th>keterangan</th>
                <th>waktu</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // echo "<pre>";
            // print_r($data);die;
            if (!empty($data)) {
            $i =1;
            foreach ($data as $key => $value) {

            ?>
        <tr>
            <td>{{$i}}</td>
            <td>{{$value['ruangan']}}</td>
            <td>{{$value['kapasitas']}}</td>
            <td>{{$value['status']}}</td>
            <td>
                <ul>
                    <?php
                    foreach ($value['showIsi'] as $ks => $vs) {
                    ?>
                    <li>{{$vs->agenda_rapat}}</li><hr>
                    <?php } ?>
                </ul>
            </td>
            <td>
                <ul>
                    <?php
                    foreach ($value['showIsi'] as $k => $v) {
                    ?>
                    <li>{{date('d-m-Y H:i A' ,strtotime($v->start_tgl_rapat))}} s/d {{date('d-m-Y H:i A' ,strtotime($v->end_tgl_rapat))}}</li><hr>
                    <?php } ?>
                </ul>
            </td>
        </tr>
        <?php $i++;}}
         ?>
        </tbody>
    </table>


</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
 // Handler for .ready() called.
    $('#closeRuangan').click(function(){
         window.close();
    });
</script>
