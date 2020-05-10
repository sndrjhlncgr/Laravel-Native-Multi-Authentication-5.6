<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

class SuperAdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:super-admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super-administrator.home');
    }

    /**
     * Show the super admin change password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm()
    {
        return view('auth.super-administrator.passwords.change_password');
    }

    /**
     * Show the super admin change password.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request){
 
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided.");
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }
 
        $adminValidation = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        $superAdmin = Auth::user();
        $superAdmin->password = bcrypt($request->get('new-password'));
        $superAdmin->save();
 
        return redirect()->back()->with("success","Password Changed");
 
    }
}
