<?php

/*
|--------------------------------------------------------------------------
| Property API routes
|--------------------------------------------------------------------------
|
| Routes related to property API
| Prefix: api/v1
*/


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Properties;

Route::get('/properties',                   [Properties::class, 'listing']);
Route::delete('/property/{id}',             [Properties::class, 'delete']);
Route::post('/property',                    [Properties::class, 'create']);
Route::put('/property/{id}',                [Properties::class, 'update']);
Route::get('/property/{id}',                [Properties::class, 'read']);
Route::get('/property/{id}/equipment',      [Properties::class, 'readEquipment']);
