<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
    'login' => true,
    'register' => false,
    'reset' => true,
    'verify' => true,
]);


//Public

Route::get('/', [App\Http\Controllers\Public\HomeController::class, 'index'])->name('public.home');

Route::get('/lapor', [App\Http\Controllers\Public\ComplaintController::class, 'index'])->name('public.complaint');
Route::post('/lapor/store', [App\Http\Controllers\Public\ComplaintController::class, 'store'])->name('public.complaint.store');
Route::get('/informasi', [App\Http\Controllers\Public\HomeController::class, 'informationIndex'])->name('public.information.index');
Route::get('/informasi/{slug}', [App\Http\Controllers\Public\HomeController::class, 'informationDetail'])->name('public.information.detail');
Route::get('/laporan-masuk', [App\Http\Controllers\Public\ComplaintController::class, 'statusIndex'])->name('public.complaint.status.index');
Route::get('/pelaporan/{id}', [App\Http\Controllers\Public\ComplaintController::class, 'statusShow'])->name('public.complaint.status.show');



//Admin

Route::middleware(['auth'])->group(function () {
   
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');
    

    Route::get('/admin/news', [NewsController::class, 'index'])->name('admin.news.index');
    Route::get('/admin/news/data', [NewsController::class, 'getData'])->name('admin.news.data');
    Route::get('/admin/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/admin/news/store', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/admin/news/{id}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/admin/news/{id}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::get('/admin/news/{id}', [NewsController::class, 'detail'])->name('admin.news.detail');
    Route::delete('/admin/news/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

    
    Route::get('/admin/pelaporan', [App\Http\Controllers\Admin\ComplaintController::class, 'index'])->name('admin.complaint.index');
    Route::get('/admin/pelaporan/detail/{id}', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintDetail'])->name('admin.complaint.detail');
    Route::get('/admin/pelaporan/data', [App\Http\Controllers\Admin\ComplaintController::class, 'getData'])->name('admin.complaint.data');
    Route::put('/admin/pelaporan/history/{id}', [App\Http\Controllers\Admin\ComplaintController::class, 'updateHistoryNote'])->name('admin.complaint.history.update');
    Route::put('/admin/aduan/update-status/{id}', [App\Http\Controllers\Admin\ComplaintController::class, 'updateStatus'])->name('admin.complaint.update_status');

    // COMPLAINT CATEGORY
    Route::get('/admin/pelaporan/kategori', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategory'])->name('admin.complaint.category.index');
    Route::get('/admin/pelaporan/kategori/data', [App\Http\Controllers\Admin\ComplaintController::class, 'getCategoryData'])->name('admin.complaint.category.data');
    Route::get('/admin/pelaporan/kategori/tambah', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryCreate'])->name('admin.complaint.category.create');
    Route::post('/admin/pelaporan/kategori/store', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryStore'])->name('admin.complaint.category.store');
    Route::get('/admin/pelaporan/kategori/{id}/edit', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryEdit'])->name('admin.complaint.category.edit');
    Route::put('/admin/pelaporan/kategori/{id}', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryUpdate'])->name('admin.complaint.category.update');
    Route::delete('/admin/pelaporan/kategori/{id}', [App\Http\Controllers\Admin\ComplaintController::class, 'complaintCategoryDestroy'])->name('admin.complaint.category.destroy');


    // Manajemen Pengguna (User)
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/data', [UserController::class, 'usersData'])->name('admin.users.data');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});




