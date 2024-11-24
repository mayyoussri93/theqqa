<?php

/*
|--------------------------------------------------------------------------
| OTP Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\SettingManagement\OTPVerificationController;
//Verofocation phone
Route::controller(OTPVerificationController::class)
    ->group(function ($router) {
Route::get('/verification', 'verification')->name('verification');
Route::post('/verification', 'verify_phone')->name('verification.submit');
Route::get('/verification/phone/code/resend', 'resend_verificcation_code')->name('verification.phone.resend');

//Forgot password phone
Route::get('/password/phone/reset', 'show_reset_password_form')->name('password.phone.form');
Route::post('/password/reset/submit', 'reset_password_with_code')->name('password.update.phone');
    });
//Admin
