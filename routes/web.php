<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CourseUserController;
use App\Http\Controllers\User\AnswersController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserlistController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//user
Route::middleware('auth', 'userMiddleware')->group(function () {

    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('courses', [CourseUserController::class, 'index'])->name('courses');
    Route::get('courses/{id}', [CourseUserController::class, 'show'])->name('courses.show');
    Route::get('courses/{id}/questions', [CourseUserController::class, 'questions'])->name('courses.questions');
    Route::post('courses/{id}/submit', [AnswersController::class, 'submit'])->name('courses.submit');
    Route::post('courses/{id}/reset', [AnswersController::class, 'reset'])->name('courses.reset');
});

//admin
Route::middleware('auth', 'adminMiddleware')->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('admin/users', [UserlistController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/{id}/edit', [UserlistController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{id}', [UserlistController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/{id}', [UserlistController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('admin/courses', [CoursesController::class, 'index'])->name('admin.courses');
    Route::get('admin/courses/create', [CoursesController::class, 'create'])->name('admin.courses.create');
    Route::post('admin.courses', [CoursesController::class, 'store'])->name('admin.courses.store');
    Route::get('admin/courses/{id}/edit', [CoursesController::class, 'edit'])->name('admin.courses.edit');
    Route::patch('admin.courses/{id}', [CoursesController::class, 'update'])->name('admin.courses.update');
    Route::delete('admin.courses/{id}', [CoursesController::class, 'destroy'])->name('admin.courses.destroy');

});
