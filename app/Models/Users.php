<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class Users extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    protected $fillable = ['id_user', 'username', 'id_jabatan', 'password', 'remember_token', 'email','name_pic','id_unit_kerja'];

     public static function getAll()
    {

        $input = Input::get('search.value');
        $get = Input::all();
        $where = "";
        $session = \Session::get('auth');
        if (!empty($session)) {
            if ($session['id_jabatan'] == 11) {
                $where.= "";
            }elseif ($session['id_jabatan'] == 13){
                $where .= "AND jabatan.id_jabatan != 11";
            }else{
                $where .= "AND jabatan.id_jabatan != 11 AND jabatan.id_jabatan != 13" ;
            }
        }
        if (!empty($input)) {
            $where = " WHERE pay like '%".$input."%' OR total like '%".$input."%' ";
        }

        if (!empty($get['username'])) {
            if (!empty($where)) {
                $where .= " or username  like '%".$get['username']."%'";
            } else {
                $where .= " WHERE username like '%".$get['username']."%'";
            }
            if (!empty($where)) {
                $where .= " or username  like '%".$get['username']."%'";
            } else {
                $where .= " WHERE username like '%".$get['username']."%'";
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
        $limit ="";
        if (!empty($start) AND !empty($length)) {
        $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = " select users.id_user,users.username,users.email,jabatan.name_jabatan from users
                    LEFT JOIN jabatan ON jabatan.id_jabatan  = users.id_jabatan
                    WHERE users.username  IS NOT NULL ".$where."
                ".$limit."
                ";
        $listData = \DB::select($query);

        return $listData;
    }
      public static function getAllEselon()
    {

        $input = Input::get('search.value');
        $get = Input::all();
        $where = "";

        if (!empty($input)) {
            $where = " WHERE pay like '%".$input."%' OR total like '%".$input."%' ";
        }

        if (!empty($get['username'])) {
            if (!empty($where)) {
                $where .= " or username  like '%".$get['username']."%'";
            } else {
                $where .= " WHERE username like '%".$get['username']."%'";
            }
            if (!empty($where)) {
                $where .= " or username  like '%".$get['username']."%'";
            } else {
                $where .= " WHERE username like '%".$get['username']."%'";
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
        $query = " select users.id_user,users.name_pic,master_unit_kerja.name_unit_kerja from users
                    LEFT JOIN master_unit_kerja ON master_unit_kerja.id_unit_kerja  = users.id_unit_kerja
				    where name_pic IS NOT NULL
                ".$limit."
                ";
        $listData = \DB::select($query);

        return $listData;
    }
    public static function getSearch($input)
    {

        $query ="Select username,id_user from users where username like '%".$input."%' ";
        $listData = \DB::select($query);

        return $listData;

    }
    public static function getName_pic($input)
    {

        $query ="Select name_pic,id_user,id_unit_kerja from users where name_pic LIKE '%".$input."%' AND name_pic IS NOT NULL";
        $listData = \DB::select($query);

        return $listData;

    }

}
