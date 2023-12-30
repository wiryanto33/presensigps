<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{


    public function proseslogin(Request $request)
    {
        // $pass = 123;
        // echo Hash::make($pass);

        if (Auth::guard('tni_al')->attempt(['nrp' => $request->nrp, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'NRP ATAU PASSWORD SALAH']);
        }
    }

    public function proseslogout()
    {
        if (Auth::guard('tni_al')->check()) {
            Auth::guard('tni_al')->logout();
            return redirect('/');
        }
    }

    public function proseslogoutadmin(){

        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }

    public function prosesloginadmin(Request $request)
    {

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/panel/dashboardAdmin');
        } else {
            return redirect('/panel')->with(['warning' => 'EMAIL ATAU PASSWORD SALAH']);
        }
    }
}
