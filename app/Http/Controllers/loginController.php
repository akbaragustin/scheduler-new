<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class loginController extends Controller
{

    private $parser = array();

    public function login()
    {

       return view('login');
    }
   public function loginCheck()
    {

     $check = US::where('username',Input::get('username'))
                 ->where('password', md5(Input::get('password')))->get();
        $alldataAuth = !empty($check->toArray()[0]) ? $check->toArray()[0] :'' ;
        if (empty($alldataAuth)) {
            \Session::flash('messageError', 'Login Gagal');
            return redirect('/login');
        }
        unset($alldataAuth['password']);
        \Session::put('auth',$alldataAuth);
        return redirect('/admin/booking_internal');
    }
   public function logout()
    {
        \Session::forget('auth');
        return redirect('/login');

    }


}
