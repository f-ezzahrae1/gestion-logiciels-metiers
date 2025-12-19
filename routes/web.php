<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogicielController;
use App\Http\Controllers\LicenceController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Login/Logout
use App\Http\Controllers\Auth\RegisteredUserController;//register
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// 🟢 Login routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// 🟢 Register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// 🟠 Routes pour l'utilisateur connecté
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD
    Route::resource('logiciels', LogicielController::class);
    Route::resource('licences', LicenceController::class);
    Route::resource('utilisateurs', UtilisateurController::class);

    // Rapports
    Route::get('/rapports', function () {
        return view('rapports');
    })->name('rapports');

    Route::get('/rapports/{type}', [ReportController::class, 'generate'])->name('reports.generate');
    Route::get('/export-rapports/{type}', [ReportController::class, 'export'])->name('reports.export');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Email verification
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('auth')
        ->name('verification.send');
});
