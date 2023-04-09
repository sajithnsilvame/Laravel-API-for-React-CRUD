<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::post('/student', [StudentController::class, 'store']);
Route::get('/students', [StudentController::class, 'index']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::get('student/{id}/edit', [StudentController::class, 'edit']);
Route::put('student/{id}/update', [StudentController::class, 'update']);
Route::delete('student/{id}/delete', [StudentController::class, 'destroy']);

Route::apiResource('students',StudentController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});