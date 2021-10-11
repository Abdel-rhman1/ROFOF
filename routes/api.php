<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/Register' , 'RegisterController@Register');
Route::post('/adminRegister' , 'adminRegisterController@Register');
Route::post('/adminLogin' , 'adminLoginController@login');
Route::post('/Login' , 'LoginController@login');
Route::post('/vendorRegister' , 'vendorRegisterController@Register');
Route::post('/vendorLogin' , 'vendorLoginController@login');
Route::group(['middleware'=>'assign.guard:subadmins'] , function (){
    Route::get('/users' , function(Request $resquest){
        return auth()->user();
    });
});


Route::group(['middleware'=>'assign.guard:admins'] , function(){
    Route::get('/stors' , 'API\StorController@index');
});


Route::group(function(){
    Route::post("/createStor" , "API\StorController@store");
});