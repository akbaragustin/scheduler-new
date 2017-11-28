<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;


class Invite_jabatan extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'invite_jabatan';
    protected $primaryKey = 'id_invite_jabatan';
    public $timestamps = false;
    protected $fillable = ['id_invite_jabatan', 'id_jabatan', 'id_rapat','status_id_rapat'];


}
