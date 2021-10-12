<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\Company\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CompanyController extends ApiController
{

    /**
     * Create New Company
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {

        if ($request->hasFile('company_logo')) {
            $datas = json_decode($request->form_data, true);
        } else {
            $datas = json_decode($request->getContent(), true);
        }

        $validator = Validator::make($datas, [
            'company_name'          => 'required|unique:companies',
            'company_address'       => 'required|unique:companies',
            'company_email'         => 'required|unique:companies',
            'company_mobile'        => 'required|unique:companies',
        ]);

        if ($validator->fails()) {
            $response['message'] = $validator->errors();;
            return $this->throwValidation($response);
        } else {

            if ($request->hasFile('company_logo')) {

                $thumbnailImage = Image::make($request->file('company_logo')->getRealPath())->resize(50, 50);
                $data['company_logo']       = $thumbnailImage;
                $newImageName = time() . '-' . $datas['company_name'] . '.' . $request->company_logo->extension();

                $thumbnailImage->save(public_path('uploads/company/') . $newImageName);
                $data['company_logo']    = $newImageName;
            } else {
                $newImageName = time() . '-' . $datas['company_name'] . '.png';

                File::copy(resource_path('images/ebllogo.png'), public_path('uploads/company/') . $newImageName);
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


            if (($companyData)) {
                $response['message'] = trans('api.messages.company.success');
                $response['data']    = $companyData;
                return $this->respond($response);
            } else {
                $response['message'] = trans('api.messages.company.failed');
                $response['data']    = $companyData;
                return $this->respond($response);
            }
        }
    }

    /**
     * Show company list
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {

        $companyModel = new Company();
        $companyData  =  $companyModel->companyList();
        
        $response = [];


        if (count($companyData) > 0) {
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $companyData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $companyData;
            return $this->respond($response);
        }
    }

    /**
     * Delete Company data
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $companyModel = new Company();
        $companyData  = $companyModel->deleteById($id);

        if ($companyData) {
            $response['message'] = trans('api.messages.common.delete');
            $response['data']    = $companyData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.common.failed');
            $response['data']    = $companyData;
            return $this->respond($response);
        }
    }

    /**
     * Fetch Company Data for update
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $companyModel = new Company();
        $companyData  = $companyModel->getUserById($id);

        if ($companyData) {
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $companyData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $companyData;
            return $this->respond($response);
        }
    }


    /**
     * Update Company Data
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        if ($request->hasFile('company_logo')) {
            $datas = json_decode($request->form_data, true);
        } else {
            $datas = json_decode($request->getContent(), true);
        }
        $id = $datas['id'];

        $validator = Validator::make($datas, [
            'company_name'          => 'required|unique:companies,company_name,' . $id,
            'company_address'       => 'required|unique:companies,company_address,' . $id,
            'company_email'         => 'required|unique:companies,company_email,' . $id,
            'company_mobile'        => 'required|unique:companies,company_mobile,' . $id,
        ]);


        if ($validator->fails()) {

            $response['message'] = trans('api.messages.common.failed');
            return $this->respondUnauthorized($response);
        } else {

            if ($request->hasFile('company_logo')) {


                $thumbnailImage = Image::make($request->file('company_logo')->getRealPath())->resize(50, 50);
                $data['company_logo']       = $thumbnailImage;
                $newImageName = time() . '-' . $datas['company_name'] . '.' . $request->company_logo->extension();
                $thumbnailImage->save(public_path('uploads/company/') . $newImageName);

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

            if (($companyData)) {
                $response['message'] = trans('api.messages.common.update');
                $response['data']    = $companyData;
                return $this->respond($response);
            } else {
                $response['message'] = trans('api.messages.common.failed');
                $response['data']    = $companyData;
                return $this->respond($response);
            }
        }
    }

    /**
     * Fetch company list
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function compnaylist()
    {

        $companyModel = new Company();
        $companyData  =  $companyModel->companyName();

        $response = [];


        if (count($companyData) > 0) {
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $companyData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $companyData;
            return $this->respond($response);
        }
    }

    /**
     * Fetch Company list with related devices
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function listbyid(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $companyModel = new Company();
        $companyData  =  $companyModel->listbyid($data['id']);

        if ($companyData) {
            $response['message'] = trans('api.messages.fetch.success');
            $response['data']    = $companyData;
            return $this->respond($response);
        } else {
            $response['message'] = trans('api.messages.fetch.failed');
            $response['data']    = $companyData;
            return $this->respond($response);
        }
    }
}
