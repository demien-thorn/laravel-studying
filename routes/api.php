<?php

use App\Http\Controllers\Api\SkusController as SkusC;
use App\Http\Controllers\CommentController;
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


Route::middleware(['middleware' => 'auth:api'])->group(callback: function () {
    Route::get(uri: 'skus', action: [SkusC::class, 'getSkus']);
});

Route::post(uri: '/comments/store', action: [CommentController::class, 'store']);
Route::post(uri: '/comments/edit/{comment}', action: [CommentController::class, 'edit']);
Route::post(uri: '/comments/update/{comment}', action: [CommentController::class, 'update']);
Route::delete(uri: '/comments/delete/{comment}', action: [CommentController::class, 'destroy']);
