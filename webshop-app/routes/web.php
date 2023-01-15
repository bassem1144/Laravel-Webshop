<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homepagecontroller;
use App\Http\Controllers\adminpagecontroller;
use App\Http\Controllers\productscontroller;

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

Route::get('/edit/{id}', [productscontroller::class, 'edit']);

Route::put('/update/{id}', [productscontroller::class, 'update']);

Route::delete('/delete/{id}', [productscontroller::class, 'destroy']);