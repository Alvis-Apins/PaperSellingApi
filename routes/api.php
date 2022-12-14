<?php

use App\Http\Controllers\Api\V1\PartnerController;
use App\Http\Controllers\Api\V1\SaleController;
use App\Http\Controllers\Api\V1\WarehouseController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('partners', PartnerController::class);
Route::apiResource('sales', SaleController::class);
Route::apiResource('warehouse', WarehouseController::class);
