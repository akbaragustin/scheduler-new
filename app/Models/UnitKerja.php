<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class UnitKerja extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'master_unit_kerja';
    protected $primaryKey = 'id_unit_kerja';
    public $timestamps = false;
    protected $fillable = ['id_unit_kerja', 'name_unit_kerja','creator', 'created', 'editor', 'edited'];

     public static function getAll()
    {
        $id_user = \Session::get('auth');
        $input = Input::get('search.value');
        $get = Input::all();
        $where = "";
        if (!empty($input)) {
            $where = " WHERE pay like '%".$input."%' OR total like '%".$input."%' ";
        }

        if (!empty($get['name_jabatan'])) {
            if (!empty($where)) {
                $where .= " or name_jabatan  like '%".$get['name_jabatan']."%'";
            } else {
                $where .= " WHERE name_jabatan like '%".$get['name_jabatan']."%'";
            }
            if (!empty($where)) {
                $where .= " or name_jabatan  like '%".$get['name_jabatan']."%'";
            } else {
                $where .= " WHERE name_jabatan like '%".$get['name_jabatan']."%'";
            }
        }

        // if (!empty($id_user['id_user'])) {
        //     if (!empty($where)) {
        //         $where .= " and id_user = ".$id_user['id_user'];
        //     } else {
        //         $where .= " WHERE id_user = ".$id_user['id_user'];
        //     }
        // }




        // limit 10 OFFSET 1
        $start = Input::get('start');
        $length = Input::get('length');
        $limit  = "LIMIT ".$length." OFFSET ".$start;
        $query = " select master_unit_kerja.id_unit_kerja,master_unit_kerja.name_unit_kerja,master_unit_kerja.created,users.username from master_unit_kerja 
                    LEFT JOIN users ON id_user  = creator
				".$where."
                ".$limit."
                ";
        $listData = \DB::select($query);
      

        return $listData;
    }
}
