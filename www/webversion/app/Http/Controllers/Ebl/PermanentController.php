<?php

namespace App\Http\Controllers\Ebl;

use App\Helpers\Helper;
use App\Http\Controllers\Ebl\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PermanentController extends ApiController
{
    /**
     * View Permanent Device List
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function view(){

        $read = Helper::showBasedOnPermission(['permanent.read'],'OR');   

        if(!$read){
            return Redirect::back()->with('');
        }else{
        if ( Session::has('token') ){ 
            $data = Session::get('token');

            $response = $this->getGuzzleRequest('GET','/permanent/list',$data);
            $res = json_decode($response['data']);

            if( $response['status'] == 200 ){
                return view('permanent/list',['permanents'=>$res->data]);    
            }else{
                return view('permanent/list',['permanents'=>[]]);
            }
        }
    }
    }

    /**
     * Delete Device
     *
     * @param int $id
     * @return Illuminate\Http\RedirectResponse
     */
    public function delete($id){
        $delete = Helper::showBasedOnPermission(['permanent.delete'],'OR');   

        if(!$delete){
            return Redirect::back()->with('');
        }else{
            if ( Session::has('token') ){ 
                
                $data = Session::get('token');

                $response = $this->getGuzzleRequest('GET','/permanent/delete/'.$id,$data);
                $res = json_decode($response['data']);

                if( $response['status'] == 200 ){

                    Session::flash('message', $res->message); 
                    Session::flash('alert-class', 'success');
                    return redirect('/permanent/list');    
                
                }else if( $response['status'] == 401 ){

                    Session::flash('message', $res->message); 
                    Session::flash('alert-class', 'error');
                    return view('/permanent/list',['permanents'=>[]]);
                }
            }
        }
    }


    /**
     * Fetch Data For Edit Device
     *
     * @param int $id
     * @return Illuminate\Http\RedirectResponse
     */
    public function edit($id){

        $edit = Helper::showBasedOnPermission(['permanent.update'],'OR');   

        if(!$edit){
            return Redirect::back()->with('');
        }else{
        if (Session::has('token')){
            $data     = Session::get('token');

            $response = $this->getGuzzleRequest('GET','/company/compnaylist',$data);
            $compnies      = json_decode($response['data']);

            $response = $this->getGuzzleRequest('GET','/permanent/edit/'.$id,$data);
            $res      = json_decode($response['data']);
        

            if($response['status'] == 200){    
                
                // Session::flash('message', $res->message); 
                Session::flash('alert-class', 'success');
                return view('permanent/edit',['data'=>$res->data,'compnies'=>$compnies->data]);

            }else if($response['status'] == 401){
                
                Session::flash('message', $res->error->message->message); 
                Session::flash('alert-class', 'error');
                return redirect('/temporary/edit')->with('error',$res->error->message->message);
            }
        }}
    }

    /**
     * Send Request for update device data
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){

        $update = Helper::showBasedOnPermission(['permanent.update'],'OR');   

        if(!$update){
            return Redirect::back()->with('');
        }else{
            if (Session::has('token')){
                $data['token']           = Session::get('token');
                $data['id']              = $request->id;
                $data['company_id']      = $request->company_id;
                $data['device_name']     = $request->device_name;
                $data['serial_number']   = $request->serial_number;
                
                $response = $this->getGuzzleRequest('post','/permanent/update',$data);
                $res = json_decode($response['data']);

                if($response['status'] == 200){    
                    
                    Session::flash('message', $res->message); 
                    Session::flash('alert-class', 'success');
                    return redirect('/permanent/list')->with('success',$res->message);

                }else if($response['status'] == 401){
                    
                    Session::flash('message', $res->error->message->message); 
                    Session::flash('alert-class', 'error');
                    return redirect('/permanent/edit')->with('error',$res->error->message->message);
                }
            }
        }  
    }
    /**
     * Use for redis
     *
     * @param Request $request
     * 
     * @return void
     */
    public function retry(Request $request){

        $data['token']           = Session::get('token');
        $data['id']              = $request->id;

        $response = $this->getGuzzleRequest('post','/permanent/retry',$data);
        $res = json_decode($response['data']);

        if($response['status'] == 200){    
            return redirect('/permanent/list');
        }else if($response['status'] == 401){
        }
    }
}
