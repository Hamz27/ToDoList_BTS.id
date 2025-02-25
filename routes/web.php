<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ItemChecklistController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::resource('checklists', ChecklistController::class)->except(['edit', 'update']);
    Route::resource('checklists.items', ItemChecklistController::class)->except(['edit', 'update']);
});

