<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;


class Invite_name extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'invite_name';
    protected $primaryKey = 'id_invite_name';
    public $timestamps = false;
    protected $fillable = ['id_invite_name', 'id_rapat', 'disposisi_rapat','status_jabatan','status_id_rapat'];

     public static function getInviteUndang($id_rapat){
         $undang = 3;
      	$query = " select * from invite_name
					where invite_name.id_rapat = ".$id_rapat." AND status_jabatan=".$undang." ";
		  $listData = \DB::select($query);
      	 return $listData;


      }
     public static function getInviteInfant($id_rapat){
         $infant =2;
      	$query = " select * from invite_name
					where invite_name.id_rapat = ".$id_rapat." AND status_jabatan=".$infant." ";


		  $listData = \DB::select($query);
      	 return $listData;


      }
}
