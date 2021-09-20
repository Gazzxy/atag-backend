<?php

/*
|--------------------------------------------------------------------------
| Equipment API routes
|--------------------------------------------------------------------------
|
| Routes related to equipment API
| Prefix: api/v1
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Equipment;

Route::get('/equipment',                                [Equipment::class, 'listing']);
Route::post('/equipment',                               [Equipment::class, 'create']);
Route::get('/equipment/{id}',                           [Equipment::class, 'read']);
Route::put('/equipment/{id}',                           [Equipment::class, 'update']);
Route::get('/equipment/{id}/reports',                   [Equipment::class, 'listReports']);
Route::post('/equipment/{id}/report',                   [Equipment::class, 'createReport']);
Route::post('/equipment/item/{uuid}/report',            [Equipment::class, 'createReportByUUID']);
Route::get('/equipment/report/download/{id}',           [Equipment::class, 'downloadReport']);
Route::get('/equipment/report/download-item/{uuid}',    [Equipment::class, 'downloadReportByUUID']);
Route::delete('/equipment/{id}',                        [Equipment::class, 'delete']);
Route::get('/equipment/item/{uuid}',                    [Equipment::class, 'readByUUID']);
Route::get('/equipment/item/{uuid}/reports',            [Equipment::class, 'listReportsByUUID']);

