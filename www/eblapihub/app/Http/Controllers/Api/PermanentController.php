<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\PermanentModel;
use App\Models\Api\TempDeviceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermanentController extends ApiController
{
    
    /**
     * Show Permanent devices
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request){
        
        $permanentDevice = new PermanentModel();
        $permanentData   = $permanentDevice->list($permanentDevice);
        $response = [];

        if(count($permanentData) > 0 ){

            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $permanentData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $permanentData;
            return $this->respond($response);
        }
    }


    public function delete($id){
        $deviceModel = new PermanentModel();
        $deviceData  = $deviceModel->deleteById($id);

        if($deviceData){
            $response['message'] = trans('api.messages.device.delete');
            $response['data']    = $deviceData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.device.failed');
            $response['data']    = $deviceData;
            return $this->respond($response);
        }
    }

    public function edit($id){
        $deviceModel = new PermanentModel();
        $deviceData  = $deviceModel->getDeviceById($id);
        
        if($deviceData){
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $deviceData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $deviceData;
            return $this->respond($response);
        }
    }

    public function update(Request $request){


        $data = json_decode($request->getContent(),true);

        $validator = Validator::make($data,[
            'company_name'       => 'required',
            'device_name'        => 'required',
            'serial_number'      => 'required',
        ]);
        


        if($validator->fails()){
            $response['message'] = trans('api.messages.device.failed');
            return $this->respondUnauthorized($response);
        } else{
        
            $permanentModel = new PermanentModel();
            $permanentData  =  $permanentModel->updateDevice($data);
            $response = [];


            if(($permanentData)){
                $response['message'] = trans('api.messages.device.update');
                $response['data']    = $permanentData;
                return $this->respond($response);
            }else{
                $response['message'] = trans('api.messages.device.failed');
                $response['data']    = $permanentData;
                return $this->respond($response);
            }
        }

    }
}
