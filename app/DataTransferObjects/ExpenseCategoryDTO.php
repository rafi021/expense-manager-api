<?php

namespace App\DataTransferObjects;

use App\Http\Requests\StoreExpenseCategoryRequest;

class ExpenseCategoryDTO
{
    public function __construct(
        public readonly string $title,
    ){}

    /*
        Form Request DTO Export for API
    */

    public static function fromApiRequest($request){
        return new self(
            title: $request->validated('title'),
        );
    }


}
