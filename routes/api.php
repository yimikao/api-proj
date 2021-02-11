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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//VISITOR & USER
Route::post('/register/{event}', [App\Http\Controllers\RegistrationController::class, 'store']);
Route::get('/allevents', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/showevent', [App\Http\Controllers\UserController::class, 'show']);

// Auth::routes();//Ask a question about this(is it Auth::api()->routes())

//USER
Route::group(['prefix'=>'dashboard'], function() {
    Route::get('/events', [App\Http\Controllers\EventController::class, 'index']);
    Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show']);
    // Route::get('/events/new', [App\Http\Controllers\EventController::class, 'create']);
    Route::post('/events', [App\Http\Controllers\EventController::class, 'store']);
    // Route::get('/events/edit', [App\Http\Controllers\EventController::class, 'edit']);
    Route::post('/events/{event}', [App\Http\Controllers\EventController::class, 'update']);
    Route::delete('/events/{event}', [App\Http\Controllers\EventController::class, 'destroy']);


    // Route::get('/register/{event}', [App\Http\Controllers\RegistrationController::class, 'store']);
    Route::get('/registrations', [App\Http\Controllers\UserController::class, 'showRegistrations']);

});





