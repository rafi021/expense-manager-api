<?php

namespace App\Services\Expense;

use Illuminate\Support\Str;
use App\Models\ExpenseCategory;
use App\DataTransferObjects\ExpenseCategoryDTO;
use App\Interfaces\BaseInterface;

class ExpenseCategoryService
{
    public function index()
    {
        return ExpenseCategory::latest()->get();
    }

    public function show(ExpenseCategory $expenseCategory)
    {
        return $expenseCategory;
    }

    public function store(ExpenseCategoryDTO $expenseCategoryDTO)
    {
        return ExpenseCategory::create([
            'title' => $expenseCategoryDTO->title,
            'slug' =>  Str::slug($expenseCategoryDTO->title),
        ]);
    }

    public function update(ExpenseCategory $expenseCategory, ExpenseCategoryDTO $expenseCategoryDTO)
    {
        return tap($expenseCategory)->update([
            'title' => $expenseCategoryDTO->title,
            'slug' =>  Str::slug($expenseCategoryDTO->title),
        ]);
    }




}
