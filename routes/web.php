<?php

use Illuminate\Support\Facades\Route;
use App\Models\Turf;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\TurfController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    $turfs = Turf::where('is_active', true)->with('images')->take(6)->get();
    return view('welcome', compact('turfs'));
});

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/turf/{slug}', [TurfController::class, 'show'])->name('turf.show');

// Static Pages
Route::get('/tournaments', [\App\Http\Controllers\TournamentController::class, 'index'])->name('tournaments');
Route::get('/membership', [\App\Http\Controllers\MembershipController::class, 'index'])->name('membership');
Route::get('/offers', [\App\Http\Controllers\OfferController::class, 'index'])->name('offers');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

use App\Http\Controllers\BookingController;

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])->middleware('throttle:6,1')->name('verification.send');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/book/{slug}', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::post('/book/{slug}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/success/{id}', [BookingController::class, 'success'])->name('booking.success');
});

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\TournamentController as AdminTournamentController;
use App\Http\Controllers\Admin\OfferController as AdminOfferController;
use App\Http\Controllers\Admin\MembershipPlanController as AdminMembershipPlanController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{booking}/status', [AdminController::class, 'updateBookingStatus'])->name('bookings.status');
    Route::get('/turfs', [AdminController::class, 'turfs'])->name('turfs');
    Route::get('/turfs/create', [AdminController::class, 'createTurf'])->name('turfs.create');
    Route::post('/turfs', [AdminController::class, 'storeTurf'])->name('turfs.store');
    Route::get('/turfs/{turf}/edit', [AdminController::class, 'editTurf'])->name('turfs.edit');
    Route::put('/turfs/{turf}', [AdminController::class, 'updateTurf'])->name('turfs.update');
    Route::delete('/turfs/{turf}', [AdminController::class, 'deleteTurf'])->name('turfs.destroy');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    
    // Tournaments Admin
    Route::resource('tournaments', AdminTournamentController::class);
    
    // Offers Admin
    Route::resource('offers', AdminOfferController::class);
    
    // Membership Plans Admin
    Route::resource('memberships', AdminMembershipPlanController::class);
});
