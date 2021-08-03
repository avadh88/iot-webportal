<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends ApiController
{
    /**
     * Verify User Detail For Login
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request){

        // $ehealth_code = $request->headers->get('x-client-code');
        $data = json_decode($request->getContent(),true);

        $validator = FacadesValidator::make($data,[
            'username'   => 'required',
            'password'   => 'required',
        ]);
        
        if($validator->fails()){
            return response([
                'message' => trans('api.messages.login.failed')
            ], 404);
        } else
        {
            $userModel = new User();
            $userData  = $userModel->verify($data);
          
            if($userData){

                if(Hash::check($data['password'],$userData->password)){
                    
                    $datas['user_role'] = $userData->role;
                    $datas['user_permission'] = $userModel->getPermissionById($userData->id);

                    // $role = Role::firstOrCreate(['role_name'=>'administartor']);
                    // $permission = Permission::firstOrCreate(['permission_name'=>'create']);
                    // $role->allowTo($permission);
                    // $roleuser = User::find(1);

                    // $roleuser->assignRoles($role);
                    // $roleuser->permission();

                    $response             = [];
                    $response['token']    = $userData->createToken('authToken')->accessToken;
                    $response['message']  = trans('api.messages.login.success');
                    $response['data']     = $datas;
                    return $this->respond($response);

                }else{
                    
                    $response['message'] = trans('api.messages.login.failed');
                    return $this->respondUnauthorized($response);
                        
                }
            }else{

                $response['message'] = trans('api.messages.login.failed');
                return $this->respondUnauthorized($response);
            }
        }
    }

    public function logout(Request $request){
        
            $token =  $request->user()->token();
            $token->revoke();
            $response = ['message' => 'You have been successfully logged out!'];
            return response($token, 200);
    }

    /**
     * List All Users
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request){

        $data = json_decode($request->getContent(),true);

        $userModel = new User();
        $userData  =  $userModel->userList();
        $response = [];

        if(count($userData) > 0){
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $userData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $userData;
            return $this->respond($response);
        }
        

    }

    /**
     * Insert User Data
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request){

        $data = json_decode($request->getContent(),true);

        $validator = FacadesValidator::make($data,[
            'username'          => 'required',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required',
            'phone_number'      => 'required',
            'role'              => 'required',
            'password'          => 'required',
            'repeat_password'   => 'required',
            // 'remember_token'    => 'required',
        ]);
        


        if($validator->fails()){
            $response['message'] = trans('api.messages.user.failed');
            return $this->respondUnauthorized($response);
        } else{
        
            $userModel = new User();
            $userData  =  $userModel->addUser($data);
            $response = [];


            if(($userData)){
                $response['message'] = trans('api.messages.user.create');
                $response['data']    = $userData;
                return $this->respond($response);
            }else{
                $response['message'] = trans('api.messages.user.failed');
                $response['data']    = $userData;
                return $this->respond($response);
            }
        }

    }


    /**
     * Delete User Data
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

        $userModel = new User();
        $userData  = $userModel->deleteById($id);

        if($userData){
            $response['message'] = trans('api.messages.user.delete');
            $response['data']    = $userData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.user.failed');
            $response['data']    = $userData;
            return $this->respond($response);
        }
  
    }

    /**
     * Fetch Data For Edit
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id){

        $userModel = new User();
        $userData  = $userModel->getUserById($id);
        
        if($userData){
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $userData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $userData;
            return $this->respond($response);
        }
    }   

    /**
     * Update User Data
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){


        $data = json_decode($request->getContent(),true);

        $validator = FacadesValidator::make($data,[
            'username'          => 'required',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required',
            'phone_number'      => 'required',
            'role'              => 'required',
            // 'remember_token'    => 'required',
        ]);
        


        if($validator->fails()){
            $response['message'] = trans('api.messages.user.failed');
            return $this->respondUnauthorized($response);
        } else{
        
            $userModel = new User();
            $userData  =  $userModel->updateUser($data);
            $response = [];


            if(($userData)){
                $response['message'] = trans('api.messages.user.update');
                $response['data']    = $userData;
                return $this->respond($response);
            }else{
                $response['message'] = trans('api.messages.user.failed');
                $response['data']    = $userData;
                return $this->respond($response);
            }
        }

    }
}