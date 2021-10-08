<?php

namespace App\Http\Controllers\Ebl;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ApplicationController extends ApiController
{

    /**
     * show view of application form
     *
     * @return void
     */
    public function new()
    {
        if (Session::has('token')) {
            // $data     = Session::get('token');
            $data['token']     = Session::get('token');
            $data['id']        = Session::get('user_id');

            // $response = $this->getGuzzleRequest('GET', '/company/compnaylist', $data);
            // $compnies      = json_decode($response['data']);

            $response = $this->getGuzzleRequest('POST', '/company/listbyid', $data);
            $compnies      = json_decode($response['data']);

            return view('application/new', ['compnies' => $compnies->data]);
        }
    }

    /**
     * Send Request to create new Application
     *
     * @param Request $request
     * 
     * @return Illuminate\Routing\Redirector
     */
    public function add(Request $request)
    {

        if (Session::has('token')) {

            $request->validate([
                'app_image' => 'required|image|mimes:bmp|max:10240',
            ]);

            $data['token']           = Session::get('token');
            $data['app_company_id']  = $request->app_company_id;
            $data['device_name']     = $request->device_name;
            $data['app_name']        = $request->app_name;
            $data['app_status']      = $request->app_status;

            if ($request->file('app_image')) {
                $data['app_image']          = request('app_image');
                $data['file_path']          = $data['app_image']->getPathname();
                $data['file_mime']          = $data['app_image']->getMimeType('image');
                $data['file_uploaded_name'] = $data['app_image']->getClientOriginalName();
                $response                   = $this->fileWithDataGuzzleRequest('POST', '/app/add', 'app_image', $data);
            } else {
                $response                   = $this->getGuzzleRequest('POST', '/app/add', $data);
            }

            $res                            = json_decode($response['data']);

            if ($response['status'] == 200) {
                $id = $res->data->id;
                Session::flash('message', $res->message);
                Session::flash('alert-class', 'alert-success');
                return redirect()->to('/app/edit/' . $id);
                // return redirect('/app/edit/')->with(['success', $res->message, 'data' => $res->data]);
            } else if ($response['status'] == 422) {

                return Redirect::back()->withErrors($res->error->message);
            } else if ($response['status'] == 401) {
                Session::flash('message', $res->error->message->message);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/app/new')->with('error', $res->error->message->message);
            }
        }
    }

    /**
     * Send request for EMT application
     * 
     * @return Illuminate\Routing\Redirector
     */
    public function list()
    {
        if (Session::has('token')) {
            $data['token']     = Session::get('token');
            $data['user_id']      = Session::get('user_id');

            $response = $this->getGuzzleRequest('POST', '/app/list', $data);
            $res      = json_decode($response['data']);

            if ($response['status'] == 200) {

                return view('application/list', ['apps' => $res->data]);
            } else if ($response['status'] == 401) {

                return Redirect::back()->with('error', $res->error->message->message);
            }
        }
    }

    /**
     * Send Request for get EMT data for edit
     * 
     * @param int $id
     * 
     * @return view
     */
    public function edit($id)
    {

        if (Session::has('token')) {
            $data = Session::get('token');

            $response = $this->getGuzzleRequest('GET', '/app/edit/' . $id, $data);
            $res      = json_decode($response['data']);

            return view('application/new', ['data' => $res->data]);
        }
    }


    /**
     * Send data for update EMT Application
     * 
     * @param Request $request
     * 
     * @return Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        if (Session::get('token')) {
            $data['token'] = Session::get('token');


            $request->validate([
                'app_image' => 'image|mimes:bmp|max:10240',
            ]);

            $data['token']           = Session::get('token');
            $data['id']              = $request->id;
            $data['app_company_id']  = $request->app_company_id;
            $data['device_name']     = $request->device_name;
            $data['app_name']        = $request->app_name;
            $data['app_status']      = $request->app_status;

            if ($request->file('app_image')) {
                $data['app_image']          = request('app_image');
                $data['file_path']          = $data['app_image']->getPathname();
                $data['file_mime']          = $data['app_image']->getMimeType('image');
                $data['file_uploaded_name'] = $data['app_image']->getClientOriginalName();
                $response                   = $this->fileWithDataGuzzleRequest('POST', '/app/update', 'app_image', $data);
            } else {
                $response                   = $this->getGuzzleRequest('POST', '/app/update', $data);
            }


            $res                            = json_decode($response['data']);

            if ($response['status'] == 200) {
                $id = $res->data->id;
                Session::flash('message', $res->message);
                Session::flash('alert-class', 'alert-success');
                return redirect()->to('/app/edit/' . $id);
            } else if ($response['status'] == 422) {

                return Redirect::back()->withErrors($res->error->message);
            } else if ($response['status'] == 401) {
                Session::flash('message', $res->error->message->message);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/app/new')->with('error', $res->error->message->message);
            }
        }
    }

    /**
     * Send Request for delet EMT  application
     * 
     * @param int $id
     * 
     * @return Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        if (Session::has('token')) {
            $data = Session::get('token');

            $response = $this->getGuzzleRequest('GET', '/app/delete/' . $id, $data);
            $res      = json_decode($response['data']);


            if ($response['status'] == 200) {

                Session::flash('message', $res->message);
                Session::flash('alert-class', 'success');
                return redirect('/app/list');
            } else {
                Session::flash('message', $res->message);
                Session::flash('alert-class', 'error');
                return redirect('/app/list');
            }
        }
    }
}
