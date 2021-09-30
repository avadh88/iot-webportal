<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ApplicationController extends ApiController
{

    public function add(Request $request)
    {

        if ($request->hasFile('app_image')) {
            $datas = json_decode($request->form_data, true);
        } else {
            $datas = json_decode($request->getContent(), true);
        }


        $validator = Validator::make($datas, [
            'app_company_id'    => 'required',
            'device_name'       => 'required|unique:applications',
            'app_name'          => 'required',
        ]);

        if ($validator->fails()) {

            $response = $validator->errors();
            return $this->throwValidation($response);
        } else {

            if ($request->hasFile('app_image')) {

                // $thumbnailImage = Image::make($request->file('app_image')->getRealPath())->resize(50, 50);
                // $data['app_image']       = $thumbnailImage;
                $newImageName = time() . '.' . $datas['app_name'] . '.' . $request->app_image->extension();

                $request->app_image->move(public_path('uploads/bmpImage/'), $newImageName);
                $data['app_image']    = $newImageName;
            }

            $data['app_company_id']    = $datas['app_company_id'];
            $data['device_name']       = $datas['device_name'];
            $data['app_name']          = $datas['app_name'];
            $data['app_status']        = $datas['app_status'];


            $appModel = new Application();
            $appModel  =  $appModel->addApplication($data);
            $response = [];


            if (($appModel)) {
                $response['message'] = trans('api.messages.common.success');
                $response['data']    = $appModel;
                return $this->respond($response);
            } else {
                $response['message'] = trans('api.messages.common.failed');
                $response['data']    = $appModel;
                return $this->respond($response);
            }
        }
    }

    public function list(){
        $appModel = new Application();
        $appData  =  $appModel->appsList();

        $response = [];


        if (count($appData) > 0) {
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $appData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $appData;
            return $this->respond($response);
        }
    }

    public function sendDataToDevice($id)
    {
        $appModel  = new Application();
        $appModel  =  $appModel->getAppById($id);


        if( !empty($appModel) ){
            $response['data']    = $appModel;
        }else{
            $response['data']    = trans('api.messages.application.nodata');;
        }
        return $this->respond($response);
    }
}
