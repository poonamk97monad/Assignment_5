<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
/*
|--------------------------------------------------------------------------
| API Routes for Resources
|--------------------------------------------------------------------------

*/
Route::post('resources', 'ResourcesController@postStoreResource');

Route::get('resources', 'ResourcesController@getIndexData');

Route::delete('resources/{id}', 'ResourcesController@deleteResource');

Route::post('/resources/update/{id}', 'ResourcesController@postUpdateResource');

Route::post('resources/add_to_favortted/{id}', 'ResourcesController@postSetFavorite');

Route::post('resources/{id}', 'ResourcesController@postAddCollectionToResource');

Route::post('resources/remove/{id}', 'ResourcesController@postRemoveCollectionToResource');

/*
|--------------------------------------------------------------------------
| API Routes for Collections
|--------------------------------------------------------------------------

*/

Route::post('collections','CollectionsController@postStoreCollection');

Route::get('collections', 'CollectionsController@getIndexData');

Route::delete('collections/{id}', 'CollectionsController@deleteCollection');

Route::post('/collections/update/{id}', 'CollectionsController@postUpdateCollection');

Route::post('collections/add_to_favortted/{id}', 'CollectionsController@postSetFavorite');

Route::post('collections/{id}', 'CollectionsController@postAddResourceToCollection');

Route::post('collections/remove/{id}', 'CollectionsController@postRemoveResourceToCollection');


