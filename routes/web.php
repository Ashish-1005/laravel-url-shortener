<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UrlController;

Route::get('/', function () {
     return redirect()->route('login');
});

Route::get('register', [AuthWebController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthWebController::class, 'registerUser']);

Route::get('login', [AuthWebController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthWebController::class, 'loginUser']);

Route::post('logout', [AuthWebController::class, 'logoutUser'])->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/invite', [InvitationController::class, 'showInviteForm'])->name('invite.form');
    Route::post('/invite', [InvitationController::class, 'sendInvite'])->name('invite.send');
});

Route::get('/accept-invite/{token}', [InvitationController::class, 'acceptInviteForm'])->name('invite.accept');
Route::post('/accept-invite/{token}', [InvitationController::class, 'registerFromInvite'])->name('invite.register');

Route::get('/dashboard', [UrlController::class, 'index'])->middleware(['auth'])->name('dashboard');


// Route to generate
Route::post('/urls/generate', [UrlController::class, 'store'])->middleware(['auth'])->name('urls.store');

// Route to display list
Route::get('/dashboard', [UrlController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Public redirect
Route::get('/{short_code}', [UrlController::class, 'resolve'])->name('urls.resolve');

