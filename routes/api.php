<?php

use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* If we need authentication then uncomment the middleware section */

Route::post('/login', [LoginController::class, 'login']);

// Route::middleware(['auth:sanctum'])->group(function(){
    /* Expense Category */
    Route::apiResource('expense-category', ExpenseCategoryController::class);
    Route::apiResource('expenses', ExpenseController::class);
// });
