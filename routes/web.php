<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopicController;

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


Route::get('/',                     [HomeController::class, 'index'])->name('home.index');
Route::get('/topics/dashboard',     [TopicController::class, 'index'])->middleware('auth')->name('topics.dashboard');
Route::get('/topics/create',        [TopicController::class, 'create'])->middleware('auth')->name('topics.create');

Route::get('/topics/review',        [TopicController::class, 'review'])->middleware('admin')->name('topics.review');

Auth::routes();
