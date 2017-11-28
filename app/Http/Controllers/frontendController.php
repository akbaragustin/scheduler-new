<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Users as US;
use App\Models\Rapat as RP ;
use App\Models\Ruangan as RU ;
use App\Models\Schedule as SC ;
use App\Models\Invite_name as IN ;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class frontendController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

          return view('frontend');
    }
    public function indexShowFrontend()
    {
          return view('tableFrontend');
    }
    public function indexShowFrontendKapus()
    {
          return view('tableKapus');
    }
    public function indexShowFrontendEselon()
    {
          return view('tableEselon');
    }
    public function indexShowFrontendRuangan()
    {
          return view('tabelRuangan');
    }
    public function indexRuangan()
    {

          return view('ruanganFe');
    }
    public function indexEselonKapus()
    {
            $data['name_pic'] = US::all()->toArray();
          return view('eselon_kapus',$data);
    }
    public function indexKapus()
    {

          return view('kapusShow');
    }

    public function indexAjax(){
            $draw=$_REQUEST['draw'];
            $length=$_REQUEST['length'];
            $start=$_REQUEST['start'];
            $search=$_REQUEST['search']["value"];
            // ======= count ===== //
            $queryCount = RP::getAllCount($id =18);
            $query = RP::getAll($id =18);
            $total=count($queryCount);
            // ======= count ===== //

            $output=array();
            $output['draw']=$draw;
            $output['recordsTotal']=$output['recordsFiltered']=$total;
            $output['data']=array();

            $list = [];
            $no =1;
            foreach ($query as $key => $row) {

        $waktu = date('H:i', strtotime($row->start_tgl_rapat))."-".date('H:i', strtotime($row->end_tgl_rapat));
         if (!empty($row->phari)) {
             $startTambah = date('d-m-Y',strtotime($row->start_tgl_rapat. '+' .$row->phari.'days'));
             $hari =date('w',strtotime($row->start_tgl_rapat));
             $hariTambah =date('w',strtotime($row->start_tgl_rapat.'+'.$row->phari.'days'));
             $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
             $dayTambah ="";
                 if ($hariTambah == 1) {
                     $dayTambah ="Senin";
                 }elseif ($hariTambah ==2) {
                     $dayTambah ="Selasa";
                 }elseif($hariTambah ==3){
                     $dayTambah ="Rabu";
                 }elseif ($hariTambah ==4) {
                     $dayTambah ="Kamis";
                 }elseif($hariTambah == 5){
                     $dayTambah ="Jumat";
                 }elseif($hariTambah ==6){
                     $dayTambah ="Sabtu";
                 }elseif ($hariTambah == 0) {
                     $dayTambah ="Minggu";
                 }
         }else{
             $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
             $hari =date('w',strtotime($row->start_tgl_rapat));
         }
         $day ="";
             if ($hari == 1) {
                 $day ="Senin";
             }elseif ($hari ==2) {
                 $day ="Selasa";
             }elseif($hari ==3){
                 $day ="Rabu";
             }elseif ($hari ==4) {
                 $day ="Kamis";
             }elseif($hari == 5){
                 $day ="Jumat";
             }elseif($hari ==6){
                 $day ="Sabtu";
             }elseif ($hari == 0) {
                 $day ="Minggu";
             }
             if (!empty($row->phari)) {
                 $json['start_tgl_rapat'] ="<center>".$day." - ".$dayTambah."<br> <small>". $start." s/d ".$startTambah."</small></center>";

             } else{
                 $json['start_tgl_rapat'] ="<center>".$day ."<br> <small>". $start."</small></center>";

             }
             $json['waktu'] = "<small>".$waktu."</small>";
                $tempat = "";
                if (!empty($row->tempat_rapat)) {
                    $tempat = $row->tempat_rapat;

            }else{
                $tempat = $row->name_ruangan;
            }

            $json['agenda_rapat'] = $row->agenda_rapat;
            $json['pj_rapat'] = $row->pj_rapat;
            $json['tempat_rapat'] = $tempat;
            $json['no'] = $no;
            $json['id_rapat'] = $row->id_rapat;
            $json['PIC'] = $row->PIC;
            $json['fasilitator'] = $row->fasilitator;
            $infant_eselon =SC::getInviteInfant($row->id_rapat);

            $infant_biasa =IN::getInviteInfant($row->id_rapat);
            $pejabat_eselon =SC::getInviteUndang($row->id_rapat);
            $pejabat_biasa =IN::getInviteUndang($row->id_rapat);

            $data_undang ="";
            if (!empty($pejabat_eselon) OR !empty($pejabat_biasa)) {
                $data_undang ="<ol>";
                if (!empty($pejabat_biasa)) {
                    foreach ($pejabat_biasa as $k => $v) {
                        $data_undang .= "<li>";
                        $data_undang .= $v->disposisi_rapat." ";
                        $data_undang .= "</li>";
                    }
                }
                if (!empty($pejabat_eselon)) {
                foreach ($pejabat_eselon as $key => $value) {
                    $data_undang .= "<li>";
                    $data_undang .= $value->name_pic." ";
                    $data_undang .= "</li>";
                    }
                }
                $data_undang .="</ol>";
            }
            $data_infant ="";
            if (!empty($infant_eselon) OR !empty($infant_biasa)) {
                $data_infant ="<ol>";
                if (!empty($infant_biasa)) {
                    foreach ($infant_biasa as $k => $v) {
                        $data_infant .= "<li>";
                        $data_infant .= $v->disposisi_rapat." ";
                        $data_infant .= "</li>";
                    }
                }
                if (!empty($infant_eselon)) {
                foreach ($infant_eselon as $key => $value) {
                    $data_infant .= "<li>";
                    $data_infant .= $value->name_pic." ";
                    $data_infant .= "</li>";
                    }
                }
                $data_infant .="</ol>";
            }
            $json['infant'] = $data_infant;
            $json['pejabat'] = $data_undang;
            // echo "<pre>";
            // print_r($infant_biasa);die;
            $no++;
            $list[] = $json;
        }
        $output['data']  = $list;
        echo json_encode($output);

    }

    public function showAjax(){
          $id_rapat = Input::get('id');
          $query = RP::getShow($id =18,$id_rapat);
          $list =[];
          foreach ($query as $key => $value) {
              $data['infant_eselon'] =SC::getInviteInfant($value->id_rapat);
              $data['undang_eselon'] =SC::getInviteUndang($value->id_rapat);
              $data['name_infant'] =IN::getInviteInfant($value->id_rapat);
              $data['disposisi_rapat'] =IN::getInviteUndang($value->id_rapat);
          $list['data'][] =$data;
          }
            $view = view('viewShow',$list)->render();
            $output['data'] = $view;
          echo json_encode($output);


     }
    public function showAjaxKapus(){
          $id_rapat = Input::get('id');
          $query = RP::getShow($id =14,$id_rapat);
          $list =[];
          foreach ($query as $key => $value) {
              $data['infant_eselon'] =SC::getInviteInfant($value->id_rapat);
              $data['undang_eselon'] =SC::getInviteUndang($value->id_rapat);
              $data['name_infant'] =IN::getInviteInfant($value->id_rapat);
              $data['disposisi_rapat'] =IN::getInviteUndang($value->id_rapat);
          $list['data'][] =$data;
          }
            $view = view('viewShowKapus',$list)->render();
            $output['data'] = $view;
          echo json_encode($output);


     }
    public function showAjaxEselon(){
          $id_rapat = Input::get('id');
          $query = RP::getShow($id =15,$id_rapat);
          $list =[];
          foreach ($query as $key => $value) {
              $data['infant_eselon'] =SC::getInviteInfant($value->id_rapat);
              $data['undang_eselon'] =SC::getInviteUndang($value->id_rapat);
              $data['name_infant'] =IN::getInviteInfant($value->id_rapat);
              $data['disposisi_rapat'] =IN::getInviteUndang($value->id_rapat);
              $data['name_eselon'] =SC::getInviteEselon($value->id_rapat);

          $list['data'][] =$data;
          }
            $view = view('viewShowEselon',$list)->render();
            $output['data'] = $view;
          echo json_encode($output);


     }
     public function indexAjaxEselon(){
         $draw=$_REQUEST['draw'];
         $length=$_REQUEST['length'];
         $start=$_REQUEST['start'];
         $search=$_REQUEST['search']["value"];
         $listWajib = new RP;
         // ======= count ===== //
         $queryCount = RP::getAllCountEselon($id =15);
         $total = count($queryCount);
         // ======= count ===== //
         $output=array();
         $output['draw']=$draw;
         $output['recordsTotal']=$output['recordsFiltered']= $total;
         $output['data']=array();
         $query = RP::getAllEselon($id =15);
         $list = [];
         $no =1;
         foreach ($query as $key => $row) {

            $waktu = date('H:i', strtotime($row->start_tgl_rapat))."-".date('H:i', strtotime($row->end_tgl_rapat));
             if (!empty($row->phari)) {
                 $startTambah = date('d-m-Y',strtotime($row->start_tgl_rapat. '+' .$row->phari.'days'));
                 $hari =date('w',strtotime($row->start_tgl_rapat));
                 $hariTambah =date('w',strtotime($row->start_tgl_rapat.'+'.$row->phari.'days'));
                 $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
                 $dayTambah ="";
                     if ($hariTambah == 1) {
                         $dayTambah ="Senin";
                     }elseif ($hariTambah ==2) {
                         $dayTambah ="Selasa";
                     }elseif($hariTambah ==3){
                         $dayTambah ="Rabu";
                     }elseif ($hariTambah ==4) {
                         $dayTambah ="Kamis";
                     }elseif($hariTambah == 5){
                         $dayTambah ="Jumat";
                     }elseif($hariTambah ==6){
                         $dayTambah ="Sabtu";
                     }elseif ($hariTambah == 0) {
                         $dayTambah ="Minggu";
                     }
             }else{
                 $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
                 $hari =date('w',strtotime($row->start_tgl_rapat));
             }
             $day ="";
                 if ($hari == 1) {
                     $day ="Senin";
                 }elseif ($hari ==2) {
                     $day ="Selasa";
                 }elseif($hari ==3){
                     $day ="Rabu";
                 }elseif ($hari ==4) {
                     $day ="Kamis";
                 }elseif($hari == 5){
                     $day ="Jumat";
                 }elseif($hari ==6){
                     $day ="Sabtu";
                 }elseif ($hari == 0) {
                     $day ="Minggu";
                 }
                 if (!empty($row->phari)) {
                     $json['start_tgl_rapat'] ="<center>".$day." - ".$dayTambah."<br> <small>". $start." s/d ".$startTambah."</small></center>";

                 } else{
                     $json['start_tgl_rapat'] ="<center>".$day ."<br> <small>". $start."</small></center>";

                 }
                 $json['waktu'] = "<small>".$waktu."</small>";
             $tempat = "";
             if (!empty($row->tempat_rapat)) {
                 $tempat = $row->tempat_rapat;

         }else{
             $tempat = $row->name_ruangan;
         }
         $json['agenda_rapat'] = $row->agenda_rapat;
         $json['pj_rapat'] = $row->pj_rapat;


         $json['no'] = $no;
         $json['tempat_rapat'] = $tempat;
         $json['id_rapat'] = $row->id_rapat;
         $json['PIC'] = $row->PIC;
         $json['fasilitator'] = $row->fasilitator;

         $infant_eselon =SC::getInviteInfant($row->id_rapat);
         $infant_biasa =IN::getInviteInfant($row->id_rapat);
         $pejabat_eselon =SC::getInviteUndang($row->id_rapat);
         $name_eselon =SC::getInviteEselon($row->id_rapat);

         $eselon ="";
         if (!empty($pejabat_eselon) OR !empty($name_eselon) OR !empty($infant_eselon)) {
             $eselon ="<ol>";
             if (!empty($name_eselon)) {
                 foreach ($name_eselon as $k => $v) {
                     $eselon .= "<li>";
                     $eselon .= $v->name_pic." ";
                     $eselon .= "</li>";
                 }
             }
             if (!empty($pejabat_eselon)) {
             foreach ($pejabat_eselon as $key => $value) {
                 $eselon .= "<li>";
                 $eselon .= $value->name_pic." ";
                 $eselon .= "</li>";
                 }
             }
             if (!empty($infant_eselon)) {
             foreach ($infant_eselon as $keys => $values) {
                 $eselon .= "<li>";
                 $eselon .= $values->name_pic." ";
                 $eselon .= "</li>";
                 }
             }
             $eselon .="</ol>";
         }
         $data_infant ="";
              $data_infant ="<ol>";
             if (!empty($infant_biasa)) {
                 foreach ($infant_biasa as $k => $v) {
                     $data_infant .= "<li>";
                     $data_infant .= $v->disposisi_rapat." ";
                     $data_infant .= "</li>";
                 }
             }

             $data_infant .="</ol>";
             $json['name_eselon'] =$eselon;
             $json['infant_biasa'] =$data_infant;
             $no++;
             $list[] = $json;
         }

     $output['data']  = $list;
     echo json_encode($output);

 }
     public function indexAjaxKapus(){
         $draw=$_REQUEST['draw'];
         $length=$_REQUEST['length'];
         $start=$_REQUEST['start'];
         $search=$_REQUEST['search']["value"];
         // ======= count ===== //
         $queryCount =RP::getAllCount($id =14);
         $query = RP::getAll($id =14);
         $total=count($queryCount);
         // ======= count ===== //

         $output=array();
         $output['draw']=$draw;
         $output['recordsTotal']=$output['recordsFiltered']=$total;
         $output['data']=array();
         $list = [];
         $no =1;
         foreach ($query as $key => $row) {

         $waktu = date('H:i', strtotime($row->start_tgl_rapat))."-".date('H:i', strtotime($row->end_tgl_rapat));
          if (!empty($row->phari)) {
              $startTambah = date('d-m-Y',strtotime($row->start_tgl_rapat. '+' .$row->phari.'days'));
              $hari =date('w',strtotime($row->start_tgl_rapat));
              $hariTambah =date('w',strtotime($row->start_tgl_rapat.'+'.$row->phari.'days'));
              $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
              $dayTambah ="";
                  if ($hariTambah == 1) {
                      $dayTambah ="Senin";
                  }elseif ($hariTambah ==2) {
                      $dayTambah ="Selasa";
                  }elseif($hariTambah ==3){
                      $dayTambah ="Rabu";
                  }elseif ($hariTambah ==4) {
                      $dayTambah ="Kamis";
                  }elseif($hariTambah == 5){
                      $dayTambah ="Jumat";
                  }elseif($hariTambah ==6){
                      $dayTambah ="Sabtu";
                  }elseif ($hariTambah == 0) {
                      $dayTambah ="Minggu";
                  }
          }else{
              $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
              $hari =date('w',strtotime($row->start_tgl_rapat));
          }
          $day ="";
              if ($hari == 1) {
                  $day ="Senin";
              }elseif ($hari ==2) {
                  $day ="Selasa";
              }elseif($hari ==3){
                  $day ="Rabu";
              }elseif ($hari ==4) {
                  $day ="Kamis";
              }elseif($hari == 5){
                  $day ="Jumat";
              }elseif($hari ==6){
                  $day ="Sabtu";
              }elseif ($hari == 0) {
                  $day ="Minggu";
              }
              if (!empty($row->phari)) {
                  $json['start_tgl_rapat'] ="<center>".$day." - ".$dayTambah."<br> <small>". $start." s/d <br>".$startTambah."</small></center>";

              } else{
                  $json['start_tgl_rapat'] ="<center>".$day ."<br> <small>". $start."</small></center>";

              }
              $json['waktu'] = "<small>".$waktu."</small>";
             $tempat = "";
             if (!empty($row->tempat_rapat)) {
                 $tempat = $row->tempat_rapat;

         }else{
             $tempat = $row->name_ruangan;
         }
         $json['agenda_rapat'] = $row->agenda_rapat;
         $json['pj_rapat'] = $row->pj_rapat;
         $json['no'] = $no;
         $json['tempat_rapat'] = $tempat;
         $json['id_rapat'] = $row->id_rapat;
         $json['PIC'] = $row->PIC;
         $json['fasilitator'] = $row->fasilitator;
         $infant_eselon =SC::getInviteInfant($row->id_rapat);
         $infant_biasa =IN::getInviteInfant($row->id_rapat);
         $data_infant ="";
         if (!empty($infant_eselon) OR !empty($infant_biasa)) {
             $data_infant ="<ol>";
             if (!empty($infant_biasa)) {
                 foreach ($infant_biasa as $k => $v) {
                     $data_infant .= "<li>";
                     $data_infant .= $v->disposisi_rapat." ";
                     $data_infant .= "</li>";
                 }
             }
             if (!empty($infant_eselon)) {
             foreach ($infant_eselon as $key => $value) {
                 $data_infant .= "<li>";
                 $data_infant .= $value->name_pic." ";
                 $data_infant .= "</li>";
                 }
             }
             $data_infant .="</ol>";
         }
         $no++;
         $json['infant'] = $data_infant;
         $list [] = $json;
     }

     $output['data']  = $list;
     echo json_encode($output);

 }
 public function indexAjaxRuangan(){
     $queryRuanganAll = RP::getShowAllRuangan();
     $draw=$_REQUEST['draw'];
     $length=$_REQUEST['length'];
     $start=$_REQUEST['start'];
     $search=$_REQUEST['search']["value"];
     // ======= count ===== //
     $count = count($queryRuanganAll);
     // ======= count ===== //

     $output=array();
     $output['draw']=$draw;
     $output['recordsTotal']=$output['recordsFiltered']=$count;
     $output['data']=array();
     $status =[];
     foreach ($queryRuanganAll as $key => $value) {

         $data['ruangan'] = $value->name_ruangan ;
         $data['kapasitas'] = $value->max_ruangan;
         $data['showIsi'] =RP::getShowRuangan($value->id_ruangan);
          if (empty($data['showIsi'])) {
              $data['status'] ="Kosong";

          }else {
              $data['status'] ="Terisi";
          }
          if ($data['status']== "Terisi") {
              $start ="<ol>";
              $keterangan ="<ol>";
              $time ="<ol>";
                foreach ($data['showIsi'] as $key => $value) {
                    $hari =date('w',strtotime($value->start_tgl_rapat));
                    $data['pj_rapat'] = $value->pj_rapat;
                    $day ="";
                        if ($hari == 1) {
                            $day ="Senin";
                        }elseif ($hari ==2) {
                            $day ="Selasa";
                        }elseif($hari ==3){
                            $day ="Rabu";
                        }elseif ($hari ==4) {
                            $day ="Kamis";
                        }elseif($hari == 5){
                            $day ="Jumat";
                        }elseif($hari ==6){
                            $day ="Sabtu";
                        }elseif ($hari == 0) {
                            $day ="Minggu";
                        }
                    $hariE =date('w',strtotime($value->end_tgl_rapat));
                    $dayE ="";
                        if ($hariE == 1) {
                            $dayE ="Senin";
                        }elseif ($hariE ==2) {
                            $dayE ="Selasa";
                        }elseif($hariE ==3){
                            $dayE ="Rabu";
                        }elseif ($hariE ==4) {
                            $dayE ="Kamis";
                        }elseif($hariE == 5){
                            $dayE ="Jumat";
                        }elseif($hariE ==6){
                            $dayE ="Sabtu";
                        }elseif ($hariE == 0) {
                            $dayE ="Minggu";
                        }
                    $start .="<li>";
                    $start .= $day.", ".date("d-m-Y", strtotime($value->start_tgl_rapat))." s/d ".$dayE.", ".date("d-m-Y", strtotime($value->end_tgl_rapat));
                    $start .="</li>";
                    $keterangan .= "<li>";
                    $keterangan .= $value->agenda_rapat;
                    $keterangan .= "</li>";
                    $time .= "<li>";
                    $time .= date("H:i", strtotime($value->start_tgl_rapat))." - ".date("H:i", strtotime($value->end_tgl_rapat));
                    $time .= "</li>";
                }
                $start .="</ol>";
                $keterangan .="</ol>";
                $time .="</ol>";
            $data['tanggal'] = $start;
            $data['waktu'] = $time;
            $data['keterangan'] = $keterangan;
        }else{
            $data['keterangan'] = "-";
            $data['waktu'] = "-";
            $data['tanggal'] = "-";
            $data['pj_rapat'] = "-";
        }

      $output['data'][]=$data;
     }
     echo json_encode($output);
 }
 public function searchAjax()
 {
   $isiSearch =Input::get('q.term');
   $query = US::getName_pic($isiSearch);
     $list =[];
         foreach ($query as $key => $value) {

             $json['id'] = $value->id_user;
             $json['text'] = $value->name_pic;
             $list[] =$json;
         }

     echo json_encode($list);

  }
  public function showTable(){
      $draw=$_REQUEST['draw'];
      $length=$_REQUEST['length'];
      $start=$_REQUEST['start'];
      $search=$_REQUEST['search']["value"];
      // ======= count ===== //
      $queryCount = RP::getAllCount($id =18);
      $query = RP::getAll($id =18);
      $total=count($queryCount);
      // ======= count ===== //

      $output=array();
      $output['draw']=$draw;
      $output['recordsTotal']=$output['recordsFiltered']=$total;
      $output['data']=array();

      $list = [];
      $no =1;
      foreach ($query as $key => $row) {

  $waktu = date('H:i', strtotime($row->start_tgl_rapat))."-".date('H:i', strtotime($row->end_tgl_rapat));
   if (!empty($row->phari)) {
       $startTambah = date('d-m-Y',strtotime($row->start_tgl_rapat. '+' .$row->phari.'days'));
       $hari =date('w',strtotime($row->start_tgl_rapat));
       $hariTambah =date('w',strtotime($row->start_tgl_rapat.'+'.$row->phari.'days'));
       $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
       $dayTambah ="";
           if ($hariTambah == 1) {
               $dayTambah ="Senin";
           }elseif ($hariTambah ==2) {
               $dayTambah ="Selasa";
           }elseif($hariTambah ==3){
               $dayTambah ="Rabu";
           }elseif ($hariTambah ==4) {
               $dayTambah ="Kamis";
           }elseif($hariTambah == 5){
               $dayTambah ="Jumat";
           }elseif($hariTambah ==6){
               $dayTambah ="Sabtu";
           }elseif ($hariTambah == 0) {
               $dayTambah ="Minggu";
           }
   }else{
       $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
       $hari =date('w',strtotime($row->start_tgl_rapat));
   }
   $day ="";
       if ($hari == 1) {
           $day ="Senin";
       }elseif ($hari ==2) {
           $day ="Selasa";
       }elseif($hari ==3){
           $day ="Rabu";
       }elseif ($hari ==4) {
           $day ="Kamis";
       }elseif($hari == 5){
           $day ="Jumat";
       }elseif($hari ==6){
           $day ="Sabtu";
       }elseif ($hari == 0) {
           $day ="Minggu";
       }
       if (!empty($row->phari)) {
           $json['start_tgl_rapat'] ="<center>".$day." - ".$dayTambah."<br> <small>". $start." s/d ".$startTambah."</small></center>";

       } else{
           $json['start_tgl_rapat'] ="<center>".$day ."<br> <small>". $start."</small></center>";

       }
       $json['waktu'] = "<small>".$waktu."</small>";
          $tempat = "";
          if (!empty($row->tempat_rapat)) {
              $tempat = $row->tempat_rapat;

      }else{
          $tempat = $row->name_ruangan;
      }

      $json['agenda_rapat'] = $row->agenda_rapat;
      $json['pj_rapat'] = $row->pj_rapat;
      $json['tempat_rapat'] = $tempat;
      $json['no'] = $no;
      $json['id_rapat'] = $row->id_rapat;
      $json['PIC'] = $row->PIC;
      $json['fasilitator'] = $row->fasilitator;
      $infant_eselon =SC::getInviteInfant($row->id_rapat);

      $infant_biasa =IN::getInviteInfant($row->id_rapat);
      $pejabat_eselon =SC::getInviteUndang($row->id_rapat);
      $pejabat_biasa =IN::getInviteUndang($row->id_rapat);

      $data_undang ="";
      if (!empty($pejabat_eselon) OR !empty($pejabat_biasa)) {
          $data_undang ="<ol>";
          if (!empty($pejabat_biasa)) {
              foreach ($pejabat_biasa as $k => $v) {
                  $data_undang .= "<li>";
                  $data_undang .= $v->disposisi_rapat." ";
                  $data_undang .= "</li>";
              }
          }
          if (!empty($pejabat_eselon)) {
          foreach ($pejabat_eselon as $key => $value) {
              $data_undang .= "<li>";
              $data_undang .= $value->name_pic." ";
              $data_undang .= "</li>";
              }
          }
          $data_undang .="</ol>";
      }
      $data_infant ="";
      if (!empty($infant_eselon) OR !empty($infant_biasa)) {
          $data_infant ="<ol>";
          if (!empty($infant_biasa)) {
              foreach ($infant_biasa as $k => $v) {
                  $data_infant .= "<li>";
                  $data_infant .= $v->disposisi_rapat." ";
                  $data_infant .= "</li>";
              }
          }
          if (!empty($infant_eselon)) {
          foreach ($infant_eselon as $key => $value) {
              $data_infant .= "<li>";
              $data_infant .= $value->name_pic." ";
              $data_infant .= "</li>";
              }
          }
          $data_infant .="</ol>";
      }
      $json['infant'] = $data_infant;
      $json['pejabat'] = $data_undang;
      // echo "<pre>";
      // print_r($infant_biasa);die;
      $no++;
      $list[] = $json;
  }
  $output['data']  = $list;
  echo json_encode($output);
  }
//   public function api(){
//       $Authorization = \Request::header('Authorization');
//       $channel = \Request::header('channel');
//
//       //print_r($header);die;
//       $data = US::where('id_user',Input::get('id_user'))->get()->toArray();
//     //   $data = US::all()->toArray();
//       return Response()->json($data);
//   }
//   public function api_items(){
//       $c = new Client();
//       $array['count'] =15;
//       $array['page'] =1;
//       $array['hot_item_id'] =-1;
//       $response = $c->post('https://api.kudoplay.com/v3/products/getItems', [
//             'headers' => [
//                 'Authorization' =>'ype0Ph3FojSlWwUqHziFeybMCRh6AZX2nbtRnq1K',
//                 'Channel' =>'WEB',
//                 'Client-version' =>'18288',
//                 'Guest-mode' =>'true',
//                 'Content-Type' => 'application/json'
//             ],
//             'body' => json_encode($array, true)
//         ]);
//     $promo = json_decode($response->getBody(), true);
//     print_r($promo);die;
//   }
// public function test(){
//         $data = date('Y-m-d H:i:s');
//
//         print_r($data);die;
//     }
}
