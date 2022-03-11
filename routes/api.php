<?php

use App\Http\Controllers\CommentsController;
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

//here we made an api to use it inside the vue component in order to get/set the new comments without  refresh
Route::prefix('Comments')->group(function () {

    Route::controller(CommentsController::class)->group(function () {
        Route::post('/add', 'create');
        Route::post('/add-reply', 'addReply');
        Route::get('/show', 'show');
    });
});
