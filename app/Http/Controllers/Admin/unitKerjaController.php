<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\PayUservice\Exception;
use App\Models\User as US;
use Illuminate\Http\Request;
use App\Models\UnitKerja as UK;
class unitKerjaController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

       return view('admin/unitKerja');
    }

    public function save()
    {
     $rules=[
            'name_unit_kerja'=>'required',
             ];
        $messages=[
            'name_unit_kerja.required'=>config('constants.ERROR_JML_WAJIB'),
        ];
           $validator=Validator::make(Input::all(), $rules, $messages);
         if ($validator->passes()) {

        $dataSession = \Session::get('auth');
        $jabatan =new UK;
        $jabatan->name_unit_kerja =Input::get('name_unit_kerja');
        $jabatan->creator =$dataSession['id_user'];
        $jabatan->created = date('Y-m-d H:i:s');
        $jabatan->save();
            \Session::flash('insertSuccess', 'SUCCSESS');
           return \Redirect::to(route('unit_kerja.index'));
          } else {
            \Session::flash('insertError', 'Gagal Menyimpan!');
           return \Redirect::to(route('unit_kerja.index'));

        }
    }
    public function indexAjax(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listJabatan = new UK;
        // ======= count ===== //
        $total=UK::count();
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = UK::getAll();

        $list = [];
        foreach ($query as $key => $row) {
            $json['name_unit_kerja'] = $row->name_unit_kerja;
            $json['creator'] = $row->username;
            $json['id_unit_kerja'] = $row->id_unit_kerja;
            $json['created'] = date('d-m-Y',strtotime($row->created));
            // $json['kd_anggota'] = $row->kd_anggota;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);

    }

    public function delete($id_unit_kerja){
    try {
            $jabatan = UK::find($id_unit_kerja);
            $jabatan->delete();
    } catch (\Exception $e) {
        \Session::flash('DeleteFails', 'Data Unit Kerja Terdaftar di Data User Struktural');
       return \Redirect::to(route('unit_kerja.index'));
    }

        \Session::flash('DeleteSucces', 'Berhasil Mengahapus');
       return \Redirect::to(route('unit_kerja.index'));


    }


    public function edit($id_unit_kerja){

        $update = UK::where('id_unit_kerja',$id_unit_kerja)->get();
        $data   = [];
        $data['data'] = UK::all();
        foreach ($update as $key => $value) {
                $data['name_unit_kerja'] = $value->name_unit_kerja;
                $data['id_unit_kerja'] = $value->id_unit_kerja;

        }
       return view('admin/unitKerja',$data);
    }

    public function update (){
        $rules=[
            'name_unit_kerja'=>'required',
             ];
        $messages=[
            'name_unit_kerja.required'=>config('constants.ERROR_JML_WAJIB'),
        ];
           $validator=Validator::make(Input::all(), $rules, $messages);
         if ($validator->passes()) {
               $dataSession = \Session::get('auth');
               $jabatan = UK::find(Input::get('update'));
                $jabatan->name_unit_kerja =Input::get('name_unit_kerja');
                $jabatan->editor =$dataSession['id_user'];
                $jabatan->edited = date('Y-m-d H:i:s');
                $jabatan->update();
            \Session::flash('insertSuccess', 'SUCCSESS');
           return \Redirect::to(route('unit_kerja.index'));
          } else {
            \Session::flash('insertError', 'Gagal Mengubah!');
           return \Redirect::to(route('unit_kerja.index'));

        }

        }



}
