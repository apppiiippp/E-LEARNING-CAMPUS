<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CoursesController;
use App\Http\Controllers\API\ReportsController;
use App\Http\Controllers\API\MaterialsController;
use App\Http\Controllers\API\AssignmentsController;
use App\Http\Controllers\API\DiscussionsController;
use App\Http\Controllers\API\SubmissionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {

    //Courses Routes
    Route::get('courses', [CoursesController::class, 'index']);
    Route::post('courses', [CoursesController::class, 'createCourses']);
    Route::put('courses/{id}', [CoursesController::class, 'updateCourses']);
    Route::delete('courses/{id}', [CoursesController::class, 'deleteCourses']);
    Route::post('courses/{id}/enroll', [CoursesController::class, 'enrollCourse']);

    //Materials Routes
    Route::post('materials', [MaterialsController::class, 'materials']);
    Route::get('materials/{id}/download', [MaterialsController::class, 'downloadMaterial']);

    //Assignments Routes
    Route::post('assignments', [AssignmentsController::class, 'createAssignment']);

    //Submissions Routes
    Route::post('submissions', [SubmissionsController::class, 'createdSubmissions']);
    Route::post('submissions/{id}/grade', [SubmissionsController::class, 'gradeSubmissions']);

    //discussions routes
    Route::post('discussions', [DiscussionsController::class, 'discussions']);
    Route::post('discussions/{id}/replies', [DiscussionsController::class, 'replies']);

    // report routes
    Route::get('reports/courses', [ReportsController::class, 'reportCourses']);
    Route::get('reports/assignments', [ReportsController::class, 'reportsGraded']);
    Route::get('reports/student/{id}', [ReportsController::class, 'reportStudent']);
});
