<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Company\Company;
use App\Models\Api\Permission\Permission;
use App\Models\Api\Role\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class RoleController extends ApiController
{

    /**
     * The var implementation.
     *
     */
    protected $roleModel, $companyModel, $permissoinModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Role $roleModel ,Permission $permissoinModel ,Company $companyModel)
    {
        $this->roleModel        = $roleModel;
        $this->companyModel     = $companyModel;
        $this->permissoinModel  = $permissoinModel;
    }


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

        $response = [];

        if ($validator->fails()) {
            $response['message'] = $validator->errors();
            return $this->throwValidation($response);
        } else {
            $roleData  =  $this->roleModel->addRole($data);

            if($roleData) {
                $permissions = $data["permission"];
                $companyAccess = $data["companyAccess"];

                if (isset($permissions)) {
                    $per = $this->permissoinModel->savePermissions($permissions);
                    $roleData->allowTo($per);
                }
                if (isset($companyAccess)) {
                    $companies = $this->companyModel->saveCompanyAccess($companyAccess);
                    $roleData->allowCompany($companies);
                }

                $response['message'] = trans('api.messages.role.create');
                $response['data']    = $roleData;
                return $this->respond($response);
            }else{
                $response['message'] = trans('api.messages.role.failed');
                $response['data']    = $roleData;
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

        $response = [];

        if ($validator->fails()) {
            $response['message'] = $validator->errors();
            return $this->throwValidation($response);
        } else {
            $roleData  =  $this->roleModel->givePermission($data);

            if($roleData) {
                $permissions = $data["permission"];
                $companyAccess = $data["companyAccess"];

                if (isset($permissions)) {
                    $per = $this->permissoinModel->savePermissions($permissions);
                    $roleData->allowTo($per);
                }
                if (isset($companyAccess)) {
                    $companies = $this->companyModel->saveCompanyAccess($companyAccess);
                    $roleData->allowCompany($companies);
                }

                $response['message'] = trans('api.messages.role.update');
                $response['data']    = $roleData;
                return $this->respond($response);
            }else{
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
        $roleData = $this->roleModel->list($this->roleModel);
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
        $data = $this->roleModel->fetchPermissionById($id);

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
        $roleData  = $this->roleModel->deleteById($id);

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
