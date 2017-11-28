@include('layouts.header')
<div class="pull-right">
    <a href="#" class="closeRuangan">
        <i class="material-icons">backspace</i>
    </a>
</div>
<div class="row" style="padding-right:25px;padding-left:25px">
    <div class="cols-xs-12">
        <table class="dataTablesRapat table table-bordered table-striped table-hover js-basic-example listTable no-footer" style="width:100%">
        <thead>
        <tr>
            <th>No</th>
            <th>Agenda</th>
            <th>Mulai Rapat</th>
            <th>Akhir Rapat</th>
            <th>Status Ruangan</th>
            <th>Tempat</th>
            <th>Pelaksana</th>
            <th>PIC</th>
            <th>Fasilitator</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $i =1;
            foreach ($data as $key => $value) {

            ?>
            <tr>
                <td>{{$i}}</td>
                <td>{{$value['agenda_rapat']}}</td>
                <td>{{$value['start_tgl_rapat']}}</td>
                <td>{{$value['end_tgl_rapat']}}</td>
                <td>{{$value['status_ruangan_rapat']}}</td>
                <td>{{!empty ($value['ruangan_rapat']) ? $value['ruangan_rapat'] : $value['tempat_rapat'] }}</td>
                <td>{{$value['pj_rapat']}}</td>
                <td>{{$value['PIC']}}</td>
                <td>{{$value['fasilitator']}}</td>
            </tr>
            <?php $i++; } ?>
        </tbody>

    </table>
    </div>
</div>
<?php
    $dataEselon ="hidden";
    $dataNonEselon ="";
    if (!empty($data[0]['name_eselon'])) {
        $dataEselon ="";
        $dataNonEselon ="hidden";
    }
 ?>
<div class="row nonEselon {{$dataNonEselon}}" style="padding-right:25px;padding-left:25px">
<div class="col-xs-6">
    <center>
    <h3 class="header smaller lighter blue">Pendamping</h3>
    </center>

    <table class="dataTablesView table table-bordered table-striped table-hover js-basic-example listTable no-footer" style="width:100%">
    <thead>
    <tr>
        <th>No</th>
        <th>Pendamping</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $i =1;
        foreach ($data as $key => $value) {
            foreach ($value['name_infant'] as $kie => $vie){
        ?>
        <tr>
            <td>{{$i}}</td>
            <td>{{$vie->disposisi_rapat}}</td>
        </tr>
        <?php $i++; }} ?>
    </tbody>

</table>
</div>
<div class="col-xs-6">
<center>
<h3 class="header smaller lighter blue">Pendamping Pejabat Struktural</h3>
</center>

<table class="dataTablesViewInfantEselon table table-bordered table-striped table-hover js-basic-example listTable no-footer" style="width:100%">
    <thead>
    <tr>
        <th>No</th>
        <th>Pendamping Pejabat Struktural</th>
        <th>Unit Kerja</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $i =1;
        foreach ($data as $key => $value) {
            foreach ($value['infant_eselon'] as $k => $v){
        ?>
        <tr>
            <td>{{$i}}</td>
            <td>{{$v->name_pic}}</td>
            <td>{{$v->name_unit_kerja}}</td>
        </tr>
        <?php $i++; }} ?>
    </tbody>

</table>
</div>
</div>
<div class="row nonEselon {{$dataNonEselon}}" style="padding-right:25px;padding-left:25px">
<div class="col-xs-6">
    <center><h3 class="header smaller lighter blue">Pejabat Yang Diundang</h3></center>
    <table class="dataTablesViewPejabat table table-bordered table-striped table-hover js-basic-example listTable no-footer" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Pejabat Yang Diundang</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i =1;
        foreach ($data as $key => $value) {
            foreach ($value['disposisi_rapat'] as $k => $v){
        ?>
        <tr>
            <td>{{$i}}</td>
            <td>{{$v->disposisi_rapat}}</td>
        </tr>
        <?php $i++; }} ?>
    </tbody>

</table>
</div>
<div class="col-xs-6">
<center>

<h3 class="header smaller lighter blue">Pejabat Yang Diundang Struktural</h3>
</center>
<table class="dataTablesViewPejabat table table-bordered table-striped table-hover js-basic-example listTable no-footer" style="width:100%">
    <thead>
    <tr>
        <th>No</th>
        <th>Pejabat Yang Diundang Eselon</th>
        <th>Unit Kerja</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $i =1;
        foreach ($data as $key => $value) {
            foreach ($value['undang_eselon'] as $k => $v){
        ?>
        <tr>
            <td>{{$i}}</td>
            <td>{{$v->name_pic}}</td>
            <td>{{$v->name_unit_kerja}}</td>
        </tr>
        <?php $i++; }} ?>
    </tbody>
    </table>
    </div>
</div>
<div class="row eselon {{$dataEselon}} "style="padding-right:25px;padding-left:25px">
    <div class="col-xs-6">
        <center>
        <h3 class="header smaller lighter blue">Pendamping</h3>
        </center>

        <table class="dataTablesView table table-bordered table-striped table-hover js-basic-example listTable no-footer" style="width:100%">
        <thead>
        <tr>
            <th>No</th>
            <th>Pendamping</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $i =1;
            foreach ($data as $key => $value) {
                foreach ($value['name_infant'] as $kie => $vie){
            ?>
            <tr>
                <td>{{$i}}</td>
                <td>{{$vie->disposisi_rapat}}</td>
            </tr>
            <?php $i++; }} ?>
        </tbody>

    </table>
    </div>
    <div class="col-xs-6">
    <center>
    <h3 class="header smaller lighter blue">Name Pejabat Struktural</h3>
    </center>

    <table class="dataTablesViewNameEselon table table-bordered table-striped table-hover js-basic-example listTable no-footer" style="width:100%">
        <thead>
        <tr>
            <th>No</th>
            <th>Pendamping Pejabat Struktural</th>
            <th>Unit Kerja</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $i =1;
            foreach ($data as $key => $value) {
                foreach ($value['name_eselon'] as $k => $v){
            ?>
            <tr>
                <td>{{$i}}</td>
                <td>{{$v->name_pic}}</td>
                <td>{{$v->name_unit_kerja}}</td>
            </tr>
            <?php $i++; }} ?>
        </tbody>

    </table>
    </div>
    </div>
</table>
</div>
</div>

<script src="{{ URL::asset('') }}assets/js/jquery-2.1.4.min.js"></script>
<script src="{{ URL::asset('') }}assets/js/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('') }}assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$('.closeRuangan').click(function(){
     window.close();
})
$('.dataTablesView').DataTable();
$('.dataTablesViewInfantEselon').DataTable();
$('.dataTablesViewUndangEselon').DataTable();
$('.dataTablesViewPejabat').DataTable();
$('.dataTablesViewNameEselon').DataTable();
</script>
