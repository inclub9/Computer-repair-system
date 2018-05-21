<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    

    use AuthenticatesUsers;

    
    protected $redirectTo = '/searchjob';

    
    public function __construct()
    {
        Auth::guard('web','admin')->logout();
        $this->middleware('guest',['except'=>['logout','userLogout']]);
    }
    public function userLogout()
    {
        Auth::guard('web','admin')->logout();
        return redirect()->route('/');

    }
}
