<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.administrator.login');
    }

     /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email',
            'password' => 'required',
        ]);

        $admin = Auth::guard('admin')->attempt(
            ['email' => $request->email,
            'password' => $request->password], 
            $request->remember
        );

        if($admin)  {
            return redirect()->intended(route('admin.home'));
        }
       
        return redirect()->back()->withInput($request->only('email'));
       
    }

     /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }

}
