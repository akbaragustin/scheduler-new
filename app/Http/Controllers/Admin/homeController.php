<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\Rapat as RP ;
use App\Models\schedule as SC ;
use App\Models\Jabatan as JB;
use App\Models\Ruangan as RU;
use App\Models\Users as US;
use Response;
class homeController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $status_jabatan = 2;
        $data['allJabatan'] = JB::where('status_jabatan',$status_jabatan)->get()->toArray();
        $data['allUser'] = json_encode(US::all());
        $data['allRuangan'] = json_encode(RU::all());

        return view ('home',$data);
    }
    public function indexAjax()
    {
        $data['allData'] = RP::getHome();
        echo json_encode($data);
     }
      public function searchAjax()
    {
      $isiSearch =Input::get('q.term');
      $query = US::getSearch($isiSearch);
        $list =[];
            foreach ($query as $key => $value) {
                $json['id'] = $value->id_user;
                $json['text'] = $value->username;
                $list[] =$json;
            }

        echo json_encode($list);

     }

    public function saveAjax()
    {

        $rapat =new RP;
        $rapat->start_tgl_rapat =date("Y-m-d H:i:s",strtotime(Input::get('start_tgl_rapat')));
        $rapat->end_tgl_rapat =date("Y-m-d H:i:s",strtotime(Input::get('end_tgl_rapat')));
        $rapat->id_ruangan =Input::get('id_ruangan');
        $rapat->agenda_rapat =Input::get('agenda_rapat');
        $rapat->pj_rapat =Input::get('pj_rapat');
        $rapat->save();

        $di_hadiri = Input::get('di_hadiri');
        $last_id = $rapat->id_rapat;
            foreach ($di_hadiri as $key => $value) {
            $schedule =new SC;
            $schedule ->id_rapat = $last_id;
            $schedule ->id_user = $value;
            $schedule->save();
            }
            $result['status'] =true;
        return Response::json($result);
    }
      public function deleteAjax($id)
    {

        print_r ($id);die;


    }
}
