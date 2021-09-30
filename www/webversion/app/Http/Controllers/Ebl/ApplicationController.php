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
            $data     = Session::get('token');

            $response = $this->getGuzzleRequest('GET', '/company/compnaylist', $data);
            $compnies      = json_decode($response['data']);

            return view('application/new', ['compnies' => $compnies->data]);
        }
    }

    /**
     * Send Request to create new Application
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {

        if (Session::has('token')) {

            $request->validate([
                'app_image' => 'required|image|mimes:bmp',
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

                Session::flash('message', $res->message);
                Session::flash('alert-class', 'alert-success');
                return redirect('/app/new')->with('success', $res->message);
            } else if ($response['status'] == 422) {

                return Redirect::back()->withErrors($res->error->message);
            } else if ($response['status'] == 401) {
                Session::flash('message', $res->error->message->message);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/app/new')->with('error', $res->error->message->message);
            }
        }
    }

    public function list(Request $request)
    {

        if (Session::has('token')) {
            $data     = Session::get('token');

            $response = $this->getGuzzleRequest('GET', '/app/list', $data);
            $res      = json_decode($response['data']);

            if ($response['status'] == 200) {

                return view('application/list', ['apps' => $res->data]);
            } else if ($response['status'] == 401) {

                return Redirect::back()->with('error', $res->error->message->message);
            }
        }
    }
}
