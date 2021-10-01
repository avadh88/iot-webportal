<?php

namespace App\Models\Api;

use App\Events\DeviceCompanyAddEvent;
use App\Events\DeviceCompanyEditEvent;
use App\Services\RedisService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class PermanentModel extends Model
{
    use HasApiTokens, HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'permenent_device';
    protected $primaryKey = 'id';
    protected $fillable   = ['company_id', 'device_name', 'serial_number', 'temp_device_id', 'status', 'retry'];

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function fetchSingleData($id)
    {
        $tempDevices = TempDeviceModel::find($id);

        $results = PermanentModel::where('company_id', $tempDevices->company_id)
            ->where('device_name', $tempDevices->device_name)
            ->where('serial_number', $tempDevices->serial_number)->exists();

        if ($results) {
            $response['message'] = trans('api.messages.common.data_exists');
        } else {

            $data                = new PermanentModel();

            $data->company_id  = $tempDevices->company_id;
            $data->device_name   = $tempDevices->device_name;
            $data->serial_number = $tempDevices->serial_number;

            if ($data->save()) {
                TempDeviceModel::where('id', $id)
                    ->update(['temp_device_id' => 1]);
                $response['message'] = trans('api.messages.device.success');
            } else {
                $response['message'] = trans('api.messages.device.failed');
            }
        }
        return $response;
    }

    public function list($data)
    {

        if ($data) {
            $permanentDevices = PermanentModel::join('companies', 'companies.id', '=', 'permenent_device.company_id')
                ->get(['permenent_device.id', 'permenent_device.device_name', 'permenent_device.serial_number', 'permenent_device.status', 'permenent_device.temp_device_id', 'permenent_device.retry', 'companies.company_name']);


            // $permanentDevices = PermanentModel::select('id','company_id','device_name','serial_number')->get();
            return $permanentDevices;
        }
    }

    public function deleteById($id)
    {
        if (!empty($id)) {
            $deleteData = PermanentModel::where('id', $id)->delete();
            return $deleteData;
        }
    }

    public function getDeviceById($id)
    {
        if (!empty($id)) {

            $permanentModel = PermanentModel::select('id', 'company_id', 'device_name', 'serial_number')->where('id', $id)->first();
            return $permanentModel;
        }
    }

    public function updateDevice($data)
    {

        $permenantModel                   = PermanentModel::find($data['id']);

        $oldCompanyId                     = $permenantModel->company_id;
        $permenantModel->company_id       = $data['company_id'];
        $permenantModel->device_name      = $data['device_name'];
        $permenantModel->serial_number    = $data['serial_number'];

        if ($permenantModel->save()) {

            if ($oldCompanyId != $permenantModel->company_id) {
                $datas = Company::where('id', $data['company_id'])->get('company_email')->first();
                event(new DeviceCompanyAddEvent($datas->company_email));
            }
            return $permenantModel;
        } else {
            return false;
        }
    }

    public function addToPermanent($data)
    {

        $tempModel                   = TempDeviceModel::find($data['id']);

        $results = PermanentModel::where('company_id', $data['company_id'])
            ->where('device_name', $data['device_name'])
            ->where('serial_number', $data['serial_number'])
            ->where('temp_device_id', $tempModel->temp_device_id)->exists();

        if ($results) {
            $response['message'] = trans('api.messages.common.data_exists');
            return $response;
        } else {
            $permenantModel                   = new PermanentModel();

            $permenantModel->company_id       = $data['company_id'];
            $permenantModel->device_name      = $data['device_name'];
            $permenantModel->serial_number    = $data['serial_number'];
            $permenantModel->temp_device_id   = $tempModel->temp_device_id;

            if ($permenantModel->save()) {
                TempDeviceModel::where('id', $data['id'])
                ->update(['status' => 1]);
                $lastInsertedId = $permenantModel->id;
                $publishTempId  = new RedisService();
                $uniqqueId      = substr(mt_rand(), 0, 10);
                $key            = 'cp-temp-to-per-' . $tempModel->temp_device_id;
                $value          = 'cp-device-register-per-' . $tempModel->temp_device_id . ";;" . $lastInsertedId . ";;" . microtime(true) . ";;" . $uniqqueId;

                $publishTempId->publishRedis($key, $value);
                $retry = $publishTempId->waitingForResponse($key, $lastInsertedId);

                if ($retry) {
                    PermanentModel::where('id', $lastInsertedId)->update(['retry' => 1]);
                } else {
                    PermanentModel::where('id', $lastInsertedId)->update(['retry' => 0]);
                }

                return $retry;
                TempDeviceModel::where('id', $data['id'])->update(['status' => 1]);
                $datas = Company::where('id', $data['company_id'])->get('company_email')->first();
                return $datas;
            } else {
                return false;
            }
        }
    }

    public function updateDeviceStatus($data)
    {
        $response = [];

        if (isset($data['statusData']['msg'])) {
            PermanentModel::where('id', $data['statusData']['uid'])->update(['status' => 'online']);
            return PermanentModel::where('id', $data['statusData']['uid'])->get('status')->first();
        } else {


            PermanentModel::where('id', $data['statusData']['uid'])->update(['status' => 'offline']);
            $response['uid'] = $data['statusData']['uid'];
            $response['msg'] = PermanentModel::where('id', $data['statusData']['uid'])->pluck('status')->first();
            $response['time'] = time();
            // return PermanentModel::where('id',$data['statusData']['uid'])->get('status')->first();    
            return $response;
        }
    }

    public function retryRedis($data)
    {
        $temp_device_id = PermanentModel::where('id', $data['id'])->pluck('temp_device_id')->first();

        $publishTempId  = new RedisService();
        $uniqqueId      = substr(mt_rand(), 0, 10);
        $key            = 'cp-temp-to-per-' . $temp_device_id;
        $value          = 'cp-device-register-per-' . $temp_device_id . ";;" . $data['id'] . ";;" . microtime(true) . ";;" . $uniqqueId;

        $publishTempId->publishRedis($key, $value);
        $retry = $publishTempId->waitingForResponse($key, $data['id']);

        if ($retry) {
            PermanentModel::where('id', $data['id'])->update(['retry' => 1]);
        } else {
            PermanentModel::where('id', $data['id'])->update(['retry' => 0]);
        }
    }

    public function statusData()
    {
        $statusData = PermanentModel::get(['id', 'status']);
        return $statusData;
    }

    public function deviceData($data)
    {
        $deviceData = PermanentModel::where('company_id',$data['id'])->get(['id','device_name']);
        return $deviceData;
    }
}
