<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class Ruangan extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'ruangan';
    protected $primaryKey = 'id_ruangan';
    public $timestamps = false;
    protected $fillable = ['id_ruangan', 'name_ruangan','max_ruangan','creator', 'created', 'editor', 'edited'];

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
                $where .= " or name_ruangan  like '%".$get['name_ruangan']."%'";
            } else {
                $where .= " WHERE name_ruangan like '%".$get['name_ruangan']."%'";
            }
            if (!empty($where)) {
                $where .= " or name_ruangan  like '%".$get['name_ruangan']."%'";
            } else {
                $where .= " WHERE name_ruangan like '%".$get['name_ruangan']."%'";
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
        $query = " select ruangan.id_ruangan,ruangan.name_ruangan,max_ruangan,ruangan.created,users.username from ruangan
                    LEFT JOIN users ON id_user  = creator
				".$where."
                ".$limit."
                ";
        $listData = \DB::select($query);


        return $listData;
    }
    public static function getAllRuangan(){
        $start = Input::get('start');
        $length = Input::get('length');
        $limit  = "LIMIT ".$length." OFFSET ".$start;
        $query = " select * from ruangan
                ".$limit."
                ";
        $listData = \DB::select($query);
        print_r($listData);die;
        return $listData;
    }
}
