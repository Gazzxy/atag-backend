<?php

/*
|--------------------------------------------------------------------------
| Dashboard API routes
|--------------------------------------------------------------------------
|
| Routes related to dashboard API
| Prefix: api/v1
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Dashboard;

Route::get('/dashboard/stats', [Dashboard::class, 'stats']);
