<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Definicion de rutas

Route::get('auth/user', function() {
 
	if(auth()->check()) 
		return response()->json([
			'authUser' => auth()->user()
		]);
 
	return null;
 
});

Route::get('chat/{chat}', 'App\Http\Controllers\ChatController@show')->name('chat.show');

Route::get('chat/with/{user}', 'App\Http\Controllers\ChatController@chat_with')->name('chat.with');

Route::get('chat/{chat}/get_users', 'App\Http\Controllers\ChatController@get_users')->name('chat.get_users');

Route::get('chat/{chat}/get_messages', 'App\Http\Controllers\ChatController@get_messages')->name('chat.get_messages');

Route::post('message/sent', '\App\Http\Controllers\MessageController@sent')->name('message.sent');