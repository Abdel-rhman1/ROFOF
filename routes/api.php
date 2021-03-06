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


Route::group(['middleware'=>'assign.guard:subadmins'] , function(){
    Route::get('/stors' , 'API\StorController@index');
});

Route::group(['middleware'=>'assign.guard:subadmins'] , function(){
    Route::group(['prefix'=>'branch' , 'middleware'=>'assign.guard:subadmins'] , function(){
        Route::post("create" , 'API\branchController@createbranch');
    });
    Route::group(['prefix'=>'stor'], function(){
        Route::post("update/{id}" , 'API\StorController@update');

        Route::post("setActivity" , 'API\StorController@storActivity');
        Route::get("getActivities/{stor_id}" , 'API\StorController@getStorActivity');
        
        Route::post('setCustomerServices' , 'API\StorController@customerServicesStor');
        Route::get('getCustomerService/{stor_id}','API\StorController@getCustomerServicesStor');
        
        Route::post('socialMedia' , 'API\StorController@socialMedia');
        Route::get("getSocialLinks/{id}" , 'API\StorController@getSocialLinks');
        
        Route::post('setlinks' , 'API\StorController@links');
        Route::get('getLinks/{id}' , 'API\StorController@getLinks');
       
        Route::get('getCat/{stor_id}' , 'API\CategoriesController@index');
        Route::post('createCat' , 'API\CategoriesController@createCategories');
        Route::post('updateCat/{cat_id}' , 'API\CategoriesController@updateCat');
        Route::post('delete/{cat_id}' , 'API\CategoriesController@deleteCat');
       
        Route::get('getbrands/{stor_id}' , 'API\brandController@getStorbrands');
        Route::post('createbrand' ,'API\brandController@createBrands' );
        Route::post('updatebrands/{brand_id}' , 'API\brandController@update');
        Route::post('deletebrand/{brand_id}' , 'API\brandController@delete');
        

        Route::get('getProuts/{stor_id}' , 'API\ProducController@index');
        Route::post('createProduct' , "API\ProducController@createProduct");
        Route::post('updateProduct/{P_id}' , "API\ProducController@update");
        Route::post('deleteProduct/{P_id}' , 'API\ProducController@delete');
        Route::post('getByCat/{stor_id}/{Cat_id}' , 'API\ProducController@getByCat');
        Route::post('getByBrand/{stor_id}/{b_id}' , 'API\ProducController@getByBrand');

        Route::post("addProductCat" , "API\ProducController@addCats");
        Route::post("addProductBrand" , "API\ProducController@addBrand");
        
        Route::post("ProductSearch" , 'API\ProducController@ProductSearch');
        //Route::post('setCustomerServices' , 'API\StorController@customerServicesStor');
    });


    Route::group(['prefix'=>'customer'] , function(){
        Route::get("getCustomer/{stor_id}" , "API\CustomerController@getStorCustomers");
        Route::post('creteCustomer' , "API\CustomerController@storeCustomer");
        Route::post("updateCustoemr/{c_id}" , "API\CustomerController@updateCust");
        Route::get("BlockCustomer/{s_id}/{c_id}" , "API\CustomerController@BlockCustomer");
        Route::post("/search" , "API\CustomerController@CustomerSeach");
        Route::get('addCusToGroup/{g_id}/{c_id}/{s_id}' , 'API\CustomerController@addCustomerToGroup');
        Route::get('removeCusFromGroup/{g_id}/{c_id}/{s_id}' , 'API\CustomerController@
                    removeCustomerFromGroup');

        
        Route::post('/moreSearch' , 'API\CustomerController@search');


        //Customer Group APIS 
        Route::get('getgroups/{stor_id}' , 'API\CustomerGroupController@getGroups');
        Route::post('createGroup' , 'API\CustomerGroupController@create');
        Route::post('updateGroup/{G_id}' , 'API\CustomerGroupController@updateGroup');
        Route::post('deleteGroup/{G_id}' , 'API\CustomerGroupController@deleteGroup');

    });
});

Route::group([],function(){
    Route::post("/createStor" , "API\StorController@store");
});


// Route::fallback(function () {
//     return view('index');
// });