<?php

namespace Tests\Feature;

use App\Models\ExpenseCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ExpenseCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_api_returns_expense_category(): void
    {
        /* Act */
        $response = $this->getJson('/api/v1/expense-category');

        /* Assert */
        $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'expense_category_id',
                    'expense_title',
                    'expense_slug',
                    'expense_percentage',
                    'expenses' => [
                        'id',
                        'user_id',
                        'amount',
                        'date',
                    ]
                ]
            ]
        ]);
    }

    public function test_api_create_expense_category():void{
        /* Arrange */
        $payload = [
            'title' => 'New Expense Category'
        ];

        /* Act */
        $response = $this->postJson('/api/v1/expense-category', $payload);

        /* Assert */
        $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            "data" => [
                "expense_category_id",
                "expense_category_title",
                "expense_category_slug",
                "stored_date",
                "expense_percentage",
            ],
        ]);
    }
}
