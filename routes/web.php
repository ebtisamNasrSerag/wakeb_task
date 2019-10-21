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


// Display view
Route::get('/','HomeController@index');


// Get Data
Route::get('/getdata', 'HomeController@infosList')->name('/getdata');
//Route::post('/getdata','HomeController@userList')->name('/getdata');
Route::get('/addRecord','HomeController@addRecord');
Route::post('/addRecord','HomeController@createRecord');
Route::get('/editRecord/{id}','HomeController@showRecord');
Route::post('/editRecord/{id}','HomeController@editRecord');
Route::get('/deleteRecord/{id}','HomeController@deleteRecord');
