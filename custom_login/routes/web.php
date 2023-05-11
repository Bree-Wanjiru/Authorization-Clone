<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;

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
})->name('home');

// display login
Route::get('/login', [AuthManager::class, 'login'])->name(name:'login');

//to db
Route::post('/login', [AuthManager::class, 'loginPost'])->name(name:'login.post');

// display signup
Route::get('/signup',  [AuthManager::class, 'signup'])->name(name:'signup');

//to db
Route::post('/signup', [AuthManager::class, 'signupPost'])->name(name:'signup.post');

//logout
Route::get('/logout', [AuthManager::class, 'logout'])->name(name:'logout');

Route::group(['middleware' => 'auth'], function(){
   //profile
   Route::get('/profile' , function(){
    return "Hi";
   });
});
