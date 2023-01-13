<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homepagecontroller;
use App\Http\Controllers\adminpagecontroller;

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
    return redirect('/home');
});

Route::get('/home', [homepagecontroller::class, 'index']);

Route::get('/admin', [adminpagecontroller::class, 'index']);