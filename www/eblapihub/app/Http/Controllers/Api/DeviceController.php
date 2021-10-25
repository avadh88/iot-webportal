<?php

namespace App\Http\Controllers\Api;

use App\Events\DeviceCompanyAddEvent;
use App\Events\DeviceEvent;
use App\Http\Controllers\Controller;
use App\Mail\DeviceRegistered;
use App\Models\Api\Permanent\PermanentModel;

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
    public function addDevice(Request $request)
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
}
