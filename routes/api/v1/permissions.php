<?php

/*
|--------------------------------------------------------------------------
| Permissions API routes
|--------------------------------------------------------------------------
|
| Routes related to permissions API
| Prefix: api/v1
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Permissions;

Route::get('/permissions',      [Permissions::class, 'listing']);
