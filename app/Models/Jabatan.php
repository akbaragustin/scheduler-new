<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class Jabatan extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    public $timestamps = false;
    protected $fillable = ['id_jabatan', 'name_jabatan','label_color','status_jabatan','creator', 'created', 'editor', 'edited'];

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
        $query = " select jabatan.id_jabatan,jabatan.name_jabatan,jabatan.created,jabatan.status_jabatan,users.username from jabatan 
                    LEFT JOIN users ON id_user  = creator
				".$where."
                ".$limit."
                ";
        $listData = \DB::select($query);
      

        return $listData;
    }
}
