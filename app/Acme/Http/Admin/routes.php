<?php

Route::group(['prefix' => 'admin', 'middleware' => 'access:admin', 'namespace' => 'Admin\Controllers'], function(){
    Route::get('/',     ['as' => 'admin.home', 'uses' => 'HomeController@Home']);

    
    //  City routes
    Route::get('city/softDelete/{id}',['as' => 'admin.city.softDelete', 'uses' => 'CityController@softDelete']);
    Route::get('city/mainpage/{id}',['as' => 'admin.city.mainpage', 'uses' => 'CityController@mainpage']);
    Route::get('city/special/{id}',['as' => 'admin.city.special', 'uses' => 'CityController@special']);    
    Route::get('city/flagCancel/{id}',['as' => 'admin.city.flagCancel', 'uses' => 'CityController@flagCancel']);    

//  Ajax routes
    Route::post('loadCities', ['as'=>'admin.loadCities', 'uses'=>'AjaxController@loadCities']);
    Route::post('loadRegions', ['as'=>'admin.loadRegions', 'uses'=>'AjaxController@loadRegions']);

//	Resource routes
    Route::resource('user', 'UserController');
    Route::resource('city', 'CityController'); // city - квартира
    
});
