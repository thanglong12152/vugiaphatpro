<?php 
use App\Http\Controllers\FrontEnd;
Route::get('/','IndexController@index');
Route::get('/login','IndexController@login');
Route::get('/register','IndexController@register');
Route::post('create','RegisterController@create');
Route::get('/{namespace}','IndexController@redirect');
Route::get('/chi-tiet-san-pham/{slug}','IndexController@detailProduct');
Route::get('/search/product','IndexController@search');

// Route::get('/{namespace}/{string}','IndexController@filter');
?>
