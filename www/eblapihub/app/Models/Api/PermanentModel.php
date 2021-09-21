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
    use HasApiTokens,HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'permenent_device';
    protected $primaryKey = 'id';
    protected $fillable   = ['company_id','device_name','serial_number'];

    public function companies(){
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function fetchSingleData($id){
        $tempDevices = TempDeviceModel::find($id);

        $results = PermanentModel::where('company_id', $tempDevices->company_id)
                                ->where('device_name', $tempDevices->device_name)
                                ->where('serial_number', $tempDevices->serial_number)->exists();

        if ($results) {
            $response['message'] = trans('api.messages.common.data_exists');
        }else{

            $data                = new PermanentModel();

            $data->company_id  = $tempDevices->company_id;
            $data->device_name   = $tempDevices->device_name;
            $data->serial_number = $tempDevices->serial_number;
        
            if($data->save()){
                TempDeviceModel::where('id', $id)
                    ->update(['temp_device_id' => 1]);
                $response['message'] = trans('api.messages.device.success');
            }else{
                $response['message'] = trans('api.messages.device.failed');
            }
        }     
        return $response;
    }

    public function list($data){
        
        if($data){
            $permanentDevices = PermanentModel::join('companies', 'companies.id', '=', 'permenent_device.company_id')
                   ->get(['permenent_device.id','permenent_device.device_name','permenent_device.serial_number','permenent_device.temp_device_id','companies.company_name']);
            

            // $permanentDevices = PermanentModel::select('id','company_id','device_name','serial_number')->get();
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
  
            $permanentModel = PermanentModel::select('id','company_id','device_name','serial_number')->where('id',$id)->first();
            return $permanentModel;
        
        }

    }
    
    public function updateDevice($data){
             
        $permenantModel                   = PermanentModel::find($data['id']);

        $oldCompanyId                     = $permenantModel->company_id;
        $permenantModel->company_id       = $data['company_id'];
        $permenantModel->device_name      = $data['device_name'];
        $permenantModel->serial_number    = $data['serial_number'];
        
        if($permenantModel->save()){

            if( $oldCompanyId != $permenantModel->company_id ){
                $datas = Company::where('id',$data['company_id'])->get('company_email')->first();
                event( new DeviceCompanyAddEvent($datas->company_email) );
            }
            return $permenantModel;
        }else{
            return false;
        }
    }

    public function addToPermanent($data){

        $tempModel                   = TempDeviceModel::find($data['id']);
        
        $results = PermanentModel::where('company_id', $data['company_id'])
                                ->where('device_name', $data['device_name'])
                                ->where('serial_number', $data['serial_number'])->exists();

        if ($results) {
            $response['message'] = trans('api.messages.common.data_exists');
        }else{
            $permenantModel                   = new PermanentModel();

            $permenantModel->company_id       = $data['company_id'];
            $permenantModel->device_name      = $data['device_name'];
            $permenantModel->serial_number    = $data['serial_number'];
            $permenantModel->temp_device_id   = $tempModel->temp_device_id;
            
            if($permenantModel->save()){
                $lastInsertedId = $permenantModel->id;
                $publishTempId  = new RedisService();
                $uniqqueId      = substr(mt_rand(),0,10);
                $key            = 'cp-temp-to-per-'.$tempModel->temp_device_id;
                $value          = 'cp-device-register-per-'.$tempModel->temp_device_id.";;".$lastInsertedId.";;".microtime(true).";;".$uniqqueId;
                
                $publishTempId->publishRedis( $key, $value );
                $publishTempId->waitingForResponse( $key ,$lastInsertedId);

                TempDeviceModel::where('id', $data['id'])->update(['status' => 1]);
                $datas = Company::where('id',$data['company_id'])->get('company_email')->first();
                return $datas;
            }else{
                return false;
            }
        }
        return $response;

    }

    public function updateDeviceStatus($data){
        // $permanentModel = new PermanentModel();
        if($data){
            PermanentModel::where('id',$data['statusData']['uid'])->update(['status'=>'online']);
            return PermanentModel::where('id',$data['statusData']['uid'])->get('status')->first();
        }else{
            PermanentModel::where('id',$data['statusData']['uid'])->update(['status'=>'offline']);
            return PermanentModel::where('id',$data['statusData']['uid'])->get('status')->first();    
        }
    }
}
