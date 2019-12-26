<?php
use App\Http\Controllers\BackEnd;

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'AdminController@index');
    Route::get('settings','AdminController@settings');
    Route::get('check-password','AdminController@checkPass');
    Route::get('/product/check-product','AdminController@checkProduct');
    Route::match(['get','post'],'/update-pwd','AdminController@updatePass');

    //Product Route
    Route::match(['get','post'],'product/add','ProductController@add');
    Route::get('/product/all','ProductController@all');
    Route::get('/product/filter','ProductController@filter');
    Route::match(['get','post'],'product/edit/{id}','ProductController@edit');
    Route::match(['get','post'],'product/delete/{id}','ProductController@delete');
    Route::get('/product/search','ProductController@search');
    //ProductType Route
    Route::get('/productType/all','ProductTypeController@all');
    Route::get('/productType/filter','ProductTypeController@filter');
    Route::match(['get','post'],'productType/add','ProductTypeController@add');
    Route::match(['get','post'],'productType/delete/{id}','ProductTypeController@delete');
    Route::match(['get','post'],'productType/edit/{id}','ProductTypeController@edit');

    //Trademark Route
    Route::get('/trademark/all','TradeMarkController@all');
    Route::match(['get','post'],'trademark/add','TradeMarkController@add');
    Route::match(['get','post'],'trademark/delete/{id}','TradeMarkController@delete');
    Route::match(['get','post'],'trademark/edit/{id}','TradeMarkController@edit');
});

Route::match(['get','post'],'/login','AdminController@login');

Route::get('/logout','AdminController@logout');

