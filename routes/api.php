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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::resource('ticket','TicketController',['except'=>['index', 'create', 'edit']]);
Route::resource('resolution','ResolutionController',['except'=>['show', 'create', 'edit']]);
Route::resource('employee','EmployeeController',['except'=>['show', 'create', 'edit']]);
Route::get('/location/{id}','LocationController@index')->name('Location.Fetch');
Route::post('/location/{id}','LocationController@store')->name('Location.Add');
Route::post('/login','EmployeeController@login')->name('login');
Route::get('/pending','SyncService@pending')->name('SyncPending');
Route::get('/syncnow/{num}','SyncService@syncnow')->name('SyncNow');
