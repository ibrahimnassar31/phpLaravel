<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::middleware('api')->prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/', [TaskController::class, 'store']);
    Route::get('/{id}', [TaskController::class, 'show']);
    Route::put('/{id}', [TaskController::class, 'update']);
    Route::delete('/{id}', [TaskController::class, 'destroy']); 
});

