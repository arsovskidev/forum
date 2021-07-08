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


Route::get('/',                                     [HomeController::class, 'index'])->name('home.index');
Route::get('/topic/{id}',                           [TopicController::class, 'show'])->name('topics.show');

Route::get('/topics/dashboard',                     [TopicController::class, 'index'])->middleware('auth')->name('topics.dashboard');
Route::get('/topics/create',                        [TopicController::class, 'create'])->middleware('auth')->name('topics.create');
Route::get('/topics/delete/{id}',                   [TopicController::class, 'destroy'])->middleware('auth')->name('topics.destroy');
Route::get('/topics/edit/{id}',                     [TopicController::class, 'edit'])->middleware('auth')->name('topics.edit');

Route::post('/topics/create',                       [TopicController::class, 'store'])->middleware('auth')->name('topics.store');
Route::post('/topics/update/{id}',                  [TopicController::class, 'update'])->middleware('auth')->name('topics.update');

Route::get('/topics/review',                        [TopicController::class, 'review'])->middleware('admin')->name('topics.review');
Route::get('/topics/review/approve/{id}',           [TopicController::class, 'approve'])->middleware('admin')->name('topics.approve');
Route::get('/topics/review/refuse/{id}',            [TopicController::class, 'refuse'])->middleware('admin')->name('topics.refuse');

Auth::routes();
