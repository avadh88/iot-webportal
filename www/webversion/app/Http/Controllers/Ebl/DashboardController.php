<?php

namespace App\Http\Controllers\Ebl;

use App\Http\Controllers\Controller;
use App\Models\ebl\DashboardModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DashboardController extends ApiController
{
    public function view(){
        return view('dashboard/dashboard');
    }
}
