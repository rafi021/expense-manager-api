<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Support\Str;
use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyExpenseList = collect([
            [
                'expense_category_id' => 1, // rent
                'user_id' => 1,
                'amount' => 10000,
                'date' => '2023-10-01',
                'notes' => 'give house rent',
            ],
            [
                'expense_category_id' => 2, // rent
                'user_id' => 1,
                'amount' => 15000,
                'date' => '2023-10-02',
                'notes' => 'give ofice rent',
            ],
            [
                'expense_category_id' => 3, // bill
                'user_id' => 1,
                'amount' => 5200,
                'date' => '2023-10-03',
                'notes' => '',
            ],
            [
                'expense_category_id' => 4, // other
                'user_id' => 1,
                'amount' => 290,
                'date' => '2023-10-04',
                'notes' => '',
            ],
        ]);

        foreach ($dummyExpenseList as $expense) {
            Expense::create([
                'expense_category_id' => $expense['expense_category_id'],
                'user_id' => $expense['user_id'],
                'amount' =>  $expense['amount'],
                'date' => $expense['date'],
                'notes' =>  $expense['notes'],
            ]);
        }
    }
}
