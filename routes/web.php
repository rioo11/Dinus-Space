<?php

use App\Http\Middleware\admin;
use App\Livewire\Admin\Activities\Index as ActivitiesIndex;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\Rooms;
use App\Livewire\Admin\Bookings;
use App\Livewire\Admin\Logs\Index as LogsIndex;
use App\Livewire\Admin\Reports\Index as ReportsIndex;
use App\Livewire\Admin\Schedule\Index as ScheduleIndex;
use App\Livewire\Admin\Settings\Index as SettingsIndex;
use App\Livewire\Admin\Users\Index as UsersIndex;
use App\Livewire\User\Booking\Index as UserBookingsIndex;
use App\Livewire\User\UserHomepage;
use Illuminate\Support\Facades\Mail;
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
    Route::get('user/bookings',UserBookingsIndex::class)->name('user.bookings');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard',AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/rooms', Rooms::class)->name('admin.rooms');
    Route::get('/admin/bookings',Bookings::class)->name('admin.bookings.index');
    Route::get('/admin/schedule/index',ScheduleIndex::class)->name('admin.schedule.index');
    Route::get('/admin/users/index',UsersIndex::class)->name('admin.users.index');
    Route::get('/admin/activities/index',ActivitiesIndex::class)->name('admin.activities.index');
    Route::get('/admin/reports/index',ReportsIndex::class)->name('admin.reports.index');
    Route::get('/admin/settings/index',SettingsIndex::class)->name('admin.settings.index');
    Route::get('/admin/logs/index',LogsIndex::class)->name('admin.logs.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
