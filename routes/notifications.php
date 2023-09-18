<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;

Route::get('/t', [NotificationController::class, 'test'])->name('test-n')->middleware('auth');
Route::get('/notifications/user/all', [NotificationController::class, 'forUser'])->name('notifications.user')->middleware('auth');
Route::post('notifications/{notification}/mark-as-unread', [NotificationController::class, 'markAsUnread'])
    ->name('notifications.markAsUnread');

Route::resource('notifications', NotificationController::class)->middleware(['auth', 'can_manage_notifications'])->except('show')->name('notifications', 'notifications.index');
//notifications.show
Route::get('/notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show')->middleware('auth');

//errors
Route::get('/errors', function () {
    return view('errors.index');
})->name('errors');

Route::post('/set-theme', [ThemeController::class, 'setTheme'])->name('set-theme');
Route::get('/get-theme', [ThemeController::class, 'getTheme'])->name('get-theme');
