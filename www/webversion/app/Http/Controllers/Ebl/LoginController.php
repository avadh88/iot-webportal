<?php

namespace App\Http\Controllers\Ebl;

use App\Http\Controllers\Controller;
use App\Models\ebl\LoginModel;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    
    public function index(){
        return view("login");
    }

    /**
     * Verify Credentials
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function loginVerify(Request $request){
        
        $validator = Validator::make($request->all(),[
            'username'   => 'required',
            'password'   => 'required',
        ]);

        if($validator->fails()){
            // Session::flash('error', json_encode($validator->getMessageBag()->all()));
            // return redirect('/login');
            return back()->withErrors($validator)->withInput();
        }else{
            $user = LoginModel::where('username',$request->username)->first();
        
            if($user){
                if(Hash::check($request->password,$user->password)){
                    // $request->session()->put('LoggedUser',$user->username);
                    Session::put('username',$user->username);
                    Session::put('role',$user->role);
                    Session::put('user_id', $user->id);
                    return redirect('/dashboard')->with('success',"Login Success");
                }else{
                    return redirect('/login')->with('error','Invalid credentials.');
                }
            }else{
                return redirect('/login')->with('error','No Record Found');
            }
        }
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request){
        // Session::forget('LoggedUser');
        Session::flush();
        return redirect('/login');
    }

}
