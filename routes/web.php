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

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::group(['prefix' => 'admin', 'middleware' => 'is_admin', 'namespace' => 'App\Http\Controllers\Admin'], function(){
    Route::resource('guestbook', 'GuestbookController');
});
