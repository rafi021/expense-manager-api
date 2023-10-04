<?php

namespace App\Http\Resources;

use App\Models\Expense;
use App\Services\Expense\ExpenseService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'expense_category_id' => $this->id,
            'expense_category_title' => $this->title,
            'expense_category_slug' => $this->slug,
            'stored_date' => $this->created_at->format('Y-m-d H:i'),
            'expense_percentage' => (new ExpenseService())->categoryWiseTotalExpensePercentage($this->id),
            'expenses' => $this->expenses
        ];
    }
}
