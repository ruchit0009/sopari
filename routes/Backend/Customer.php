<?php

  Route::group(['namespace' => 'Customer'], function () {
    Route::resource('customer', 'CustomerController');
    
    });
    
    
    Route::post('customer/get', 'Customer\CustomerTableController')->name('customer.get');
?>