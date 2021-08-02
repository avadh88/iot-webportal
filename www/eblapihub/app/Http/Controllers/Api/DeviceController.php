<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\PermanentModel;
use Illuminate\Http\Request;

class DeviceController extends ApiController
{
    /**
     * Add device to permenent database
     *
     * @param Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function addDevice(Request $request,$id){
        
        $data = json_decode($request->getContent(),true);

        $permanentModel = new PermanentModel();
        $permanentData = $permanentModel->fetchSingleData($id);

        // return $this->respond($data);
      
        if($permanentData){
            $response['message'] = trans('api.messages.common.success');
            $response['data']    = $permanentData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.common.failed');
            $response['data']    = $permanentData;
            return $this->respond($response);
        }
    }
}
