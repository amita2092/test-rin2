<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/user-settings', [ProfileController::class, 'editUserNotificationSetting'])->name('profile.settings');

    Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('/notification/add', [NotificationController::class, 'add'])->name('notification.add');
    Route::post('/notification/store', [NotificationController::class, 'store'])->name('notification.store');

    Route::get('/notification/show', [NotificationController::class, 'show'])->name('notification.show');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
     ->name('notifications.markAsRead');

    Route::get('/notification/count', [NotificationController::class, 'getUnreadCount'])->name('notifications.count');
});

require __DIR__.'/auth.php';
