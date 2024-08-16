<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvailableJobController;
use App\Http\Controllers\CompanyController;
use App\Models\AvailableJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/jobs', [AvailableJobController::class, 'index']);



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->post('/logout', [AuthController::class, 'logout']);
Route::middleware(['auth:sanctum'])->post('/avatar', [AuthController::class, 'storeProfile']);
Route::middleware(['auth:sanctum'])->post('/about', [AuthController::class, 'storeAbout']);
Route::middleware(['auth:sanctum'])->post('/jobs/save', [AvailableJobController::class, 'saveJobs']);
Route::middleware(['auth:sanctum'])->post('/jobs/remove', [AvailableJobController::class, 'removeJobs']);
Route::middleware(['auth:sanctum'])->get('/jobs/savedJobs', [AvailableJobController::class, 'getSavedJobs']);
Route::middleware(['auth:sanctum'])->post('/jobs/store', [AvailableJobController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/jobs/store', [CompanyController::class, 'store']);
Route::get('/test', function () {
    return response([
        'name' => "John Anamboi",
        "happy" => true,
        "friend" => "only Christopher"
    ]);
});
