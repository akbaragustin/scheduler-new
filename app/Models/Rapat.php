<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;


class Rapat extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 't_rapat';
    protected $primaryKey = 'id_rapat';
    public $timestamps = false;
    protected $fillable = ['id_rapat', 'start_tgl_rapat','end_tgl_rapat','pj_rapat','infant_rapat','status_jabatan_rapat', 'id_ruangan', 'agenda_rapat', 'creator', 'created', 'editor', 'edited','status_id_rapat','PIC','status_fasilitator','fasilitator'];

     public static function getAll($status)
    {
        $id_user = \Session::get('auth');
        $agenda_rapat = Input::get('agenda_rapat');
        $pj_rapat = Input::get('pj_rapat');
        $PIC = Input::get('Pic');
        $filterWaktu = Input::get('filterWaktu');
        $get = Input::all();
        $where = "";
        if (!empty($filterWaktu)) {
            if ($filterWaktu =="bulan") {
                $waktuM =date ("Y-m-d H:i:s");
                $waktuA =date("Y-m-d H:i:s",strtotime('+1 month'));

            }elseif ($filterWaktu =="minggu") {
                $waktuM =date ("Y-m-d H:i:s");
                $waktuA =date("Y-m-d H:i:s",strtotime('+1 week'));
            }else{
                $waktuM =date ("Y-m-d H:i:s");
                $waktuA =date("Y-m-d H:i:s",strtotime('+1 day'));
            }
                $where .= "AND (t_rapat.start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR t_rapat.end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (t_rapat.start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."'))";
        }

        if (!empty($agenda_rapat)) {
                $where .= " AND t_rapat.agenda_rapat  like '%".$agenda_rapat."%'";

        }
        if (!empty($pj_rapat)) {
            $where .= "AND t_rapat.pj_rapat like '%".$pj_rapat."%'";
        }
        if (!empty($PIC)) {
            $where .= "AND t_rapat.PIC like '%".$PIC."%'";
        }
        if (!empty(Input::get('waktuM')) && !empty(Input::get('waktuA'))) {
            $waktuM =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuM'), 0,-3).":00"));
            $waktuA =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuA'), 0,-3).":00"));
            $where .= "AND (t_rapat.start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR t_rapat.end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (t_rapat.start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."'))";
        }

                if ( !empty(Input::get('name_pic')) ) {
                    $listIdRapat = self::getNamPic($status,  $where, Input::get('name_pic'));
                    $toString  = implode(",",$listIdRapat);
                    $where .= " AND t_rapat.id_rapat in (".$toString.") ";
                }
        // if (!empty($waktuM)){
        //     $where .= "AND t_rapat.start_tgl_rapat = '".$waktuM."'";
        // }
        // if (!empty($waktuA)){
        //     $where .= "AND t_rapat.start_tgl_rapat = '".$waktuA."'";
        // }
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
        $status_active =1;
        $limit ="";
            if (isset($start) AND isset($length)) {
                $limit  = "LIMIT ".$length." OFFSET ".$start;
            }

        $query = " select * from t_rapat
					Left JOIN ruangan on ruangan.id_ruangan = t_rapat.id_ruangan
					Left JOIN invite_jabatan on invite_jabatan.id_rapat = t_rapat.id_rapat
					where invite_jabatan.id_jabatan ='".$status."' AND t_rapat.status_active_rapat = '".$status_active."' AND t_rapat.status_id_rapat IS NULL
                    ".$where."
                    ORDER BY start_tgl_rapat ASC
                ".$limit."

                ";

        $listData = \DB::select($query);

      	 return $listData;
      }
     public static function getAllEselon($status)
    {
        $id_user = \Session::get('auth');
        $agenda_rapat = Input::get('agenda_rapat');
        $pj_rapat = Input::get('pj_rapat');
        $PIC = Input::get('Pic');
        $filterWaktu = Input::get('filterWaktu');
        $get = Input::all();
        $where = "";
        if (!empty($agenda_rapat)) {
                $where .= " AND t_rapat.agenda_rapat  like '%".$agenda_rapat."%'";

        }
        if (!empty($pj_rapat)) {
            $where .= "AND t_rapat.pj_rapat like '%".$pj_rapat."%'";
        }
        if (!empty($PIC)) {
            $where .= "AND t_rapat.PIC like '%".$PIC."%'";
        }
        if (!empty(Input::get('waktuM')) && !empty(Input::get('waktuA'))) {
            $waktuM =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuM'), 0,-3).":00"));
            $waktuA =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuA'), 0,-3).":00"));
            $where .= "AND (t_rapat.start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR t_rapat.end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (t_rapat.start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."'))";
        }
        if (!empty($filterWaktu)) {
            if ($filterWaktu =="bulan") {
                $waktuM =date ("Y-m-d H:i:s");
                $waktuA =date("Y-m-d H:i:s",strtotime('+1 month'));

            }elseif ($filterWaktu =="minggu") {
                $waktuM =date ("Y-m-d H:i:s");
                $waktuA =date("Y-m-d H:i:s",strtotime('+1 week'));
            }else{
                $waktuM =date ("Y-m-d H:i:s");
                $waktuA =date("Y-m-d H:i:s",strtotime('+1 day'));
            }
                $where .= "AND (t_rapat.start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR t_rapat.end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (t_rapat.start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."'))";
        }

        if ( !empty(Input::get('name_pic')) ) {
            $listIdRapat = self::getNamPic($status,  $where, Input::get('name_pic'));
            $toString  = implode(",",$listIdRapat);
            $where .= " AND t_rapat.id_rapat in (".$toString.") ";
        }
        // if ()

        // if (!empty($waktuM)){
        //     $where .= "AND t_rapat.start_tgl_rapat = '".$waktuM."'";
        // }
        // if (!empty($waktuA)){
        //     $where .= "AND t_rapat.start_tgl_rapat = '".$waktuA."'";
        // }
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
            if (isset($start) AND isset($length)) {
                $limit  = "LIMIT ".$length." OFFSET ".$start;
            }

        $query = " select * from t_rapat
					Left JOIN ruangan on ruangan.id_ruangan = t_rapat.id_ruangan
                    Left JOIN invite_jabatan on invite_jabatan.id_rapat = t_rapat.id_rapat
					where invite_jabatan.id_jabatan ='".$status."' AND t_rapat.status_id_rapat IS NULL
                    ".$where."
                ORDER BY start_tgl_rapat ASC
                ".$limit."
                ";
        $listData = \DB::select($query);
      	 return $listData;
      }


     public static function getNamPic($status,  $where, $idPic) {
        $query = " select * from t_rapat
            Left JOIN ruangan on ruangan.id_ruangan = t_rapat.id_ruangan
            Left JOIN invite_jabatan on invite_jabatan.id_rapat = t_rapat.id_rapat
            left JOIN schedule as sc on sc.id_rapat = t_rapat.id_rapat
            where invite_jabatan.id_jabatan ='".$status."' and sc.id_user =  '".$idPic."'
            ".$where."
        ORDER BY start_tgl_rapat ASC
        ";
        $listData = \DB::select($query);
        $idRapat = [];
        if (!empty($listData)) {
            foreach($listData as $k => $v) {
                $idRapat[] = $v->id_rapat;
            }
        }
        return $idRapat;

     }

     public static function getAllCount($status)
    {
        $id_user = \Session::get('auth');
        $agenda_rapat = Input::get('agenda_rapat');
        $pj_rapat = Input::get('pj_rapat');
        $get = Input::all();
        $where = "";
        if (!empty($agenda_rapat)) {
                $where .= " AND t_rapat.agenda_rapat  like '%".$agenda_rapat."%'";

        }
        if (!empty($pj_rapat)) {
            $where .= "AND t_rapat.pj_rapat like '%".$pj_rapat."%'";
        }
        if (!empty(Input::get('waktuM')) && !empty(Input::get('waktuA'))) {
            $waktuM =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuM'), 0,-3).":00"));
            $waktuA =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuA'), 0,-3).":00"));
            $where .= "AND (t_rapat.start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR t_rapat.end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (t_rapat.start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."'))";
        }
        if ( !empty(Input::get('name_pic')) ) {
            $listIdRapat = self::getNamPic($status,  $where, Input::get('name_pic'));
            $toString  = implode(",",$listIdRapat);
            $where .= " AND t_rapat.id_rapat in (".$toString.") ";
        }
        // if (!empty($waktuM)){
        //     $where .= "AND t_rapat.start_tgl_rapat = '".$waktuM."'";
        // }
        // if (!empty($waktuA)){
        //     $where .= "AND t_rapat.start_tgl_rapat = '".$waktuA."'";
        // }
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
        $status_active =1;
        $limit ="";

        $query = " select * from t_rapat
					Left JOIN ruangan on ruangan.id_ruangan = t_rapat.id_ruangan
					Left JOIN invite_jabatan on invite_jabatan.id_rapat = t_rapat.id_rapat
					where invite_jabatan.id_jabatan ='".$status."' AND t_rapat.status_active_rapat = '".$status_active."' AND t_rapat.status_id_rapat IS NULL
                    ".$where."
                ".$limit."
                ";

        $listData = \DB::select($query);
      	 return $listData;
      }
     public static function getAllCountEselon($status)
    {
        $id_user = \Session::get('auth');
        $agenda_rapat = Input::get('agenda_rapat');
        $pj_rapat = Input::get('pj_rapat');
        $PIC = Input::get('Pic');
        $get = Input::all();
        $where = "";
        if (!empty($agenda_rapat)) {
                $where .= " AND t_rapat.agenda_rapat  like '%".$agenda_rapat."%'";

        }
        if (!empty($pj_rapat)) {
            $where .= "AND t_rapat.pj_rapat like '%".$pj_rapat."%'";
        }
        if (!empty($PIC)) {
            $where .= "AND t_rapat.PIC like '%".$PIC."%'";
        }
        if (!empty(Input::get('waktuM')) && !empty(Input::get('waktuA'))) {
            $waktuM =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuM'), 0,-3).":00"));
            $waktuA =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuA'), 0,-3).":00"));
            $where .= "AND (t_rapat.start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR t_rapat.end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (t_rapat.start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."'))";
        }

                if ( !empty(Input::get('name_pic')) ) {
                    $listIdRapat = self::getNamPic($status,  $where, Input::get('name_pic'));
                    $toString  = implode(",",$listIdRapat);
                    $where .= " AND t_rapat.id_rapat in (".$toString.") ";
                }
        // if (!empty($waktuM)){
        //     $where .= "AND t_rapat.start_tgl_rapat = '".$waktuM."'";
        // }
        // if (!empty($waktuA)){
        //     $where .= "AND t_rapat.start_tgl_rapat = '".$waktuA."'";
        // }
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
        $status_active =1;
        $limit ="";

        $query = " select * from t_rapat
					Left JOIN ruangan on ruangan.id_ruangan = t_rapat.id_ruangan
					Left JOIN invite_jabatan on invite_jabatan.id_rapat = t_rapat.id_rapat
					where invite_jabatan.id_jabatan ='".$status."' AND t_rapat.status_id_rapat IS NULL
                    ".$where."
                ".$limit."
                ";

        $listData = \DB::select($query);
      	 return $listData;
      }
      public static function getData($status){
          $status_active =1;
          $query = " select * from t_rapat
  						where invite_jabatan.id_jabatan ='".$status."' AND t_rapat.status_active_rapat = '".$status_active."'
                      ".$where."
                  ".$limit."
                  ";

          $listData = \DB::select($query);
      }
     public static function getAllInternal($status)
    {
        $id_user = \Session::get('auth');
        $input = Input::get('search.value');
        $agenda_rapat = Input::get('agenda_rapat');
        $pj_rapat = Input::get('pj_rapat');
        $PIC = Input::get('Pic');
        $filterWaktu = Input::get('filterWaktu');
        $get = Input::all();
        $where = "";

        if (!empty($agenda_rapat)) {
                $where .= " AND t_rapat.agenda_rapat  like '%".$agenda_rapat."%'";

        }
        if (!empty($pj_rapat)) {
            $where .= "AND t_rapat.pj_rapat like '%".$pj_rapat."%'";
        }
        if (!empty($PIC)) {
            $where .= "AND t_rapat.PIC like '%".$PIC."%'";
        }
        if (!empty(Input::get('waktuM')) && !empty(Input::get('waktuA'))) {
            $waktuM =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuM'), 0,-3).":00"));
            $waktuA =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuA'), 0,-3).":00"));
            $where .= "AND (t_rapat.start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR t_rapat.end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (t_rapat.start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."'))";
        }
        if (!empty($filterWaktu)) {
            if ($filterWaktu =="bulan") {
                $waktuM =date ("Y-m-d H:i:s");
                $waktuA =date("Y-m-d H:i:s",strtotime('+1 month'));

            }elseif ($filterWaktu =="tahun") {
                $waktuM =date ("Y-m-d H:i:s");
                $waktuA =date("Y-m-d H:i:s",strtotime('+1 year'));
            }else{
                $waktuM =date ("Y-m-d H:i:s");
                $waktuA =date("Y-m-d H:i:s",strtotime('+1 day'));
            }
                $where .= "AND (t_rapat.start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR t_rapat.end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (t_rapat.start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."'))";
        }
      /*  if (!empty($input)) {
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
*/
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
        $status_active =1;
        $limit  = "";
        if (!empty($start) AND !empty($length)) {
            $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = " select * from t_rapat
					Left JOIN ruangan on ruangan.id_ruangan = t_rapat.id_ruangan
					Left JOIN invite_jabatan on invite_jabatan.id_rapat = t_rapat.id_rapat

					where invite_jabatan.id_jabatan ='".$status."' AND t_rapat.status_id_rapat IS NULL
                ".$where."
                ORDER BY start_tgl_rapat ASC
                ".$limit."
                ";
        $listData = \DB::select($query);
      	 return $listData;
      }
      public static function getAllInternalBook($status)
     {
         $id_user = \Session::get('auth');
         $input = Input::get('search.value');
         $get = Input::all();
         $PIC = Input::get('Pic');
         $filterWaktu = Input::get('filterWaktu');
         $where = "";
         if (!empty($agenda_rapat)) {
                 $where .= " AND t_rapat.agenda_rapat  like '%".$agenda_rapat."%'";

         }
         if (!empty($pj_rapat)) {
             $where .= "AND t_rapat.pj_rapat like '%".$pj_rapat."%'";
         }
         if (!empty(Input::get('waktuM')) && !empty(Input::get('waktuA'))) {
             $waktuM =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuM'), 0,-3).":00"));
             $waktuA =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuA'), 0,-3).":00"));
             $where .= "AND (t_rapat.start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR t_rapat.end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (t_rapat.start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."'))";
         }
         if (!empty($PIC)) {
             $where .= "AND t_rapat.PIC like '%".$PIC."%'";
         }
         if (!empty($filterWaktu)) {
             if ($filterWaktu =="bulan") {
                 $waktuM =date ("Y-m-d H:i:s");
                 $waktuA =date("Y-m-d H:i:s",strtotime('+1 month'));

             }elseif ($filterWaktu =="tahun") {
                 $waktuM =date ("Y-m-d H:i:s");
                 $waktuA =date("Y-m-d H:i:s",strtotime('+1 year'));
             }else{
                 $waktuM =date ("Y-m-d H:i:s");
                 $waktuA =date("Y-m-d H:i:s",strtotime('+1 day'));
             }
                 $where .= "AND (t_rapat.start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR t_rapat.end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (t_rapat.start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."'))";
         }
       /*  if (!empty($input)) {
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
 */
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
         $status_active =1;
         $id_user =Session()->get('auth')['id_user'];
         $limit  = "";
         if (!empty($start) AND !empty($length)) {
             $limit  = "LIMIT ".$length." OFFSET ".$start;
         }
         $query = " select * from t_rapat
                   Left JOIN ruangan on ruangan.id_ruangan = t_rapat.id_ruangan
                   Left JOIN invite_jabatan on invite_jabatan.id_rapat = t_rapat.id_rapat

                   where invite_jabatan.id_jabatan ='".$status."' AND t_rapat.creator = '".$id_user."' AND t_rapat.status_id_rapat IS NULL
                 ".$where."
                ORDER BY start_tgl_rapat ASC
                 ".$limit."
                 ";
         $listData = \DB::select($query);
            return $listData;
       }

      public static function getShow($id_jabatan,$id_rapat){
        $query = " select * from t_rapat
                    Left JOIN ruangan on ruangan.id_ruangan = t_rapat.id_ruangan
                    where t_rapat.id_rapat =".$id_rapat." ";


          $listData = \DB::select($query);
         return $listData;


      }
      public static function getHome(){
        $query = " select * from t_rapat
                    Left JOIN invite_jabatan on invite_jabatan.id_rapat = t_rapat.id_rapat
                    where status_active_rapat ='1'
                     ";


          $listData = \DB::select($query);
         return $listData;


      }
      public static function getShowAllRuangan(){
          $query ="select * from ruangan";
          $listData = \DB::select($query);
          return $listData;
      }
      public static function getShowRuangan($id_ruangan){

        $status ="internal";

        if (empty(Input::get('waktuM'))) {
            $waktuM =date("Y-m-d 00:00:00");
            $waktuA =date("Y-m-d 23:59:00");
        }else{
            $waktuM =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuM'), 0,-3).":00"));
            $waktuA =date("Y-m-d H:i:s",strtotime(substr(Input::get('waktuA'), 0,-3).":00"));
        }
        $status_active = "1";
        $query ="Select * from t_rapat WHERE (start_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR end_tgl_rapat BETWEEN '".$waktuM."' AND '".$waktuA."' OR (start_tgl_rapat <= '".$waktuM."' AND end_tgl_rapat >= '".$waktuA."')) AND status_active_rapat ='".$status_active."' AND status_ruangan_rapat ='".$status."' AND id_ruangan ='".$id_ruangan."'";
        $listData = \DB::select($query);
     return $listData;
      }
     public static function checkRapatStatus(){
         $id_rapat = Input::get('id');
            $query ="select t_rapat.status_active_rapat from t_rapat where id_rapat ='".$id_rapat."' ";
        $listData = \DB::select($query);
     return $listData;
     }
     public static function checkRuangan($data){
        $start = $data['start'];
        $end = $data['end'];
        $ruangan = $data['ruangan'];
        if (!empty($data['id'])) {
                $id = $data['id'];

        }
        $status =1;
        $status_active =1;
        $where ="";
        if (!empty($id)) {
            $where = "AND id_rapat != '".$id."'";
        }
        $query ="select * from t_rapat where id_ruangan = '".$ruangan."' AND (start_tgl_rapat BETWEEN '".$start."' AND '".$end."' OR end_tgl_rapat BETWEEN '".$start."' AND '".$end."' OR (start_tgl_rapat <= '".$start."' AND end_tgl_rapat >= '".$end."'))  AND status_active_rapat ='".$status_active." '".$where."   ";
        $listData = \DB::select($query);
        // echo "<pre>";
        // print_r($listData);die;
        return $listData;


     }
     public static function checkRuanganbook($data){
        $start = $data['start'];
        $end = $data['end'];
        $ruangan = $data['ruangan'];
        if (!empty($data['id'])) {
                $id = $data['id'];

        }
        $status =1;
        $status_active =1;
        $where ="";
        if (!empty($id)) {
            $where = "AND id_rapat != '".$id."'";
        }
        $query ="select * from t_rapat where id_ruangan = '".$ruangan."' AND (start_tgl_rapat BETWEEN '".$start."' AND '".$end."' OR end_tgl_rapat BETWEEN '".$start."' AND '".$end."' OR (start_tgl_rapat <= '".$start."' AND end_tgl_rapat >= '".$end."'))".$where."   ";
        $listData = \DB::select($query);
        // echo "<pre>";
        // print_r($listData);die;
        return $listData;


     }

}
