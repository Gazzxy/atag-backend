<?php

/*
|--------------------------------------------------------------------------
| Clients API routes
|--------------------------------------------------------------------------
|
| Routes related to clients API
| Prefix: api/v1
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Clients;

Route::post('/client',                  [Clients::class, 'create']);
Route::get('/client/{id}',              [Clients::class, 'read']);
Route::put('/client/{id}',              [Clients::class, 'update']);
Route::get('/clients',                  [Clients::class, 'listing']);
Route::get('/client/{id}/users',        [Clients::class, 'users']);
Route::get('/client/{id}/properties',   [Clients::class, 'properties']);
Route::get('/client/{id}/equipment',    [Clients::class, 'equipment']);
Route::get('/clients/statuses',         [Clients::class, 'statuses']);
Route::get('/clients/account-types',    [Clients::class, 'accountTypes']);
Route::delete('/client/{id}',           [Clients::class, 'delete']);

