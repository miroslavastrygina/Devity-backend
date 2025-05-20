<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\TestResultController;
use App\Http\Controllers\TestQuestionController;
use App\Http\Controllers\AssignmentSubmissionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post("/login", "login");
    Route::post("/register", "register");
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::post("/update/{id}", "update");
    });


    Route::controller(CourseController::class)->prefix('courses')->group(function () {
        Route::get("/", "index");
        Route::get('/{id}', 'show');
        Route::delete('/{id}', 'delete');
        Route::post('/create', 'create');
        Route::put('/{id}', 'update');
    });

    Route::controller(BlockController::class)->prefix('blocks')->group(function () {
        Route::get("/", "index");
        Route::get('/{id}', 'show');
        Route::delete('/{id}', 'delete');
        Route::put('/{id}', 'update');
        Route::post('/create', 'create');
    });

    Route::controller(GroupController::class)
        ->middleware('auth:sanctum')
        ->prefix('groups')
        ->group(function () {
            Route::get("/", "index");
            Route::get('/{id}', 'show');
            Route::delete('/{id}', 'delete');
            Route::put('/{id}', 'update');
            Route::post('/create', 'create');
            Route::get('/attach/{id}', 'attachToGroup');
        });

    Route::controller(LessonController::class)->prefix('lessons')->group(function () {
        Route::get("/", "index");
        Route::get('/{id}', 'show');
        Route::delete('/{id}', 'delete');
        Route::put('/{id}', 'update');
        Route::post('/create', 'create');
    });

    Route::controller(TestController::class)->prefix('tests')->group(function () {
        Route::get("/", "index");
        Route::get('/{id}', 'show');
        Route::delete('/{id}', 'delete');
        Route::put('/{id}', 'update');
        Route::post('/create', 'create');
    });

    Route::controller(TestQuestionController::class)->prefix('tests-question')->group(function () {
        Route::get("/", "index");
        Route::get('/{id}', 'show');
        Route::delete('/{id}', 'delete');
        Route::put('/{id}', 'update');
        Route::post('/create', 'create');
    });

    Route::controller(TestResultController::class)->prefix('tests-result')->group(function () {
        Route::get("/", "index");
        Route::get('/{id}', 'show');
        Route::delete('/{id}', 'delete');
        Route::put('/{id}', 'update');
        Route::post('/create', 'create');
    });

    Route::controller(AssignmentController::class)->prefix('assignment')->group(function () {
        Route::get("/", "index");
        Route::get('/{id}', 'show');
        Route::delete('/{id}', 'delete');
        Route::put('/{id}', 'update');
        Route::post('/create', 'create');
    });

    Route::controller(AssignmentSubmissionController::class)->prefix('assignment-submission')->group(function () {
        Route::get("/", "index");
        Route::get('/{id}', 'show');
        Route::delete('/{id}', 'delete');
        Route::put('/{id}', 'update');
        Route::post('/create', 'create');
        Route::get(
            '/grades-by-student/{id}',
            'getGradesByStudent'
        );
    });
});
