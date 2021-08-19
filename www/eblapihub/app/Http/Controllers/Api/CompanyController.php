<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class CompanyController extends ApiController
{
    public function add(Request $request){

        if ($request->hasFile('company_logo')) {
            $datas = json_decode($request->form_data,true);
        }else{
            $datas = json_decode($request->getContent(),true);
        }
     

        $validator = Validator::make($datas,[
            'company_name'          => 'required',
            'company_address'       => 'required',
            'company_email'         => 'required',
            'company_mobile'        => 'required',
        ]);

        if($validator->fails()){
            $response['message'] = trans('api.messages.common.failed');
            return $this->respondUnauthorized($response);
        } else{

            if ($request->hasFile('company_logo')) {
    
                $newImageName = time() . '-' . $datas['company_name'] . '.' .$request->company_logo->extension();
                $request->company_logo->move(public_path('uploads'),$newImageName);
                $data['company_logo']    = $newImageName;
            
            }

            $data['company_name']    = $datas['company_name'];
            $data['company_address'] = $datas['company_address'];
            $data['company_email']   = $datas['company_email'];
            $data['company_mobile']  = $datas['company_mobile'];
            $data['company_status']  = $datas['company_status'];

            $companyModel = new Company();
            $companyData  =  $companyModel->addCompany($data);
            $response = [];


            if(($companyData)){
                $response['message'] = trans('api.messages.common.success');
                $response['data']    = $companyData;
                return $this->respond($response);
            }else{
                $response['message'] = trans('api.messages.common.failed');
                $response['data']    = $companyData;
                return $this->respond($response);
            }
        }
    }

    public function list(){

        $companyModel = new Company();
        $companyData  =  $companyModel->companyList();

        $response = [];


        if(count($companyData) > 0){
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $companyData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $companyData;
            return $this->respond($response);
        }
    }

    public function delete($id){
        $companyModel = new Company();
        $companyData  = $companyModel->deleteById($id);

        if($companyData){
            $response['message'] = trans('api.messages.common.delete');
            $response['data']    = $companyData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.common.failed');
            $response['data']    = $companyData;
            return $this->respond($response);
        }

    }

    public function edit($id){
        $companyModel = new Company();
        $companyData  = $companyModel->getUserById($id);
        
        if($companyData){
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $companyData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $companyData;
            return $this->respond($response);
        }
    }

    public function update(Request $request){

        if ($request->hasFile('company_logo')) {
            $datas = json_decode($request->form_data,true);
        }else{
            $datas = json_decode($request->getContent(),true);
        }

        $validator = Validator::make($datas,[
            'company_name'          => 'required',
            'company_address'       => 'required',
            'company_email'         => 'required',
            'company_mobile'        => 'required',
        ]);


        if($validator->fails()){
            
            $response['message'] = trans('api.messages.common.failed');
            return $this->respondUnauthorized($response);
        } else{
        
            if ($request->hasFile('company_logo')) {
    
                $newImageName = time() . '-' . $datas['company_name'] . '.' .$request->company_logo->extension();
                $request->company_logo->move(public_path('uploads'),$newImageName);
                $data['company_logo']    = $newImageName;
            
            }

            $data['id']              = $datas['id'];
            $data['company_name']    = $datas['company_name'];
            $data['company_address'] = $datas['company_address'];
            $data['company_email']   = $datas['company_email'];
            $data['company_mobile']  = $datas['company_mobile'];
            $data['company_status']  = $datas['company_status'];


            $companyModel = new Company();
            $companyData  =  $companyModel->updateCompany($data);
            $response = [];
            


            if(($companyData)){
                $response['message'] = trans('api.messages.common.update');
                $response['data']    = $companyData;
                return $this->respond($response);
            }else{
                $response['message'] = trans('api.messages.common.failed');
                $response['data']    = $companyData;
                return $this->respond($response);
            }
        }

    }

    public function compnaylist(){

        $companyModel = new Company();
        $companyData  =  $companyModel->companyName();

        $response = [];


        if(count($companyData) > 0){
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $companyData;
            return $this->respond($response);
        }else{
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $companyData;
            return $this->respond($response);
        }
    }
}
