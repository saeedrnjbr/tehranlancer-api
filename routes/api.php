<?php

use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FreelancerController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/movies', [MovieController::class, "movies"]);
Route::get('/sliders', [SliderController::class, "sliders"]);
Route::get('/events', [EventController::class, "events"]);
Route::post('/events/request', [EventController::class, "storeEvent"]);
Route::get('/events/{id}', [EventController::class, "showEvent"]);
Route::get('/movies/{id}', [MovieController::class, "showMovie"]);
Route::get('/event-categories', [EventCategoryController::class, "categories"]);
Route::get('/course-categories', [CourseCategoryController::class, "categories"]);
Route::get('/course-categories/tree', [CourseCategoryController::class, "tree"]);
Route::get('/course-categories/{id}/courses', [CourseCategoryController::class, "showCourses"]);
Route::get('/course-categories/{id}', [CourseCategoryController::class, "showCourseCategory"]);
Route::get('/courses', [CourseController::class, "courses"]);
Route::get('/courses/{id}', [CourseController::class, "showCourse"]);
Route::get('/courses/{id?}/lessons', [CourseController::class, "lessons"]);
Route::get('/lessons/{id}', [LessonController::class, "showLesson"]);
Route::get('/freelancers', [FreelancerController::class, "freelancers"]);
Route::get('/product-categories', [ProductCategoryController::class, "categories"]);
Route::get('/product-categories/{id}', [ProductCategoryController::class, "showCategory"]);
Route::get('/products', [ProductController::class, "products"]);
Route::get('/products/{id}', [ProductController::class, "showProduct"]);
Route::post('/users/login', [UserController::class, "userAuth"]);
Route::post('/users/web-login', [UserController::class, "userAuthWeb"])->name("user.auth");
Route::post('/users/verify', [UserController::class, "userVerify"]);
Route::middleware("jwt")->group(function(){
    Route::get('/users/current', [UserController::class, "current"]);
    Route::get('/freelancers/level', [FreelancerController::class, "showLevel"]);
    Route::post('/freelancers/level', [FreelancerController::class, "level"]);
});
Route::post('/freelancers/request', [FreelancerController::class, "request"]);
Route::get('/freelancers/{id}', [FreelancerController::class, "showFreelancer"]);
