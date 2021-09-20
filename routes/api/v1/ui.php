<?php

/*
|--------------------------------------------------------------------------
| UI API routes
|--------------------------------------------------------------------------
|
| Routes related to UI API
| Prefix: api/v1
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\UI;

Route::get('/ui/navigation', [UI::class, 'getNavigation']);
