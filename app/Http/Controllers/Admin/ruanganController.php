<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\User as US;
use App\Models\Ruangan as RU;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ruanganController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

       return view('admin/ruangan');
    }

    public function save()
    {
        $rules=[
            'name_ruangan'=>'required',
            'max_ruangan'=>'required'
             ];
        $messages=[
            'name_ruangan.required'=>config('constants.ERROR_JML_WAJIB'),
             'max_ruangan.required'=>config('constants.ERROR_JML_WAJIB'),
          ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
        $dataSession = \Session::get('auth');
        $ruangan =new RU;
        $ruangan->name_ruangan =Input::get('name_ruangan');
        $ruangan->max_ruangan =Input::get('max_ruangan');
        $ruangan->creator =$dataSession['id_user'];
        $ruangan->created = date('Y-m-d H:i:s');
        $ruangan->save();
         \Session::flash('insertSuccess', 'BERHASIL');
           return \Redirect::to(route('ruangan.index'));
          } else {
            \Session::flash('insertError', 'Gagal Menambahkan!');
           return \Redirect::to(route('ruangan.index'));
        }
    }
    public function indexAjax(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listJabatan = new RU;
        // ======= count ===== //
        $total=RU::count();
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = RU::getAll();

        $list = [];
        foreach ($query as $key => $row) {
            $json['name_ruangan'] = $row->name_ruangan;
            $json['max_ruangan'] = $row->max_ruangan;
            $json['creator'] = $row->username;
            $json['id_ruangan'] = $row->id_ruangan;
            $json['created'] = date('d-m-Y',strtotime($row->created));
            // $json['kd_anggota'] = $row->kd_anggota;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);

    }

    public function delete($id_ruangan){
       try {
           $jabatan = RU::find($id_ruangan);
           $jabatan->delete();
       } catch (\Exception $e) {
           \Session::flash('DeleteFails', 'Data Ruangan Terdaftar di Table Agenda');
            return \Redirect::to(route('ruangan.index'));
       }

       \Session::flash('DeleteSucces', 'Berhasil Mengahapus');
       return \Redirect::to(route('ruangan.index'));


    }
    public function edit($id_ruangan){

        $update = RU::where('id_ruangan',$id_ruangan)->get();
        $data   = [];
        $data['data'] = RU::all();
        foreach ($update as $key => $value) {
                $data['name_ruangan'] = $value->name_ruangan;
                $data['max_ruangan'] = $value->max_ruangan;
                $data['id_ruangan'] = $value->id_ruangan;

        }
       return view('admin/ruangan',$data);
    }

    public function update (){
         $rules=[
            'name_ruangan'=>'required',
            'max_ruangan'=>'required'
             ];
        $messages=[
            'name_ruangan.required'=>config('constants.ERROR_JML_WAJIB'),
             'max_ruangan.required'=>config('constants.ERROR_JML_WAJIB'),
          ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
               $dataSession = \Session::get('auth');
               $jabatan = RU::find(Input::get('update'));
                $jabatan->name_ruangan =Input::get('name_ruangan');
                $jabatan->max_ruangan =Input::get('max_ruangan');
                $jabatan->editor =$dataSession['id_user'];
                $jabatan->edited = date('Y-m-d H:i:s');
                $jabatan->update();
                 \Session::flash('insertSuccess', 'BERHASIL');
                return \Redirect::to(route('ruangan.index'));
             } else {
            \Session::flash('insertError', 'Gagal Merubah!');
            return \Redirect::to(route('ruangan.index'));
        }
        }



}
