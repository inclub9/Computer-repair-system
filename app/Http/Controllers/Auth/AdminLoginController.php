<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Infomation;
class AdminLoginController extends Controller
{

    public function __construct()
    {
        Auth::guard('web','admin')->logout();
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $ChLogin = 0;
        if (Auth::guard('admin')->attempt(['email' => $request->email,
            'password' => $request->password], $request->remember)) {
            $ChLogin = 'admin';
        }
        if (Auth::guard('technician')->attempt(['department_id' => 2, 'email' => $request->email,
            'password' => $request->password], $request->remember)) {
            return redirect()->route('AdminAllJob');
        }
        if (Auth::guard('manager')->attempt(['department_id' => 3, 'email' => $request->email,
            'password' => $request->password], $request->remember)) {
            return redirect()->route('managerindex');
        }

        if (Auth::guard('info')->attempt(['department_id' => 1, 'email' => $request->email,
            'password' => $request->password], $request->remember)) {
            return redirect()->route('infojob');
        }
        if (Auth::guard('web')->attempt(['email' => $request->email,
            'password' => $request->password], $request->remember)) {
            return redirect()->route('UserAllJob');
        }
        //dd($ChLogin);
        if ($ChLogin == 'admin') return redirect()->route('AdminAllJob');
        $informations = Infomation::all();
        return view('auth.login',compact('informations'));
    }

    public function logout()
    {
        Auth::guard('admin','web')->logout();
        return redirect('/');
    }
}
