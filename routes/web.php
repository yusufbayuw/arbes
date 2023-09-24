<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('littlegatekeeper');
// Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('getLogin');
// Route::post('/login', 'App\Http\Controllers\Auth\LoginController@customLogin')->name('login');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('dir.secretpage.index');
});

Route::get('/{year}', 'App\Http\Controllers\SecretController@index')
    ->where('year', '\d{4}')
    ->middleware('littlegatekeeper');

Route::get('/auth/login', function () {
    return view('dir.secretpage.login');
});

Route::post('/auth/login', 'App\Http\Controllers\SecretController@addCredentials')->name('addCredentials');
