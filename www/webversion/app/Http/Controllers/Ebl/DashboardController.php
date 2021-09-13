<?php

namespace App\Http\Controllers\Ebl;

use App\Http\Controllers\Controller;
use App\Models\ebl\DashboardModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DashboardController extends ApiController
{
    public function view(){
        return view('dashboard/dashboard');
    }

    public function info(){
        // $read = Helper::showBasedOnPermission(['permanent.read'],'OR');   

        // if(!$read){
            // return Redirect::back()->with('');
        // }else{
        if ( Session::has('token') ){ 
            $data = Session::get('token');

            $response = $this->getGuzzleRequest('GET','/dashboard/info',$data);
            $res = json_decode($response['data']);

            if( $response['status'] == 200 ){
                return view('dashboard/dashboard',['data'=>$res->data]);    
            }else{
                return view('dashboard/dashboard',['data'=>[]]);
            }
        }
    }
    // }
}
