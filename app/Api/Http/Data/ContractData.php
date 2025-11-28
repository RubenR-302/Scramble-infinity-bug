<?php

namespace App\Api\Http\Data;

class ContractData extends AbstractApiData
{
    public function __construct(
        public int $id,
        public int $employeeId,
        public string $contractType,
        public float $salary,
        public ?EmployeeData $employee = null,
    ) {
    }
}
