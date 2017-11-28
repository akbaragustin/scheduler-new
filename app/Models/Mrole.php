<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Mrole extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'menu_role';
    protected $primaryKey = 'kd_role';
    public $timestamps = false;
    protected $fillable = ['kd_role', 'id_jabatan', 'id_menu'];

    /**
     * Get the comments for the blog post.
     */
    public static function groupRole()
    {
        $query = "select mr.kd_role, ma.name_menu, mg.name_jabatan from menu_role as mr
                    LEFT JOIN menu_admin as ma on mr.id_menu = ma.id_menu
                    LEFT JOIN jabatan as mg on mr.id_jabatan = mg.id_jabatan
                    ";
        $role = \DB::select($query);
        return $role;
    }
    /**
     * Get the comments for the blog post.
     */
    public static function roleDelete($grp)
    {
        $role = Mrole::where('id_jabatan', '=', $grp)->delete();
        return $role;
    }

    /**
     * Get the comments for the blog post.
     */
    public static function roleDeleteIdMenu($id_menu)
    {
        $role = Mrole::where('id_menu', '=', $id_menu)->delete();
        return $role;
    }
    /**
     * Get the comments for the blog post.
     */
    public static function roleInsert($param)
    {
        $role = MR::find($param);
        $role->delete();
        return $role;
    }

    /**
     * Get the comments for the blog post.
     */
    public static function getSelected($user_grp=1)
    {
        $user = Mrole::where('id_jabatan', '=', $user_grp)
                ->get();
        $result = $user->toArray();
        return $result;
    }


}
