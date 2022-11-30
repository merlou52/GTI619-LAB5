<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    protected function authenticated()
    {
        if(auth()->user()->hasRole('ROLE_ADMIN'))
        {
            return redirect('/admin');
        }else if(auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_AFFAIRES'))
        {
            return redirect('/prepAffaires');
        }else if(auth()->user()->hasRole('ROLE_PREPOSE_CLIENTS_RESIDENTIELS'))
        {
            return redirect('/prepResidentiel');
        }

        return redirect('/home');
    }

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
}
