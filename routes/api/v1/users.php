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

Route::post('/user',                    [Users::class, 'create']);
Route::get('/user',                     [Users::class, 'info']);
Route::get('/user/{id}',                [Users::class, 'read']);
Route::delete('/user/{id}',             [Users::class, 'delete']);
Route::get('/users',                    [Users::class, 'listing']);
Route::get('/users/statuses',           [Users::class, 'statuses']);
Route::get('/users/types',              [Users::class, 'types']);
Route::put('/user/{id}/auth',           [Users::class, 'updateAuth']);
Route::put('/user/{id}/info',           [Users::class, 'updateInfo']);
Route::put('/user/{id}/permissions',    [Users::class, 'updatePermissions']);
Route::put('/user/{id}/password',       [Users::class, 'updatePasswordForUser']);
Route::put('/user/password',            [Users::class, 'updatePassword']);
Route::put('/user/name',                [Users::class, 'updateName']);

// System administrators
Route::get('/admins',                   [Users::class, 'listAdministrators']);


