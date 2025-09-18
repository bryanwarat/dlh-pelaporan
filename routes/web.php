<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


//Public

Route::get('/', [App\Http\Controllers\Public\HomeController::class, 'index'])->name('public.home');

Route::get('/aduan', [App\Http\Controllers\Public\ComplaintController::class, 'index'])->name('public.complaint');
Route::post('/aduan/store', [App\Http\Controllers\Public\ComplaintController::class, 'store'])->name('public.complaint.store');


//Admin

Route::middleware(['auth'])->group(function () {
   
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');
    
    Route::get('/admin/berita', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('admin.news.index');
    
    Route::get('/admin/aduan', [App\Http\Controllers\Admin\ComplaintController::class, 'index'])->name('admin.complaint.index');
    Route::get('/admin/aduan/detail/{id}', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintDetail'])->name('admin.complaint.detail');

    Route::get('/admin/aduan/kategori', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategory'])->name('admin.complaint.category.index');
    Route::get('/admin/aduan/kategori/tambah', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryCreate'])->name('admin.complaint.category.create');
    Route::post('/admin/aduan/kategori/store', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryStore'])->name('admin.complaint.category.store');

});


