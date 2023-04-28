<?php

use App\Http\Controllers\Api\SkusController as SkusC;
use App\Http\Controllers\Comments\CommentController as CommentC;
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

const COMMENTS = '/v1/comments';
const COMMENT = '/v1/comments/{comment}';

Route::middleware(['middleware' => 'auth:api'])->group(callback: function () {
    Route::get(uri: 'skus', action: [SkusC::class, 'getSkus']);
});

Route::get(uri: COMMENTS, action: [CommentC::class, 'index']);
Route::post(uri: COMMENTS, action: [CommentC::class, 'store']);
Route::post(uri: COMMENT, action: [CommentC::class, 'edit']);
Route::put(uri: COMMENT, action: [CommentC::class, 'update']);
Route::delete(uri: COMMENT, action: [CommentC::class, 'destroy']);
