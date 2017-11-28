<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User as US;
use Illuminate\Http\Request;
use App\Models\Jabatan as JB;
class jabatanController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

       return view('admin/jabatan');
    }

    public function save()
    {
     $rules=[
            'name_jabatan'=>'required',
             ];
        $messages=[
            'name_jabatan.required'=>config('constants.ERROR_JML_WAJIB'),
        ];
           $validator=Validator::make(Input::all(), $rules, $messages);
         if ($validator->passes()) {

        $dataSession = \Session::get('auth');
        $jabatan =new JB;
        $jabatan->name_jabatan =Input::get('name_jabatan');
        $jabatan->status_jabatan = 2;
        $jabatan->creator =$dataSession['id_user'];
        $jabatan->created = date('Y-m-d H:i:s');
        $jabatan->save();
            \Session::flash('insertSuccess', 'SUCCSESS');
           return \Redirect::to(route('jabatan.index'));
          } else {
            \Session::flash('insertError', 'Gagal Menyimpan!');
           return \Redirect::to(route('jabatan.index'));

        }
    }
    public function indexAjax(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listJabatan = new JB;
        // ======= count ===== //
        $total=JB::count();
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = JB::getAll();

        $list = [];
        foreach ($query as $key => $row) {
            $json['name_jabatan'] = $row->name_jabatan;
            $json['creator'] = $row->username;
            $json['id_jabatan'] = $row->id_jabatan;
            $json['status_jabatan'] = $row->status_jabatan;
            $json['created'] = date('d-m-Y',strtotime($row->created));
            // $json['kd_anggota'] = $row->kd_anggota;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);

    }

    public function delete($id_jabatan){
        try {
            $jabatan = JB::find($id_jabatan);
            $jabatan->delete();
        } catch (\Exception $e) {
            \Session::flash('DeleteFails', 'Data Jabatan Terdaftar di Data Users');
            return \Redirect::to(route('jabatan.index'));
        }

       return \Redirect::to(route('jabatan.index'));


    }
    public function edit($id_jabatan){

        $update = JB::where('id_jabatan',$id_jabatan)->get();
        $data   = [];
        $data['data'] = JB::all();
        foreach ($update as $key => $value) {
                $data['name_jabatan'] = $value->name_jabatan;
                $data['id_jabatan'] = $value->id_jabatan;

        }
       return view('admin/jabatan',$data);
    }

    public function update (){
        $rules=[
            'name_jabatan'=>'required',
             ];
        $messages=[
            'name_jabatan.required'=>config('constants.ERROR_JML_WAJIB'),
        ];
           $validator=Validator::make(Input::all(), $rules, $messages);
         if ($validator->passes()) {
               $dataSession = \Session::get('auth');
               $jabatan = JB::find(Input::get('update'));
                $jabatan->name_jabatan =Input::get('name_jabatan');
                $jabatan->status_jabatan =Input::get('status_jabatan');
                $jabatan->editor =$dataSession['id_user'];
                $jabatan->edited = date('Y-m-d H:i:s');
                $jabatan->update();
            \Session::flash('insertSuccess', 'SUCCSESS');
           return \Redirect::to(route('jabatan.index'));
          } else {
            \Session::flash('insertError', 'Gagal Mengubah!');
           return \Redirect::to(route('jabatan.index'));

        }

        }



}
