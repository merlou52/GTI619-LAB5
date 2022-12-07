<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/caddy-check', 'App\Http\Controllers\CaddyController@check');

Route::resource('client', ClientController::class);
Route::get('client/{id}/edit', 'ClientController@edit')->name('client.edit');
Route::put('client/{id}', 'ClientController@update')->name('client.update');
Route::delete('client/{id}', 'ClientController@destroy')->name('client.destroy');



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/createUser', [\App\Http\Controllers\CreateNewUserController::class, 'index'])->name('admin.usercreate');
Route::post('/createUser', [\App\Http\Controllers\CreateNewUserController::class, 'create']);

Route::get('/2fa/enable', '\App\Http\Controllers\Google2FAController@enableTwoFactor');
Route::get('/2fa/disable', '\App\Http\Controllers\Google2FAController@disableTwoFactor');
Route::get('/2fa/validate', '\App\Http\Controllers\Auth\LoginController@getValidateToken');
Route::post('/2fa/validate', ['middleware' => 'throttle:5', 'uses' => '\App\Http\Controllers\Auth\LoginController@postValidateToken']);


