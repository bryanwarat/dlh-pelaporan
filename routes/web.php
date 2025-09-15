<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::get('/news', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('admin.news.index');

Route::get('/complaint', [App\Http\Controllers\Admin\ComplaintController::class, 'index'])->name('admin.complaint.index');

