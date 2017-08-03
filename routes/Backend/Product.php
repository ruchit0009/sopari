<?php

  Route::group(['namespace' => 'Product'], function () {
    Route::resource('product', 'ProductController');
    Route::post('product/get', 'ProductTableController')->name('product.get');
    Route::post('product/add-product-qty', 'ProductController@addQuantity')->name('product.add-qty');
    });
    
    
    
?>