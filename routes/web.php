<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CourseController;

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
Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login');
Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])->name('become.instructor');
Route::post('/become/instructor/register', [AdminController::class, 'BecomeInstructorRegister'])->name('become.instructor.register');



// Admin Group Middleware
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'adminPassword'])->name('admin.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');


    /* Instructor Active */
    Route::controller(AdminController::class)->group(function(){
        Route::get('/instructor/all', 'AllInstructor')->name('all.instructor');
        Route::post('/update/user/status', 'UpdateUserStatus')->name('update.user.status');
        Route::get('/instructor/add', 'AddInstructor')->name('add.instructor');
    });

    //Route Category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category/all', 'AllCategory')->name('all.category');
        Route::get('/category/add', 'AddCategory')->name('add.category');
        Route::post('/category/store', 'StoreCategory')->name('store.category');
        Route::get('/category/edit/{id}', 'EditCategory')->name('edit.category');
        Route::post('/category/update', 'UpdateCategory')->name('update.category');
        Route::get('/category/delete/{id}', 'DeleteCategory')->name('delete.category');
    });

    // Sub Category
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/subcategory/all', 'AllSubCategory')->name('all.subcategory');
        Route::get('/subcategory/add', 'AddSubCategory')->name('add.subcategory');
        Route::post('/subcategory/store', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/subcategory/edit/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/subcategory/update', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/subcategory/delete/{id}', 'DeleteSubCategory')->name('delete.subcategory');

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

    // Course Group Middleware
    Route::controller(CourseController::class)->group(function(){
        Route::get('/course/all', 'AllCourse')->name('all.course');
        Route::get('/course/add', 'AddCourse')->name('add.course');

        Route::get('/subcategory/ajax/{category_id}','GetSubCategory');

        Route::post('/course/store', 'StoreCourse')->name('store.course');
        Route::get('/course/edit/{id}', 'EditCourse')->name('edit.course');
        Route::post('/course/update', 'UpdateCourse')->name('update.course');
        Route::get('/course/delete/{id}', 'DeleteCourse')->name('delete.course');
        Route::post('/update/course/image','UpdateCourseImage')->name('update.course.image');
        Route::post('/update/course/video','UpdateCourseVideo')->name('update.course.video');
        Route::post('/update/course/goal','UpdateCourseGoal')->name('update.course.goal');

    });

    // Course Section and Lecture All Route
    Route::controller(CourseController::class)->group(function(){
    Route::get('/add/course/lecture/{id}','AddCourseLecture')->name('add.course.lecture');
    Route::post('/add/course/section/','AddCourseSection')->name('add.course.section');


    Route::get('/edit/lecture/{id}','EditLecture')->name('edit.lecture');
    Route::post('/update/course/lecture','UpdateCourseLecture')->name('update.course.lecture');
    Route::get('/delete/lecture/{id}','DeleteLecture')->name('delete.lecture');
    Route::post('/delete/section/{id}','DeleteSection')->name('delete.section');
});


});

// User Group Middleware
Route::middleware(['auth','role:user'])->group(function(){

});





