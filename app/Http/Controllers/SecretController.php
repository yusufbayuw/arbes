<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretController extends Controller
{
    public function index($year)
    {
        $auth = resolve('littlegatekeeper');

        if($auth->isAuthenticated())
        {
            if (view()->exists('dir.'.$year.'.index'))
            {
                return view('dir.'.$year.'.index');
            } else {
                return abort('404');
            }
        } else {
            return view('dir.secretpage.login');
        }


    }

///// FOR LOGING IN

        public function addCredentials(Request $request)
    {

        $auth = resolve('littlegatekeeper');

        $loginSuccess = $auth->attempt($request->only([
            'username',
            'password'
        ]));

        if ($loginSuccess) {
            return redirect()->intended()->with('success', 'Thank You for authorizing. Please proceed.');
        }
        else{
            return back()->with('error', 'You entered the wrong credentials');
        }

    }
}
