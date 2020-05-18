<?php 
use App\Http\Controllers\FrontEnd;
Route::get('/','IndexController@index');
Route::get('/login','IndexController@login');
Route::get('/logout','IndexController@logout');
Route::get('/register','IndexController@register');
Route::post('create','RegisterController@create');
Route::post('/delete','IndexController@delete');
Route::get('/{namespace}','IndexController@redirect');
Route::get('chi-tiet-san-pham/{slug}','IndexController@detailProduct');

Route::post('/search/product','IndexController@search');
Route::post('chi-tiet-san-pham/search/product','IndexController@search');
Route::post('caculate','IndexController@caculatePriceAjax');
Route::post('order','IndexController@orderCart');

Route::get('show/cart/{cartId}','IndexController@showCart');
Route::post('delete/cart','IndexController@deleteProduct');
// Route::get('cart','IndexController@showCart');
// Route::get('/{namespace}/{string}','IndexController@filter');
?>
