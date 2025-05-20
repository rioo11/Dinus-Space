<?php

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\User\UserHomepage;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['guest'])->group(function () {
    Route::get('/',UserHomepage::class)->name('guest.homepage');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('user/homepage',UserHomepage::class)->name('user.homepage');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard',AdminDashboard::class)->name('admin.dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
