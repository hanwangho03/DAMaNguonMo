<?php

use App\Http\Controllers\clients\HomeController;

use App\Http\Controllers\clients\AboutController;
use App\Http\Controllers\clients\DestinationController;
use App\Http\Controllers\clients\TourController;
use App\Http\Controllers\clients\TourDetailController;
use App\Http\Controllers\clients\TravelGuidesController;
use App\Http\Controllers\clients\LoginController;
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

// Route::get('/', function () {
//     return view('home');
// });
Route   ::get("/home", [HomeController::class,'index'])->name('home'); 
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/tours', [TourController::class, 'index'])->name('tours');
Route::get('/tour-guides', [TravelGuidesController::class, 'index'])->name('team');
Route::get('/tour/{id}', [TourDetailController::class, 'index'])->name('tour-detail');
Route::get('/destination', [DestinationController::class, 'index'])->name('destination');
Route::get('/login', [LoginController::class, 'index'])->name('login');