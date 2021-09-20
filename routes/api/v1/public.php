<?php

/*
|--------------------------------------------------------------------------
| Public API - requires no authenticated session
|--------------------------------------------------------------------------
|
| Routes related to public API
| Prefix: api/v1
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Users;

Route::get('/verify-confirmation',      [Users::class, 'verifyConfirmation']);
Route::post('/verify-account',          [Users::class, 'verifyAccount']);
Route::post('/verify-password-reset',   [Users::class, 'verifyPasswordReset']);
Route::put('/change-password',          [Users::class, 'changePassword']);

Route::get('/debug-sentry', function ()
{
    throw new Exception('My first Sentry error!');
});
