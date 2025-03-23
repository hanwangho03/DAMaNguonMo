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
use App\Http\Controllers\admins\AdminController;
use App\Http\Controllers\admins\AdminThongKeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Client routes
Route::get('/home', [HomeController::class,'index'])->name('home'); 
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/tours', [TourController::class, 'index'])->name('tours');
Route::get('/tour-guides', [TravelGuidesController::class, 'index'])->name('team');
Route::get('/tour/{id}', [TourDetailController::class, 'index'])->name('tour-detail');
Route::get('/destination', [DestinationController::class, 'index'])->name('destination');

// Login & Register
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('user-login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('activate-account/{token}', [LoginController::class, 'activateAccount'])->name('activate.account');

// Booking Tour
Route::get('/tour-booking', [TourBookingController::class, 'index'])->name('tour-booking');
Route::get('/tour-booking/{id}', [BookingController::class, 'showBookingForm'])->name('tour-booking');
Route::post('/tour-booking', [BookingController::class, 'storeBooking'])->name('store-booking');

// Booking Success & Invoice
Route::get('/booking-success', [BookingController::class, 'showBookingSuccess'])->name('booking-success');
Route::get('/invoice/{invoiceId}', [BookingController::class, 'showInvoice'])->name('invoice-detail');
Route::get('/user-bookings', [BookingController::class, 'userBookings'])->name('user.bookings');

// Review & Profile
Route::post('/tour/{id}/review', [TourDetailController::class, 'addReview'])->name('addReview');
Route::get('/user/{id}', [LoginController::class, 'show'])->name('user.profile');
Route::post('/user/{id}/update', [LoginController::class, 'updateProfile'])->name('user.update');

// Duplicate (but valid) tours index route
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');

// Admin routes
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/tours', [AdminController::class, 'tours'])->name('admin.tours');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
Route::get('/admin/comments', [AdminController::class, 'comments'])->name('admin.comments');
Route::get('/admin/stats/tours', [AdminController::class, 'statsTours'])->name('admin.stats.tours');
Route::get('/admin/stats/revenue', [AdminController::class, 'statsRevenue'])->name('admin.stats.revenue');

// ➕ Biểu đồ tròn: Thống kê doanh thu theo tháng
Route::get('/admin/thong-ke/doanh-thu', [AdminThongKeController::class, 'thongKeDoanhThu'])->name('admin.thongke.doanhthu');
