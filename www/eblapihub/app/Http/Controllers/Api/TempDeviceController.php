<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\TempDeviceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TempDeviceController extends ApiController
{

    /**
    * The var implementation.
    *
    */
    protected $tempModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( TempDeviceModel $tempModel )
    {
        $this->tempModel        = $tempModel;
    }

    /**
     * Insert Temp Device
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function insertTempData(Request $request){
        
        $data = json_decode($request->getContent(),true);
        

        $tempModel = new TempDeviceModel();
        $tempData  =  $tempModel->insertTempDevice($data);

        // $tempData = new TempDeviceModel();

        // $tempData->company_name = $request->input('company_name');
        // $tempData->device_name = $request->input('device_name') . "_" . $request->input('serial_number');
        // $tempData->serial_number = $request->input('serial_number');

        // if($tempData->save()){
        //     $response['message'] = "Data Register Successfully";
        //     $response['data']    = $tempData;
        // }else{
        //     $response['message'] = "Not Registered";
        // }
        // return response()->json($response);

        if($tempData){
            $response['message'] = trans('api.messages.device.register');
            $response['data']    = $tempData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.device.failed');
            $response['data']    = $tempData;
            return $this->respond($response);
        }
    } 
    

    /**
     * check existing temp device
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkTempData(Request $request){

        $data       = $request->all();
        $tempDevice = new TempDeviceModel();
        $tempData   = $tempDevice->checkDevice($data);

        $response['message'] = $tempData;
        return $this->respond($response);

        // return response()->json($tempData);

        
    }
    /**
     * Show temp devices
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function listDevices(Request $request){
        
        $tempData   = $this->tempModel->list();
        $response = [];

        if(count($tempData) > 0 ){

            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $tempData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $tempData;
            return $this->respond($response);
        }
    }

    /**
     * fetch data for efit
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id){
        $tempData  = $this->tempModel->getDeviceById($id);
        
        if($tempData){
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $tempData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $tempData;
            return $this->respond($response);
        }
    }

    /**
     * Update temp data
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){

        $data = json_decode($request->getContent(),true);

        $validator = Validator::make($data,[
            'company_name'       => 'required',
            'device_name'        => 'required',
            'serial_number'      => 'required',
        ]);

        if($validator->fails()){
            $response['message'] = $validator->errors();
            return $this->throwValidation($response);
        } else{
            $tempData  =  $this->tempModel->updateTempDevice($data);
            $response = [];


            if(($tempData)){
                $response['message'] = trans('api.messages.device.update');
                $response['data']    = $tempData;
                return $this->respond($response);
            }else{
                $response['message'] = trans('api.messages.device.failed');
                $response['data']    = $tempData;
                return $this->respond($response);
            }
        }
    }

    /**
     * Delete temp data
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id){
        $tempData  = $this->tempModel->deleteById($id);

        if($tempData){
            $response['message'] = trans('api.messages.device.delete');
            $response['data']    = $tempData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.device.failed');
            $response['data']    = $tempData;
            return $this->respond($response);
        }
    }
}
