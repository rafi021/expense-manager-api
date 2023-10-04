<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

    public function category():BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id', 'id')->withDefault();
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
