<?php

namespace App\Http\Controllers\Ebl;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RoleController extends ApiController
{
    /**
     * Show role form
     *
     * @return void
     */
    public function new(){
        $add = Helper::showBasedOnPermission('role.create');   

        if(!$add){
            return Redirect::back()->with('');
        }else{
            return view('roles/new');
        }
    }

    /**
     * Send Request for Add new role 
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function add(Request $request){
        $add = Helper::showBasedOnPermission('role.create');   

        if(!$add){
            return Redirect::back()->with('');
        }else{
            if ( Session::has('token') ){ 
                $data['token']     = Session::get('token');
                $data['role_name'] = $request->role_name;
                $data['permission'] = $request->permission;

                $response          = $this->getGuzzleRequest('post','/roles/add',$data);
                $res               = json_decode($response['data']);

                if($response['status'] == 200){

                    Session::flash('message', $res->message); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect('/roles/list')->with('success',$res->message); 
                
                }else if($response['status'] == 401){
                    
                    Session::flash('message', $res->error->message->message); 
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('/roles/new')->with('error',$res->error->message->message);
                
                }
            }
        }
    }

    public function create(Request $request){
        $data     = $request->all();

        $response = $this->getGuzzleRequest('POST','/roles/create',$data);
        $res      = json_decode($response['data']);
        
    }

    /**
     * Send request for role list
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function view(){

        $read = Helper::showBasedOnPermission('role.read');   

        if(!$read){
            return Redirect::back()->with('');
        }else{
            if ( Session::has('token') ){ 
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET','/roles/view',$data);
                $res      = json_decode($response['data']);
                
                if( $response['status'] == 200 ){
                    
                    // View [list] not found.
                    return view('/roles/roles_table',['roles'=>$res->data]);    
                }else if( $response['status'] == 401 ){
                    
                    return Redirect::back()->with('error',$res->error->message->message);
                }
            }
        }
    }

    /**
     * Send request for fetch role permission data for edit
     *
     * @param Request $request
     * @param int $id
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request,$id){
        $edit = Helper::showBasedOnPermission('role.update');   

        if(!$edit){
            return Redirect::back()->with('');
        }else{
            if ( Session::has('token') ){ 
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET','/roles/edit/'.$id,$data);
                $res      = json_decode($response['data']);

                if( $response['status'] == 200 ){

                    if( isset($res->data->permission)){
                        return view('roles/edit_roles',['permissions'=> ( array )$res->data->permission,'role'=>$res->data->role]);    
                    }else{
                        return view('roles/edit_roles',['permissions'=> [],'role'=>$res->data->role]);    
                    }

                }else if( $response['status'] == 401 ){
                    return Redirect::back()->with('error',$res->error->message->message);
                }
            }
        }
    }


    /**
     * Send request to update role permission
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        $update = Helper::showBasedOnPermission('role.update');   

        if(!$update){
            return Redirect::back()->with('');
        }else{
            if ( Session::has('token') ){ 
                $data['token'] = Session::get('token');
                $data['data']  = $request->all();

                $response      = $this->getGuzzleRequest('POST','/roles/update',$data);
                $res           = json_decode($response['data']);
                
                return redirect('roles/list');    
            }
        }
    }

    /**
     * Send Request to delete Role
     *
     * @param Request $request
     * @param int $id
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request,$id){
        $delete = Helper::showBasedOnPermission('role.delete');   

        if(!$delete){
            return Redirect::back()->with('');
        }else{    
            if ( Session::has('token') ){ 
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET','/roles/delete/'.$id,$data);
                $res      = json_decode($response['data']);
                

                if( $response['status'] == 200 ){

                    Session::flash('message', $res->message); 
                    Session::flash('alert-class', 'alert-success');
                    return redirect('/roles/list');    
                
                }else if( $response['status'] == 401 ){
                    return view('/roles/list',['users'=>[]]);
                }
            }
        }
    }
}
