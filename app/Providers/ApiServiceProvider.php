<?php

namespace App\Providers;

use App\Repositories\Expense\ExpenseInterface;
use App\Repositories\Expense\ExpenseRepository;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ExpenseInterface::class,
            ExpenseRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
