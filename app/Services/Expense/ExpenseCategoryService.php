<?php

namespace App\Services\Expense;

use Illuminate\Support\Str;
use App\Models\ExpenseCategory;
use App\DataTransferObjects\ExpenseCategoryDTO;

class ExpenseCategoryService
{
    public function index()
    {
        return ExpenseCategory::latest()->get();
    }

    public function show(string $id)
    {
        return ExpenseCategory::findOrFail($id);
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
            'slug' => Str::slug($expenseCategoryDTO->title),
        ]);
    }

    public function delete(string $id)
    {
        return $this->show($id)->delete();
    }
}
