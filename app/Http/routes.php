<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('/auction', 'AuctionController@index');
Route::post('/auction', 'AuctionController@create');
Route::get('/auction/{id}', 'AuctionController@view');
Route::get('/my-auctions', 'AuctionController@self');
Route::get('/auction/{id}/edit', 'AuctionController@edit');
Route::post('/auction/{id}/edit', 'AuctionController@update');
Route::get('my-bids', 'BidController@self');
Route::post('bid/{id}', 'BidController@create');
Route::post('bid/{id}/update', 'BidController@update');