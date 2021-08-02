<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class PermanentModel extends Model
{
    use HasApiTokens,HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'permenent_device';
    protected $primaryKey = 'id';
    protected $fillable   = ['company_name','device_name','serial_number'];


    public function fetchSingleData($id){
        $tempDevices = TempDeviceModel::find($id);

        $results = PermanentModel::where('company_name', $tempDevices->company_name)
                                ->where('device_name', $tempDevices->device_name)
                                ->where('serial_number', $tempDevices->serial_number)->exists();

        if ($results) {
            $response['message'] = trans('api.messages.common.data_exists');
        }else{

            $data                = new PermanentModel();

            $data->company_name  = $tempDevices->company_name;
            $data->device_name   = $tempDevices->device_name;
            $data->serial_number = $tempDevices->serial_number;
        
            if($data->save()){
                TempDeviceModel::where('id', $id)
                    ->update(['flag' => 1]);
                $response['message'] = trans('api.messages.device.success');
            }else{
                $response['message'] = trans('api.messages.device.failed');
            }
        }     
        return $response;
    }

    public function list($data){
        
        if($data){
            $permanentDevices = PermanentModel::select('id','company_name','device_name','serial_number')->get();
            return $permanentDevices;
        }
    }

    public function deleteById($id){
        if(!empty($id)){
            $deleteData = PermanentModel::where('id',$id)->delete();
            return $deleteData;
        }
    }

    public function getDeviceById($id){
        if(!empty($id)){
  
            $permanentModel = PermanentModel::select('id','company_name','device_name','serial_number')->where('id',$id)->first();
            return $permanentModel;
        
        }

    }
    
    public function updateDevice($data){
             
        $permenantModel                   = PermanentModel::find($data['id']);

        $permenantModel->company_name     = $data['company_name'];
        $permenantModel->device_name      = $data['device_name'];
        $permenantModel->serial_number    = $data['serial_number'];
      
        if($permenantModel->save()){
            return $permenantModel;
        }else{
            return false;
        }
    }
}
