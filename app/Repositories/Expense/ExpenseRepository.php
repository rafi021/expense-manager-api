<?php

namespace App\Repositories\Expense;

use Carbon\Carbon;
use App\Models\Expense;
use App\Http\Resources\ExpenseCategoryResource;
use App\Http\Resources\ExpenseResource;

class ExpenseRepository implements ExpenseInterface
{
    /*
    * @param $data
    * @return mixed|void
    */
    public function store($request_data)
    {
        $data = Expense::create([
            'expense_category_id' => $request_data->validated('expense_category_id'),
            'user_id' => $request_data->validated('user_id'),
            'amount' =>  $request_data->validated('amount'),
            'date' => $request_data->validated('date') ?? Carbon::now()->format('Y-m-d'),
            'notes' =>  $request_data->validated('notes'),
        ]);

        return $this->show($data->id);
    }

    /*
    * @retun mixed|void
    */

    public function all()
    {
        $sortColumn = request('sort_column','date');
        if(!in_array($sortColumn, ['id','date','amount'])){
            $sortColumn = 'date';
        }

        $sortBy = request('sort_by','desc');
        if(!in_array($sortBy, ['asc','desc'])){
            $sortBy = 'desc';
        }

        $data = Expense::select(['id', 'amount', 'user_id', 'expense_category_id','date', 'created_at'])
        ->with(['category:id,title,slug,created_at'])
        ->when(request('expense_category_id'), function ($query) {
            $query->where(['expense_category_id' => request('expense_category_id')]);
        })
        ->when(request('start_date'), function ($query) {
            $query->where('date', '>=', request('start_date'));
        })
        ->when(request('end_date'), function ($query) {
            $query->where('date', '<=', request('end_date'));
        })
        ->orderBy($sortColumn, $sortBy)
        ->get();
        $mapped_expenses = $this->mapDataProcess($data);
        return $mapped_expenses;
    }

    /*
    * @retun mixed|void
    */

    public function allPaginate($perPage)
    {
        $sortColumn = request('sort_column','date');
        if(!in_array($sortColumn, ['id','date','amount'])){
            $sortColumn = 'date';
        }

        $sortBy = request('sort_by','desc');
        if(!in_array($sortBy, ['asc','desc'])){
            $sortBy = 'desc';
        }

        $data = Expense::select(['id', 'amount', 'user_id', 'expense_category_id','date', 'created_at'])
        ->with(['category:id,title,slug,created_at'])
        ->when(request('expense_category_id'), function ($query) {
            $query->where(['expense_category_id' => request('expense_category_id')]);
        })
        ->when(request('start_date'), function ($query) {
            $query->where('date', '>=', request('start_date'));
        })
        ->when(request('end_date'), function ($query) {
            $query->where('date', '<=', request('end_date'));
        })
        ->orderBy($sortColumn, $sortBy)
        ->paginate($perPage);

        $mapped_expenses = $this->mapDataProcess($data);
        return $mapped_expenses;
    }

    /*
    * @retun mixed|void
    */

    public function show($slug)
    {
        return Expense::with(['category:id,title,slug,created_at'])->findOrFail($slug);
    }

    /*
    * @param $data
    * @return mixed|void
    */

    public function update($request_data, $slug)
    {
        $data = $this->show($slug);
        $data->update([
            'expense_category_id' => $request_data->validated('expense_category_id'),
            'user_id' => $request_data->validated('user_id'),
            'amount' =>  $request_data->validated('amount'),
            'date' => $request_data->validated('date') ?? Carbon::now()->format('Y-m-d'),
            'notes' =>  $request_data->validated('notes'),
        ]);
        return $data;
    }

    public function delete($slug)
    {
        return $this->show($slug)->delete();
    }

    public function mapDataProcess($data){
        return $data->map(fn($expense) => [
            'expense_id' => $expense->id,
            'user_id' => $expense->user_id,
            'expense_category_id' => $expense->expense_category_id,
            'expense_amount' => $expense->amount,
            'expense_date' => Carbon::parse($expense->date)->format('d M Y'),
            'expense_notes' => $expense->notes,
            'create_date' => $expense->created_at->format('Y-m-d H:i'),
            'expense_category' => $expense->category,
            // 'user' => $expense->user,  // If needed
        ]);
    }
}
