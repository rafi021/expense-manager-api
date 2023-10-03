<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;
use App\DataTransferObjects\ExpenseCategoryDTO;
use App\Services\Expense\ExpenseCategoryService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyExpenseCategoryList = [
            'Rent',
            'Bill',
            'Utility',
            'Others'
        ];

        foreach ($dummyExpenseCategoryList as $expense) {
            ExpenseCategory::create([
                'title' => $expense,
                'slug' =>  Str::slug($expense),
            ]);
        }
    }
}
