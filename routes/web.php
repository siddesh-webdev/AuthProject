<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

// Route::get()
Route::post('/register/create',[UserController::class,'createUser']);

Route::post('/login/checkUser',[UserController::class,'checkUser']);

Route::get('/dashboard/profile',[UserController::class,'profile'])->name('profile')->middleware('auth');

Route::get('logout',[UserController::class,'logout'])->name('logout');