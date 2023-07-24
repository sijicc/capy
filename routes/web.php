<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\Announcement;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('announcements', AnnouncementController::class);

    Route::group(['middleware' => 'role:admin'], function () {
        Route::resource('roles', RoleController::class);
        Route::resource('settings', SettingController::class);
    });
});

Route::get('/fire', function () {
    Announcement::create([
        'title' => 'Test Announcement',
        'content' => 'This is a test announcement.',
        'should_notify' => true,
        'should_email' => true,
        'publish_at' => now(),
        'user_id' => auth()->user()->id,
    ])->publish();
});
