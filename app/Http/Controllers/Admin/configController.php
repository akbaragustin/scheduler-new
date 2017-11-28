<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Validator;
// models
use App\Models\MenuAdmin as MA;
use App\Models\Mrole as MR;
use App\Models\Jabatan as JB;



// use App\liblary\Helpers as HP;


class configController extends Controller
{
    private $parser = [];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function menu()
    {
        $data['dataMenu'] = MA::all();
        return view("config.menu",$data);
    }

    public function menuView()
    {
        $data['dataMenu'] = MA::all()->toArray();

        return view("config.menuView");
    }

     public function menuViewIcon()
    {
        $data['dataMenu'] = MA::all()->toArray();

        return view("config.menuViewIcon");
    }

    public function menuSave()
    {
        $rules=[
            'name_menu'=>'required',
            'parent_menu'=>'required',
            'icon_menu'=>'required',

        ];
        $messages=[
            'name_menu.required'=>config('constants.ERROR_NAME_MENU'),
            'url_menu.required'=>config('constants.ERROR_URL_NAME'),
            'parent_menu.required'=>config('constants.ERROR_PARENT_MENU'),
            'icon_menu.required'=>config('constants.ERROR_ICON_MENU'),
        ];
        $validator=Validator::make(Input::all(), $rules, $messages);
        // echo "<pre>";
        // print_R(\Input::all());die;
        if ($validator->fails()) {
            \Session::flash('insertError', 'Gagal Menyimpan!');
           return \Redirect::to(route('menu.index'));

         } else {
            $data = new MA;
            $data->name_menu = Input::get('name_menu');
            $data->url_menu = Input::get('url_menu');
            $data->parent_menu = Input::get('parent_menu');
            $data->icon_menu = Input::get('icon_menu');
            $data->level_menu = 0;
            $data->posisition_menu = 0;
            $data->save();
          \Session::flash('insertSuccess', 'SUCCSESS');
           return \Redirect::to(route('menu.index'));

        }
    }
    public function menuEdit($id_menu){

        $update = MA::getAllEdit($id_menu);
        $data   = [];
         $data['dataMenu'] = MA::all();
        foreach ($update as $key => $value) {
                $data['name_menu'] = $value['name_menu'];
                $data['url_menu'] = $value['url_menu'];
                $data['parent_menu'] = $value['parent_menu'];
                $data['parent_name'] = $value['parent_name'];
                $data['icon_menu'] = $value['icon_menu'];
                $data['id_menu'] = $value['id_menu'];

        }
       return view('config.menu',$data);
    }


    public function menuUpdate()
    {

        $rules=[
            'name_menu'=>'required',
            'url_menu'=>'required',
            'parent_menu'=>'required',
            'icon_menu'=>'required',

        ];
        $messages=[
            'name_menu.required'=>config('constants.ERROR_NAME_MENU'),
            'url_menu.required'=>config('constants.ERROR_URL_NAME'),
            'parent_menu.required'=>config('constants.ERROR_PARENT_MENU'),
            'icon_menu.required'=>config('constants.ERROR_ICON_MENU'),
        ];
        $validator=Validator::make(Input::all(), $rules, $messages);
        if ($validator->passes()) {
            // print_R(Input::get('parent_menu'));die;
               $dataSession = \Session::get('auth');
                $data = MA::find(Input::get('update'));
                $data->name_menu = Input::get('name_menu');
                $data->url_menu = Input::get('url_menu');
                $data->parent_menu = Input::get('parent_menu');
                $data->icon_menu = Input::get('icon_menu');
                $data->level_menu = 0;
                $data->posisition_menu = 0;
                $data->update();
            \Session::flash('insertSuccess', 'SUCCSESS');
           return \Redirect::to(route('menu.index'));
          } else {
            \Session::flash('insertError', 'Gagal Mengubah!');
           return \Redirect::to(route('menu.index'));

        }
    }
    public function menuDelete($id_menu)
    {
        $jabatan = MA::find($id_menu);
       $jabatan->delete();
       \Session::flash('insertSuccess', 'SUCCSESS');
       return \Redirect::to(route('menu.index'));


    }

    public function menuRole(){
        $listGroup = JB::all();
        $data['listGroup'] = $listGroup;
        $data['listSelected']  = [];
      return view ('config.role',$data);


    }
     public function reloadMenu()
    {
        $data['allMenu'] = getMenu();
        $array =  MR::where('id_jabatan',Input::get('id'))->get()->toArray();

        // print_R($array);die;

        $id_menu = [];
        foreach ($array as $key => $value) {
            $id_menu[] = $value['id_menu'];
        }
        $data['id_menu'] =$id_menu;

        if (!empty(Input::get('id'))) {
        $result['html'] = view ('config.roleView',$data)->with('parser', $this->parser)->render();
            /*return view ('config.roleView',$data);*/
        }else {
            $result ['html'] ="";
        }

         return response()->json($result);

    }
    public function roleSave()
    {
        $data = Input::all();
        $delete = MR::roleDelete($data['group_name']);
        if (!empty($data['id_menu'])) {
            foreach ($data['id_menu'] as $key => $value) {
                $roleInsert = new MR;
                $roleInsert->id_jabatan = $data['group_name'];
                $roleInsert->id_menu = $value;
                $roleInsert->save();
            }
        }

       \Session::flash('insertSuccess', 'SUCCSESS');
         return \Redirect::to(route('role.index'));
    }


}
