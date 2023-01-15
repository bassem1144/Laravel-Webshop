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

// Shows home page
Route::get('/home', [homepagecontroller::class, 'index']);

// Shows admin page
Route::get('/admin', [adminpagecontroller::class, 'index']);

// Shows create page
Route::get('/create', [productscontroller::class, 'create']);

// Stores data from create page
Route::post('/store', [productscontroller::class, 'store']);

// Shows edit page
Route::get('/edit/{id}', [productscontroller::class, 'edit']);

// Updates data from edit page
Route::put('/update/{id}', [productscontroller::class, 'update']);

// Deletes data
Route::delete('/delete/{id}', [productscontroller::class, 'destroy']);