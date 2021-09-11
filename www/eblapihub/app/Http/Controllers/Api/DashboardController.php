<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\DashboardModel;
use App\Models\Api\PermanentModel;
use App\Models\Api\TempDeviceModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends ApiController
{
    /**
     * dashboard info
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function info(){
        $data = [];
        $data['userCount'] = User::count();
        $data['tempCount'] = TempDeviceModel::count();
        $data['PermanentCount'] = PermanentModel::count();

        if(($data)){
            $response['message'] = trans('api.messages.common.success');
            $response['data']    = $data;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.common.failed');
            $response['data']    = $data;
            return $this->respond($response);
        }
    }
}