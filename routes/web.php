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

Route::get('/', [App\Http\Controllers\ServiceController::class, 'list'])->name('services_list');
Route::get('/service/{id}/purchase', [App\Http\Controllers\StripePaymentController::class, 'purchase'])->name('services_purchase');
Route::post('/service/{id}/purchase', [App\Http\Controllers\StripePaymentController::class, 'stripePost'])->name('stripe_post');
Route::get('/user/services', [App\Http\Controllers\ServiceController::class, 'userServices'])->name('user_services');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
