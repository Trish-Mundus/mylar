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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/', [MainController::class]);
//Route::get('/test', [MainController::class,'test']);
Route::get('/', 'App\Http\Controllers\MainController@home');
Route::get('/test', 'App\Http\Controllers\MainController@test')->name('test');
Route::post('/test/check', 'App\Http\Controllers\MainController@t_check');
//Route::get('/test', action:'MainController@test');
//Route::get('/test', function () {
//    return view('test');
//});
Route::get('/user/{param}/{user_name}', function ($param,$user_name) {
    return $param.' '.$user_name;
});
