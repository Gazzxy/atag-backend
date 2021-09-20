<?php

/*
|--------------------------------------------------------------------------
| Reports API routes
|--------------------------------------------------------------------------
|
| Routes related to reports API
| Prefix: api/v1
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Reports;

Route::delete('/report/{id}',           [Reports::class, 'delete']);
