<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Backend\CategoryController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile',[UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update',[UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::post('/user/password/update',[UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
    Route::get('/user/logout',[UserController::class, 'UserLogout'])->name('user.logout');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Login Admin
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
// Admin Group Middleware
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'adminPassword'])->name('admin.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');

    //Route Category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category/all', 'AllCategory')->name('all.category');
        Route::get('/category/add', 'AddCategory')->name('add.category');
        Route::post('/category/store', 'StoreCategory')->name('store.category');
        Route::post('/category/edit', 'EditCategory')->name('edit.category');
        Route::post('/category/delete', 'UpdateCategory')->name('delete.category');
    });
});

// Instructor Group Middleware
Route::middleware(['auth','role:instructor'])->group(function(){
    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');

    Route::get('/instructor/change/password', [InstructorController::class, 'InstructorPassword'])->name('instructor.password');
    Route::post('/instructor/update/password', [InstructorController::class, 'InstructorUpdatePassword'])->name('instructor.update.password');

});

// User Group Middleware
Route::middleware(['auth','role:user'])->group(function(){

});





