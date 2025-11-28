<?php

namespace App\Api\Http\Data;

class DepartmentData extends AbstractApiData
{
    public function __construct(
        public int $id,
        public string $name,
        public string $code,
        public ?BudgetData $budget = null,
    ) {
    }
}
