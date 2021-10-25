<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Permission\Permission;
use App\Models\Api\Role\Role;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class RoleController extends ApiController
{
    //

    /**
     * Add new role
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $validator = FacadesValidator::make($data, [
            'role_name'          => 'required|unique:roles',
        ]);


        if ($validator->fails()) {
            $response['message'] = $validator->errors();
            return $this->throwValidation($response);
        } else {

            $userModel = new Role();
            $userData  =  $userModel->addRole($data);
            $response = [];

            if ($userData) {
                $response['message'] = trans('api.messages.role.create');
                $response['data']    = $userData;
                return $this->respond($response);
            } else {
                $response['message'] = trans('api.messages.role.failed');
                $response['data']    = $userData;
                return $this->respond($response);
            }
        }
    }

    /**
     * Update user permission
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        $data      = json_decode($request->getContent(), true);
        $id        = $data['id'];

        $validator = FacadesValidator::make($data, [
            'role_name'          => 'required|unique:roles,role_name,' . $id,
        ]);

        if ($validator->fails()) {
            $response['message'] = $validator->errors();
            return $this->throwValidation($response);
        } else {

            $roleModel = new Role();
            $roleData = $roleModel->givePermission($data);


            if ($roleData) {
                $response['message'] = trans('api.messages.role.update');
                $response['data']    = $roleData;
                return $this->respond($response);
            } else {
                $response['message'] = trans('api.messages.role.failed');
                $response['data']    = $roleData;
                return $this->respond($response);
            }
        }
    }

    /**
     * View all Role
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request)
    {

        $roleModel = new Role();
        $roleData = $roleModel->list($roleModel);
        $response  = [];

        if (count($roleData) > 0) {

            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $roleData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $roleData;
            return $this->respond($response);
        }
    }


    /**
     * Fetch data for edit
     *
     * @param Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {

        $data = json_decode($request->getContent(), true);

        $roleModel = new Role();
        $data = $roleModel->fetchPermissionById($id);

        if ($data) {
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $data;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = [];
            return $this->respond($response);
        }
    }

    /**
     * Delete Role
     *
     * @param Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id)
    {

        $roleModel = new Role();
        $roleData  = $roleModel->deleteById($id);

        if ($roleData) {
            $response['message'] = trans('api.messages.role.delete');
            $response['data']    = $roleData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.role.failed');
            $response['data']    = $roleData;
            return $this->respond($response);
        }
    }
}
