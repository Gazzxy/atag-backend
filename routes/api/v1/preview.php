<?php

/*
|--------------------------------------------------------------------------
| Preview mailable API route
|--------------------------------------------------------------------------
|
| Routes related to previewing mailables
| Prefix: api/v1
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Preview;

Route::get('/preview/available',            [Preview::class, 'show']);

Route::get('/preview/mailable/SendAccountCreatedNotification',              [Preview::class, 'renderSendAccountCreatedNotification']);
Route::get('/preview/mailable/SendAccountActivated',                        [Preview::class, 'renderSendAccountActivated']);
Route::get('/preview/mailable/SendClientCreated',                           [Preview::class, 'renderSendClientCreated']);
Route::get('/preview/mailable/SendPasswordResetInstructions',               [Preview::class, 'renderSendPasswordResetInstructions']);
Route::get('/preview/mailable/SendPasswordResetSuccessfullyNotification',   [Preview::class, 'renderSendPasswordResetSuccessfullyNotification']);
