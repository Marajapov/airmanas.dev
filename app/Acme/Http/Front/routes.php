<?php

Route::group(['domain' => '', 'prefix' => '/', 'namespace' => 'Front\Controllers'], function() {
    Route::get('/', ['as' => 'front.home',   'uses' => 'HomeController@Home']);
});

Route::group(['prefix' => '/', 'namespace' => 'Front\Controllers'], function() {
    Route::get('login', ['as' => 'front.login',   'uses' => 'AuthController@Login']);
    Route::post('login', ['as' => 'front.login',   'uses' => 'AuthController@postLogin']);
    Route::post('logout', ['as' => 'front.logout',   'uses' => 'AuthController@postLogout']);
    // Search routes
    Route::post('booking_pre',['as'=>'front.booking_pre', 'uses'=> 'HomeController@booking_pre']);
    Route::post('search', ['as' => 'front.search', 'uses' => 'HomeController@searchResult']);

    

    // Requesting 
    Route::post('form', ['as' => 'front.form', 'uses' => 'AjaxController@showAjaxLoading']);
    Route::post('ajaxRequest', ['as' => 'front.ajaxRequest', 'uses' => 'AjaxController@ajaxRequest']);

    Route::get('result/o/{o}/od/{od}/d/{d}/dd/{dd}/a/{a}/c/{c}/i/{i}', ['as' => 'front.result', 'uses' => 'AjaxController@showResult']);




    
    Route::post('ajaxCall', ['as' => 'front.ajaxCall', 'uses' => 'HomeController@ajaxCall']);
    Route::post('passenger', ['as' => 'front.passenger', 'uses' => 'HomeController@passenger']);
	
    // Qiwi
    Route::get('qiwi/', ['as' => 'front.payqiwi', 'uses' => 'HomeController@payQiwi']);
	
    
    Route::post('passenger', ['as'=>'front.passenger', 'uses'=> 'HomeController@passenger']);
    Route::post('flight_preview', ['as'=>'front.flight_preview', 'uses'=> 'HomeController@flight_preview']);

    Route::post('get_available_tickets', ['as' => 'front.get_available_tickets', 'uses' => 'AjaxController@getAvailableTickets']);
    
    Route::get('verification', ['as' => 'front.verification', 'uses' => 'HomeController@verification']);

    Route::get('locale/{locale?}',   ['as' => 'locale',   'uses' => 'CommonController@setLocale']);
    
    //  Ajax routes
    Route::post('loadCities', ['as'=>'front.loadCities', 'uses'=>'AjaxController@loadCities']);
    Route::post('loadRegions', ['as'=>'front.loadRegions', 'uses'=>'AjaxController@loadRegions']);
    Route::post('pickDate', ['as'=>'front.pickDate', 'uses'=>'AjaxController@pickDate']);
    Route::post('pickDateReturn', ['as'=>'front.pickDateReturn', 'uses'=>'AjaxController@pickDateReturn']);


    // Sender and Receiver
    Route::get('receiver/',['as'=>'front.messenger','uses'=>'HomeController@receiver']);
    Route::get('sender',['as'=>'front.messenger','uses'=>'HomeController@sender']);

    // Mobilnik routes
    Route::get('getAirports/',['as'=>'front.messenger','uses'=>'HomeController@getAirports']);
    Route::get('msearch', ['as' => 'front.mobilnik.search', 'uses' => 'MobilnikController@searchResult']);
    Route::get('mobilnik/', ['as' => 'front.mobilnik', 'uses' => 'MobilnikController@payMobilnik']);
    Route::post('getpnr', ['as' => 'front.getpnr', 'uses' => 'MobilnikController@getPnr']);

});

?>