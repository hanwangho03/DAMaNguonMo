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



use App\Http\Controllers\admins\AdminCommentController;

use App\Http\Controllers\admins\AdminTourController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admins\AdminUserController;
use App\Http\Controllers\admins\AdminBookingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// Route::get('/', function () {
//     return view('home');
// });
Route::get("/home", [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/tours', [TourController::class, 'index'])->name('tours');
Route::get('/tour-guides', [TravelGuidesController::class, 'index'])->name('team');
Route::get('/tour/{id}', [TourDetailController::class, 'index'])->name('tour-detail');
Route::get('/destination', [DestinationController::class, 'index'])->name('destination');

// Login & Register
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

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

// Admin routes (bắt đầu phân quyền )
Route::middleware(['adminSession'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/tours', [AdminTourController::class, 'tours'])->name('admin.tours');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    
    Route::get('/admin/comments', [AdminController::class, 'comments'])->name('admin.comments');
    Route::get('/admin/stats/tours', [AdminController::class, 'statsTours'])->name('admin.stats.tours');
    Route::get('/admin/stats/revenue', [AdminController::class, 'statsRevenue'])->name('admin.stats.revenue');
    
    
    // ➕ Biểu đồ tròn: Thống kê doanh thu theo tháng
    Route::get('/admin/thong-ke/doanh-thu', [AdminThongKeController::class, 'thongKeDoanhThu'])->name('admin.thongke.doanhthu');
    
    Route::prefix('admin')->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.delete');
    });
    
    
    // Route cho comment
    Route::get('comments', [AdminCommentController::class, 'index'])->name('admin.comments');
    Route::get('admin/comments', [AdminCommentController::class, 'index'])->name('admin.comments.index');
    Route::put('admin/comments/{id}/toggle', [AdminCommentController::class, 'toggle'])->name('admin.comments.toggle');
    Route::delete('/admin/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');
    
    Route::get('/admin/create_tour', [TourController::class, 'create'])->name('admin-create-tour');
    Route::post('/admin/store_tour', [TourController::class, 'store'])->name('admin-store-tour');
    Route::get('/admin/edit_tour/{id}', [TourController::class, 'edit'])->name('admin-edit-tour');
    Route::put('/admin/update_tour/{id}', [TourController::class, 'update'])->name('admin-update-tour');
    Route::get('/admin/delete_tour/{id}', [TourController::class, 'destroy'])->name('admin-delete-tour');
    
    //route booking
    Route::prefix('admin')->group(function () {
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
        Route::post('/bookings/{id}/update-status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
        Route::delete('/bookings/{id}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');
    });
    // thong ke booking tourtour
    Route::get('/admin/stats/tours', [AdminThongKeController::class, 'showMostBookedTours'])->name('admin.stats_tours');

});
// Admin routes (kết thúc phân quyền )


