<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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

    public function showLoginForm()
    {
        return view('auth.login'); // Change 'auth.login' to your actual login view path
    }

    public function customLogin(Request $request)
    {
        // Validate the login request
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $customUsername = env('GATEKEEPER_USERNAME');
        $customPassword = env('GATEKEEPER_PASSWORD');
        
        // Check if the provided username and password match the values from .env
        if ($request->username === $customUsername && $request->password === $customPassword) {
            // Authentication successful
            return redirect('/'); // Change this to your desired redirect path
        }

        // Authentication failed
        return back()->withErrors(['username' => 'Invalid credentials']);
    }
}
