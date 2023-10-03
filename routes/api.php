<?php

use App\Http\Controllers\Api\ExpenseCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* If we need authentication then uncomment the middleware section */

// Route::middleware(['auth:sanctum'])->group(function(){
    /* Expense Category */
    Route::apiResource('expense-category', ExpenseCategoryController::class)->except(['destroy']);
// });
