<?php

namespace App\Http\Controllers\Ebl;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class UserController extends ApiController
{
    /**
     * redirect to login if not have access
     *
     * @return void
     */
    public function index()
    {
        if (Session::has('token')) {
            return redirect()->back();
        } else {
            return view("/login");
        }
    }

    /**
     * Send request for verify credentials
     *
     * @param Request $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function loginVerify(Request $request)
    {

        $data['token']    = $request->_token;
        $data['username'] = $request->username;
        $data['password'] = $request->password;

        $response = $this->getGuzzleRequest('POST', '/login/verify', $data);
        $res = json_decode($response['data']);

        if ($response['status'] == 200) {
            Session::put('username', $data['username']);
            Session::put('token', $res->token);
            Session::put('user_id', $res->data->user_id);
            Session::put('role', $res->data->user_role);
            Session::put('permission', $res->data->user_permission);
            Session::put('company_logo', $res->data->company_logo);

            Session::flash('message', $res->message);
            Session::flash('alert-class', 'success');
            return redirect('/dashboard')->with('success', $res->message);
        } else if ($response['status'] == 401) {

            Session::flash('message', $res->error->message->message);
            Session::flash('alert-class', 'error');
            return redirect('/login')->with('error', $res->error->message->message);
        }
    }

    /**
     * logout
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {

        if (Session::has('token')) {
            $data['token'] = Session::get('token');

            $response      = $this->getGuzzleRequest('post', '/logout', $data);
            $res           = json_decode($response['data']);

            if ($response['status'] == 200) {
                $request->session()->flush();
                return redirect('/login');
            }
            if ($response['status'] == 401) {
                return redirect('/login');
            }
        }
    }

    /**
     * Send request for fetch all user list
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function list()
    {
        $read = Helper::showBasedOnPermission(['user.read'], 'OR');

        if (!$read) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET', '/user/list', $data);
                $res      = json_decode($response['data']);

                if ($response['status'] == 200) {
                    return view('users/user_list', ['users' => $res->data]);
                } else {
                    return view('users/user_list', ['users' => []]);
                }
            }
        }
    }

    /**
     * View form for register new user
     *
     * @return void
     */
    public function new()
    {
        $add = Helper::showBasedOnPermission(['user.create'], 'OR');

        if (!$add) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET', '/roles/view', $data);
                $res      = json_decode($response['data']);

                $response = $this->getGuzzleRequest('GET', '/company/compnaylist', $data);
                $compnies      = json_decode($response['data']);

                return view('users/new_user', ['roles' => $res->data, 'compnies' => $compnies->data]);
            }
        }
    }

    /**
     * Send Request for register new user
     *
     * @param Request $request
     *  
     * @return Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $add = Helper::showBasedOnPermission(['user.create'], 'OR');

        if (!$add) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {

                $data['token']           = Session::get('token');
                $data['username']        = $request->username;
                $data['first_name']      = $request->first_name;
                $data['last_name']       = $request->last_name;
                $data['email']           = $request->email;
                $data['phone_number']    = $request->phone_number;
                $data['role_id']         = $request->role_id;
                $data['company_id']      = $request->company_id;
                $data['password']        = $request->password;
                $data['repeat_password'] = $request->repeat_password;

                $response = $this->getGuzzleRequest('post', '/user/add', $data);
                $res = json_decode($response['data']);

                if ($response['status'] == 200) {
                    if (isset($res->error)) {
                        Session::flash('message', $res->error->message->message);
                        Session::flash('alert-class', 'error');
                        return redirect('/user/list')->with('error', $res->error->message->message);
                    } else {
                        Session::flash('message', $res->message);
                        Session::flash('alert-class', 'success');
                        return redirect('/user/list')->with('success', $res->message);
                    }
                } else if ($response['status'] == 401) {

                    Session::flash('message', $res->error->message->message);
                    Session::flash('alert-class', 'error');
                    return redirect('/user/new')->with('error', $res->error->message->message);
                } else if ($response['status'] == 422) {
                    return Redirect::back()->withErrors($res->error->message->message);
                }
            }
        }
    }

    /**
     * Send request to delete data
     *
     * @param int $id
     * @return Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $delete = Helper::showBasedOnPermission(['user.delete'], 'OR');

        if (!$delete) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET', '/user/delete/' . $id, $data);
                $res      = json_decode($response['data']);


                if ($response['status'] == 200) {

                    Session::flash('message', $res->message);
                    Session::flash('alert-class', 'success');
                    return redirect('/user/list');
                } else {

                    Session::flash('message', $res->message);
                    Session::flash('alert-class', 'error');
                    return redirect('/user/list');
                }
            }
        }
    }

    /**
     * Send request to fetch user data for edit
     *
     * @param int $id
     * @return Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $edit = Helper::showBasedOnPermission(['user.update'], 'OR');

        if (!$edit) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data     = Session::get('token');

                $response = $this->getGuzzleRequest('GET', '/user/edit/' . $id, $data);
                $res      = json_decode($response['data']);

                $response = $this->getGuzzleRequest('GET', '/roles/view', $data);
                $role     = json_decode($response['data']);

                $response = $this->getGuzzleRequest('GET', '/company/compnaylist', $data);
                $compnies      = json_decode($response['data']);

                if ($response['status'] == 200) {

                    // Session::flash('message', $res->message); 
                    Session::flash('alert-class', 'alert-success');
                    return view('users/new_user', ['data' => $res->data, 'roles' => $role->data, 'compnies' => $compnies->data]);
                } else if ($response['status'] == 401) {

                    Session::flash('message', $res->error->message->message);
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('/user/new')->with('error', $res->error->message->message);
                }
            }
        }
    }

    /**
     * Send request for update user data
     *
     * @param Request $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $update = Helper::showBasedOnPermission(['user.update'], 'OR');

        if (!$update) {
            return Redirect::back()->with('');
        } else {
            if (Session::has('token')) {
                $data['token']           = Session::get('token');
                $data['id']              = $request->id;
                $data['username']        = $request->username;
                $data['first_name']      = $request->first_name;
                $data['last_name']       = $request->last_name;
                $data['email']           = $request->email;
                $data['phone_number']    = $request->phone_number;
                $data['role_id']         = $request->role_id;
                $data['company_id']      = $request->company_id;

                $response = $this->getGuzzleRequest('post', '/user/update', $data);
                $res = json_decode($response['data']);

                if ($response['status'] == 200) {
                    if (isset($res->error)) {
                        Session::flash('message', $res->error->message->message);
                        Session::flash('alert-class', 'error');
                        return redirect('/user/list')->with('error', $res->error->message->message);
                    } else {
                        Session::flash('message', $res->message);
                        Session::flash('alert-class', 'success');
                        return redirect('/user/list')->with('success', $res->message);
                    }
                } else if ($response['status'] == 401) {

                    Session::flash('message', $res->error->message->message);
                    Session::flash('alert-class', 'error');
                    return redirect('/user/new')->with('error', $res->error->message->message);
                } else if ($response['status'] == 422) {
                    return Redirect::back()->withErrors($res->error->message->message);
                }
            }
        }
    }
}
