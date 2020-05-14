# Laravel Native Multi-Authentication
[![Issue](https://img.shields.io/github/issues/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6?style=flat-square)](https://packagist.org/packages/sandrocagara/laravelmultiauth)
![Forks](https://img.shields.io/github/forks/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6?style=flat-square)
[![Stars](https://img.shields.io/github/stars/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6?style=flat-square)](https://packagist.org/packages/sandrocagara/laravelmultiauth)
[![License](https://img.shields.io/github/license/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6?style=flat-square)](https://packagist.org/packages/sandrocagara/laravelmultiauth)


![Image of Sandro Cagara](https://i.ibb.co/WzjQLHV/68747470733a2f2f692e6962622e636f2f5a56516a3777592f647361646164732e706e67.jpg)

A Simple Native Laravel Package for handling multiple authentication **EASY!!**
- **Laravel**: 5.6
- **Author**: Sandro Cagara
- **Package Version**: v1.0.7 stable

## Features

|            Forgot password           |  Account Verification Email  |            Change Password           |
|--------------------------------------|------------------------------|--------------------------------------|
|:heavy_check_mark: Subscriber         |:heavy_check_mark: Subscriber |:heavy_check_mark: Subscriber         |
|:heavy_check_mark: Administrator      |:x: Administrator             |:heavy_check_mark: Administrator      |
|:heavy_check_mark: Super Administrator|:x: Super Administrator       |:heavy_check_mark: Super Administrator|

## Compatibility

| Laravel Framework  |
|--------------------|
| >= 5.0.x  <= 5.8.x |

## Installing and configuring

Install using composer: <br>
**Note:** before you install this you need make an default authentication using `php artisan make:auth` then delete `home.blade.php`.

```sh
$ composer require sandrocagara/laravelmultiauth
```

and you need to publish `[#]Sandrocagara\Multiauth\AuthServiceProvider`:

```sh
$ php artisan vendor:publish --force
```

## Routes

You need to paste this in your `routes/web.php`.

```
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

//if route not exist!
Route::fallback(function(){
    return back();
});
```

## Migration

Then after that you're ready to migrate.

```
php artisan migrate
```

## Generate Dummy accounts using `Laravel Tinker`

```
php artisan tinker
```
**User:** `factory(App\User::class, 5)->create();`<br>
**Administrator:** `factory(App\Admin::class, 5)->create();`<br>
**Super Administrator:** `factory(App\SuperAdmin::class, 5)->create();`

**Default Password:** `secret`


## Common Issue you may Encounter


**Error:** Expected response code 250 but got code "530", with message "530 5.7.1 Authentication required".<br>
**Solution:** You need to setup your mail driver. for more info [https://laravel.com/docs/5.6/mail]

---

**Error:** Object not found! when click reset password in email.<br>
**Solution:** if you're using `php artisan serve` you need to change the `APP_URL` value from http://localhost to http://127.0.0.1:8000/ in the env file.

---

**Error:** Trying to access array offset on value of type null. this type of error cause of php version so maybe you can upgrade the php version in your composer.json<br>
**Solution:** try to update composer by this command: `composer update`

---

**Error:** “The page has expired due to inactivity”.<br>
**Solution:** if youre using php artisan serve you need to change in env file the APP_URL from http://localhost to http://127.0.0.1:8000/

---

## License

This package inherits the licensing of its parent framework, Laravel, and as such is open-sourced 
software licensed under the [MIT license](http://opensource.org/licenses/MIT)
