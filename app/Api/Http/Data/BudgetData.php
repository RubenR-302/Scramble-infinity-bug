<?php

namespace App\Api\Http\Data;

class BudgetData extends AbstractApiData
{
    public function __construct(
        public int $id,
        public int $departmentId,
        public float $amount,
        public int $fiscalYear,
        public ?DepartmentData $department = null,
    ) {
    }
}
