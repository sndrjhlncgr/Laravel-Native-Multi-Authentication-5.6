<h1 align="center">Laravel Native Multi Authentication</h1>
<p align="center">A Simple Native Laravel Package for handling multiple authentication.</p>

<p align="center">
   <a href="https://github.com/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6/issues"><img alt="GitHub issues" src="https://img.shields.io/github/issues/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6"></a>
    <a href="https://github.com/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6/network"><img alt="GitHub forks" src="https://img.shields.io/github/forks/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6"></a>
    <a href="https://github.com/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6"></a>
    <a href="https://github.com/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6/blob/master/LICENSE"><img alt="GitHub license" src="https://img.shields.io/github/license/sndrjhlncgr/Laravel-Native-Multi-Authentication-5.6"></a>
<p align="center">

![Image of Sandro Cagara](https://i.ibb.co/WzjQLHV/68747470733a2f2f692e6962622e636f2f5a56516a3777592f647361646164732e706e67.jpg)

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

You need to copy/paste this in your `routes/web.php`.

```
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('home')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/change-password','HomeController@showChangePasswordForm')->name('home.change-password.form');
    Route::post('/change-password', 'HomeController@changePassword')->name('home.change-password.submit');

    Route::get('/logout', 'Auth\LoginController@userlogout')->name('home.logout');
});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login.form');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    Route::get('/', 'AdminHomeController@index')->name('admin.home');

    Route::get('/change-password','AdminHomeController@showChangePasswordForm')->name('admin.change-password.form');
    Route::post('/change-password','AdminHomeController@changePassword')->name('admin.change-password.submit');

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

    Route::get('/change-password', 'SuperAdminHomeController@showChangePasswordForm')->name('super-admin.change-password.form');
    Route::post('/change-password', 'SuperAdminHomeController@changePassword')->name('super-admin.change-password.submit');

    Route::get('/logout', 'Auth\SuperAdminLoginController@superAdminlogout')->name('super-admin.logout');

    Route::post('/password/email', 'Auth\SuperAdminForgotPasswordController@sendResetLinkEmail')->name('super-admin.password.email');
    Route::get('/password/reset', 'Auth\SuperAdminForgotPasswordController@showLinkRequestForm')->name('super-admin.password.request');
    Route::post('/password/reset', 'Auth\SuperAdminResetPasswordController@reset')->name('super-admin.reset');
    Route::get('/password/reset/{token}', 'Auth\SuperAdminResetPasswordController@showResetForm')->name('super-admin.password.reset');
});

Route::prefix('account')->group(function() {
    Route::get('/user/verified/{token}', 'Auth\RegisterController@accountVerification');
});

Route::fallback(function(){
    return back();
});
```

## Migration

Then after that you're ready to migrate.

```
php artisan migrate
```

## Config

in `config/auth.php` the default expiration of reset password is `30mins`. you can change it by updating this array.

```
'passwords' => [
     'users' => [
         'provider' => 'users',
         'table' => 'password_resets',
         'expire' => 30, <-HERE
     ],

     'admins' => [
         'provider' => 'admins',
         'table' => 'password_resets',
         'expire' => 30, <-HERE
     ],

     'super_admins' => [
         'provider' => 'super_admins',
         'table' => 'password_resets',
         'expire' => 30, <-HERE
     ],
 ],
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

MIT © 2020 [Sandro Cagara](https://github.com/sndrjhlncgr)
