<?php

use App\Http\Controllers\Api\SkusController as SkusC;
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

Route::middleware('auth:sanctum')->get(uri: '/user', action: function (Request $request) {
    return $request->user();
});

Route::get(uri: 'skus', action: [SkusC::class, 'getSkus']);
