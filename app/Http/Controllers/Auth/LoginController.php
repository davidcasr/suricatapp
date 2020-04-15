<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath(){

        if(Auth::user()->isAn('super')){
           return RouteServiceProvider::HOME_ADMIN;
        }elseif(Auth::user()->isAn('admin')){
            return RouteServiceProvider::HOME;
        }elseif(Auth::user()->isAn('supervisor')){
            return RouteServiceProvider::HOME;
        }elseif(Auth::user()->isAn('reports')){
            return RouteServiceProvider::HOME_REPORTS;
        }
        
    }

}
