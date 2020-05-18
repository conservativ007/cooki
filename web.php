<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

  Route::get('/cooki', 'Coocki@one');
  Route::get('/cookiform', 'Coocki@two');
  Route::get('/cookicounter', 'Coocki@three');
