<?php

use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FreelancerController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", [UserController::class, "userLogin"]);


Route::group(["prefix" => "/admin"], function () {
  
    Route::get('/', [UserController::class, "login"])->name("login");
  
    Route::post('/auth', [UserController::class, "auth"])->name("admin.auth");
  
    Route::get('/logout', function () {
        request()->session()->regenerate();
        auth()->logout();
        request()->session()->regenerateToken();
        return redirect()->route("login");
    })->name("admin.logout");

    Route::group(['middleware' => ['auth:web']], function () {

        Route::get('/dashboard', [DashboardController::class, "index"])->name("admin.dashboard");

        Route::group(["prefix" => "users"], function () {

            Route::get('/', [UserController::class, "index"])->name("admin.users.index");
    
            Route::get('/create', [UserController::class, "create"])->name("admin.users.create");
           
            Route::get('/export', [UserController::class, "export"])->name("admin.users.export");

            Route::get('/create/{id}', [UserController::class, "show"])->name("admin.users.show");

            Route::post('/', [UserController::class, "store"])->name("admin.users.store");

            Route::post('/{id}', [UserController::class, "update"])->name("admin.users.update");

            Route::get('/remove/{id}', [UserController::class, "remove"])->name("admin.users.remove");

        });


        Route::group(["prefix" => "freelancers"], function () {

            Route::get('/', [FreelancerController::class, "index"])->name("admin.freelancers.index");
    
            Route::get('/create', [FreelancerController::class, "create"])->name("admin.freelancers.create");
            
            Route::get('/create/{id}', [FreelancerController::class, "show"])->name("admin.freelancers.show");

            Route::post('/', [FreelancerController::class, "store"])->name("admin.freelancers.store");

            Route::post('/{id}', [FreelancerController::class, "update"])->name("admin.freelancers.update");

            Route::get('/image/remove/{id}', [FreelancerController::class, "removeImage"])->name("admin.freelancers.remove.image");

            Route::get('/remove/{id}', [FreelancerController::class, "remove"])->name("admin.freelancers.remove");

        });


        Route::group(["prefix" => "movies"], function () {

            Route::get('/', [MovieController::class, "index"])->name("admin.movies.index");
    
            Route::get('/create', [MovieController::class, "create"])->name("admin.movies.create");
            
            Route::get('/create/{id}', [MovieController::class, "show"])->name("admin.movies.show");

            Route::post('/', [MovieController::class, "store"])->name("admin.movies.store");

            Route::post('/{id}', action: [MovieController::class, "update"])->name("admin.movies.update");

            Route::get('/image/remove/{id}', [MovieController::class, "removeImage"])->name("admin.movies.remove.image");

            Route::get('/remove/{id}', [MovieController::class, "remove"])->name("admin.movies.remove");

        });

        Route::group(["prefix" => "genres"], function () {

            Route::get('/', [GenreController::class, "index"])->name("admin.genres.index");
    
            Route::get('/create', [GenreController::class, "create"])->name("admin.genres.create");
            
            Route::get('/create/{id}', [GenreController::class, "show"])->name("admin.genres.show");

            Route::post('/', [GenreController::class, "store"])->name("admin.genres.store");

            Route::post('/{id}', [GenreController::class, "update"])->name("admin.genres.update");

            Route::get('/remove/{id}', [GenreController::class, "remove"])->name("admin.genres.remove");

        });


        Route::group(["prefix" => "sliders"], function () {

            Route::get('/', [SliderController::class, "index"])->name("admin.sliders.index");
    
            Route::get('/create', [SliderController::class, "create"])->name("admin.sliders.create");
            
            Route::get('/create/{id}', [SliderController::class, "show"])->name("admin.sliders.show");

            Route::post('/', [SliderController::class, "store"])->name("admin.sliders.store");

            Route::post('/{id}', [SliderController::class, "update"])->name("admin.sliders.update");

            Route::get('/image/remove/{id}', [SliderController::class, "removeImage"])->name("admin.sliders.remove.image");

            Route::get('/remove/{id}', [SliderController::class, "remove"])->name("admin.sliders.remove");

        });
        

        Route::group(["prefix" => "event-categories"], function () {

            Route::get('/', [EventCategoryController::class, "index"])->name("admin.event_categories.index");
    
            Route::get('/create', [EventCategoryController::class, "create"])->name("admin.event_categories.create");
            
            Route::get('/create/{id}', [EventCategoryController::class, "show"])->name("admin.event_categories.show");

            Route::post('/', [EventCategoryController::class, "store"])->name("admin.event_categories.store");

            Route::post('/{id}', [EventCategoryController::class, "update"])->name("admin.event_categories.update");

            Route::get('/remove/{id}', [EventCategoryController::class, "remove"])->name("admin.event_categories.remove");

        });



        Route::group(["prefix" => "events"], function () {

            Route::get('/', [EventController::class, "index"])->name("admin.events.index");
    
            Route::get('/create', [EventController::class, "create"])->name("admin.events.create");
            
            Route::get('/create/{id}', [EventController::class, "show"])->name("admin.events.show");

            Route::post('/', [EventController::class, "store"])->name("admin.events.store");

            Route::post('/{id}', [EventController::class, "update"])->name("admin.events.update");

            Route::get('/image/remove/{id}', [EventController::class, "removeImage"])->name("admin.events.remove.image");

            Route::get('/remove/{id}', [EventController::class, "remove"])->name("admin.events.remove");

            Route::get('/requests', [EventController::class, "requests"])->name("admin.events.requests");

        });

        Route::group(["prefix" => "product-categories"], function () {

            Route::get('/', [ProductCategoryController::class, "index"])->name("admin.product_categories.index");
    
            Route::get('/create', [ProductCategoryController::class, "create"])->name("admin.product_categories.create");
            
            Route::get('/create/{id}', [ProductCategoryController::class, "show"])->name("admin.product_categories.show");

            Route::post('/', [ProductCategoryController::class, "store"])->name("admin.product_categories.store");

            Route::post('/{id}', [ProductCategoryController::class, "update"])->name("admin.product_categories.update");

            Route::get('/remove/{id}', [ProductCategoryController::class, "remove"])->name("admin.product_categories.remove");

        });


        Route::group(["prefix" => "products"], function () {

            Route::get('/', [ProductController::class, "index"])->name("admin.products.index");
    
            Route::get('/create', [ProductController::class, "create"])->name("admin.products.create");
            
            Route::get('/create/{id}', [ProductController::class, "show"])->name("admin.products.show");

            Route::post('/', [ProductController::class, "store"])->name("admin.products.store");

            Route::post('/{id}', [ProductController::class, "update"])->name("admin.products.update");

            Route::get('/image/remove/{id}', [ProductController::class, "removeImage"])->name("admin.products.remove.image");

            Route::get('/remove/{id}', [ProductController::class, "remove"])->name("admin.products.remove");

        });


        Route::group(["prefix" => "course-categories"], function () {

            Route::get('/', [CourseCategoryController::class, "index"])->name("admin.course_categories.index");
    
            Route::get('/create', [CourseCategoryController::class, "create"])->name("admin.course_categories.create");
            
            Route::get('/create/{id}', [CourseCategoryController::class, "show"])->name("admin.course_categories.show");

            Route::post('/', [CourseCategoryController::class, "store"])->name("admin.course_categories.store");

            Route::post('/{id}', [CourseCategoryController::class, "update"])->name("admin.course_categories.update");

            Route::get('/remove/{id}', [CourseCategoryController::class, "remove"])->name("admin.course_categories.remove");

        });




        Route::group(["prefix" => "courses"], function () {

            Route::get('/', [CourseController::class, "index"])->name("admin.courses.index");
    
            Route::get('/create', [CourseController::class, "create"])->name("admin.courses.create");
            
            Route::get('/create/{id}', [CourseController::class, "show"])->name("admin.courses.show");

            Route::post('/', [CourseController::class, "store"])->name("admin.courses.store");

            Route::post('/{id}', [CourseController::class, "update"])->name("admin.courses.update");

            Route::get('/image/remove/{id}', [CourseController::class, "removeImage"])->name("admin.courses.remove.image");

            Route::get('/remove/{id}', [CourseController::class, "remove"])->name("admin.courses.remove");

        });


        Route::group(["prefix" => "lessons"], function () {

            Route::get('/', [LessonController::class, "index"])->name("admin.lessons.index");
    
            Route::get('/create', [LessonController::class, "create"])->name("admin.lessons.create");
            
            Route::get('/create/{id}', [LessonController::class, "show"])->name("admin.lessons.show");

            Route::post('/', [LessonController::class, "store"])->name("admin.lessons.store");

            Route::post('/{id}', [LessonController::class, "update"])->name("admin.lessons.update");

            Route::get('/remove/{id}', [LessonController::class, "remove"])->name("admin.lessons.remove");

        });


    });
});
