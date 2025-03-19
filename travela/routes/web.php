<?php

use App\Http\Controllers\clients\HomeController;

use App\Http\Controllers\clients\AboutController;
use App\Http\Controllers\clients\DestinationController;
use App\Http\Controllers\clients\TourController;
use App\Http\Controllers\clients\TourDetailController;
use App\Http\Controllers\clients\TravelGuidesController;
use App\Http\Controllers\clients\LoginController;
use App\Http\Controllers\clients\TourBookingController;
use App\Http\Controllers\clients\BookingController;
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
//Handle Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('user-login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('activate-account/{token}', [LoginController::class, 'activateAccount'])->name('activate.account');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/tour-booking', [TourBookingController::class, 'index'])->name('tour-booking');
Route::get('/tour-booking/{id}', [BookingController::class, 'showBookingForm'])->name('tour-booking');
Route::post('/tour-booking', [BookingController::class, 'storeBooking'])->name('store-booking');
Route::get('/booking-success', function () {
    return view('clients.booking-success');
})->name('booking-success');
Route::get('/booking-success', [BookingController::class, 'showBookingSuccess'])->name('booking-success');
Route::get('/invoice/{invoiceId}', [BookingController::class, 'showInvoice'])->name('invoice-detail');
Route::get('/user-bookings', [BookingController::class, 'userBookings'])->name('user.bookings');

Route::post('/tour/{id}/review', [TourDetailController::class, 'addReview'])->name('addReview');
Route::get('/user/{id}', [LoginController::class, 'show'])->name('user.profile');
Route::post('/user/{id}/update', [LoginController::class, 'updateProfile'])->name('user.update');

