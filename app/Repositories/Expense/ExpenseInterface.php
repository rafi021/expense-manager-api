<?php

namespace App\Repositories\Expense;

use App\Interfaces\BaseInterface;

interface ExpenseInterface extends BaseInterface
{
    public function mapDataProcess($data);
}
