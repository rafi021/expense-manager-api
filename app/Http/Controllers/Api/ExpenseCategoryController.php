<?php

namespace App\Http\Controllers\Api;

use App\Trait\ApiResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\DataTransferObjects\ExpenseCategoryDTO;
use App\Http\Resources\ExpenseCategoryResource;
use App\Services\Expense\ExpenseCategoryService;
use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;

class ExpenseCategoryController extends Controller
{
    use ApiResponse;

    public function __construct(protected ExpenseCategoryService $service){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->service->index();
        $metadata['count'] = count($data);
        if(!$data){
            return $this->ResponseSuccess([], null, 'No Data Found!');
        }
        return $this->ResponseSuccess(
            ExpenseCategoryResource::collection($data), $metadata
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseCategoryRequest $request)
    {
        try {
            $category = $this->service->store(ExpenseCategoryDTO::fromApiRequest($request));
            return $this->ResponseSuccess( ExpenseCategoryResource::make($category));
        } catch (\Exception $e) {
            return $this->ResponseError($e->getMessage(), null, 'Data Process Error! Consult Tech Team');
        }
    }

    /**
     * Display the specified resource.
     * Model Binding Approach
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        if(!$expenseCategory){
            return $this->ResponseSuccess([], null, 'No Data Found!');
        }
        return $this->ResponseSuccess(
            ExpenseCategoryResource::make($expenseCategory)
        );
    }

    /**
     * Update the specified resource in storage.
     *  Model Binding Approach
     */
    public function update(UpdateExpenseCategoryRequest $request, ExpenseCategory $expenseCategory)
    {
        try {
            $category = $this->service->update($expenseCategory, ExpenseCategoryDTO::fromApiRequest($request));
            return $this->ResponseSuccess(ExpenseCategoryResource::make($category));
        } catch (\Exception $e) {
            return $this->ResponseError($e->getMessage(), null, 'Data Process Error! Consult Tech Team');
        }
    }

    /**
     * Remove the specified resource from storage.
     *  Normal slug to id approach
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        try {
            $data = $this->service->delete($expenseCategory->id);
            return $this->ResponseSuccess($data, null, 'Data Deleted Successfully!', 204);
        } catch (\Exception $e) {
           return $this->ResponseError($e->getMessage());
        }
    }
}
