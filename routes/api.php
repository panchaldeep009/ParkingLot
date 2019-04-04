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

Route::get('/tickets', 'ParkedCarsController@getTicket');
Route::post('/tickets', 'ParkedCarsController@getTicket');

Route::get('/tickets/{ticket_number}', 'ParkedCarsController@checkoutTicket');
Route::post('/payments/{ticket_number}', 'ParkedCarsController@payForTicket');