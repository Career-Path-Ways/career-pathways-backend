<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvailableJobController;
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

Route::get('/test', function () {
    return response([
        'name' => "John Anamboi",
        "happy" => true,
        "friend" => "only Christopher"
    ]);
});
