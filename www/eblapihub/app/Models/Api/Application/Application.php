<?php

namespace App\Models\Api\Application;

use App\Models\Api\Application\Traits\Relationship\EMTAppRelationship;
use App\Models\Api\Role\Role;
use App\Models\User\User;
use App\Services\RedisService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Laravel\Passport\HasApiTokens;

class Application extends Model
{
    use HasFactory, HasApiTokens, EMTAppRelationship;

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

    public function appsList($id)
    {

        $role = User::join("roles", 'roles.id', '=', 'users.role_id')->select('roles.role_name', 'roles.id')->where('users.id', $id)->get()->first();

        if ($role['role_name'] == 'administrator') {
            $data = Application::join('permenent_device', 'permenent_device.id', '=', 'applications.device_name')->select('applications.id', 'applications.app_name', 'permenent_device.device_name', 'applications.app_status')->get()->toArray();
        } else {

            $roleData = Role::find($role['id']);
            $roleData = $roleData->companies->map->devices->flatten()->pluck('company_id')->unique();

            $i = 0;
            $data = [];
            if (isset($roleData)) {
                foreach ($roleData as $id) {
                    $appData   = Application::join('permenent_device', 'permenent_device.id', '=', 'applications.device_name')->select('applications.id', 'applications.app_name', 'permenent_device.device_name', 'applications.app_status')->where('app_company_id', $id)->get()->first();
                    if (isset($appData)) {
                        $data[$i] = $appData;
                    }
                    $i++;
                }
            }
        }

        return $data;
    }

    public function getDataById($id)
    {
        if ($id) {
            $appModel = Application::join('companies', 'companies.id', '=', 'applications.app_company_id')->join('permenent_device', 'permenent_device.id', '=', 'applications.device_name')->select('applications.*', 'applications.device_name as device_id', 'companies.company_name', 'permenent_device.device_name')->where('applications.id', $id)->get()->first();
            $appModel['app_image'] = URL::to('/public/uploads/bmpImage/') . '/' . $appModel['app_image'];

            return $appModel;
        }
    }

    public function getAppById($id)
    {
        $appModel  = Application::where('applications.device_name', $id)->join('permenent_device', 'permenent_device.id', '=', 'applications.device_name')
            ->select('applications.id', 'applications.app_name', 'applications.app_status', 'applications.app_image', 'permenent_device.device_name', 'permenent_device.id')->get()->first();

        $appModel['app_image'] = URL::to('/public/uploads/bmpImage/') . '/' . $appModel['app_image'];

        return $appModel;
    }

    public function updateEMTApplication($data)
    {
        $appModel                   = Application::find($data['id']);

        $appModel->app_company_id   = $data['app_company_id'];
        $appModel->device_name      = $data['device_name'];
        $appModel->app_name         = $data['app_name'];

        if ($data['app_status'] == 'on') {
            $appModel->app_status = 1;
        } else {
            $appModel->app_status = 0;
        }

        if (isset($data['app_image'])) {

            if (is_file(public_path('uploads/bmpImage/') . $appModel->app_image)) {
                unlink(public_path('uploads/bmpImage/') . $appModel->app_image);
            }

            $appModel->app_image         = $data['app_image'];
        }

        if ($appModel->save()) {
            return $appModel;
        } else {
            return false;
        }
    }

    public function deleteEMTApplication($id)
    {

        $image = Application::find($id);

        if (is_file(public_path('uploads/bmpImage/') . $image->company_logo)) {
            unlink(public_path('uploads/bmpImage/') . $image->company_logo);
        }

        $deleteData = Application::where('id', $id)->delete();
        return $deleteData;
    }

    public function loadImage($data)
    {
        $appId = $data['id'];
        $deviceId = $data['deviceId'];

        $uniqueId = substr(mt_rand(), 0, 10);
        $key      = 'cp-event-' . $deviceId;
        $value    = 'cp-apps--emt--' . $deviceId . ';;load;;' . microtime(true) . ';;' . $uniqueId;
        $redis    = new RedisService();

        $res      = $redis->publishRedis($key, $value);

        // $response = $redis->subRedis('emt-app-res-' . $deviceId);
        $response = $redis->getRedis('emt-app-res-' . $deviceId);
        return $response;
    }

    public function processImage($data)
    {
        $appId = $data['id'];
        $deviceId = $data['deviceId'];

        $uniqueId = substr(mt_rand(), 0, 10);
        $key      = 'cp-event-' . $deviceId;
        $value    = 'cp-apps--emt--' . $deviceId . ';;process;;' . microtime(true) . ';;' . $uniqueId;
        $redis    = new RedisService();
        $res      = $redis->publishRedis($key, $value);

        $response = $redis->getRedis('emt-app-res-' . $deviceId);
        return $response;
        // return $res;
    }

    public function getMaxLine($data){
        $id = $data['id'];
        $deviceId = $data['deviceId'];

        $uniqueId = substr(mt_rand(), 0, 10);
        $key      = 'cp-event-' . $deviceId;
        $value    = 'cp-apps--emt--' . $deviceId . ';;max_line_number;;' . microtime(true) . ';;' . $uniqueId;
        $redis    = new RedisService();
        $res      = $redis->publishRedis($key, $value);

        $response = $redis->getRedis('emt-app-res-max-line-' . $deviceId);
        if($response){
            Application::where('id', $id)->update(['max_line' => $response]);
        }
        return $response;
    }

}
