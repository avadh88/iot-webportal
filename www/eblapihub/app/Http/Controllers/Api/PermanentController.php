<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\PermanentModel;
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
    public function list(Request $request)
    {

        $permanentDevice = new PermanentModel();
        $permanentData   = $permanentDevice->list($permanentDevice);
        $response = [];

        if (count($permanentData) > 0) {

            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $permanentData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $permanentData;
            return $this->respond($response);
        }
    }

    /**
     * Delete permanent device
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $deviceModel = new PermanentModel();
        $deviceData  = $deviceModel->deleteById($id);

        if ($deviceData) {
            $response['message'] = trans('api.messages.device.delete');
            $response['data']    = $deviceData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.device.failed');
            $response['data']    = $deviceData;
            return $this->respond($response);
        }
    }

    /**
     * Fetch Data for edit
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        $deviceModel = new PermanentModel();
        $deviceData  = $deviceModel->getDeviceById($id);

        if ($deviceData) {
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $deviceData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $deviceData;
            return $this->respond($response);
        }
    }

    /**
     * Update permanent device data
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {


        $data = json_decode($request->getContent(), true);

        $validator = Validator::make($data, [
            'company_id'         => 'required',
            'device_name'        => 'required',
            'serial_number'      => 'required',
        ]);


        if ($validator->fails()) {
            $response['message'] = trans('api.messages.device.failed');
            return $this->respondUnauthorized($response);
        } else {

            $permanentModel = new PermanentModel();
            $permanentData  =  $permanentModel->updateDevice($data);
            $response = [];

            if (($permanentData)) {
                $response['message'] = trans('api.messages.device.update');
                $response['data']    = $permanentData;
                return $this->respond($response);
            } else {
                $response['message'] = trans('api.messages.device.failed');
                $response['data']    = $permanentData;
                return $this->respond($response);
            }
        }
    }

    /**
     * Add device to permenent database
     *
     * @param Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        $permanentModel = new PermanentModel();
        $permanentData = $permanentModel->addToPermanent($data);

        if ($permanentData) {
            // event( new DeviceCompanyAddEvent($permanentData->company_email) );
            $response['message'] = trans('api.messages.common.success');
            $response['data']    = $permanentData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.common.failed');
            $response['data']    = $permanentData;
            return $this->respond($response);
        }
    }


    /**
     * Get and save device status to db
     *
     * @return void
     */
    public function status(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        $permanentModel = new PermanentModel();
        $permanentModel = $permanentModel->updateDeviceStatus($data);


        $response['data']    = $permanentModel;
        return $this->respond($permanentModel);
    }


    public function retry(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        $permanentModel = new PermanentModel();
        $permanentModel = $permanentModel->retryRedis($data);


        $response['data']    = $permanentModel;
        return $this->respond($response);
    }

    public function statusData()
    {
        $permanentModel = new PermanentModel();
        $permanentModel = $permanentModel->statusData();

        $response['data']    = $permanentModel;
        return $this->respond($response);
    }

    public function deviceList(Request $request)
    {
        $data = json_decode($request->getContent(), true);



        $permanentModel = new PermanentModel();
        $permanentModel = $permanentModel->deviceData($data);

        $response['data']    = $permanentModel;
        return $this->respond($response);
    }
}
