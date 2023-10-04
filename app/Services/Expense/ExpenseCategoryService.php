<?php

namespace App\Services\Expense;

use Illuminate\Support\Str;
use App\Models\ExpenseCategory;
use App\DataTransferObjects\ExpenseCategoryDTO;

class ExpenseCategoryService
{
    public function index()
    {
        $data = ExpenseCategory::with(['expenses'])->latest()->get();
        return $this->mapDataProcess($data);
    }

    public function show(string $id)
    {
        return ExpenseCategory::with(['expenses'])->findOrFail($id);
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

    public function mapDataProcess($data){
        $expense_service = new ExpenseService();

        return $data->map(fn($category) => [
            'expense_category_id' => $category->id,
            'expense_title' => $category->title,
            'expense_slug' => $category->slug,
            'expense_percentage' => $expense_service->categoryWiseTotalExpensePercentage($category->id),
            'expenses' => $category->expenses,
        ]);
    }
}
