<?php 
use App\Http\Controllers\FrontEnd;
Route::get('/','IndexController@index');
Route::get('/{namespace}','IndexController@redirect');
Route::get('/chi-tiet-san-pham/{slug}','IndexController@detailProduct');
Route::get('/search/product','IndexController@search');

?>
