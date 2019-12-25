<?php

Route::get('/', 'UserController@index');
Route::get('/clients/{id}', 'UserController@selectClient');
Route::post('/client', 'UserController@save');
Route::delete('/client/del/{id}', 'UserController@delete');
Route::put('/client/{id}', 'UserController@put');
Route::get('/client/search/', 'UserController@filtro')->name("client.search");
Route::get('select-id/{sort}/{param?}/', 'UserController@select')->name('select.user.for');

Route::get('/product', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@selectProduct');
Route::post('/product', 'ProductController@save');
Route::delete('/product/del/{id}', 'ProductController@delete');
Route::put('/product/{id}', 'ProductController@put');
Route::get('/product/search/', 'ProductController@filtro')->name("product.search");
Route::any('select-product/{sort}/{param?}/', 'ProductController@select')->name('select.product.for');

Route::get('/order', 'PurchaseOrderController@index');
Route::get('/orders/{id}', 'PurchaseOrderController@selectProduct');
Route::post('/order', 'PurchaseOrderController@save');
Route::delete('/order/del/{id}', 'PurchaseOrderController@delete');
Route::put('/order/{id}', 'PurchaseOrderController@put');
Route::get('/order/search/', 'PurchaseOrderController@filtro')->name("order.search");
Route::get('select-order/{sort}/{param?}/', 'PurchaseOrderController@select')->name('select.order.for');