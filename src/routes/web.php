<?php

/*
|--------------------------------------------------------------------------
| Web Routes #SandroCagara Multi Authentication
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Sandrocagara\Multiauth\Http\Controllers'], function () {
   //Front Page
    Route::get('/', function () {
        return view('welcome');
    });

    //Subscriber Routes
    Auth::routes();
    Route::prefix('home')->group(function() {
        //Subscriber Dashboard
        Route::get('/', 'HomeController@index')->name('home');

        //Subscriber Change Password
        Route::get('/change-password','HomeController@showChangePasswordForm')->name('home.change-password.form');
        Route::post('/change-password', 'HomeController@changePassword')->name('home.change-password.submit');

        //Subscriber Logout
        Route::get('/logout', 'Auth\LoginController@userlogout')->name('home.logout');
    });

    //Administrator Routes
    Route::prefix('admin')->group(function() {
        //Administrator Login
        Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login.form');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

        //Administrator Dashboard
        Route::get('/', 'AdminHomeController@index')->name('admin.home');

        //Administrator Change Password
        Route::get('/change-password','AdminHomeController@showChangePasswordForm')->name('admin.change-password.form');
        Route::post('/change-password','AdminHomeController@changePassword')->name('admin.change-password.submit');

        //Administrator Logout
        Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

        //Administrator Forgot Password
        Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.reset');
        Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    });

    //Super Administrator Routes
    Route::prefix('super-admin')->group(function() {
        //Super Administrator Login
        Route::get('/login', 'Auth\SuperAdminLoginController@showLoginForm')->name('super-admin.login.form');
        Route::post('/login', 'Auth\SuperAdminLoginController@login')->name('super-admin.login.submit');

        //Super Administrator Dashboard
        Route::get('/', 'SuperAdminHomeController@index')->name('super-admin.home');

        //Super Administrator Change Password
        Route::get('/change-password', 'SuperAdminHomeController@showChangePasswordForm')->name('super-admin.change-password.form');
        Route::post('/change-password', 'SuperAdminHomeController@changePassword')->name('super-admin.change-password.submit');

        //Super Administrator Logout
        Route::get('/logout', 'Auth\SuperAdminLoginController@superAdminlogout')->name('super-admin.logout');

        //Super Administrator Forgot Password
        Route::post('/password/email', 'Auth\SuperAdminForgotPasswordController@sendResetLinkEmail')->name('super-admin.password.email');
        Route::get('/password/reset', 'Auth\SuperAdminForgotPasswordController@showLinkRequestForm')->name('super-admin.password.request');
        Route::post('/password/reset', 'Auth\SuperAdminResetPasswordController@reset')->name('super-admin.reset');
        Route::get('/password/reset/{token}', 'Auth\SuperAdminResetPasswordController@showResetForm')->name('super-admin.password.reset');
    });

    //Account Verification Routes
    Route::prefix('account')->group(function() {
        //Subscriber Verification
        Route::get('/user/verified/{token}', 'Auth\RegisterController@accountVerification');
    });

    //Error Message
    Route::fallback(function(){
        return back();
    });
});