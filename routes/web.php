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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('resource','ResourcesController');
Route::resource('collection','CollectionsController');

Route::post('add_collection/{id}/{idr}','CollectionsController@update');
Route::post('delete_collection/{id}/{idr}','CollectionsController@destroy');

Route::post('add_resource/{id}/{idr}','ResourcesController@update');
Route::post('delete_resource/{id}/{idr}','ResourcesController@destroy');

Route::post('add_favorites_collection/{id}','CollectionsController@setFavorite');
Route::post('add_favorites_resource/{id}','ResourcesController@setFavorite');


Route::get('/search','ResourcesController@search');


