<?php

namespace App\Http\Resources;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'expense_id' => $this->id,
            'expense_id' => $this->id,
            'expense_category_id' => $this->expense_category_id,
            'expense_amount' => $this->amount,
            'expense_date' => Carbon::parse($this->date)->format('d M Y'),
            'expense_notes' => $this->notes,
            'create_date' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
