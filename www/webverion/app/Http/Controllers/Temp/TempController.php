<?php

namespace App\Http\Controllers\Temp;

use App\Helpers\Helper;
use App\Http\Controllers\Ebl\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TempController extends ApiController
{


    public function list(){

        $read = Helper::showBasedOnPermission('temporary.read');   

        if(!$read){
            return Redirect::back()->with('');
        }else{
            if ( Session::has('token') ){ 
                $data = Session::get('token');

                $response = $this->getGuzzleRequest('GET','/list/devices',$data);
                $res = json_decode($response['data']);

                if( $response['status'] == 200 ){
                    return view('temporary/list',['temps'=>$res->data]);    
                }else{
                    return view('temporary/list',['temps'=>[]]);
                }
            }
        }
    }

    public function insertData(Request $request,$id){

        $add = Helper::showBasedOnPermission('permenent.add');   

        if(!$add){
            return Redirect::back()->with('');
        }else{
        if ( Session::has('token') ){ 
            $data = Session::get('token');
        }
        $response = $this->getGuzzleRequest('GET','/list/add/'.$id,$data);
        $res      = json_decode($response['data']);

        if($response['status'] == 200){
            Session::flash('message', $res->message); 
            Session::flash('alert-class', 'alert-success');
            return redirect('/temporary/list');
        }}
    }
    
    public function edit($id){

        $edit = Helper::showBasedOnPermission('temporary.update');   

        if(!$edit){
            return Redirect::back()->with('');
        }else{
            if (Session::has('token')){
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET','/temporary/edit/'.$id,$data);
                $res      = json_decode($response['data']);
            

                if($response['status'] == 200){    
                    
                    // Session::flash('message', $res->message); 
                    Session::flash('alert-class', 'alert-success');
                    return view('temporary/edit',['data'=>$res->data]);

                }else if($response['status'] == 401){
                    
                    Session::flash('message', $res->error->message->message); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('/temporary/edit')->with('error',$res->error->message->message);
                }
            }
        } 
    }

    public function update(Request $request){
        $update = Helper::showBasedOnPermission('temporary.update');   

        if(!$update){
            return Redirect::back()->with('');
        }else{
            if (Session::has('token')){
                $data['token']           = Session::get('token');
                $data['id']              = $request->id;
                $data['company_name']    = $request->company_name;
                $data['device_name']     = $request->device_name;
                $data['serial_number']   = $request->serial_number;
                
                $response = $this->getGuzzleRequest('post','/temporary/update',$data);
                $res = json_decode($response['data']);

                if($response['status'] == 200){    
                    
                    Session::flash('message', $res->message); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect('/temporary/list')->with('success',$res->message);

                }else if($response['status'] == 401){
                    
                    Session::flash('message', $res->error->message->message); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('/temporary/edit')->with('error',$res->error->message->message);
                }
            }
        }
    }

    public function delete($id){
        $delete = Helper::showBasedOnPermission('temporary.delete');   

        if(!$delete){
            return Redirect::back()->with('');
        }else{
            if ( Session::has('token') ){ 
                
                $data = Session::get('token');

                $response = $this->getGuzzleRequest('GET','/temporary/delete/'.$id,$data);
                $res = json_decode($response['data']);

                if( $response['status'] == 200 ){

                    Session::flash('message', $res->message); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect('/temporary/list');    
                
                }else if( $response['status'] == 401 ){
                    return view('/temporary/list',['temps'=>[]]);
                }
            }
        }
    }
}
