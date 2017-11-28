<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\PayUservice\Exception;
use App\Models\User as US;
use Illuminate\Http\Request;
use App\Models\Master_pic as MP;
class MasterPicController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

       return view('admin/master_pic');
    }

    public function save()
    {
     $rules=[
            'name_master_pic'=>'required',
             ];
        $messages=[
            'name_master_pic.required'=>config('constants.ERROR_JML_WAJIB'),
        ];
           $validator=Validator::make(Input::all(), $rules, $messages);
         if ($validator->passes()) {

        $dataSession = \Session::get('auth');
        $jabatan =new MP;
        $jabatan->name_master_pic =Input::get('name_master_pic');
        $jabatan->creator =$dataSession['id_user'];
        $jabatan->created = date('Y-m-d H:i:s');
        $jabatan->save();
            \Session::flash('insertSuccess', 'SUCCSESS');
           return \Redirect::to(route('master_pic.index'));
          } else {
            \Session::flash('insertError', 'Gagal Menyimpan!');
           return \Redirect::to(route('master_pic.index'));

        }
    }
    public function indexAjax(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listJabatan = new MP;
        // ======= count ===== //
        $total=MP::count();
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = MP::getAll();

        $list = [];
        foreach ($query as $key => $row) {
            $json['name_master_pic'] = $row->name_master_pic;
            $json['creator'] = $row->username;
            $json['id_master_pic'] = $row->id_master_pic;
            $json['created'] = date('d-m-Y',strtotime($row->created));
            // $json['kd_anggota'] = $row->kd_anggota;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);

    }

    public function delete($id_master_pic){
    try {
            $jabatan = MP::find($id_master_pic);
            $jabatan->delete();
    } catch (\Exception $e) {
        \Session::flash('DeleteFails', 'Data Unit Kerja Terdaftar di Data User Struktural');
       return \Redirect::to(route('master_pic.index'));
    }

        \Session::flash('DeleteSucces', 'Berhasil Mengahapus');
       return \Redirect::to(route('master_pic.index'));


    }


    public function edit($id_master_pic){

        $update = MP::where('id_master_pic',$id_master_pic)->get();
        $data   = [];
        $data['data'] = MP::all();
        foreach ($update as $key => $value) {
                $data['name_master_pic'] = $value->name_master_pic;
                $data['id_master_pic'] = $value->id_master_pic;

        }
       return view('admin/master_pic',$data);
    }

    public function update (){
        $rules=[
            'name_master_pic'=>'required',
             ];
        $messages=[
            'name_master_pic.required'=>config('constants.ERROR_JML_WAJIB'),
        ];
           $validator=Validator::make(Input::all(), $rules, $messages);
         if ($validator->passes()) {
               $dataSession = \Session::get('auth');
               $jabatan = MP::find(Input::get('update'));
                $jabatan->name_master_pic =Input::get('name_master_pic');
                $jabatan->editor =$dataSession['id_user'];
                $jabatan->edited = date('Y-m-d H:i:s');
                $jabatan->update();
            \Session::flash('insertSuccess', 'SUCCSESS');
           return \Redirect::to(route('master_pic.index'));
          } else {
            \Session::flash('insertError', 'Gagal Mengubah!');
           return \Redirect::to(route('master_pic.index'));

        }

        }



}
