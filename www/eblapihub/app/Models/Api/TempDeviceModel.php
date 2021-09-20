<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class TempDeviceModel extends Model
{
    use HasFactory,HasApiTokens;

    protected $connection = 'mysql2';
    protected $table = 'temp_devices';
    protected $fillable = ['company_id','device_name','serial_number'];

    public function list($data){
        
        if($data){
            $tempDevices = TempDeviceModel::select('id','company_name','device_name','serial_number')->get();
            return $tempDevices;
        }
    }


    public function checkDevice($datas){

        $results = TempDeviceModel::where('company_id', $datas['company_id'])
                                ->where('device_name', $datas['device_name'])
                                ->where('serial_number', $datas['serial_number'])->exists();

        if ($results) {
            $response['message'] = trans('api.messages.device.data_exists');
        }
       
        else{

            $data                = new TempDeviceModel();

            $data->company_id  = $datas['company_id'];
            $data->device_name   = $datas['device_name'];
            $data->serial_number = $datas['serial_number'];
        
            if($data->save()){
                $response['message'] = trans('api.messages.device.success');
            }else{
                $response['message'] = trans('api.messages.device.failed');
            }
        }     
        return $response;
    }

    public function getDeviceById($id){
        if(!empty($id)){
  
            $permanentModel = TempDeviceModel::select('id','company_name','device_name','serial_number')->where('id',$id)->first();
            return $permanentModel;
        
        }

    }

     
    public function updateTempDevice($data){
             
        $tempModel                   = TempDeviceModel::find($data['id']);

        $tempModel->company_name     = $data['company_name'];
        $tempModel->device_name      = $data['device_name'];
        $tempModel->serial_number    = $data['serial_number'];
      
        if($tempModel->save()){
            return $tempModel;
        }else{
            return false;
        }
    }

    public function deleteById($id){
        if(!empty($id)){
            $deleteData = TempDeviceModel::where('id',$id)->delete();
            return $deleteData;
        }
    }
}
