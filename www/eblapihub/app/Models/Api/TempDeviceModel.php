<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Laravel\Passport\HasApiTokens;

class TempDeviceModel extends Model
{
    use HasFactory, HasApiTokens;

    protected $connection = 'mysql2';
    protected $table = 'temp_devices';
    protected $fillable = ['company_id', 'device_name', 'serial_number', 'temp_device_id'];

    public function list()
    {
        $tempDevices = TempDeviceModel::select('id', 'company_name', 'device_name', 'serial_number', 'status')->get()->toArray();
        return $tempDevices;
    }

    public function insertTempDevice($data)
    {
        $tempModel                   = TempDeviceModel::find($data['id']);

        $tempModel->company_name = $data['company_name'];
        $tempModel->device_name = $data['device_name'] . "_" . $data['serial_number'];
        $tempModel->serial_number = $data['serial_number'];

        if ($tempModel->save()) {
            return $tempModel;
        } else {
            return false;
        }
    }

    public function checkDevice($datas)
    {

        $results = TempDeviceModel::where('company_name', $datas['company_name'])
            ->where('device_name', $datas['device_name'])
            ->where('serial_number', $datas['serial_number'])->exists();

        if ($results) {
            $response = trans('api.messages.tempdevice.data_exists');
        } else {

            $data                = new TempDeviceModel();

            $data->company_name  = $datas['company_name'];
            $data->device_name   = $datas['device_name'];
            $data->serial_number = $datas['serial_number'];
            $data->temp_device_id = $datas['temp_device_id'];

            if ($data->save()) {
                $response = trans('api.messages.tempdevice.success');
            } else {
                $response = trans('api.messages.tempdevice.failed');
            }
        }
        return $response;
    }

    public function getDeviceById($id)
    {
        if (!empty($id)) {
            // $id = Crypt::decryptString($id);
            $permanentModel = TempDeviceModel::select('id', 'company_name', 'device_name', 'serial_number', 'temp_device_id')->where('id', $id)->first();

            return $permanentModel;
        }
    }


    public function updateTempDevice($data)
    {

        $tempModel                   = TempDeviceModel::find($data['id']);

        $tempModel->company_name     = $data['company_name'];
        $tempModel->device_name      = $data['device_name'];
        $tempModel->serial_number    = $data['serial_number'];

        if ($tempModel->save()) {
            return $tempModel;
        } else {
            return false;
        }
    }

    public function deleteById($id)
    {
        if (!empty($id)) {
            $deleteData = TempDeviceModel::where('id', $id)->delete();
            return $deleteData;
        }
    }
}
