<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


//Public

Route::get('/', [App\Http\Controllers\Public\HomeController::class, 'index'])->name('public.home');

Route::get('/lapor', [App\Http\Controllers\Public\ComplaintController::class, 'index'])->name('public.complaint');
Route::post('/lapor/store', [App\Http\Controllers\Public\ComplaintController::class, 'store'])->name('public.complaint.store');


//Admin

Route::middleware(['auth'])->group(function () {
   
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');
    

    Route::get('/admin/news', [NewsController::class, 'index'])->name('admin.news.index');
Route::get('/admin/news/data', [NewsController::class, 'getData'])->name('admin.news.data');
Route::get('/admin/news/create', [NewsController::class, 'create'])->name('admin.news.create');
Route::post('/admin/news/store', [NewsController::class, 'store'])->name('admin.news.store');
Route::get('/admin/news/{id}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
Route::put('/admin/news/{id}', [NewsController::class, 'update'])->name('admin.news.update');
Route::get('/admin/news/{id}', [NewsController::class, 'show'])->name('admin.news.show');
Route::delete('/admin/news/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

    
    Route::get('/admin/aduan', [App\Http\Controllers\Admin\ComplaintController::class, 'index'])->name('admin.complaint.index');
    Route::get('/admin/aduan/detail/{id}', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintDetail'])->name('admin.complaint.detail');
    Route::get('/admin/aduan/data', [App\Http\Controllers\Admin\ComplaintController::class, 'getData'])->name('admin.complaint.data');


    // COMPLAINT CATEGORY
    Route::get('/admin/aduan/kategori', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategory'])->name('admin.complaint.category.index');
    Route::get('/admin/aduan/kategori/data', [App\Http\Controllers\Admin\ComplaintController::class, 'getCategoryData'])->name('admin.complaint.category.data');
    Route::get('/admin/aduan/kategori/tambah', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryCreate'])->name('admin.complaint.category.create');
    Route::post('/admin/aduan/kategori/store', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryStore'])->name('admin.complaint.category.store');
    Route::get('/admin/aduan/kategori/{id}/edit', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryEdit'])->name('admin.complaint.category.edit');
    Route::put('/admin/aduan/kategori/{id}', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryUpdate'])->name('admin.complaint.category.update');
    Route::delete('/admin/aduan/kategori/{id}', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryDestroy'])->name('admin.complaint.category.destroy');


});


