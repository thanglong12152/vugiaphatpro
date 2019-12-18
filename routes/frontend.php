<?php 
use App\Http\Controllers\FrontEnd;
Route::get('/','IndexController@index');
Route::get('/{namespace}','IndexController@redirect');

?>
