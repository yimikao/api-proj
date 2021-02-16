<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


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


//AUTH ROUTES
Route::post('/user-create', function(Request $request) {
    // die(var_dump($request->input("name")));
    User::create([
        "name" =>  $request->input('name'),
        "email" => $request->input('email'),
        "password" =>  Hash::make($request->input('password')),

    ]);
});

Route::post('/login', function(Request $request) {
    $credentials = [
        "email" => $request->input('email'),
        "password" => $request->input('password'),

    ];

    $token = auth('api')->attempt($credentials);
    return $token;
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    // $user = $request->user(); //this also works
    $user =  auth()->user();

    return $user;
});


// Route::get('/users', [App\Http\Controllers\UserController::class,'index']);



//VISITOR & USER
Route::post('/events/{event}/register', [App\Http\Controllers\RegistrationController::class, 'store']);
Route::get('/events', [App\Http\Controllers\EventController::class, 'index']);
Route::get('/events/{event}', [App\Http\Controllers\EventController::class, 'show']);
Route::get('/allevents/{user}', [App\Http\Controllers\UserController::class, 'show']);

// Auth::routes();//Ask a question about this(is it Auth::api()->routes())


//USER
Route::group(['middleware' => 'auth:api', 'prefix'=>'dashboard'], function() {
    
    
    Route::post('/events', [App\Http\Controllers\EventController::class, 'store']);
    Route::patch('/events/{event}', [App\Http\Controllers\EventController::class, 'update']);
    Route::delete('/events/{event}', [App\Http\Controllers\EventController::class, 'destroy']);

    Route::get('/registrations', [App\Http\Controllers\UserController::class, 'showRegistrations']);

});



