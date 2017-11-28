<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;

class MenuAdmin extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'menu_admin';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;
    protected $fillable = ['id_menu', 'leve_menu', 'parent_menu', 'position_menu', 'url_menu', 'icon_menu', 'name_menu', 'created', 'creator', 'edited', 'editor'];

    public static function getAllEdit ($id_menu){


    $query = "SELECT xx.id_menu,xx.level_menu,xx.parent_menu,xx.posisition_menu,xx.url_menu,xx.name_menu,xx.icon_menu,ma2.name_menu as parent_name from (
	select * from menu_admin as ma where ma.id_menu = '".$id_menu."'
    ) as xx
    left join menu_admin as ma2 on xx.parent_menu = ma2.id_menu";

    $listData = \DB::select($query);
    $listData = json_decode(json_encode($listData),true);
     return $listData;
    }

}
