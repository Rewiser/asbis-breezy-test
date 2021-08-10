<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ManagerController;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/manager', [ManagerController::class, 'select']);
    Route::post('/manager/create', [ManagerController::class, 'create']);
    Route::post('/manager/edit', [ManagerController::class, 'edit']);
    Route::post('/manager/delete', [ManagerController::class, 'delete']);
});