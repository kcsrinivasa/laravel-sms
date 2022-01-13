<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return redirect(route('sms.index')); });

Route::get('/sms', 'App\Http\Controllers\SMSController@index')->name('sms.index');
Route::get('/sms-send/nexmo', 'App\Http\Controllers\SMSController@send_nexmo_sms')->name('sms.nexmo.send');
Route::get('/sms-send/twilio', 'App\Http\Controllers\SMSController@send_twilio_sms')->name('sms.twilio.send');