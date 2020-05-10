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
    Route::get('/', function () {
        return view('welcome');
    });
    
    Auth::routes();
    
    Route::prefix('home')->group(function() {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/logout', 'Auth\LoginController@userlogout')->name('home.logout');
    });
    
    Route::prefix('admin')->group(function() {
        Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login.form');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
        Route::get('/', 'AdminHomeController@index')->name('admin.home');
        Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    
        Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.reset');
        Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    });
    
    Route::prefix('super-admin')->group(function() {
        Route::get('/login', 'Auth\SuperAdminLoginController@showLoginForm')->name('super-admin.login.form');
        Route::post('/login', 'Auth\SuperAdminLoginController@login')->name('super-admin.login.submit');
        Route::get('/', 'SuperAdminHomeController@index')->name('super-admin.home');
        Route::get('/logout', 'Auth\SuperAdminLoginController@superAdminlogout')->name('super-admin.logout');
    
        Route::post('/password/email', 'Auth\SuperAdminForgotPasswordController@sendResetLinkEmail')->name('super-admin.password.email');
        Route::get('/password/reset', 'Auth\SuperAdminForgotPasswordController@showLinkRequestForm')->name('super-admin.password.request');
        Route::post('/password/reset', 'Auth\SuperAdminResetPasswordController@reset')->name('super-admin.reset');
        Route::get('/password/reset/{token}', 'Auth\SuperAdminResetPasswordController@showResetForm')->name('super-admin.password.reset');
    }); 

    Route::prefix('account')->group(function() {
        Route::get('/user/verified/{token}', 'Auth\RegisterController@accountVerification');
    });
    
});