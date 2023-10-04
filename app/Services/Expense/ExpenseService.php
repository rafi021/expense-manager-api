<?php

namespace App\Services\Expense;

use App\Models\Expense;

class ExpenseService
{
    public function calculateTotalExpense(){
        return Expense::sum('amount');
    }

    public function categoryWiseTotalExpensePercentage(string $category_id){
        $total_expense = $this->calculateTotalExpense();
        if($total_expense>0){
            return round((Expense::where('expense_category_id', $category_id)->sum('amount')*100)/$total_expense, 2);
        }
        return 0;
    }
}
