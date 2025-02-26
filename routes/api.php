<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ItemController;

/**
 * Route untuk Register
 * @method "POST"
 */
Route::post('/register', [AuthController::class, 'register'])->name('register');

/**
 * Route untuk Login
 * @method "POST"
 */
Route::post('/login', [AuthController::class, 'login'])->name('login');

/**
 * Route untuk Logout
 * @method "POST"
 */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





// Checklist Routes
Route::middleware('auth:api')->post('/checklist', [ChecklistController::class, 'create']);
Route::middleware('auth:api')->delete('/checklist/{id}', [ChecklistController::class, 'delete']);
Route::middleware('auth:api')->get('/checklists', [ChecklistController::class, 'index']);
Route::middleware('auth:api')->get('/checklist/{id}', [ChecklistController::class, 'show']);

// Item Routes
Route::middleware('auth:api')->post('/checklist/{checklistId}/items', [ItemController::class, 'create']);
Route::middleware('auth:api')->get('/item/{id}', [ItemController::class, 'show']);
Route::middleware('auth:api')->put('/item/{id}', [ItemController::class, 'update']);
Route::middleware('auth:api')->put('/item/{id}/status', [ItemController::class, 'updateStatus']);
Route::middleware('auth:api')->delete('/item/{id}', [ItemController::class, 'delete']);

