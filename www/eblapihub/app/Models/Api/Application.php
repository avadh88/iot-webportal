<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Laravel\Passport\HasApiTokens;

class Application extends Model
{
    use HasFactory, HasApiTokens;

    public function addApplication($data)
    {
        $appModel  = new Application();

        $appModel->app_company_id   = $data['app_company_id'];
        $appModel->device_name      = $data['device_name'];
        $appModel->app_name         = $data['app_name'];

        if ($data['app_status'] == 'on') {
            $appModel->app_status = 1;
        } else {
            $appModel->app_status = 0;
        }

        if (isset($data['app_image'])) {
            $appModel->app_image         = $data['app_image'];
        }

        if ($appModel->save()) {
            return $appModel;
        } else {
            return false;
        }
    }

    public function appsList()
    {
        $data = Application::join('permenent_device', 'permenent_device.id', '=', 'applications.device_name')->select('applications.id', 'applications.app_name', 'permenent_device.device_name', 'applications.app_status')->get()->toArray();

        return $data;
    }

    public function getDataById($id){

        // $data = Application::join()
    }

    public function getAppById($id)
    {
        $appModel  = Application::where('applications.device_name', $id)->join('permenent_device', 'permenent_device.id', '=', 'applications.device_name')
            ->select('applications.id', 'applications.app_name', 'applications.app_status', 'applications.app_image', 'permenent_device.device_name', 'permenent_device.id')->get();


        $list = [];
        $i    = 1;

        foreach ($appModel as $key) {
            $key['app_image'] = URL::to('/public/uploads/bmpImage/') . '/' . $key['app_image'];
            $list[$i] = $key;
            $i++;
        }

        return $list;
    }
}
