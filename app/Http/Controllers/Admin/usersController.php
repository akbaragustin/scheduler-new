<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use Illuminate\Http\Request;
use App\Models\Jabatan as JB;
use App\Models\UnitKerja as UK;
use Illuminate\Support\Facades\Validator;
class usersController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
                $data['jabatan'] = JB::all()->toArray();
        $session = \Session::get('auth');
        if ($session['id_jabatan'] == 13) {
            unset($data['jabatan'][0]);
        }else if($session['id_jabatan'] == 11){


        }else{
            unset($data['jabatan'][0]);
            unset($data['jabatan'][1]);
        }
       return view('admin/users',$data);
    }
    public function index_eselon()
    {
        $data['unit_kerja'] = UK::all();
       return view('admin/users_eselon',$data);
    }
     public function editIndex()
    {
        $id_user = \Session::get('auth');
        $update = US::where('id_user',$id_user['id_user'])->get();
        $data['jabatan'] = JB::all();
        foreach ($update as $key => $value) {
                $data['id_user'] = $value->id_user;
                $data['username'] = $value->username;
                $data['email'] = $value->email;
                $data['password'] = md5($value->password);
                $data['id_jabatan'] = $value->id_jabatan;

        }
       return view('admin/Edituser',$data);
    }

    public function save_eselon()
    {
        $rules=[
            'name_pic'=>'required',
                   ];
        $messages=[
            'name_pic.required'=>config('constants.ERROR_JML_WAJIB'),
                    ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
        $users =new US;
        $users->name_pic =Input::get('name_pic');
        $users->id_unit_kerja =Input::get('id_unit_kerja');
        $users->save();
           \Session::flash('insertSuccess', 'BERHASIL');
           return \Redirect::to(route('users_eselon.index'));
          } else {
            \Session::flash('insertError', 'Gagal Menambahkan!');
           return \Redirect::to(route('users_eselon.index'));

        }
    }
 public function save()
    {
        $rules=[
            'username'=>'required',
            'email'=>'required',
            'password'=>'required'
             ];
        $messages=[
            'username.required'=>config('constants.ERROR_JML_WAJIB'),
             'password.required'=>config('constants.ERROR_JML_WAJIB'),
            'email.required'=>config('constants.ERROR_JML_WAJIB'),
        ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
        $users =new US;
        $users->username =Input::get('username');
        $users->id_jabatan =Input::get('jabatan');
        $users->password =md5(Input::get('password'));
        $users->email =Input::get('email');
        $users->remember_token =Input::get('_token');
        $users->save();
           \Session::flash('insertSuccess', 'BERHASIL');
           return \Redirect::to(route('users.index'));
          } else {
            \Session::flash('insertError', 'Gagal Menambahkan!');
           return \Redirect::to(route('users.index'));

        }
    }
    public function indexAjax()
    {
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listJabatan = new US;
        // ======= count ===== //
        $total=US::count();
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();

        $query = US::getAll();

        $list = [];
        foreach ($query as $key => $row) {
            $json['id_user'] = $row->id_user;
            $json['username'] = $row->username;
            $json['email'] = $row->email;
            $json['name_jabatan'] = $row->name_jabatan;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);
    }
       public function indexAjax_eselon()
    {
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listJabatan = new US;
        // ======= count ===== //
        $total=US::count();
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();

        $query = US::getAllEselon();

        $list = [];
        foreach ($query as $key => $row) {
            $json['id_user'] = $row->id_user;
            $json['name_pic'] = $row->name_pic;
            $json['id_unit_kerja'] = $row->name_unit_kerja;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);
    }

     public function delete($id_user){
         try {
             $users = US::find($id_user);
             $users->delete();
         } catch (\Exception $e) {
             \Session::flash('DeleteFails', 'Data User Terdaftar di Data Agenda');
             return \Redirect::to(route('users.index'));
         }

       return \Redirect::to(route('users.index'));


    }
    public function delete_eselon($id_user){

        try {
            $users = US::find($id_user);
            $users->delete();
        } catch (\Exception $e) {
            \Session::flash('DeleteFails', 'Data User Terdaftar di Data Agenda');
            return \Redirect::to(route('users_eselon.index'));
        }

      return \Redirect::to(route('users_eselon.index'));


    }

    public function edit_eselon($id_user){
        $update = US::where('id_user',$id_user)->get();
        $data   = [];
        $data['data'] = US::all();
         $data['unit_kerja'] = UK::all();
        foreach ($update as $key => $value) {
                $data['id_user'] = $value->id_user;
                $data['name_pic'] = $value->name_pic;
                $data['id_unit_kerja'] = $value->id_unit_kerja;

        }
         return view('admin/users_eselon',$data);
    }
    public function edit($id_user){
        $update = US::where('id_user',$id_user)->get();
        $data   = [];
        $data['data'] = US::all();
        $data['jabatan'] = JB::all();
        foreach ($update as $key => $value) {
                $data['id_user'] = $value->id_user;
                $data['username'] = $value->username;
                $data['email'] = $value->email;
                $data['password'] = md5($value->password);
                $data['id_jabatan'] = $value->id_jabatan;


        }
       return view('admin/users',$data);
    }

     public function update (){
             $rules=[
            'username'=>'required',
            'email'=>'required',
            'password'=>'required'
             ];
        $messages=[
            'username.required'=>config('constants.ERROR_JML_WAJIB'),
             'password.required'=>config('constants.ERROR_JML_WAJIB'),
            'email.required'=>config('constants.ERROR_JML_WAJIB'),
        ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
                $users = US::find(Input::get('update'));
                $users->username =Input::get('username');
                $users->id_jabatan =Input::get('jabatan');
                if (!empty(Input::get('password'))) {
                    if (Input::get('password') !='true') {
                    $users->password =md5(Input::get('password'));

                    }
               }
                $users->email =Input::get('email');
                $users->remember_token =Input::get('_token');
                $users->update();
               \Session::flash('insertSuccess', 'BERHASIL');
               return \Redirect::to(route('users.index'));
              } else {
                \Session::flash('insertError', 'Gagal Mengubah!');
               return \Redirect::to(route('users.index'));

            }
        }
    public function update_eselon (){
             $rules=[
            'name_pic'=>'required',
             ];
        $messages=[
            'name_pic.required'=>config('constants.ERROR_JML_WAJIB'),
        ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
                $users = US::find(Input::get('update'));
                $users->name_pic =Input::get('name_pic');
                $users->id_unit_kerja =Input::get('id_unit_kerja');

                $users->update();
               \Session::flash('insertSuccess', 'BERHASIL');
               return \Redirect::to(route('users_eselon.index'));
              } else {
                \Session::flash('insertError', 'Gagal Mengubah!');
               return \Redirect::to(route('users_eselon.index'));

            }
        }
    public function updateEdit (){
             $rules=[
            'username'=>'required',
            'email'=>'required',
            'password'=>'required'
             ];
        $messages=[
            'username.required'=>config('constants.ERROR_JML_WAJIB'),
             'password.required'=>config('constants.ERROR_JML_WAJIB'),
            'email.required'=>config('constants.ERROR_JML_WAJIB'),
        ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
                $users = US::find(Input::get('update'));
                $users->username =Input::get('username');
                $users->id_jabatan =Input::get('jabatan');
                if (!empty(Input::get('password'))) {
                    if (Input::get('password') !='true') {
                    $users->password =md5(Input::get('password'));

                    }
               }
                $users->email =Input::get('email');
                $users->remember_token =Input::get('_token');
                $users->update();
               \Session::flash('insertSuccess', 'BERHASIL');
               return \Redirect::to(route('Editusers.index'));
              } else {
                \Session::flash('insertError', 'Gagal Mengubah!');
               return \Redirect::to(route('Editusers.index'));

            }
        }

}
