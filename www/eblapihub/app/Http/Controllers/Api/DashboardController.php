<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Permanent\PermanentModel;
use App\Models\Api\TempDeviceModel;
use App\Models\User\User;
class DashboardController extends ApiController
{
    /**
    * The var implementation.
    *
    */
    protected $userModel, $tempModel, $permanentModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( User $userModel, TempDeviceModel $tempModel, PermanentModel $permanentModel)
    {
        $this->userModel            = $userModel;
        $this->tempModel            = $tempModel;
        $this->permanentModel       = $permanentModel;
    }

    /**
     * Get user and devices count
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function info(){
        $data = [];
        $data['userCount'] = $this->userModel::count();
        $data['tempCount'] = $this->tempModel::count();
        $data['PermanentCount'] = $this->permanentModel::count();
        // $data['userCount'] = User::count();
        // $data['tempCount'] = TempDeviceModel::count();
        // $data['PermanentCount'] = PermanentModel::count();

        if(($data)){
            $response['message'] = trans('api.messages.login.success');
            $response['data']    = $data;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.login.failed');
            $response['data']    = $data;
            return $this->respond($response);
        }
    }
}