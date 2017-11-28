<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;


class Unit_kerja extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'master_unit_kerja';
    protected $primaryKey = 'id_invite_jabatan';
    public $timestamps = false;
    protected $fillable = ['id_unit_kerja', 'name_unit_kerja'];

    
}
