<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Laravel\Passport\HasApiTokens;

class Company extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable   = ['company_name','company_address','company_status','company_logo'];

    
    public function addCompany($data){
        $companyModel  = new Company();
        
        $companyModel->company_name         = $data['company_name'];
        $companyModel->company_address      = $data['company_address'];
        $companyModel->company_email        = $data['company_email'];
        $companyModel->company_mobile       = $data['company_mobile'];

        if($data['company_status'] == 'on'){
            $companyModel->company_status = 1;
        }else{
            $companyModel->company_status = 0;    
        }

        if(isset($data['company_logo'])){
            $companyModel->company_logo         = $data['company_logo'];
        }

        if($companyModel->save()){
            return $companyModel;
        }else{
            return false;
        }
    }

    public function companyList(){
        $data = Company::select('id','company_name','company_status','company_logo')->get()->toArray();

        $list = [];
        $i    = 1;
        
        foreach($data as $key){
            if($key['company_logo'] == ""){
                $key['company_logo'] = URL::to('/resources/images/ebllogo.png');
            }else{
                $key['company_logo'] = URL::to('/public/uploads/company/').'/'.$key['company_logo'];
            }
            $list[$i] = $key;
            $i++;
        }
        return $list;
    }

    public function companyName(){
        $data = Company::select('id','company_name')->get()->toArray();
        return $data;
    }

    public function deleteById($id){
        $image = Company::find($id);

        if(is_file(public_path('uploads/company/').$image->company_logo)){
            unlink(public_path('uploads/company/').$image->company_logo);

        }

        $deleteData = Company::where('id',$id)->delete();
        return $deleteData;
    }

  
    public function getUserById($id){
        
        if($id){
            $companyModel = Company::select('id','company_name','company_address','company_email','company_mobile','company_status','company_logo')->where('id',$id)->first();
            $companyModel['company_logo'] = URL::to('/public/uploads/company/').'/'.$companyModel['company_logo'];
            
            return $companyModel;
        }
    }

    public function updateCompany($data){
     
        $companyModel                   = Company::find($data['id']);

        $companyModel->company_name     = $data['company_name'];
        $companyModel->company_address  = $data['company_address'];
        $companyModel->company_email    = $data['company_email'];
        $companyModel->company_mobile   = $data['company_mobile'];

        if($data['company_status'] == 'on'){
            $companyModel->company_status = 1;
        }else{
            $companyModel->company_status = 0;    
        }
        if(isset($data['company_logo'])){
            if( is_file(public_path('uploads/company/').$companyModel->company_logo) ){
                unlink(public_path('uploads/company/').$companyModel->company_logo);
            }

            $companyModel->company_logo         = $data['company_logo'];
        }

        if($companyModel->save()){
            return $companyModel;
        }else{
            return false;
        }
    }
}
