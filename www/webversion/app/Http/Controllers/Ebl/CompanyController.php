<?php

namespace App\Http\Controllers\Ebl;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CompanyController extends ApiController
{
    /**
     * Send request for company list
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function view()
    {

        $read = Helper::showBasedOnPermission(['company.read'], 'OR');

        if (!$read) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET', '/company/list', $data);
                $res      = json_decode($response['data']);

                if ($response['status'] == 200) {

                    return view('/company/list', ['companies' => $res->data]);
                } else if ($response['status'] == 401) {

                    return Redirect::back()->with('error', $res->error->message->message);
                }
            }
        }
    }

    /**
     * show view of company form
     *
     * @return void
     */
    public function new()
    {
        $add = Helper::showBasedOnPermission(['company.create'], 'OR');

        if (!$add) {
            return Redirect::back()->with('');
        } else {
            return view('company/new');
        }
    }

    /**
     * Send Request to add new company
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {

        $add = Helper::showBasedOnPermission(['company.create'], 'OR');

        if (!$add) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {

                $request->validate([
                    'company_logo' => 'image|mimes:jpeg,png,jpg|max:2048',
                ]);

                $data['token']           = Session::get('token');
                $data['company_name']    = $request->company_name;
                $data['company_address'] = $request->company_address;
                $data['company_email']   = $request->company_email;
                $data['company_mobile']  = $request->company_mobile;
                $data['company_status']  = $request->company_status;

                if ($request->file('company_logo')) {
                    $data['company_logo']       = request('company_logo');
                    $data['file_path']          = $data['company_logo']->getPathname();
                    $data['file_mime']          = $data['company_logo']->getMimeType('image');
                    $data['file_uploaded_name'] = $data['company_logo']->getClientOriginalName();
                    $response      = $this->fileWithDataGuzzleRequest('POST', '/company/add', 'company_logo', $data);
                } else {
                    $response      = $this->getGuzzleRequest('POST', '/company/add', $data);
                }

                $res               = json_decode($response['data']);
                if ($response['status'] == 200) {

                    Session::flash('message', $res->message);
                    Session::flash('alert-class', 'alert-success');
                    return redirect('/company/list')->with('success', $res->message);
                } else if ($response['status'] == 401) {

                    Session::flash('message', $res->error->message->message);
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('/company/new')->with('error', $res->error->message->message);
                }
            }
        }
    }

    /**
     * Send Request to delete company
     *
     * @param int $id
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {

        $delete = Helper::showBasedOnPermission(['company.delete'], 'OR');

        if (!$delete) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET', '/company/delete/' . $id, $data);
                $res      = json_decode($response['data']);

                if ($response['status'] == 200) {

                    Session::flash('message', $res->message);
                    Session::flash('alert-class', 'alert-success');
                    return redirect('/company/list');
                } else {
                    return redirect('/company/list');
                }
            }
        }
    }

    /**
     * Send Request to Fecth company data for update
     *
     * @param int $id
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {

        $edit = Helper::showBasedOnPermission(['company.update'], 'OR');

        if (!$edit) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET', '/company/edit/' . $id, $data);
                $res      = json_decode($response['data']);

                if ($response['status'] == 200) {

                    return view('company/new', ['data' => $res->data]);
                } else if ($response['status'] == 401) {

                    Session::flash('message', $res->error->message->message);
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('/company/new')->with('error', $res->error->message->message);
                }
            }
        }
    }

    /**
     * Send Reques for update company
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {

        $update = Helper::showBasedOnPermission(['company.update'], 'OR');

        if (!$update) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data['token'] = Session::get('token');

                $request->validate([
                    'company_logo' => 'image|mimes:jpeg,png,jpg|max:2048',
                ]);

                $data['id']                 = $request->id;
                $data['company_name']       = $request->company_name;
                $data['company_address']    = $request->company_address;
                $data['company_status']     = $request->company_status;
                $data['company_email']      = $request->company_email;
                $data['company_mobile']     = $request->company_mobile;

                if ($request->file('company_logo')) {
                    $data['company_logo']       = request('company_logo');
                    $data['file_path']          = $data['company_logo']->getPathname();
                    $data['file_mime']          = $data['company_logo']->getMimeType('image');
                    $data['file_uploaded_name'] = $data['company_logo']->getClientOriginalName();
                    $response      = $this->fileWithDataGuzzleRequest('POST', '/company/update', $data);
                } else {
                    $response      = $this->getGuzzleRequest('POST', '/company/update', $data);
                }

                // $response      = $this->fileWithDataGuzzleRequest('POST','/company/update',$data);
                $res           = json_decode($response['data']);
                return redirect('company/list');
            }
        }
    }
}
