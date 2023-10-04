<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Repositories\Expense\ExpenseInterface;
use App\Services\Expense\ExpenseService;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    use ApiResponse;

    public function __construct(protected ExpenseInterface $expenseRepository){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request('per_page');
        $data = $this->expenseRepository->allPaginate($perPage);
        $metadata['count'] = count($data);
        $metadata['total_expense'] = (new ExpenseService())->calculateTotalExpense();
        if(!$data){
            return $this->ResponseSuccess([], null, 'No Data Found!');
        }
        return $this->ResponseSuccess(
            $data, $metadata
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        try {
            $data = $this->expenseRepository->store($request);
            return $this->ResponseSuccess($data, null, 'Data Stored Successfully!', 201);
        } catch (\Exception $e) {
            return $this->ResponseError($e->getMessage(), null, 'Data Process Error! Consult Tech Team');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $data = $this->expenseRepository->show($slug);
        if(!$data){
            return $this->ResponseSuccess([], null, 'No Data Found!', 200);
        }
        return $this->ResponseSuccess(ExpenseResource::make($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, string $slug)
    {
        try {
            $data = $this->expenseRepository->update($request, $slug);
            return $this->ResponseSuccess(ExpenseResource::make($data), null, 'Data Updated Successfully!', 200);
        } catch (\Exception $e) {
           return $this->ResponseError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try {
            $data = $this->expenseRepository->delete($slug);
            return $this->ResponseSuccess($data, null, 'Data Updated Successfully!', 200);
        } catch (\Exception $e) {
           return $this->ResponseError($e->getMessage());
        }
    }
}
