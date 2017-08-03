<?php

  Route::group(['namespace' => 'Order'], function () {
    Route::resource('order', 'OrderController');
    Route::post('order/get', 'OrderTableController')->name('order.get');
    Route::group(['prefix' => 'order/{order}'], function () {
         Route::get('recover', 'OrderController@orderRecover')->name('order.recover');
     });
   
    });
    
    
?>