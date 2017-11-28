@if (!empty (\Session::get('messageError')))
<script type="text/javascript">

 swal("{{\Session::get('messageError')}}")

</script>

@endif
@if (!empty (\Session::get('insertError')))
<script type="text/javascript">

 swal("{{\Session::get('insertError')}}",'Isi Semua Data!','error')

</script>

@endif
@if (!empty (\Session::get('insertSuccess')))
<script type="text/javascript">

 swal("{{\Session::get('insertSuccess')}}", "You clicked the button!", "success")

</script>

@endif
@if (!empty (\Session::get('DeleteFails')))
<script type="text/javascript">

 swal("Gagal Menghapus !!", "{{\Session::get('DeleteFails')}}", "error")

</script>

@endif
@if (!empty (\Session::get('DeleteSucces')))
<script type="text/javascript">

 swal("GOOD", "{{\Session::get('DeleteSucces')}}", "success")

</script>

@endif

@if (!empty(\Session::get('insertFailsInfantUndang')))
<script type="text/javascript">
 swal("Gagal Menyimpan","Nama Infant dan Nama pejabat yang di undang sama !",'error')
</script>
@endif
@if (!empty(\Session::get('insertFailsdate')))
<script type="text/javascript">
 swal("Gagal Menyimpan","waktu mulai lebih besar dari waktu akhir !",'error')
</script>
@endif
@if (!empty(\Session::get('insertFailsRuangan')))
<script type="text/javascript">
 swal("Gagal Menyimpan","Ruangan yang anda gunakan sudah terisi",'error')
</script>
@endif
