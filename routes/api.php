<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('customer/{customer_id}/eligible-check', [App\Http\Controllers\Api\CustomerController::class, 'eligibleCheck'])->name('eligible.check');
Route::get('customer/{customer_id}/validate-submission', [App\Http\Controllers\Api\CustomerController::class, 'validateSubmission'])->name('validate.submission');