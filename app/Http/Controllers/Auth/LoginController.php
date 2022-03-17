<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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

    public function authenticated()
    {
        if(auth()->user()->hasRole('Admin'))
        {
            return redirect('/admin/dashboard');
        }
        elseif(auth()->user()->hasRole('Student'))
        {
            return redirect('/student/dashboard');
        }
        elseif(auth()->user()->hasRole('Teacher'))
        {
            return redirect('/teacher/dashboard');
        }
        elseif(auth()->user()->hasRole('Coordinator'))
        {
            return redirect('/coordinator/dashboard');
        }

        return redirect('home');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }


}
