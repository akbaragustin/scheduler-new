<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="{{ URL::asset('') }}assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<div class="pull-right">
    <a href="#" class="closeRuangan">
        <i class="material-icons">backspace</i>
    </a>
</div>
<div class="row">
<div class="col-xs-6">
    <center>
    <h3 class="header smaller lighter blue">Infant</h3>
    </center>

    <table class="dataTablesView table table-bordered table-striped table-hover js-basic-example listTable no-footer" style="width:100%">
    <thead>
    <tr>
        <th>No</th>
        <th>Infant</th>
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
<h3 class="header smaller lighter blue">Infant Eselon</h3>
</center>

<table class="dataTablesViewInfantEselon table table-bordered table-striped table-hover js-basic-example listTable no-footer" style="width:100%">
    <thead>
    <tr>
        <th>No</th>
        <th>Infant Eselon</th>
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
<div class="row">
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

<h3 class="header smaller lighter blue">Pejabat Yang Diundang Eselon</h3>
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

<script src="{{ URL::asset('') }}assets/js/jquery-2.1.4.min.js"></script>
<script src="{{ URL::asset('') }}assets/js/jquery.dataTables.min.js"></script>
<script src="{{ URL::asset('') }}assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$('.dataTablesView').DataTable();
$('.dataTablesViewInfantEselon').DataTable();
$('.dataTablesViewUndangEselon').DataTable();
$('.dataTablesViewPejabat').DataTable();
</script>
