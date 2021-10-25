<?php

namespace App\Http\Controllers\Temp;

use App\Helpers\Helper;
use App\Http\Controllers\Ebl\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TempController extends ApiController
{

    /**
     * Send Request for fetch temp device list
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function list()
    {

        $read = Helper::showBasedOnPermission(['temporary.read'], 'OR');

        if (!$read) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data = Session::get('token');

                $response = $this->getGuzzleRequest('GET', '/list/devices', $data);
                $res = json_decode($response['data']);

                if ($response['status'] == 200) {
                    return view('temporary/list', ['temps' => $res->data]);
                } else {
                    return view('temporary/list', ['temps' => []]);
                }
            }
        }
    }

    /**
     * Send Request to insert temp device to permanent device
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function insertData(Request $request)
    {

        $add = Helper::showBasedOnPermission(['permanent.create'], 'OR');

        if (!$add) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data['token'] = Session::get('token');

                $data['id']               = $request->id;
                $data['company_id']       = $request->company_id;
                $data['device_name']      = $request->device_name;
                $data['serial_number']    = $request->serial_number;
                $data['temp_device_id']   = $request->temp_device_id;

                $response = $this->getGuzzleRequest('POST', '/permanent/add', $data);
                $res      = json_decode($response['data']);

                if ($response['status'] == 200) {
                    if (isset($res->error)) {
                        Session::flash('message', $res->error->message->message);
                        Session::flash('alert-class', 'error');
                        return redirect()->back()->with('error', $res->error->message->message);
                    } else {
                        Session::flash('message', $res->message);
                        Session::flash('alert-class', 'success');
                        return redirect('/temporary/list')->with('success', $res->message);
                    }
                } else if ($response['status'] == 401) {

                    Session::flash('message', $res->error->message->message);
                    Session::flash('alert-class', 'error');
                    return redirect()->back()->with('error', $res->error->message->message);
                } else if ($response['status'] == 422) {
                    return Redirect::back()->withErrors($res->error->message->message);
                }
            }
        }
    }

    /**
     * Send Request to fecth data for update
     *
     * @param int $id
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {

        $edit = Helper::showBasedOnPermission(['temporary.update'], 'OR');

        if (!$edit) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET', '/company/compnaylist', $data);
                $compnies      = json_decode($response['data']);

                $response = $this->getGuzzleRequest('GET', '/temporary/edit/' . $id, $data);
                $res      = json_decode($response['data']);

                if ($response['status'] == 200) {

                    // Session::flash('message', $res->message); 
                    Session::flash('alert-class', 'alert-success');
                    return view('temporary/edit', ['data' => $res->data, 'compnies' => $compnies->data]);
                } else if ($response['status'] == 401) {

                    Session::flash('message', $res->error->message->message);
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('/temporary/edit')->with('error', $res->error->message->message);
                }
            }
        }
    }

    /**
     * Fetch Data for inserting device temp to permanent 
     *
     * @param int $id
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function permanent($id)
    {
        // if(!$edit){
        //     return Redirect::back()->with('');
        // }else{
        if (Session::has('token')) {
            $data     = Session::get('token');

            $response = $this->getGuzzleRequest('GET', '/company/compnaylist', $data);
            $compnies      = json_decode($response['data']);

            $response = $this->getGuzzleRequest('GET', '/temporary/edit/' . $id, $data);
            $res      = json_decode($response['data']);

            if ($response['status'] == 200) {

                // Session::flash('message', $res->message); 
                Session::flash('alert-class', 'alert-success');
                return view('temporary/addpermanent', ['data' => $res->data, 'compnies' => $compnies->data]);
            } else if ($response['status'] == 401) {

                Session::flash('message', $res->error->message->message);
                Session::flash('alert-class', 'alert-danger');
                return redirect('/temporary/addpermanent')->with('error', $res->error->message->message);
            }
        }
        // }
    }

    /**
     * Send Request to update temp device data
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $update = Helper::showBasedOnPermission(['temporary.update'], 'OR');

        if (!$update) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data['token']           = Session::get('token');
                $data['id']              = $request->id;
                $data['company_name']    = $request->company_name;
                $data['device_name']     = $request->device_name;
                $data['serial_number']   = $request->serial_number;

                $response = $this->getGuzzleRequest('post', '/temporary/update', $data);
                $res = json_decode($response['data']);

                if ($response['status'] == 200) {
                    if (isset($res->error)) {
                        Session::flash('message', $res->error->message->message);
                        Session::flash('alert-class', 'error');
                        return redirect('/temporary/list')->with('error', $res->error->message->message);
                    } else {
                        Session::flash('message', $res->message);
                        Session::flash('alert-class', 'success');
                        return redirect('/temporary/list')->with('success', $res->message);
                    }
                } else if ($response['status'] == 401) {

                    Session::flash('message', $res->error->message->message);
                    Session::flash('alert-class', 'error');
                    return redirect('/temporary/edit')->with('error', $res->error->message->message);
                } else if ($response['status'] == 422) {
                    return Redirect::back()->withErrors($res->error->message->message);
                }
            }
        }
    }

    /**
     * Send Request to delete temp device data
     *
     * @param int $id
     *
     *  @return Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $delete = Helper::showBasedOnPermission(['temporary.delete'], 'OR');

        if (!$delete) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {

                $data = Session::get('token');

                $response = $this->getGuzzleRequest('GET', '/temporary/delete/' . $id, $data);
                $res = json_decode($response['data']);

                if ($response['status'] == 200) {

                    Session::flash('message', $res->message);
                    Session::flash('alert-class', 'success');
                    return redirect('/temporary/list');
                } else if ($response['status'] == 401) {
                    Session::flash('message', $res->message);
                    Session::flash('alert-class', 'error');
                    return view('/temporary/list', ['temps' => []]);
                }
            }
        }
    }
}
