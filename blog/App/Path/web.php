<?php
use Dedelang\Engine\Route;

Route::set('/','Welcome@index');

Route::set('posts/view/@id','Posts@view');
Route::set('posts/update/@id','Posts@update');
Route::set('posts/delete/@id','Posts@delete');
Route::set('posts/views','Posts@views');
Route::set('posts','Posts@index');
