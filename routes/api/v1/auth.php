<?php

/*
|--------------------------------------------------------------------------
| Users API routes
|--------------------------------------------------------------------------
|
| Routes related to users API
| Prefix: api/v1
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Users;

Route::post('/users/login',         [Users::class, 'login']);
Route::get('/users/logout',         [Users::class, 'logout']);
Route::post('/retrieve-password',   [Users::class, 'retrievePassword']);
