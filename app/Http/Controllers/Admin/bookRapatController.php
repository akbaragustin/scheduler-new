<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use App\Models\Ruangan as RU;
use App\Models\Invite_name as IN;
use App\Models\Invite_jabatan as IJ;
use App\Models\Schedule as SC;
use App\Models\Rapat as RP;
use App\Models\UnitKerja;
use App\Models\Master_pic as MP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class bookRapatController extends Controller
{
       private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['master_pic'] = MP::All()->toArray();
        $data['unit_kerja'] = UnitKerja::all()->toArray();
        $data['name_pic'] = US::whereNotNull('name_pic')->get()->toArray();
        $data['allRuangan'] = RU::all()->toArray();
       return view('admin/booking_internal',$data);
    }

    public function save()
    {

        $infant_eselon = Input::get('infant_eselon');
        $undang_eselon = Input::get('undang_eselon');
        $id_user =Session()->get('auth');
        $start =date("Y-m-d H:i:s",strtotime(substr(Input::get('start_tgl_rapat'), 0,-3).":00"));
        $end = date("Y-m-d H:i:s",strtotime(substr(Input::get('end_tgl_rapat'), 0,-3).":00"));
        $s = strtotime(substr(Input::get('start_tgl_rapat'), 0,-3).":00");
        $e = strtotime(substr(Input::get('end_tgl_rapat'), 0,-3).":00");
        $tambahHari = Input::get('tambahHari');
        if ($s >  $e ) {
            \Session::flash('insertFailsdate','gagal');
            return \Redirect::to(route('booking_internal.index'));
        }
        if (!empty (Input::get('ruangan_rapat'))) {
            $data['start'] =$start;
            $data['end'] =$end;
            $data['ruangan'] =Input::get('ruangan_rapat');
            $checkRuangan =RP::checkRuanganBook($data);


            if (!empty($checkRuangan)) {

                 \Session::flash('insertFailsRuangan','gagal');
             return \Redirect::to(route('booking_internal.index'));
            }

        }
        //Validasi Infat & pejabat Yang diundang
        if (!empty($infant_eselon) && !empty($undang_eselon)) {
        foreach ($infant_eselon as $key => $value) {
           foreach ($undang_eselon as $k => $v) {
              if ($value == $v) {
                 \Session::flash('insertFailsInfantUndang','gagal');
                 return \Redirect::to(route('booking_internal.index'));
                 }
               }
            }
        }
        $rules=[
            'start_tgl_rapat'=>'required',
            'end_tgl_rapat'=>'required',
            'agenda_rapat'=>'required',
            'status_ruangan_rapat'=>'required'
             ];
        $messages=[
            'start_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'end_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'agenda_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'status_ruangan_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
          ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
        $eselon =new RP;
        $eselon->agenda_rapat =Input::get('agenda_rapat');
        $eselon->start_tgl_rapat =$start;
        $eselon->end_tgl_rapat =$end;
        $eselon->status_ruangan_rapat =Input::get('status_ruangan_rapat');
        $eselon->PIC =Input::get('PIC');
        $eselon->creator =$id_user['id_user'];
        $eselon->created =date('Y-m-d H:i:s');
        if (!empty(Input::get('tempat_rapat'))) {
        $eselon->tempat_rapat =Input::get('tempat_rapat');

        }
        $eselon->status_pelaksana =Input::get('status_pelaksana');
        if (!empty(Input::get('pelaksana'))) {
                $dataPelaksana = Input::get('pelaksana');

        }else{
            $dataPelaksana =Input::get('pj_rapat');
        }
        $eselon->status_fasilitator =Input::get('status_fasilitator');
        if (!empty(Input::get('fasilitator'))) {
            $dataF = Input::get('fasilitator');

        }else{
            $dataF =Input::get('fasilitatornon');
        }
        $eselon->fasilitator =$dataF;
        $eselon->phari =$tambahHari;
        $eselon->pj_rapat =$dataPelaksana;
        $eselon->status_active_rapat =2;
        $eselon->id_ruangan =Input::get('ruangan_rapat');
        $eselon->save();

        $last_id = $eselon->id_rapat;
        //Insert Infant Nama Bebas (No Db)
        $name_infant = Input::get('name_infant');
        if (!empty($name_infant)) {
            foreach ($name_infant as $key => $value) {
                $invite_name = new IN;
                $invite_name ->id_rapat = $last_id;
                $invite_name ->disposisi_rapat = $value;
                $invite_name ->status_jabatan = 2;
                $invite_name->save();
            }
        }
        //Insert Pejabat Yang di Undang Nama Bebas (NO DB)
        $pejabat_undang = Input::get('disposisi_rapat');
        if (!empty($pejabat_undang)) {
            foreach ($pejabat_undang as $key => $value) {
                $invite_name = new IN;
                $invite_name ->id_rapat = $last_id;
                $invite_name ->disposisi_rapat = $value;
                $invite_name ->status_jabatan = 3;
                $invite_name->save();
            }
        }
        //Insert Rapat Eselon Type Infant
    if (!empty($infant_eselon)) {
        foreach ($infant_eselon as $key => $value) {
            $schedule = new SC;
            $schedule ->id_rapat = $last_id;
            $schedule ->id_user = $value;
            $schedule ->status_jabatan = 2;
            $schedule->save();
        }
    }
        //Insert Rapat Eselon Type Pejabat Yang Di Undang
    if (!empty($undang_eselon)) {
        foreach ($undang_eselon as $key => $value) {
            $schedule = new SC;
            $schedule ->id_rapat = $last_id;
            $schedule ->id_user = $value;
            $schedule ->status_jabatan = 3;
            $schedule->save();
        }
    }
    if (!empty($infant_eselon) OR !empty($undang_eselon)) {
        $invite_jabatan_eselon = new IJ;
        $invite_jabatan_eselon ->id_rapat =$last_id;
        $invite_jabatan_eselon ->id_jabatan =15;
        $invite_jabatan_eselon->save();
    }
        $invite_jabatan = new IJ;
        $invite_jabatan ->id_rapat =$last_id;
        $invite_jabatan ->id_jabatan =18;
        $invite_jabatan->save();


        //tambahHari
        if (!empty($tambahHari)) {
            for ($i=1; $i<=$tambahHari ; $i++) {
                $startTambah =date('Y-m-d H:i:s',strtotime($start .'+'.$i.' day'));
                $endTambah =date('Y-m-d H:i:s',strtotime($end .'+'.$i.' day'));
                if (!empty (Input::get('ruangan_rapat'))) {
                    $data['start'] =$startTambah;
                    $data['end'] =$endTambah;
                    $data['ruangan'] =Input::get('ruangan_rapat');
                    $checkRuangan =RP::checkRuangan($data);

                    if (!empty($checkRuangan)) {

                         \Session::flash('insertFailsRuangan','gagal');
                     return \Redirect::to(route('eselon.index'));
                    }
                }
                $eselon =new RP;
                $eselon->agenda_rapat =Input::get('agenda_rapat');
                $eselon->start_tgl_rapat =$startTambah;
                $eselon->end_tgl_rapat =$endTambah;
                $eselon->status_id_rapat =$last_id;
                $eselon->status_ruangan_rapat =Input::get('status_ruangan_rapat');
                $eselon->PIC =Input::get('PIC');
                $eselon->creator =$id_user['id_user'];
                $eselon->created =date('Y-m-d H:i:s');
                if (!empty(Input::get('tempat_rapat'))) {
                $eselon->tempat_rapat =Input::get('tempat_rapat');

                }
                $eselon->status_pelaksana =Input::get('status_pelaksana');
                if (!empty(Input::get('pelaksana'))) {
                    $dataPelaksana = Input::get('pelaksana');

                }else{
                    $dataPelaksana =Input::get('pj_rapat');
                }
                $eselon->status_fasilitator =Input::get('status_fasilitator');
                if (!empty(Input::get('fasilitator'))) {
                    $dataF = Input::get('fasilitator');

                }else{
                    $dataF =Input::get('fasilitatornon');
                }
                $eselon->fasilitator =$dataF;
                $eselon->pj_rapat =$dataPelaksana;
                $eselon->status_active_rapat =2;
                $eselon->id_ruangan =Input::get('ruangan_rapat');
                $eselon->save();

                $last_idTambah = $eselon->id_rapat;
                //Insert Infant Nama Bebas (No Db)
                $name_infant = Input::get('name_infant');
                if (!empty($name_infant)) {
                    foreach ($name_infant as $key => $value) {
                        $invite_name = new IN;
                        $invite_name ->id_rapat = $last_idTambah;
                        $invite_name ->status_id_rapat = $last_id;
                        $invite_name ->disposisi_rapat = $value;
                        $invite_name ->status_jabatan = 2;
                        $invite_name->save();
                    }
                }
                //Insert Pejabat Yang di Undang Nama Bebas (NO DB)
                $pejabat_undang = Input::get('disposisi_rapat');
                if (!empty($pejabat_undang)) {
                    foreach ($pejabat_undang as $key => $value) {
                        $invite_name = new IN;
                        $invite_name ->id_rapat = $last_idTambah;
                        $invite_name ->status_id_rapat = $last_id;
                        $invite_name ->disposisi_rapat = $value;
                        $invite_name ->status_jabatan = 3;
                        $invite_name->save();
                    }
                }
                //Insert Rapat Eselon Type Infant
            if (!empty($infant_eselon)) {
                foreach ($infant_eselon as $key => $value) {
                    $schedule = new SC;
                    $schedule ->id_rapat = $last_idTambah;
                    $schedule ->status_id_rapat = $last_id;
                    $schedule ->id_user = $value;
                    $schedule ->status_jabatan = 2;
                    $schedule->save();
                }
            }
                //Insert Rapat Eselon Type Pejabat Yang Di Undang
            if (!empty($undang_eselon)) {
                foreach ($undang_eselon as $key => $value) {
                    $schedule = new SC;
                    $schedule ->id_rapat = $last_idTambah;
                    $schedule ->status_id_rapat = $last_id;
                    $schedule ->id_user = $value;
                    $schedule ->status_jabatan = 3;
                    $schedule->save();
                }
            }
            if (!empty($infant_eselon) OR !empty($undang_eselon)) {
                $invite_jabatan_eselon = new IJ;
                $invite_jabatan_eselon ->id_rapat =$last_idTambah;
                $invite_jabatan_eselon ->status_id_rapat =$last_id;
                $invite_jabatan_eselon ->id_jabatan =15;
                $invite_jabatan_eselon->save();
            }
                $invite_jabatan = new IJ;
                $invite_jabatan ->id_rapat =$last_idTambah;
                $invite_jabatan ->status_id_rapat =$last_id;
                $invite_jabatan ->id_jabatan =18;
                $invite_jabatan->save();

            }
        }
         \Session::flash('insertSuccess', 'BERHASIL');
           return \Redirect::to(route('booking_internal.index'));
          } else {
            \Session::flash('insertError', 'Gagal Menambahkan!');
           return \Redirect::to(route('booking_internal.index'));
        }
    }
    public function indexAjax(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listJabatan = new RU;
        // ======= count ===== //
        $query = RP::getAllInternalBook($id =18);
        $total=count($query);
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();

        $list = [];
        foreach ($query as $key => $row) {
            $start = date('d-F-Y H:i',strtotime($row->start_tgl_rapat));
            if (!empty($row->phari)) {
                    $end = date('d-F-Y H:i',strtotime($row->end_tgl_rapat.'+'.$row->phari.'days'));
            }else{
                    $end = date('d-F-Y H:i',strtotime($row->end_tgl_rapat));
            }
            $status ="";
            if ($row->status_active_rapat == 1) {
              $status ="Approve";
            }elseif ($row->status_active_rapat == 2) {
              $status ="Pending";
            }elseif ($row->status_active_rapat == 3) {
              $status ="Reject";
            }

            $json['agenda_rapat'] = $row->agenda_rapat;
            $json['pj_rapat'] = $row->agenda_rapat;
            $json['start_tgl_rapat'] = $start;
            $json['end_tgl_rapat'] = $end;
            $json['status_active'] =$status;
            if (!empty($row->name_ruangan)) {
                    $json['tempat_rapat'] = $row->name_ruangan;
            }else{
                    $json['tempat_rapat'] = $row->tempat_rapat;
            }
            $json['id_rapat'] = $row->id_rapat;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);

    }

    public function showAjax(){
          $id_rapat = Input::get('id_rapat');
          $query = RP::getShow($id =18,$id_rapat);
          $list =[];
          foreach ($query as $key => $value) {
              $data['agenda_rapat'] =$value->agenda_rapat;
              $data['start_tgl_rapat'] =$value->start_tgl_rapat;
              $data['end_tgl_rapat'] =$value->end_tgl_rapat;
              $data['status_ruangan_rapat'] =$value->status_ruangan_rapat;
              $data['ruangan_rapat'] =$value->name_ruangan;
              $data['tempat_rapat'] =$value->tempat_rapat;
              $data['pj_rapat'] =$value->pj_rapat;
              $data['PIC'] =$value->PIC;
              $data['fasilitator'] =$value->fasilitator;
              $data['infant_eselon'] =SC::getInviteInfant($value->id_rapat);
              $data['undang_eselon'] =SC::getInviteUndang($value->id_rapat);
              $data['name_infant'] =IN::getInviteInfant($value->id_rapat);
              $data['disposisi_rapat'] =IN::getInviteUndang($value->id_rapat);
              $data['name_eselon'] =SC::getInviteEselon($value->id_rapat);
          $list['data'][] =$data;
          }
         return view('admin/viewShowKapus',$list);
     }
   public function showRuangan(){
       $queryRuanganAll = RP::getShowAllRuangan();
       $status =[];
       $list =[];
       $data['tanggalM'] = date("Y-m-d ",strtotime(substr(Input::get('waktuM'), 0,-3).":00"));
       $data['tanggalA'] = date("Y-m-d ",strtotime(substr(Input::get('waktuA'), 0,-3).":00"));

       foreach ($queryRuanganAll as $key => $value) {
           $data['keterangan'] = "-";
           $data['waktu'] = "-";
           $data['ruangan'] = $value->name_ruangan ;
           $data['kapasitas'] = $value->max_ruangan;
           $data['showIsi'] =RP::getShowRuangan($value->id_ruangan);
            if (empty($data['showIsi'])) {
                $data['status'] ="Kosong";

            }else {
                $data['status'] ="Terisi";
            }

        $list['data'][]=$data;
       }

       return view('admin/kapusShow',$list);
   }
   public function searchAjax()
   {
     $isiSearch =Input::get('q.term');
     $query = US::getName_pic($isiSearch);
       $list =[];
           foreach ($query as $key => $value) {

               $json['id'] = $value->id_user;
               $json['text'] = $value->name_pic;
               $list[] =$json;
           }

       echo json_encode($list);

    }
    public function edit($id_rapat){

        $update = RP::getShow($id =18,$id_rapat);
        $data   = [];
        $data['master_pic'] = MP::All()->toArray();
        $data['unit_kerja'] = UnitKerja::all()->toArray();
        $data['name_pic'] = US::all()->toArray();
        $data['allRuangan'] = RU::all()->toArray();
        $data['data'] = RU::all();
        foreach ($update as $key => $row) {
            $start = date('Y-m-d H:i',strtotime($row->start_tgl_rapat));
            $end = date('Y-m-d H:i',strtotime($row->end_tgl_rapat));
            $data['agenda_rapat'] = $row->agenda_rapat;
            $data['start_tgl_rapat'] = $start;
            $data['end_tgl_rapat'] = $end;
            $data['phari'] = $row->phari;
            $data['status_ruangan_rapat'] = $row->status_ruangan_rapat;
            $data['PIC'] = $row->PIC;
            $data['id_ruangan'] = $row->id_ruangan;
            $data['status_pelaksana'] =$row->status_pelaksana;
            if ($data['status_pelaksana']=="unitkerja") {
                $data['pelaksana'] = $row->pj_rapat;
            }else {
            $data['pj_rapat'] = $row->pj_rapat;
            }
            $data['status_fasilitator'] =$row->status_fasilitator;
            if ($data['status_fasilitator']=="unitkerjaFasilitator") {
                $data['fasilitator'] = $row->fasilitator;
            }else if($data['status_fasilitator']=="nonunitkerjaFasilitator") {
            $data['fasilitatornon'] = $row->fasilitator;
            }
            $data['tempat_rapat'] = $row->tempat_rapat;
            $data['infant_eselon'][] =SC::getInviteInfant($row->id_rapat);
            $data['undang_eselon'][] =SC::getInviteUndang($row->id_rapat);
            $data['name_infant'][] =IN::getInviteInfant($row->id_rapat);
            $data['disposisi_rapat'][] = IN::getInviteUndang($row->id_rapat);
            $data['id_rapat'] = $row->id_rapat;
        }

       return view('admin/booking_internal',$data);
    }
    public function update (){
        $infant_eselon = Input::get('infant_eselon');
        $undang_eselon = Input::get('undang_eselon');
        $id_user =Session()->get('auth');
        $start =date("Y-m-d H:i:s",strtotime(substr(Input::get('start_tgl_rapat'), 0,-3).":00"));
        $end = date("Y-m-d H:i:s",strtotime(substr(Input::get('end_tgl_rapat'), 0,-3).":00"));
        $s = strtotime(substr(Input::get('start_tgl_rapat'), 0,-3).":00");
        $e = strtotime(substr(Input::get('end_tgl_rapat'), 0,-3).":00");
        $tambahHari = Input::get('tambahHari');

        if ($s >  $e ) {
            \Session::flash('insertFailsdate','gagal');
            return \Redirect::to(route('booking_internal.index'));
        }
        if (!empty (Input::get('ruangan_rapat'))) {
            $data['start'] =$start;
            $data['end'] =$end;
            $id_user =Session()->get('auth')['id_user'];
            $data['id'] = Input::get('update');
            $data['ruangan'] =Input::get('ruangan_rapat');
            $checkRuangan =RP::checkRuanganBook($data);

            if (!empty($checkRuangan)) {

                 \Session::flash('insertFailsRuangan','gagal');
             return \Redirect::to(route('booking_internal.index'));
            }

        }
        //Validasi Infat & pejabat Yang diundang
        if (!empty($infant_eselon) && !empty($undang_eselon)) {
        foreach ($infant_eselon as $key => $value) {
           foreach ($undang_eselon as $k => $v) {
              if ($value == $v) {
                 \Session::flash('insertFailsInfantUndang','gagal');
                 return \Redirect::to(route('booking_internal.index'));
             }
           }
        }
    }
         $rules=[
            'start_tgl_rapat'=>'required',
            'end_tgl_rapat'=>'required',
            'agenda_rapat'=>'required',
            'status_ruangan_rapat'=>'required'
             ];
        $messages=[
            'start_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'end_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'agenda_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'status_ruangan_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
          ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
               $invite_name = IN::where('id_rapat',input::get('update'));
               $invite_name->delete();
               $invite_jabatan = IJ::where('id_rapat',input::get('update'));
               $invite_jabatan->delete();
               $schedule =SC::where('id_rapat',Input::get('update'));
               $schedule->delete();

                $eselon = RP::find(Input::get('update'));
                $eselon->agenda_rapat =Input::get('agenda_rapat');
                $eselon->start_tgl_rapat =$start;
                $eselon->end_tgl_rapat =$end;
                $eselon->phari =$tambahHari;
                $eselon->status_ruangan_rapat =Input::get('status_ruangan_rapat');
                $eselon->status_pelaksana =Input::get('pj_rapat');
                $eselon->PIC =Input::get('PIC');
                if (!empty(Input::get('pelaksana'))) {
                $dataPelaksana = Input::get('pelaksana');

                }else{
                    $dataPelaksana =Input::get('pj_rapat');
                }
                $eselon->status_fasilitator =Input::get('status_fasilitator');
                if (!empty(Input::get('fasilitator'))) {
                    $dataF = Input::get('fasilitator');

                }else{
                    $dataF =Input::get('fasilitatornon');
                }
                $eselon->fasilitator =$dataF;
                $eselon->pj_rapat =$dataPelaksana;
                $eselon->tempat_rapat =Input::get('tempat_rapat');
                $eselon->editor =$id_user['id_user'];
                $eselon->edited =date('Y-m-d H:i:s');
                $eselon->id_ruangan =Input::get('ruangan_rapat');
                $eselon->status_active_rapat =2;
                $eselon->update();
             $last_id = $eselon->id_rapat;

             //Insert Infant Nama Bebas (No Db)
             $name_infant = Input::get('name_infant');
             if (!empty($name_infant)) {
                 foreach ($name_infant as $key => $value) {
                     $invite_name = new IN;
                     $invite_name ->id_rapat = $last_id;
                     $invite_name ->disposisi_rapat = $value;
                     $invite_name ->status_jabatan = 2;
                     $invite_name->save();
                 }
            }
             //Insert Pejabat Yang di Undang Nama Bebas (NO DB)
             $pejabat_undang = Input::get('disposisi_rapat');
             if (!empty($pejabat_undang)) {
                 foreach ($pejabat_undang as $key => $value) {
                     $invite_name = new IN;
                     $invite_name ->id_rapat = $last_id;
                     $invite_name ->disposisi_rapat = $value;
                     $invite_name ->status_jabatan = 3;
                     $invite_name->save();
                 }
            }
             //Insert Rapat Eselon Type Infant
        if (!empty($infant_eselon)) {
             foreach ($infant_eselon as $key => $value) {
                 $schedule = new SC;
                 $schedule ->id_rapat = $last_id;
                 $schedule ->id_user = $value;
                 $schedule ->status_jabatan = 2;
                 $schedule->save();
             }
        }
             //Insert Rapat Eselon Type Pejabat Yang Di Undang
        if (!empty($undang_eselon)) {
             foreach ($undang_eselon as $key => $value) {
                 $schedule = new SC;
                 $schedule ->id_rapat = $last_id;
                 $schedule ->id_user = $value;
                 $schedule ->status_jabatan = 3;
                 $schedule->save();
             }
         }
         if (!empty($infant_eselon) OR !empty($undang_eselon)) {
             $invite_jabatan_eselon = new IJ;
             $invite_jabatan_eselon ->id_rapat =$last_id;
             $invite_jabatan_eselon ->id_jabatan =15;
             $invite_jabatan_eselon->save();
         }
        $invite_jabatan = new IJ;
        $invite_jabatan ->id_rapat =$last_id;
        $invite_jabatan ->id_jabatan =18;
        $invite_jabatan->save();

        //tambahHari
        if (!empty($tambahHari)) {
            for ($i=1; $i<=$tambahHari ; $i++) {
                $startTambah =date('Y-m-d H:i:s',strtotime($start .'+'.$i.' day'));
                $endTambah =date('Y-m-d H:i:s',strtotime($end .'+'.$i.' day'));
                if (!empty (Input::get('ruangan_rapat'))) {
                    $data['start'] =$startTambah;
                    $data['end'] =$endTambah;
                    $data['ruangan'] =Input::get('ruangan_rapat');
                    $data['id'] =Input::get('update')+$i;
                    $checkRuangan =RP::checkRuangan($data);

                    if (!empty($checkRuangan)) {

                         \Session::flash('insertFailsRuangan','gagal');
                     return \Redirect::to(route('eselon.index'));
                    }
                }
                $eselon =new RP;
                $eselon->agenda_rapat =Input::get('agenda_rapat');
                $eselon->start_tgl_rapat =$startTambah;
                $eselon->end_tgl_rapat =$endTambah;
                $eselon->status_id_rapat =$last_id;
                $eselon->status_ruangan_rapat =Input::get('status_ruangan_rapat');
                $eselon->PIC =Input::get('PIC');
                $eselon->creator =$id_user['id_user'];
                $eselon->created =date('Y-m-d H:i:s');
                if (!empty(Input::get('tempat_rapat'))) {
                $eselon->tempat_rapat =Input::get('tempat_rapat');

                }
                $eselon->status_pelaksana =Input::get('status_pelaksana');
                if (!empty(Input::get('pelaksana'))) {
                    $dataPelaksana = Input::get('pelaksana');

                }else{
                    $dataPelaksana =Input::get('pj_rapat');
                }
                $eselon->status_fasilitator =Input::get('status_fasilitator');
                if (!empty(Input::get('fasilitator'))) {
                    $dataF = Input::get('fasilitator');

                }else{
                    $dataF =Input::get('fasilitatornon');
                }
                $eselon->fasilitator =$dataF;
                $eselon->pj_rapat =$dataPelaksana;
                $eselon->status_active_rapat =2;
                $eselon->id_ruangan =Input::get('ruangan_rapat');
                $eselon->save();

                $last_idTambah = $eselon->id_rapat;
                //Insert Infant Nama Bebas (No Db)
                $name_infant = Input::get('name_infant');
                if (!empty($name_infant)) {
                    foreach ($name_infant as $key => $value) {
                        $invite_name = new IN;
                        $invite_name ->id_rapat = $last_idTambah;
                        $invite_name ->status_id_rapat = $last_id;
                        $invite_name ->disposisi_rapat = $value;
                        $invite_name ->status_jabatan = 2;
                        $invite_name->save();
                    }
                }
                //Insert Pejabat Yang di Undang Nama Bebas (NO DB)
                $pejabat_undang = Input::get('disposisi_rapat');
                if (!empty($pejabat_undang)) {
                    foreach ($pejabat_undang as $key => $value) {
                        $invite_name = new IN;
                        $invite_name ->id_rapat = $last_idTambah;
                        $invite_name ->status_id_rapat = $last_id;
                        $invite_name ->disposisi_rapat = $value;
                        $invite_name ->status_jabatan = 3;
                        $invite_name->save();
                    }
                }
                //Insert Rapat Eselon Type Infant
            if (!empty($infant_eselon)) {
                foreach ($infant_eselon as $key => $value) {
                    $schedule = new SC;
                    $schedule ->id_rapat = $last_idTambah;
                    $schedule ->status_id_rapat = $last_id;
                    $schedule ->id_user = $value;
                    $schedule ->status_jabatan = 2;
                    $schedule->save();
                }
            }
                //Insert Rapat Eselon Type Pejabat Yang Di Undang
            if (!empty($undang_eselon)) {
                foreach ($undang_eselon as $key => $value) {
                    $schedule = new SC;
                    $schedule ->id_rapat = $last_idTambah;
                    $schedule ->status_id_rapat = $last_id;
                    $schedule ->id_user = $value;
                    $schedule ->status_jabatan = 3;
                    $schedule->save();
                }
            }
            if (!empty($infant_eselon) OR !empty($undang_eselon)) {
                $invite_jabatan_eselon = new IJ;
                $invite_jabatan_eselon ->id_rapat =$last_idTambah;
                $invite_jabatan_eselon ->status_id_rapat = $last_id;
                $invite_jabatan_eselon ->id_jabatan =15;
                $invite_jabatan_eselon->save();
            }
                $invite_jabatan = new IJ;
                $invite_jabatan ->id_rapat =$last_idTambah;
                $invite_jabatan ->status_id_rapat = $last_id;
                $invite_jabatan ->id_jabatan =18;
                $invite_jabatan->save();

            }
        }
        \Session::flash('insertSuccess', 'BERHASIL');
         return \Redirect::to(route('booking_internal.index'));
     } else {
        \Session::flash('insertError', 'Gagal Merubah!');
        return \Redirect::to(route('booking_internal.index'));
        }
    }
    public function delete($id_rapat){
        $invite_jabatan = IJ::where('status_id_rapat',$id_rapat);
        $invite_jabatan->delete();
        $invite_name = IN::where('status_id_rapat',$id_rapat);
        $invite_name->delete();
        $schedule = SC::where('status_id_rapat',$id_rapat);
        $schedule->delete();
        $rapat = RP::where('status_id_rapat',$id_rapat);
        $rapat->delete();
        $invite_name = IN::where('id_rapat',$id_rapat);
        $invite_name->delete();
        $invite_jabatan = IJ::where('id_rapat',$id_rapat);
        $schedule = sc::where('id_rapat',$id_rapat);
        $schedule->delete();
        $invite_jabatan->delete();
       $eselon = RP::find($id_rapat);
       $eselon->delete();
      \Session::flash('DeleteSucces', 'Berhasil Mengahapus');
       return \Redirect::to(route('booking_internal.index'));


    }


}
